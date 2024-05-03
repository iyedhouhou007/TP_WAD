<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if session variables are not already set
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    $_SESSION['username'] = "test123";
    $_SESSION['password'] = "123";
    $_SESSION['login'] = false;
}
?>
