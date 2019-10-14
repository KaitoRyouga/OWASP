<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Broken Auth</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login">
           <a href="index.php"> <button class="button" type="button">Login</button></a>      
           <a href="logout.php"> <button class="button" type="button">Logout</button></a>      
    </div>
	<div class="menu">
		<ul>
			<li><a href="#">Home</a></li>
		</ul>
	</div>
	<?php
		session_start();

		echo '</br>Login sucessfully with account '.$_SESSION["username"].'';
	?>
</body>
</html>
<script type="text/javascript"></script>