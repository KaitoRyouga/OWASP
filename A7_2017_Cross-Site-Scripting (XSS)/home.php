<!DOCTYPE html>
<html lang="en">
<head>
	<title>Photo Gallery HTML Template</title>
	<meta charset="UTF-8">
	<meta name="description" content="Photo Gallery HTML Template">
	<meta name="keywords" content="endGam,gGaming, magazine, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Top right elements -->
	<div class="spacial-controls">
		<div class="search-switch"><img src="img/search-icon.png" alt=""></div>
		<div class="nav-switch-warp">
			<div class="nav-switch">
				<div class="ns-bar"></div>
			</div>
		</div>
	</div>
	<!-- Top right elements end -->

	<div class="main-warp">
		<!-- header section -->
		<header class="header-section">
			<div class="header-close">
				<i class="fa fa-times"></i>
			</div>
			<div class="header-warp">
				<a href="" class="site-logo">
					<img src="./img/logo.png" alt="">
				</a>
				<img src="img/menu-icon.png" alt="" class="menu-icon">
				<ul class="main-menu">
					<li class="active"><a href="./home.php">Home</a></li>
					<li><a href="./gallery.html">Gallery</a></li>
					<li><a href="./gallery-single.html">Single gallery</a></li>
					<li><a href="./blog.html">Blog</a></li>
					<li><a href="./contact.html">Contact</a></li>
					<?php
						session_start();
						if ($_SESSION['userid'] == 'QWRtaW') {
							echo '<li><a href="ask.php">Ask</a></li>';
						}
					?>
					<li><a href="edit.php">Edit</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
			<div class="copyright">Colorlib 2018  @ All rights reserved</div>
		</header>
		<!-- header section end -->

		<!-- Page section -->
		<div class="page-section home-page">
			<div class="hero-slider owl-carousel">
				<?php
					session_start();
					require_once 'class/edit.php';

					$edit = new edit();

					$edit->add_select();
				?>
			</div>
			<div id="snh-1"></div>
		</div>
		<!-- Page section end-->
	</div>

	<!-- Search model -->
	<div class="search-model">
		<div class="h-100 d-flex align-items-center justify-content-center">
			<div class="search-close-switch">x</div>
			<form class="search-moderl-form">
				<input type="text" id="search-input" placeholder="Search here.....">
			</form>
		</div>
	</div>
	<!-- Search model end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/isotope.pkgd.min.js"></script>
	<script src="js/imagesloaded.pkgd.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>
