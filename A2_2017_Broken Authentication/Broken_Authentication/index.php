<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style_Login.css">
  <meta charset="UTF-8">
  <title>Form</title>
  <?php
    session_start();
    require_once 'class/user.php';
    if (!empty($_POST["submit"])) {
      $username = $_POST['username'];
      $password = $_POST['login'];

      $user = new user();


      if ($user->login($username, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("location:home.php");
      }else{
        header("location:index.php");
      }
    }
  ?>
</head>
<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <h2 class="active"> Sign In </h2>
      <h2 class="inactive underlineHover">Sign Up </h2>

      <!-- Icon -->
      <div class="fadeIn first">
        <img style="width: 30px; height: 30px;" src="images/user.svg" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form action="#" id="main-form" method="POST">
        <input type="text" class="fadeIn second" name="username" placeholder="Username">
        <input type="text" class="fadeIn third" name="login" placeholder="Password">
        <input type="submit" name="submit" class="fadeIn fourth" value="Log In">
      </form>

      <!-- Remind Passowrd -->

      <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div>

    </div>
  </div>
</body>
</html>