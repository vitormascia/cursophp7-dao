<?php
	
	//classe PDO já é nativa do sistema
	class SQL extends PDO {

		private $connection;

		public function __construct() {

			$this->connection = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");

		}

		private function setParam($statment, $key, $value) {

			$statment->bindParam($key, $value);

		}

		private function setParams($statment, $parameters = array()) {

			foreach ($parameters as $key => $value) {
				
				$this->setParam($key, $value);

			}

		}

		public function query($rawQuery, $params = array()) {

			$statment = $this->connection->prepare($rawQuery);

			$this->setParams($statment, $params);

			$statment->execute();

			return $statment;

		}

		public function select($rawQuery, $params = array()):array {

			$statment = $this->query($rawQuery, $params);

			return $statment->fetchAll(PDO::FETCH_ASSOC);

		}

	}

?>


