<?php 
	class clientes{
		//decarando variaveis//
		private $nomeCliente;
		private $email;
		private $dataCadastro;

		//construtor//
		public function __construct($nomeCliente, $email, $dataCadastro){
			$this->setNome($nomeCliente);
			$this->setEmail($email);
			$this->setData($dataCadastro);
		}
		//pega e entrega NOME//
		public function setNome($nomeCliente){
			$this->nomeCliente = $nomeCliente;
		}
		public function getNome(){
			return $this->nomeCliente;
		}
		//pega e entrega DATA NASCIMENTO//
		public function setData($dataCadastro){
			$data = explode('/', $dataCadastro);
			$this->dataCadastro = "$data[2]-$data[1]-$data[0]";			
		}
		public function getData(){
			return $this->dataCadastro;
		}
		//pega e entrega EMAIL//
		public function setEmail($email){
			$this->email= $email;
		}
		public function getEmail(){
			return $this->email;
		}
	}

?>
