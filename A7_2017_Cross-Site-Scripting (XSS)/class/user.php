<?php
	session_start();
	/**
	 * 
	 */
	class user
	{
		public $pdo;
		public $msg;
		
		public function connect()
		{
			if (session_status() === PHP_SESSION_ACTIVE) {
				try {
					$dbhost = 'localhost';
					$dbname = 'xssgallery';
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
				$this->msg = "Sever diconnect";
				return false;
			}
		}

		public function login($username, $password)
		{
			$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('SELECT USER,PASS, USERID FROM user');
			$sql->execute();
			$user = $sql->fetchAll();

			foreach ($user as $key => $value) {
				if ($value[0] == $username and $value[1] == $password) {
					$_SESSION['userid'] = $value[2];
					return true;
				}
			}
			return false;
		}

		public function check_user($ask)
		{
			$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('SELECT USER,PASS FROM user');
			$sql->execute();
			$user = $sql->fetchAll();
		}

		public function print_msg()
		{
			$msg = $this->msg;
			echo '
				<script type="text/javascript">
  					alert("'.$msg.'")
				</script>';
		}
	}
?>