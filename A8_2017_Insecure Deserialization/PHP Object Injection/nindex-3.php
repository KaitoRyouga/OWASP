<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>SD</title>
</head>
<body>
    <div class="menu">
        <ul>
            <li><a href='?r=a:4:{i:0;s:5:"Hello";i:1;s:13:"This is a Web";i:2;s:20:"PHP Object Injection";i:3;s:11:"KaitoRyouga";}' type="submit">CLICK HERE</a></li>
        </ul>
    </div>
    <div class="content">
        <?php 
            class PHPObjectInjection{
                public $inject;
                function __construct(){

                }

                function __wakeup(){
                    if(isset($this->inject)){
                        eval($this->inject);
                    }
                }
            }
            if(isset($_REQUEST['r'])){  

                $var = unserialize($_REQUEST['r']);
                
                if(is_array($var)){ 
                    echo "<br/>".$var[0]." - ".$var[1] ." ". $var[2] . " - " . $var[3];
                }
            }else{
                echo "";
            }
        ?>
    </div>
</body>
</html>