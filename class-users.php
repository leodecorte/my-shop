<?php 

Class Users {

	private $pdo;

	public function __construct($dbname, $host, $user, $password) {
		

		try {
			$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $password);
		}
		
		catch (PDOException $e) {
			echo "Database Error: ".$e->getMessage();
			exit();

		}

		catch (Exception $e) {
			echo "Generic Error: ".$e->getMessage();
			exit();

		}
	}

		public function searchUsers() {

			$res = array();

			$cmd = $this->pdo->query("SELECT * FROM users ORDER BY id desc");

			$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}

		public function signUp($password, $email) {

			$cmd = $this->pdo->prepare("SELECT id FROM users WHERE email = :e");
			$cmd->bindValue(":e", $email);
			$cmd->execute();
			if ($cmd->rowCount() > 0) {
				return false;
			} else {
				$cmd = $this->pdo->prepare("INSERT INTO users (email, password) VALUES (:e, :p)");
				
				$cmd->bindValue(":e",$email);
				$cmd->bindValue(":p",$password);
				$cmd->execute();
				return true;
			}
		}

		public function deleteUser($id) {

			$cmd = $this->pdo->prepare("DELETE FROM users WHERE ID = :id");
			$cmd->bindValue(":id", $id);
			$cmd->execute();
		}

		public function searchData($id) {

			$res = array();

			$cmd = $this->pdo->prepare("SELECT * FROM users WHERE ID = :id");
			$cmd->bindValue(":id", $id);
			$cmd->execute();
			$res = $cmd->fetch(PDO::FETCH_ASSOC);
			return $res;
		}

		public function updateUser($id, $email, $password) {

			$cmd = $this->pdo->prepare("UPDATE users SET email = :e, password = :p WHERE ID = :id");
			
			$cmd->bindValue(":e", $email);
			$cmd->bindValue(":p", $password);
			$cmd->bindValue(":id", $id);
			$cmd->execute();
			return true;
		}

		



	
}


?>