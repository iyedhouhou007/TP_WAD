<?php 
session_start()


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="../css/logout.css">
</head>
<body>
    <?php include("../includes/header.php") ?>
    <div class="container">
        <h1>Logout</h1>
        <p>Are you sure you want to logout?</p>
        <form action="account.php" method="post">
            <input type="submit" name="disc-btn" class="logout-btn" value="Logout">
        </form>
    </div>
</body>
</html>


<?php 

    if(isset($_POST['disc-btn'])) {
        $_SESSION['login'] = false;
        session_destroy();
        echo "<script>window.location.href = 'index.php';</script>";
        exit;
    }

?>