<?php

    function recipeInput ($conn, $ingredients, $cookingMethod) {

        if (empty($ingredients) || empty($cookingMethod)) {

            $_SESSION['error'] = 'Please fill in the form below!';
            header('Location: ../view/recipe.php');
            die;
        }

        if (strlen($ingredients) < 5 || strlen($ingredients) > 255) {

            $_SESSION['error'] = 'Ingredients must more than 5 letters and less than 255!';
            header('Location: ../view/recipe.php');
            die;
        }

        if (strlen($cookingMethod) < 5 || strlen($cookingMethod) > 255) {

            $_SESSION['error'] = 'Ingredients must more than 5 letters and less than 255!';
            header('Location: ../view/recipe.php');
            die;
        }

        $ingredients = htmlspecialchars($ingredients, ENT_QUOTES);
        $cookingMethod = htmlspecialchars($cookingMethod, ENT_QUOTES);
        $userID = $_SESSION['userID'];

        $insertQuery = 
        "INSERT INTO recipe (ingredients, cookMethod) VALUES ('$ingredients', '$cookingMethod')";
        $result = mysqli_query($conn, $insertQuery);

        $recipeId = mysqli_insert_id($conn);
        $headerQuery = 
        "INSERT INTO recipeheader (userID, recipeID) VALUES ('$userID', '$recipeId')";
        $result = mysqli_query($conn, $headerQuery);

        if ($result) {

            $_SESSION['success'] = 'Recipe Insertion Successful!';
            header('Location: ../view/recipe.php');
            die;
        } else {

            $_SESSION['error'] = 'Recipe insertion failed!';
            header('Location: ../view/recipe.php');
            die;
        }
    }

    function stockInput ($conn, $stockName) {

        if (empty($stockName)) {

            $_SESSION['error'] = 'Please fill in the form below!';
            header('Location: ../view/main.php');
            die;
        }

        if (strlen($stockName) < 2 || strlen($stockName) > 255) {

            $_SESSION['error'] = 'Stock name must more than 2 letters and less than 255!';
            header('Location: ../view/main.php');
            die;
        }

        $stockName = htmlspecialchars($stockName, ENT_QUOTES);
        $stockDate = date('Y-m-d');
        $userID = $_SESSION['userID'];

        $insertQuery = 
        "INSERT INTO stockdetail (stockName, stockDate) VALUES ('$stockName', CAST('$stockDate' AS DATE))";
        $result = mysqli_query($conn, $insertQuery);

        $stockID = mysqli_insert_id($conn);
        $headerQuery = 
        "INSERT INTO stockheader (userID, stockID) VALUES ('$userID', '$stockID')";
        $result = mysqli_query($conn, $headerQuery);

        if ($result) {

            $_SESSION['success'] = 'Stock Insertion Successful!';
            header('Location: ../view/main.php');
            die;
        } else {

            $_SESSION['error'] = 'Stock insertion failed!';
            header('Location: ../view/main.php');
            die;
        }
    }