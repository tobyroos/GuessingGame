<?php
session_start();
?>
 
<!doctype html>
<head>
    <title>Guessing Game</title>
</head>
 
<body>
    <form action="" method="GET">
        <label for="guessNum">Guess a Number between 1 and 100: </label>
        <input type="text" min="1" max="100" name="guessNum">

        <button type="submit" name="submit"> Submit </button>
    </form>
    <?php
        echo "Last Guess: " . $_SESSION['guess'] . "<br>";
        echo "Number of Guesses: " . $_SESSION['guessCount'] . "<br>";
        echo $_SESSION['feed'] . "<br>";

        if (isset($_GET['submit'])) {
            $_SESSION['guess'] = $_GET['guessNum'];
            $_SESSION['guessCount'] = $_SESSION['guessCount'] + 1;

            if($_SESSION['guess'] == $_SESSION['rand']){
                header('Location: scoreboard.php');
            } else if($_SESSION['guess'] > $_SESSION['rand']){
                $_SESSION['feed'] = "Too High";
            } else if($_SESSION['guess'] < $_SESSION['rand']){
                $_SESSION['feed'] = "Too Low";
            }

            header('refresh: 0.05; guessgame.php');
        }
    ?>
</body>
 
</html>