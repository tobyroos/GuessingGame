<?php
session_start();
$_SESSION['rand'] = rand(1, 100);
$_SESSION['guessCount'] = 0;
$_SESSION['feed'] = "";
$_SESSION['guess'] = null;
header('Location: guessgame.php');
?>