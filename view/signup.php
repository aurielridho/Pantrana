<?php

  session_start();

  include_once ('../controller/authController.php');
  include_once ('../model/connection.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      singupUser($conn, $_POST['username'], $_POST['email'], $_POST['city'], 
      $_POST['country'], $_POST['password'], $_POST['confPassword']);
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
              <h3>Register</h3>
              <p>Please enter the form below.</p>
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
            <input type="text" placeholder="Email" name="email"/>
            <input type="text" placeholder="City" name="city"/>
            <input type="text" placeholder="Country" name="country"/>
            <input type="password" placeholder="Password" name="password"/>
            <input type="password" placeholder="Confirm Password" name="confPassword"/>
            <button type="submit">REGISTER</button>
            <p class="message">Already have an account? <a href="../view/login.php">Login</a></p>
          </form>
        </div>
    </div>
</body>
</html>