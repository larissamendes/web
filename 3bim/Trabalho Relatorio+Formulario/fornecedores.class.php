<?php 
	class fornecedores{
		//decarando variaveis//
		private $nome;
		private $email;
		private $data;

		//construtor//
		public function __construct($nome, $email, $data){
			$this->setNome($nome);
			$this->setEmail($email);
			$this->setData($data);
		}
		//pega e entrega NOME//
		public function setNome($nome){
			$this->nome= $nome;
		}
		public function getNome(){
			return $this->nome;
		}
		//pega e entrega DATA NASCIMENTO//
		public function setData($data){
			$dataC = explode('/',$data);
			$this->data= "$dataC[2]-$dataC[1]-$dataC[0]";			
		}
		public function getData(){
			return $this->data;
		}
		//pega e entrega FOTO//
		public function setEmail($email){
			$this->email= $email;
		}
		public function getEmail(){
			return $this->email;
		}
	}

?>
