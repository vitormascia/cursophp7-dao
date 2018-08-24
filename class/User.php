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

		public function setData($data) {

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));

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
				$this->setData($row);

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
				$this->setData($row);

			} else {

				throw new Exception("Login e/ou senha inválidos!");
				
			}

		}

		public function insert() {

			$sql = new SQL();
			 
			// store procedure_nome da tabela_o que vai fazer
			// Usando o MySQL, procedure chama com CALL, se fosse SQLServer seria EXECUTE
			# Usado para receber as informações que não tenho no código (pois gera automático no BD),
    		# que no caso é o ID e a data de cadastro.
			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",
				array(":LOGIN"=>$this->getDeslogin(), ":PASSWORD"=>$this->getDessenha())
			);

			if (count($results) > 0) {
				
				$row = $results[0];
				$this->setData($row);

			}

		}

		public function update($login, $password) {

			$this->setDeslogin($login);
			$this->setDessenha($password);
			
			$sql = new SQL();

			$sql->query("UPDATE tb_usuarios 
				SET (deslogin = :LOGIN, dessenha = :PASSWORD) 
				WHERE idusuario = :ID",
				array(":LOGIN"=>$this->getDeslogin(), ":PASSWORD"=>$this->getDessenha(), ":ID"=>$this->getIdusuario())
			);

		}

		// Para que não seja necessário passar $login e $password toda vez que estanciar um objeto ( $user = new User(); )
		// Caso não passar nada no parâmetro, $login e $password são alimentados com vazio ("")
		// Ou seja, deixa de ser obrigatório a passagem de parâmetro
		public function __construct($login = "", $password = "") {

			$this->setDeslogin($login);
			$this->setDessenha($password);

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