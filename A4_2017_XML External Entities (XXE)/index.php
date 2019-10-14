<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="home.css">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <div class="menu">
        <ul>
            <li><a href="#">Connect</a></li>
        </ul>
    </div>

     <?php
        libxml_disable_entity_loader (false);
        $xmlfile = file_get_contents('php://input');
        
        $doc = new DOMDocument();

        $doc->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);

        $login = simplexml_import_dom($doc);

        echo $login->username;
        echo $login->password;
       
    ?>
</body>

</html>