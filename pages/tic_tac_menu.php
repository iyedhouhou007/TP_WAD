<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tic_tac_menu.css"> <!-- Adjusted path to CSS file -->
    <title>Tic-Tac-Toe Mode Selection</title>
</head>

<body>
    <?php include("../includes/header.php"); ?> <!-- Adjusted path to header.php -->
    <div class="container">
        <h1>Welcome to Tic-Tac-Toe</h1>
        <form action="tic_tac_menu.php" method="POST">
            <label for="mode">Select Game Mode:</label>
            <select id="mode" name="mode">
                <option value="single">Single Player</option>
                <option value="multi">Multiplayer</option>
            </select>
            <br><br>
            <input type="submit" value="Start Game">
        </form>
    </div>

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if mode is selected
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mode'])) {
        $mode = $_POST['mode'];
        // Redirect user to the appropriate game page based on the selected mode
        if ($mode === 'single') {
            echo "<script>window.location.href = 'tic_tac_single.php';</script>";
            exit();
        } elseif ($mode === 'multi') {
            echo "<script>window.location.href = 'tic_tac_toe.php';</script>";
            exit();
        }
    }
    ?>
</body>

</html>
