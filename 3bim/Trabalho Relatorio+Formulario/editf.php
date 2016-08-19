
<div class="conteudo">

<?php
	require_once 'init.php';
 	include_once 'fornecedores.class.php';
 	
 			 // pega os dados do formulário
		 $id = isset ($_POST['id']) ? $_POST['id']:null;
 		$nome = isset ( $_POST ['txtNome']) ? $_POST ['txtNome']:null;
 		$email= isset ($_POST['txtEmail'])?$_POST['txtEmail']:null ;
 		$data = isset ($_POST['txtData'])?$_POST['txtData']:null ;
	
 		// validação simples se campos estão vazios
 		if (empty($nome) || empty($data) || empty($email)){
 			header ('Location:index.php');
 			exit;
 		}
 		
 		// instancia objeto aluno
 		$fornecedor = new fornecedores($nome,$email,$data);
 		
 		
 		// atualiza o BD
 		$PDO = db_connect();
 		$sql = "UPDATE fornecedores SET nomeFornecedor = :nome, email = :email,dataFundacao = :data WHERE idFornecedor = :id";
 		$stmt = $PDO-> prepare($sql);
		$stmt-> bindParam(':nome', $fornecedor-> getNome());
 		$stmt-> bindParam(':data', $fornecedor-> getData());
 		$stmt-> bindParam(':email',$fornecedor-> getEmail());
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

