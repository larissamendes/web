<?php
	require_once 'init.php';
 	include_once 'aluno.class.php';
 	// validação da imagem
 	$dadosOK = true;
 	$arquivo = $_FILES['txtFoto'];
 	if ($arquivo['error'] != 0){
 		echo "Erro no UPLOAD do arquivo.<br>";
 		$dadosOK = false;
		exit;
 	}else{
 		// Verificando o tamanho
 	if (($arquivo['size'] == 0) || ( $arquivo['size'] > 100000)) {
 		echo "Erro no tamanho do arquivo.<br>";
 		$dadosOK = false;
 		exit;
 	}else{
 		// Verificando o tipo do arquivo
 		if (($arquivo['type'] != "image/gif") &&
 			($arquivo['type'] != "image/jpeg") &&
 			($arquivo['type'] != "image/pjpeg") &&
 			($arquivo['type'] != "image/x-png") &&
 			($arquivo['type'] != "image/png") &&
 			($arquivo['type'] != "image/bmp") ){

 			echo "Erro no arquivo. Tipo não permitido <br>";
 			$dadosOK = false;
 			exit;
 	}else {
 		// diretorio de destino //DUVIDA!!
 		$file_src = '../../ tmp / '. $_FILES['txtFoto']['name'];
 		// funcao para mover o arquivo do diretorio temporario
 		if (!move_uploaded_file ( $_FILES["txtFoto"]["tmp_name"],$file_src)){
 			echo "Erro ao mover arquivo:".$arquivo["error"]."<br>";
 			$dadosOK = false;
 		exit;
 			}
 		}
	 }
 }

		 // pega os dados do formulário
		 $id = isset ($_POST['id']) ? $_POST['id']:null;
 		$name = isset ( $_POST ['txtNome']) ? $_POST ['txtNome']:null;
 		$dataNasc = isset ($_POST['txtData']) ? $_POST ['txtData']:null;
 		// validação simples se campos estão vazios
 		if (empty ($name) || empty ($dataNasc))
 		{
 			echo "Campos devem ser preenchidos!!";
 			exit;
 		}
 		// instancia objeto aluno
 		$aluno = new Aluno ($name,$dataNasc,$file_src);
 		// atualiza o BD
 		$PDO = db_connect();
 		$sql = "UPDATE aluno SET nome = :name,dataNasc = :data, foto = :foto
			WHERE idAluno = : id";
 		$stmt = $PDO-> prepare($sql);
		$stmt-> bindParam(': name ', $aluno-> getNome());
 		$stmt-> bindParam(': data ', $aluno-> getDataNasc());
 		$stmt-> bindParam(': foto ',$aluno-> getFoto());
 		$stmt-> bindParam(': id ', $id,	PDO::PARAM_INT);

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
