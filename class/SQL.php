 <?php
	
	//classe PDO já é nativa do sistema
	class SQL extends PDO {

		private $connection;

		public function __construct() {

			$this->connection = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");

		}

		private function setParam($statement, $key, $value) {

			$statement->bindParam($key, $value);

		}

		private function setParams($statement, $parameters = array()) {

			foreach ($parameters as $key => $value) {
				
				$this->setParam($statement, $key, $value);

			}

		}

		public function query($rawQuery, $params = array()) {

			$statement = $this->connection->prepare($rawQuery);

			$this->setParams($statement, $params);

			$statement->execute();

			return $statement;

		}

		public function select($rawQuery, $params = array()):array {

			$statement = $this->query($rawQuery, $params);

			return $statement->fetchAll(PDO::FETCH_ASSOC);

		}

	}

?>


