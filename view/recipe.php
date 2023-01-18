<?php

    session_start();

    include_once ('../model/connection.php');
    include_once ('../controller/databaseInsertion.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_SESSION['userID'])) {

            $_SESSION['error'] = 'Please login to insert!';
            header('Location: ../view/recipe.php');
            die;
        }
        
        recipeInput($conn, $_POST['ingredients'], $_POST['cookingMethod']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <input id="toggler" type="checkbox">

        <label for="toggler">
          <img src="/assets/images/image 9.svg" alt="">
        </label>

        <div class="dropdown">
            <?php
                if (!isset($_SESSION['userID'])) {
                    echo '<a href="">Helps</a>';
                    echo '<a href="">Privacy Policy</a>';
                    echo '<a href="">About Us</a>';
                    echo '<a href="../view/signup.php">Register</a>';
                    echo '<a href="../view/login.php">Login</a>';
                } else {
                    echo '<a href="">Weekly Analytics</a>';
                    echo '<a href="">Helps</a>';
                    echo '<a href="">Privacy Policy</a>';
                    echo '<a href="">About Us</a>';
                    echo '<a href="../controller/userLogout.php">Logout</a>';
                }
            ?>
        </div>
    </div>

    <div class="topnav">
        <a class="uncurr-page" href="/view/main.php">Stock</a>
        <a class="uncurr-page" href="/view/shopList.php">Shopping List</a>
        <a class="recipe" href="/view/recipe.php">Recipe</a>
        <a class="uncurr-page" href="/view/expired.php">Expired</a>
    </div>

    <div class="header-recipe">
        <p>
            <?php
                if (!isset($_SESSION['userID'])) {
                    echo 'Login to See Recipe!';
                } else {
                    echo $_SESSION['username']."'s Recipe";
                }
            ?>
        </p>
    </div>
    <!-- Still error here -->
    <!-- TODO: Finish it -->
    <div class="body-content">
        <div class="body-card">
            <h1>Recipe Insertion</h1>
            <div class="alert-message">
                <?php
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                ?>
            </div>
            <div class="success-message">
                <?php
                    if (isset($_SESSION['success'])) {
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    }
                ?>
            </div>
            <form action="" class="ingredients-input" method="POST">
                <section class="input-section">
                    <div class="input-placeholder">
                        <h3>Ingredients:</h3>
                        <textarea name="ingredients" cols="60" rows="10" class="input-ingredients"></textarea>
                    </div>

                    <div class="input-placeholder" id="method-placeholder">
                        <h3>Cooking method:</h3>
                        <textarea name="cookingMethod" cols="60" rows="10" class="input-cooking"></textarea>
                    </div>
                </section>

                <button id="recipe-insert-btn" class="btn-insert" type="submit">
                    INSERT
                </button>
            </form>
        </div>

        <div class="body-card">
            <h1>Recipe List</h1>
            <?php
                if (isset($_SESSION['userID'])) {

                    $userID = $_SESSION['userID'];

                    $query = "SELECT recipe.ingredients, recipe.cookMethod FROM recipe 
                    INNER JOIN recipeheader ON recipe.recipeID = recipeheader.recipeID
                    WHERE recipeheader.userID = '$userID'";

                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<div class="card-list">';
                            echo '<div class="card-header">';
                            echo '<h3>Ingredient</h3>';
                            echo '<h3>Cooking Method</h3>';
                            echo '</div>';
                            echo '<div class="card-content">';
                            echo '<p>';
                            echo $row['ingredients'];
                            echo '</p>';
                            echo '<p>';
                            echo $row['cookMethod'];
                            echo '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                } else {
                    echo '<h2>';
                    echo 'Login to see recipe!';
                    echo '</h2>';
                }
            ?>
        </div>
    </div>

    </div>
</body>
</html>