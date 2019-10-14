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
					<li><a href="./home.php">Home</a></li>
					<li><a href="./gallery.html">Gallery</a></li>
					<li><a href="./gallery-single.html">Single gallery</a></li>
					<li><a href="./blog.html">Blog</a></li>
					<li class="active"><a href="edit.php">Edit</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
			<div class="copyright">Colorlib 2018  @ All rights reserved</div>
		</header>
		<!-- header section end -->

		<!-- Page section -->
		<div class="page-section contact-page">
			<div class="contact-warp">
				<div class="row">
					<div class="col-xl-6 p-0">
						<div class="contact-text">
							<span>Edit with manager permissions</span>
							<h2>Get in touch</h2>
							<form class="contact-form" action="#" method="POST" id="form_edit" enctype="multipart/form-data">
								<input type="file" name="file_upload">
								<?php
									session_start();
									require_once 'class/edit.php';

									$edit = new edit();

									if (!empty($_POST['submit_select'])) {
										$edit->ask($_POST['subject'], $_POST['messenge'], basename($_FILES["file_upload"]["name"]));
										$target_dir  = "img/";
										$target_dir .= basename($_FILES["file_upload"]["name"]);
										$imageFileType = strtolower(pathinfo(basename($_FILES["file_upload"]["name"]),PATHINFO_EXTENSION));

										if ($imageFileType == "jpg" or $imageFileType == "png" ) {
											if (!move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_dir)) {
												$edit->msg = "File error";
												$edit->print_msg();
											}else{
												$edit->save_name(basename($_FILES["file_upload"]["name"]));
												header('location:index.php');
											}
										}else{
											$edit->msg = "File error";
											$edit->print_msg();
										}
									}
								?>
								<input type="text" placeholder="Your account" name="account">
								<input type="text" placeholder="Subject" name="subject">
								<textarea placeholder="Message" name="messenge"></textarea>
								<!-- <button class="site-btn" type="submit" name="submit_select" form="form_edit">Send edit</button> -->
								<input class="site-btn" type="submit" name="submit_select" value="Edit">
							</form>
						</div>
					</div>
				</div>
			</div>
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
