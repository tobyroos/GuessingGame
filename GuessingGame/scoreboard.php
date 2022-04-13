<?php
// Start a session
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Scoreboard</title>
    </head>
    <body>

        <h1><?php echo "YOU WON"; ?></h1>
        <h2><?php echo "You Guessed " . $_SESSION['rand'] . " in " . $_SESSION['guessCount'] . " tries"; ?></h2>

        <?php

            $servername = "sql204.epizy.com";
            $dbusername = "epiz_30809348";
            $dbpassword = "ZgcVz7gXGLF90Ye";
            $dbname = "epiz_30809348_GuessingGame";

            $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $insertData = "INSERT INTO ScoreBoard (username, score) VALUES ('" . $_SESSION["username"] . "', '" . $_SESSION['guessCount'] . "')";
            if ($conn->query($insertData) === TRUE){
                echo "Logged score<br>";
            } else {
                echo "Failed to log score<br>";
            }

            unset ($_SESSION['guessCount']);

            $sqlScore = "SELECT * FROM ScoreBoard ORDER BY score LIMIT 10";
            $resultScore = $conn->query($sqlScore);
            

            $index = 0;
            echo "<br>Place\t|\tName\t|\tScore<br>";
            while ($row = $resultScore->fetch_assoc()) {
                $index = $index + 1;
                echo $index . "\t|\t " . $row["username"] . "\t|\t" . $row["score"] . "<br>";
            }

        ?>

        <form action="setup.php" method="GET">
            <button type="submit" name="submit"> Play Again </button>
        </form>

    </body>
</html>
