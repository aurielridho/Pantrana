<?php

  session_start();
  
  include_once ('../model/connection.php');
  include_once ('../controller/authController.php');
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      checkUserLogin($conn, $_POST['username'], $_POST['password']);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/credStyle.css">
    <title>Document</title>
</head>
<body>
    <div class="login-page">
      <div class="form">
        <div class="login">
          <div class="login-header">
            <img src="../assets/images/image 9.svg" alt="" class="logo-pantrana">
            <h3>LOGIN</h3>
            <p>Please enter your credentials to login.</p>
            <div class="alert-message">
            <?php
              if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
              }  
            ?>
            </div>
          </div>
        </div>
        <form class="login-form" method="POST">
          <input type="text" placeholder="Username" name="username"/>
          <input type="password" placeholder="Password" name="password"/>
          <button type="submit">LOGIN</button>
          <p class="message">Not registered? <a href="../view/signup.php">Create an account</a></p>
        </form>
      </div>
    </div>
</body>
</html>