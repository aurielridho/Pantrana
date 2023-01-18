<?php

    include_once ('../controller/function.php');
    include_once ('../controller/inputValidation.php');

    function checkUserLogin ($conn, $username, $password) {
        if (!empty($username) && !empty($password)) {

            if (!validateString($username)) {

                $_SESSION['error'] = 'Please enter valid credentials';
                header('Location: ../view/login.php');
                die;
            }

            $password = hashString($password);
            $loginQuery = "SELECT * FROM user WHERE username = '$username'";
            
            $result = mysqli_query($conn, $loginQuery);
            $userData = mysqli_fetch_assoc($result);
            
            if ($userData) {

                if ($password == $userData['password']) {

                    $_SESSION['username'] = $userData['username'];
                    $_SESSION['userID'] = $userData['userID'];
                    
                    header('Location: ../view/main.php');
                    die;
                } else {

                    $_SESSION['error'] = 'Please enter valid credentials';
                    header('Location: ../view/login.php');
                    die;
                }
            } else {

                $_SESSION['error'] = 'Please enter valid credentials';
                header('Location: ../view/login.php');
                die;
            }
        }
        
        $_SESSION['error'] = 'Please do not empty credentials';
        header('Location: ../view/login.php');
        die;
    }

    function singupUser ($conn, $username, $email, $city, $country, $password, $confPassword) {
       if (!canUserSignup($username, $email, $city, $country, $password, $confPassword)) {

            $_SESSION['error'] = 'Please do not empty the credential';
            header('Location: ../view/signup.php');
            die;
       }

       if (!validateEmail($email)) {

            $_SESSION['error'] = 'Please enter valid email';
            header('Location: ../view/signup.php');
            die;
       }

       if (!validateString($username)) {

            $_SESSION['error'] = 'Username can only consist of letter and number';
            header('Location: ../view/signup.php');
            die;
       }

       if (!validateString($city)) {

            $_SESSION['error'] = 'Please enter a valid city';
            header('Location: ../view/signup.php');
            die;
       }

       if (!validateString($country)) {

            $_SESSION['error'] = 'Please enter a valid country';
            header('Location: ../view/signup.php');
            die;
       }

       if ($password != $confPassword) {

            $_SESSION['error'] = 'Password does not match';
            header('Location: ../view/signup.php');
            die;
       }

       $searchQuery = "SELECT * FROM user WHERE username = '$username'";
       $result = mysqli_query($conn, $searchQuery);
       $checkData = mysqli_fetch_assoc($result);
       if ($checkData) {
        
            $_SESSION['error'] = 'Username already exist!';
            header('Location: ../view/signup.php');
            die;
       }

       $password = hashString($password);
       $signupQuery = "INSERT INTO user (username, email, password, city, country) VALUES 
       ('$username', '$email', '$password', '$city', '$country')";

       $result = mysqli_query($conn, $signupQuery);
       if ($result) {
            header('Location: ../view/login.php');
            die;
       } else {
            header('Location: ../view/signup.php');
            die;
       }
    }

    function canUserSignup ($username, $email, $city, $country, $password, $confPassword) {
        if (
            !empty($username) &&
            !empty($email) &&
            !empty($city) &&
            !empty($country) &&
            !empty($password) &&
            !empty($confPassword)
           ) {
              return true;
           }

        return false;
    }
?>