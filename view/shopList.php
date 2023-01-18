<?php

    session_start();

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
        <a class="shop" href="/view/shopList.php">Shopping List</a>
        <a class="uncurr-page" href="/view/recipe.php">Recipe</a>
        <a class="uncurr-page" href="/view/expired.php">Expired</a>
    </div>

    <div class="header-shop">
        <p>
            <?php
                if (!isset($_SESSION['userID'])) {
                    echo 'Login to See Shopping list!';
                } else {
                    echo $_SESSION['username']."'s shopping list";
                }
            ?>
        </p>
    </div>

    <div class="body-content">
        <div class="body-card">
            <h1>WIP</h1>
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
            <form action="" class="ingredients-input">
                <section class="input-section">
                    <div class="input-placeholder">
                        <h3>WIP:</h3>
                        <textarea name="ingredients" cols="60" rows="10" class="input-ingredients"></textarea>
                    </div>

                    <div class="input-placeholder" id="method-placeholder">
                        <h3>WIP:</h3>
                        <textarea name="cookingMethod" cols="60" rows="10" class="input-cooking"></textarea>
                    </div>
                </section>

                <button id="shop-insert-btn" class="btn-insert" type="submit">
                    THIS BUTTON DOESN'T DO ANYTHING
                </button>
            </form>
        </div>
    </div>
</body>
</html>