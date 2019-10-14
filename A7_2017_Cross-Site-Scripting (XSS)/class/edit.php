<?php
	/**
	 * 
	 */
	class edit
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

		public function auto_fix()
        {
        	$this->connect();
        	$pdo = $this->pdo;
        	$sql_array = array('SET @num := 0', 'UPDATE ask SET id = @num := (@num+1)', 'ALTER TABLE ask AUTO_INCREMENT = 1');
			for ($i=0; $i < 3; $i++) { 
				$sql = $pdo->prepare($sql_array[$i]);
				$sql->execute();
			}
        }

        public function add_select()
        {
        	$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('SELECT * FROM img');
			$sql->execute();
			$user = $sql->fetchAll();
			$number_end = $this->check_number();
			$flag = 1;
			$flagS = 1;
			foreach ($user as $key => $value) {
				if ($this->check_lock($value[1])) {
					
				}else{
					continue;
				}
				if ($value[0] == $number_end) {
					$number = $user[0][0];
					$name = $user[0][1];
				}else{
					$number = $user[$flag++][0];
					$name   = $user[$flagS++][1];
				}
	        	echo '				
	        	<div class="slider-item d-flex align-items-center set-bg" data-setbg="img/'.$value[1].'" data-hash="slide-'.$value[0].'">
						<div class="next-slide-show set-bg" data-setbg="img/'.$name.'">
							<a href="#slide-'.$number.'" class="ns-btn">Next</a>
						</div>
				</div>';
			}
        }

        public function add_ask()
        {
        	$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('SELECT * FROM ask');
			$sql->execute();
			$user = $sql->fetchAll();
			foreach ($user as $key => $value) {
				echo '  <li>
	                       <a href="?image='.$value[3].'" onclick="onon();">
	                           <span class="mail-sender">Manager</span>
	                           <span class="mail-subject">'.$value[1].'</span>
	                           <span class="mail-message-preview">'.$value[2].'</span>
	                       </a>
	                    </li>';
			}
        }

        public function ask($subject, $messenge, $image_name)
        {
        	$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('INSERT INTO ask(SUBJECT, MESSENGE, IMAGE_NAME) VALUES(?, ?, ?)');
			$sql->execute(array("$subject", "$messenge", "$image_name"));
        }

        public function unlock($image)
        {
        	$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('UPDATE img SET LOCK_STATUS = ? WHERE NAME = ?');
			$sql->execute(array("unlock", "$image"));
        }

        public function check_lock($name)
        {
			$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('SELECT LOCK_STATUS FROM img WHERE NAME = ?');
			$sql->execute(array("$name"));
			$user = $sql->fetchAll();
			foreach ($user as $key => $value) {
				if ($value[0] == 'lock') {
				 	return false;
				}else{
					return true;
				}
			}
        }

		public function save_name($name)
		{

			$this->connect();

			$pdo = $this->pdo;
			$sql = $pdo->prepare('INSERT INTO img (NAME, LOCK_STATUS) VALUES (?, ?)');
			$sql->execute(array("$name", "lock"));

		}

		public function check_number()
		{
			$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('SELECT count(*) FROM img');
			$sql->execute();
			$user = $sql->fetchAll();
			foreach ($user as $key => $value) {
				return $value[0];
			}
		}

		public function delete_ask($image)
		{
			$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('DELETE FROM ask WHERE IMAGE_NAME = ?');
			if ($sql->execute(array("$image"))) {
				$this->auto_fix();
			}
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