<div class="conteudo">

<?php
	require_once 'init.php';
 	include_once 'cliente.class.php';
 	
 			 // pega os dados do formulário
		$id = isset($_POST['id']) ? $_POST['id'] : null;
 		$nome = isset($_POST ['txtNome']) ? $_POST ['txtNome'] : null;
 		$email= isset($_POST['txtEmail']) ? $_POST['txtEmail'] : null ;
 		$data = isset($_POST['txtData']) ? $_POST['txtData'] : null ;
	
 		
 	 validação simples se campos estão vazios
 		if (empty($nome) || empty($data)|| empty($email)){
 			header ('Location:index.php');
 			exit;
 		}
 		
 		// instancia objeto aluno
 		$cliente = new clientes($nome,$email,$data);
 		
 		// atualiza o BD
 		$PDO = db_connect();
 		$sql = "UPDATE clientes SET nomeCliente = :nome,dataCadastro = :data, email = :email WHERE idCliente = :id";
 		$stmt = $PDO-> prepare($sql);
		$stmt-> bindParam(':nome', $cliente-> getNome());
 		$stmt-> bindParam(':data', $cliente-> getData());
 		$stmt-> bindParam(':email',$cliente-> getEmail());
 		$stmt-> bindParam(':id', $id,	PDO::PARAM_INT);

 		if ($stmt->execute())
 		{
 			header ('Location:index.php');
 		}
 		else
 		{
 			echo "Erro ao alterar";
 			print_r($stmt->errorInfo());
 		}
 		?>
</div>

