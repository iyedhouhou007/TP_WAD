<?php
session_start();

if (!isset($_SESSION['correctAnswer'])) {
    $_SESSION['correctAnswer'] = rand(1, 5);
    $_SESSION['numberAttempts'] = 0; // Initialize numberAttempts here
}

$usersAnswer = NULL;
$showWinMessage = false;
$showTooHighMessage = false;
$showTooLowMessage = false;
$numberAttempts = isset($_SESSION['numberAttempts']) ? $_SESSION['numberAttempts'] : 0; // Initialize $numberAttempts

if (isset($_POST['submition'])) {
    $numberAttempts++; // Increment number of attempts
    $_SESSION['numberAttempts'] = $numberAttempts; // Save the updated number of attempts to session

    $usersAnswer = isset($_POST['usersAnswer']) ? $_POST['usersAnswer'] : NULL;
    if ($_SESSION['correctAnswer'] == $usersAnswer) {
        $showWinMessage = true;
    } elseif ($_SESSION['correctAnswer'] < $usersAnswer) {
        $showTooHighMessage = true;
    } elseif ($_SESSION['correctAnswer'] > $usersAnswer) {
        $showTooLowMessage = true;
    }
}

if (isset($_POST['replay'])) {
    unset($_SESSION['numberAttempts']);
    unset($_SESSION['correctAnswer']);
    echo "<script>window.location.href = 'index.php';</script>";
    exit; // Ensure no further output is sent after redirection
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/guess_game_style.css"> <!-- Adjusted path to CSS file -->
    <title>Guess Game</title>
</head>

<body>
    <?php include("../includes/header.php") ?> <!-- Adjusted path to header.php -->

    <div class="body">
        <div class="container">
            <h1 class="header">GUESS THE NUMBER GAME (1-5)</h1>
            <form action="index.php" method="post" class="form">
                <input type="number" name="usersAnswer" id="answer-field">
                <input type="submit" name="submition" value="Done" id="sub-btn">
            </form>

            <form action="index.php" method="post" class="form">
                <input type="submit" class="replay-btn" name="replay" value="Replay" style="margin:auto">
            </form>

            <?php if ($showWinMessage) : ?>
                <div class="win-message-container">
                    <div class="win-message">
                        <p>Congratulations! You won!</p>
                        <form action="index.php" method="post">
                            <input type="submit" name="replay" value="Replay" class="replay-btn">
                        </form>
                    </div>
                </div>
            <?php elseif ($showTooHighMessage) : ?>
                <div class="result">
                    <p class="incorrect">Too high!</p>
                </div>
            <?php elseif ($showTooLowMessage) : ?>
                <div class="result">
                    <p class="incorrect">Too low!</p>
                </div>
            <?php endif; ?>

            <div class="attempts">Number of attempts: <?php echo $numberAttempts; ?></div>
        </div>
    </div>
</body>

</html>
