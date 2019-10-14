<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="home.css">
    <meta charset="UTF-8">
    <title>Directory Traversal</title>
    <?php

        function show_file($file)
        {
            if (is_file($file)) {
                $file_open = fopen($file, "r") or die("Couldn't open $file.");
                while (!feof($file_open)) {
                    echo fgets($file_open) . "</br>" ;
                }
                fclose($file_open);
            }else{
                echo "This file doesn't exist!";
            }
        }

    ?>
</head>
<body>
    <div class="menu">
        <ul>
            <li><a href="?action=file">Show file</a></li>
            <li><a href="?action=directory">Show directory</a></li>
        </ul>
    </div>

    <div class="file">
        <ul>
            <li><a href="?file=1.txt">1.txt</a></li>
            <li><a href="?file=2.txt">2.txt</a></li>
        </ul>
    </div>

    <?php
        if (!empty($_GET['file'])) {
            $file = $_GET['file'];
            show_file($file);
        }
    ?>
</body>
</html>