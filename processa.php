<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Cadastro</title>	
		<meta charset="utf-8">
	</head>
	<body>
		<?php
			include_once 'aluno.class.php';
			include_once 'conexao.class.php';
			$camposOK=true;
			
			//Recebe o valor dos campos//
			$arquivo = $_FILES["txtFoto"]; //file metodo de envio de aquivos
			$nome = $_POST["txtNome"]; //post metodo de envio de dados			
			$dtNasc = $_POST["txtData"];
			$data = explode("/",$dtNasc);
	
			//Verifica nome//
			if ( $nome == "" ){
				echo "Informe o nome <br>";
				$camposOK = false;
			}
			
			//Valida data//
			if (($data[2] <= 2016) && ($data[2]>0000)){				
				if (($data[1] == 04) || ($data[1] == 06)  || ($data[1] == 09) || ($data[1] == 11)){
					if(($data[0] <= 30) && ($data[0] > 00)){	
					}else{	
						$camposOK = false;
					}
				} else if (($data[1] == 01) || ($data[1] == 03)  || ($data[1] == 05) || ($data[1] == 07) || ($data[1] == 08)|| ($data[1] == 10)|| ($data[1] == 12) ){
					if(($data[0] <= 31) && ($data[0] > 00)){	
					}else{	
						$camposOK = false;
					}
				}else if ($data[1] == 02){
					if ($data[2] % 4 ==0){
						if ($data[2] % 100 !=0){
							if ($data[0] <= 29){
							} else if ($data[2] % 400 ==0){
									if (($data[0] <= 29) && ($data[0] > 00)){						
									}else{	
										$camposOK = false;
									}
							} else if (($data[0] <= 28) && ($data[0] > 00)){
								}else{
									$camposOK = false;
								}
						}else{
							$camposOK = false;
						}
					}else{
						echo "A data está inválida <br>";
						$camposOK = false;
					}
				}
			}
			
			//Verifica Foto//
			if($arquivo['error']!= 0 || $arquivo['size'] == 0){
				echo "Erro no envio do arquivo <br>";
				$camposOK = false;	
							
			}
			if($arquivo['size'] > 100000){
				echo "Tamanho maior que o permitido";
				$camposOK = false;
			} 
			if(($arquivo['type'] != "image/gif") &&
			($arquivo['type'] != "image/jpeg") && 
			($arquivo['type'] != "image/png") &&
			($arquivo['type'] != "image/bng") &&
			($arquivo['type'] != "image/jpg")){
				echo "Tipo de arquivo inválido";
				$camposOK = false;
			}
			
			$file_src= 'tmp/'.$_FILES['txtFoto']['name'];
			if(!move_uploaded_file($_FILES['txtFoto']['tmp_name'],$file_src)){
				echo "Erro ao mover arquivo";
				$camposOK = false;
			}
			
			//Escrever tudo
			if( $camposOK ){
				$mysqlimg = addslashes(fread(fopen($file_src, "rb"),$arquivo['size']));//caminho do arquivo, r=read-leitura b=binario//  
				$aluno = new Aluno($nome,$dtNasc,$mysqlimg);
				$MySQL = new MySQL;
				
				try{
					$MySQL->inserirAluno($aluno->getNome(), $aluno->getDataNasc(), $aluno->getFoto());
					echo "Dados gravados com sucesso <br>";
				}catch (Exception $e){
					echo "Erro ao inserir: ". $e->getMessage() . "<br>" ;
				}
			}
		?>
	</body>
</html>
