<?php
session_start();

// Initialize the game board if it's not already set
if (!isset($_SESSION['box'])) {
    $_SESSION['box'] = [['-', '-', '-'], ['-', '-', '-'], ['-', '-', '-']];
}

// Initialize the player symbol if it's not already set
if (!isset($_SESSION['playerSymbol'])) {
    $_SESSION['playerSymbol'] = 'X'; // Default player symbol
}

$playCounter = 0; // Counter to track number of plays

// Check if the replay button is clicked
if (isset($_POST['replay'])) {
    $_SESSION['box'] = [['-', '-', '-'], ['-', '-', '-'], ['-', '-', '-']]; // Reset the game board
    $_SESSION['playerSymbol'] = 'X'; // Reset player symbol to 'X'
}

// Function to check if a player has won
function checkWinner($board, $symbol)
{
    // Check rows
    for ($row = 0; $row < 3; $row++) {
        if ($board[$row][0] == $symbol && $board[$row][1] == $symbol && $board[$row][2] == $symbol) {
            return true; // Row win
        }
    }

    // Check columns
    for ($col = 0; $col < 3; $col++) {
        if ($board[0][$col] == $symbol && $board[1][$col] == $symbol && $board[2][$col] == $symbol) {
            return true; // Column win
        }
    }

    // Check diagonals
    if (($board[0][0] == $symbol && $board[1][1] == $symbol && $board[2][2] == $symbol) ||
        ($board[0][2] == $symbol && $board[1][1] == $symbol && $board[2][0] == $symbol)
    ) {
        return true; // Diagonal win
    }

    return false; // No win
}

function checkDraw($board) {
    for ($row = 0; $row < 3; $row++) {
        for ($col = 0; $col < 3; $col++) {
            if ($board[$row][$col] == '-') {
                return false; // If any cell is empty, the game is not draw
            }
        }
    }
    return true; // All cells are filled, indicating a draw
}

// Function to display the game board
function displayBoard($board)
{
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            $cellValue = $board[$i][$j];
            echo "<p class='playerSymbol'>$cellValue</p>";
        }
    }
}

// Process player moves
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which button is clicked and update the corresponding cell
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            $buttonName = "btn-$i-$j";
            if (isset($_POST[$buttonName])) {
                // Update the game board with the player's symbol
                if ($_SESSION['box'][$i][$j] == '-') { // Check if the cell is empty
                    $_SESSION['box'][$i][$j] = $_SESSION['playerSymbol'];
                    // Toggle player symbol for the next turn
                    $_SESSION['playerSymbol'] = ($_SESSION['playerSymbol'] === 'X') ? 'O' : 'X';
                    // Increase play counter
                    $playCounter++;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tic_tac_toe.css"> <!-- Adjusted path to CSS file -->
    <title>ticTacToe</title>
</head>

<body>
    <?php include("../includes/header.php");?> <!-- Adjusted path to header.php -->
    <h1 class="title">Tic-Tac-Toe Single Player</h1> 
    <div class="body">
        <div class="container">
            <form class="form" action="tic_tac_toe.php" method="POST">
                <?php
                if(checkWinner($_SESSION['box'],'X')) {
                    displayBoard($_SESSION['box']);
                    echo '<div class="win-message-container">
                        <h2 class="win-message">X wins</h2>
                    </div>';
                } elseif(checkWinner($_SESSION['box'],'O')) {
                    displayBoard($_SESSION['box']);
                    echo '<div class="win-message-container">
                        <h2 class="win-message">O wins</h2>
                    </div>';
                } elseif(checkDraw($_SESSION['box'])) {
                    displayBoard($_SESSION['box']);
                    echo '<div class="win-message-container">
                        <h2 class="win-message">Draw</h2>
                    </div>';
                } else {
                    // Display the game board buttons
                    for ($i = 0; $i < 3; $i++) {
                        for ($j = 0; $j < 3; $j++) {
                            $cellValue = $_SESSION['box'][$i][$j];
                            if ($cellValue != '-') {
                                echo "<div class='cell playerSymbol'>$cellValue</div>";
                            } else { ?>
                                <button type="submit" name="btn-<?php echo $i ?>-<?php echo $j ?>" class="playbtn"></button>
                            <?php }
                        }
                    }
                }
                ?>
            </form>
        </div>
    </div>

    <!-- Replay form -->
    <form action="tic_tac_toe.php" method="POST">
        <input type="submit" name="replay" value="Replay" class="replay-btn">
    </form>
</body>

</html>
