<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
	<title>PHP_File-Upload</title>
</head>
<body>
    <div class="menu">
        <ul>
            <li><a href="?action=image">Upload file image</a></li>
            <li><a href="?action=zip">Upload file zip</a></li>
            <li><a href="upload/">Upload</a></li>
        </ul>
    </div>
	<div class="content">
		<form action="#" method="POST" enctype="multipart/form-data" id="main-form">
			<p>Select image to upload</p>
			<input type="file" name="file_upload">
			<input type="submit" name="submit" value="Upload">
		</form>
		<?php
			if (isset($_POST["submit"])) {
				$target_dir  = "upload/";
				$target_dir .= basename($_FILES["file_upload"]["name"]);

				$upload_name = $_FILES["file_upload"]["name"];
				$upload_size = $_FILES["file_upload"]["size"];
				$upload_type = $_FILES["file_upload"]["type"];

				if ($upload_type == "image/jpeg" or $upload_type == "image/png") {
					if (!move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_dir)) {
						echo "File Eror123";
					}else{
						echo "{$target_dir} succesfully!!!";
					}
				}else{
					echo "File Eror";
				}
			}
		?>
	</div>
</body>
</html>