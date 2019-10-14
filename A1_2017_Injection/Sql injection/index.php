<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Injection</title>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style type="text/css">
  	#tab{
    background: #2f3640;
    margin-top: 150px;
    width: 1000px;
    color: white;
}
  </style>
</head>
  <body>
    <div class="searchBox">
    	<form action="#" method="POST">
	        <input class="searchInput"type="text" name="content_search" placeholder="Search">
	        <button class="searchButton" type="submit" name="submit" formmethod="POST" value="submit">
	            <i class="material-icons">
	                search
	            </i>
	        </button>
    	</form>
    	<?php
        	if (!empty($_POST["submit"])) {
        		$search = $_POST["content_search"];
	        	$dbh  = mysqli_connect('localhost', 'root', 'kaitoryouga');
				mysqli_select_db($dbh,'sqlinjection');
				$sql_stmt = 'SELECT * FROM book WHERE BOOK = "'.$search.'"';
// SELECT * FROM book WHERE BOOK = "" or "1" = "1" union SELECT TABLE_NAME,database(),version(),table_schema FROM INFORMATION_SCHEMA.TABLES where "1" ="1";
				if (mysqli_query($dbh,$sql_stmt)) {
					$result = mysqli_query($dbh,$sql_stmt);
					$rows = mysqli_num_rows($result);
					$row = mysqli_fetch_all($result);
					echo '<table border="1" width="100%" id="tab">
							<thead>
				        		<th>ID</th>
				        		<th>BOOK</th>
				        		<th>AUTHOR</th>
				        		<th>DESCRIPTION</th>
				        	</thead>
				        	<tbody>
					';
					foreach ($row as $key => $value) {
						echo '  <tr>
				        			<td>'.$value[0].'</td>
				        			<td>'.$value[1].'</td>
				        			<td>'.$value[2].'</td>
				        			<td>'.$value[3].'</td>
				        		</tr> ';
					}
					echo '	</tbody>
				        </table>';
				}
        	}
        ?>
        <p>Harry Potter Series</p>
        <p>The Da Vinci Code</p>
        <p>The Little Prince</p>
        <p>The Lord of the Rings</p>
        <p>Animal Farm</p>
    </div>
  </body>
</html>
