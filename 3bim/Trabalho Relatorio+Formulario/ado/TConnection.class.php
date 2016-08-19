<?php
	/**
		* class TConnection
		* gerencia conexões com banco de dados
		* usando arquivos de configuraçao
	**/

	final class TConnection {
	/**
		* método __construct()
		* não existirão instâncias de TConnection
		* por isso este método será private
	**/

		private function __construct(){}
		/**
			* método open()
			* recebe o nome do banco de dados,
			* verifica se existe arquivo de configuração
			* instância objet PDO correspondente
		**/

		public static function open($name){
		//verifica se existe o arquivo de configuração
			if (file_exists($name)){
			//lê o ini we retorna um array
				$db = parse_ini_file($name);
			}else{
			//se não existir lança um erro
				throw new Exception("Arquivo $name não encontrado");
			}

			//lê as informações contidas no arquivo
			$user = isset($db['user']) ? $db['user'] : NULL;	
			$pass = isset($db['pass']) ? $db['pass'] : NULL;
			$name = isset($db['name']) ? $db['name'] : NULL;
			$host = isset($db['host']) ? $db['host'] : NULL;
			$type = isset($db['type']) ? $db['type'] : NULL;
			$port = isset($db['port']) ? $db['port'] : NULL;
		
			//verifica 	ual o tipo de driver a ser utilizado
			switch ($type) {
				case 'pgsql':
					$port = $port ? $port : '5432';
					$conn = new PDO("pgsql:dbname={$name}; user={$user}; password={$pass}; host={$host}; port={$port}");
				break;
				case 'mysql':
					$port = $port ? $port : '3306';
					$conn = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
	 			break;
				case 'sqlite':
					$conn = new PDO("sqlite:{$name}");
				break;
				case 'ibase':
					$conn = new PDO("firebird:dbname={$name}, $user, $pass");
				break;
				case "oci8":
					$conn = new PDO("oci:dbname{$name}", $user, $pass);
				break;
				case "mssql":
					$conn = new PDO("mssql:host={$host}, 1433;dbname={$name}", $user, $pass);
				break;
			}
		
			//define para que o PDO lance exceções na ocorrência de erros
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			//retorna o objeto instanciado
			return $conn;
		}
	}
?>

