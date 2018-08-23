<?php

	class User {

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario() {
			return $this->idusuario;
		}

		public function setIdusuario($value) {
			$this->idusuario = $value;
		}

		public function getDeslogin() {
			return $this->deslogin;
		}

		public function setDeslogin($value) {
			$this->deslogin = $value;
		}

		public function getDessenha() {
			return $this->dessenha;
		}

		public function setDessenha($value) {
			$this->dessenha = $value;
		}

		public function getDtcadastro() {
			return $this->dtcadastro;
		}

		public function setDtcadastro($value) {
			$this->dtcadastro = $value;
		}

		public function loadById($id) {

			$sql = new SQL();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id
			));

			//Busca por ID só vai encontrar 1
			//$results é um array indexado de arrays associativos
			if (count($results) > 0) {
				
				$row = $results[0];

				$this->setIdusuario($row['idusuario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDessenha($row['dessenha']);
				$this->setDtcadastro(new DateTime($row['dtcadastro']));

			}

		}

		public static function getList() {

			$sql = new SQL();

			$results = $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

			return json_encode($results);

		}

		public static function search($login) {

    		// % (The percent sign represents zero, one, or multiple characters)
   			// _ (The underscore represents a single character)

			$sql = new SQL();

			$results = $sql->select("SELECT * 
				FROM tb_usuarios 
				WHERE deslogin 
				LIKE :SEARCH 
				ORDER BY deslogin",
				array(":SEARCH"=>"%".$login."%")
			);

			return json_encode($results);

		}

		public function login($login, $password) {

			$sql = new SQL();

			$results = $sql->select("SELECT * 
				FROM tb_usuarios 
				WHERE (deslogin = :LOGIN) AND (dessenha = :PASSWORD)", 
				array(":LOGIN"=>$login, ":PASSWORD"=>$password)
			);

			if (count($results) > 0) {
				
				$row = $results[0];

				$this->setIdusuario($row['idusuario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDessenha($row['dessenha']);
				$this->setDtcadastro(new DateTime($row['dtcadastro']));

			} else {

				throw new Exception("Login e/ou senha inválidos!");
				
			}

		}

		public function __toString() {

			return json_encode(array(
				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d-m-Y H:i:s")
			));

		}

	}

?>