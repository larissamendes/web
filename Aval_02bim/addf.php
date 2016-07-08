<div class="conteudo">
<?php
	require_once 'init.php';
	include_once 'fornecedores.class.php';

	// pega os dados do formulário
	$nome = isset ($_POST['txtNome'])?$_POST['txtNome']:null;
	$data = isset ($_POST['txtData'])?$_POST['txtData']:null ;
	$email = isset ($_POST['txtEmail'])?$_POST['txtEmail']:null ;

	// validação simples se campos estão vazios
	if( empty ( $nome ) || empty ( $data) || empty ( $email)){
		header ('Location: index.php');
		exit;
	}

	// instancia objeto aluno
	$fornecedor = new Fornecedores($nome,$email,$data);
	
	// insere no BD
	$PDO = db_connect() ;
	$sql = "INSERT INTO fornecedores(nomeFornecedor,email,dataFundacao) VALUES (:nome , :email , :data )";
	$stmt = $PDO->prepare($sql);
	$stmt->bindParam(':nome' ,$fornecedor->getNome());
	$stmt->bindParam(':data' ,$fornecedor->getData());
	$stmt->bindParam(':email' ,$fornecedor->getEmail());
	if($stmt->execute()){
		header ('Location: index.php');
	}else{
		echo "Erro ao cadastrar!!";
		print_r( $stmt->errorInfo());
	}
?>
</div>
