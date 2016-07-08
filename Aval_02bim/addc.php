<!-- Conteudo -->
<div class="conteudo">
<?php
	require_once 'init.php';
	include_once 'cliente.class.php';
	
	 // pega os dados do formulário
	 $nome = isset($_POST['txtNome']) ? $_POST['txtNome'] : null;
	 $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : null;
	 $data = isset($_POST['txtData']) ? $_POST['txtData'] : null;
	 
 	if ( empty($nome) || empty($data) || empty($email)){
		
		header('Location:index.php');		
		exit;
	}

	 // instancia objeto cliente
	 $cliente = new clientes($nome, $email, $data);
	
	 
	 // insere no BD
	 $PDO = db_connect();
	 $sql ="INSERT INTO clientes(nomeCliente, email, dataCadastro) VALUES(:nome, :email, :data)";
	 $stmt = $PDO->prepare($sql);
	 $stmt->bindParam( ':nome' , $cliente->getNome());
	 $stmt->bindParam( ':data' , $cliente->getData());
	 $stmt->bindParam( ':email' , $cliente->getEmail());
	 
	
	 
	 if($stmt->execute())
	 {
		header('Location:index.php');
		
	 }
	 else
	 {
		 echo"Erro ao cadastrar cliente.";
		 print_r($stmt->errorInfo());
	 }
?>
</div>
