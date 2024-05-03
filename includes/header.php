<?php
include("../includes/session_init.php"); // Adjusted path to session_init.php
$currentPage = basename($_SERVER['SCRIPT_NAME'], '.php'); // Moved inside PHP block
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="../css/header_style.css"> <!-- Adjusted path to CSS file -->
</head>
<body>

<nav>
    <ul>
        <li><a <?php if ($currentPage == 'index') echo 'class="active"'; ?> href="../pages/index.php">Guess Game</a></li> <!-- Adjusted href attribute -->
        <li><a <?php if ($currentPage == 'tic_tac_menu') echo 'class="active"'; ?> href="../pages/tic_tac_menu.php">Tic Tac Toe</a></li> <!-- Adjusted href attribute -->
        <?php if(!$_SESSION['login'] ) { ?> 
            <li><a <?php if ($currentPage == 'login_form') echo 'class="active"'; ?> href="../pages/login_form.php">Login</a></li> <!-- Adjusted href attribute -->
        <?php } else { ?> 
            <li><a <?php if ($currentPage == 'account') echo 'class="active"'; ?> href="../pages/account.php">Hello <?php echo $_SESSION["username"]; ?></a></li> <!-- Adjusted href attribute -->
        <?php } ?>
    </ul>
</nav>

</body>
</html>
