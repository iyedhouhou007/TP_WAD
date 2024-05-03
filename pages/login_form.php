<?php
include("../includes/session_init.php"); // Adjusted path to session_init.php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login_form.css"> <!-- Adjusted path to CSS file -->
    <title>Login</title>
</head>

<body>
    <?php include("../includes/header.php") ?> <!-- Adjusted path to header.php -->

    <div class="body-container">
        <div class="login-container">
            <h1 class="header">LOGIN</h1>
            <form action="login_form.php" method="post">
                <div class="input-box">
                    <input placeholder="Username" type="text" name="username" id="username" class="input-field" required>
                </div>
                <div class="input-box">
                    <input placeholder="Password" type="password" name="password" id="password" class="input-field" required>
                </div>
                <div class="submit-btn">
                    <input type="submit" name="sub-btn" value="Login" id="sub-btn">
                </div>
            </form>
        </div>
    </div>

    <?php 
    if(isset($_POST["sub-btn"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        session_start(); // Starting the session if not already started

        if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['username'] == $username && $_SESSION['password'] == $password) {
            unset($_POST['username']);
            unset($_POST['password']);
            $_SESSION['login'] = true;
           
            echo "<script>window.location.href = 'index.php';</script>";
            exit; // Ensure no further output is sent
        } elseif (isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['username'] == $username && $_SESSION['password'] != $password) {
            echo '<div class="error-message">Hello '.$_SESSION['username'].' your password is incorrect </div>';
            unset($_POST["sub-btn"]);
        } else {
            echo '<div class="error-message">You entered the wrong credentials</div>';
            unset($_POST["sub-btn"]);
        }
    }
    ?>
</body>

</html>
