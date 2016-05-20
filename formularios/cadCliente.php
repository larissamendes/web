<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Cadastro</title>	
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Os dados informados são:</h1>
		<?php
			$camposOK=true;
			//Recebe o valor dos campos//
			$nome = $_POST["txtNome"];			
			$ender = $_POST["txtEndereco"];			
			$cpf = $_POST["txtCPF"];
			$estado = $_POST["listEstados"];
			$dtNasc = $_POST["txtData"];
			$data = explode("/",$dtNasc);
			$sexo = $_POST["sexo"];
			$cinema = $_POST["checkCinema"];
			$musica = $_POST["checkMusica"];
			$info = $_POST["checkInfo"];
			$login = $_POST["txtLogin"];
			$senha1 = $_POST["txtSenha1"];
			$senha2 = $_POST["txtSenha2"];
			
			//Verifica os campos//
			if ( $nome == "" ){
				echo "Informe o nome <br>";
				$camposOK = false;
			}
			if ( $ender == "" ){
				echo "Informe o endereço <br>";
				$camposOK = false;
			}
			//Verificação das senhas//
			if ( $senha1 != $senha2 ){
				echo "As senhas não conferem <br>";
				$camposOK = false;
			}
			//Valida CPF
				if(empty($cpf)) {
					$camposOK = false;	
					echo "<b>CPF Inválido</b>";
				}
				$cpf = ereg_replace('[^0-9]', '', $cpf);
				$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
     
				if (strlen($cpf) != 11) {
					echo "<b>CPF Inválido</b>";
				}else if ($cpf == '00000000000' || 
				$cpf == '11111111111' || 
				$cpf == '22222222222' || 
				$cpf == '33333333333' || 
				$cpf == '44444444444' || 
				$cpf == '55555555555' || 
				$cpf == '66666666666' || 
				$cpf == '77777777777' || 
				$cpf == '88888888888' || 
				$cpf == '99999999999') {
				$camposOK = false;
				echo "<b>CPF Inválido</b>";
				
				}else{   
				for ($t = 9; $t < 11; $t++) {
					for ($d = 0, $c = 0; $c < $t; $c++){
						$d += $cpf{$c} * (($t + 1) - $c);
					}
					$d = ((10 * $d) % 11) % 10;
						if ($cpf{$c} != $d) {
							$camposOK = false;
							echo "<b>CPF Inválido</b>";
						}
				}
			}

			
			//Validação da data
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
			
			if( $camposOK ){
				echo "<TABLE border='0' cellpadding='5'>";
				echo "<tr><td>Nome: </td><td><b> $nome </b></td></tr>";
				echo "<tr><td>CPF: </td><td><b> $cpf </b></td></tr>";
				echo "<tr><td>Endereço: </td><td><b> $ender </b></td></tr>";
				echo "<tr><td>Estado: </td><td><b> $estado </b></td></tr>";
				echo "<tr><td>Data de Nascimento: </td><td><b> $dtNasc </b></td></tr>";
				echo "<tr><td>Sexo: </td><td><b> $sexo </b></td></tr>";
				echo "<tr><td>Login: </td><td><b> $login </b></td></tr>";
				echo "<tr><td>Senha: </td><td><b> $senha1 </b></td></tr>";
				
				echo "<tr><td>Áreas de interesse: </td><td><b>";
				  if($cinema == true){
					echo "Cinema <br>";  
				  }
				  if($musica){
					echo "Música <br>";  
				  }
				  if($info){
					echo "Informática <br>";  
				  }
				echo "</b></td></tr></TABLE>";
			}
		?>
	</body>
</html>
