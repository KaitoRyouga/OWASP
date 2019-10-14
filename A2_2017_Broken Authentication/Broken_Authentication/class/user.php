<?php
	/**
	 * 
	 */
	class user
	{	
		public $pdo;

		public function connect()
		{
			if (session_status() === PHP_SESSION_ACTIVE) {
				try {
					$dbhost = 'localhost';
					$dbname='brokenauth';
					$dbuser = 'root';
					$dbpass = 'kaitoryouga';
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
					$this->pdo = $pdo;
					return true;
				}catch (PDOException $e) {
					echo "Error : " . $e->getMessage() . "<br/>";
					die();
				}
			}else{
				return false;
			}
		}

		public function login($username, $password)
		{
			$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('SELECT USER,PASS FROM user');
			$sql->execute();
			$user = $sql->fetchAll();

			foreach ($user as $key => $value) {
				if ($value[0] == $username and $value[1] == $password) {
					return true;
				}
			}
			return false;
		}
	}

?>