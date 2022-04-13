<?php
    session_start();
    // server side code

    $servername = "sql204.epizy.com";
    $dbusername = "epiz_30809348";
    $dbpassword = "ZgcVz7gXGLF90Ye";
    $dbname = "epiz_30809348_GuessingGame";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $salt = bin2hex(random_bytes(2));
    $hash = hash('sha256', $_SESSION["password"] . $salt);
    $sql = "INSERT INTO User (username, hash, salt) VALUES ('" . $_SESSION["username"] . "', '" . $hash . "', '" . $salt . "')";
    if ($conn->query($sql) === TRUE){
        header('Location: setup.php');
    } else {
        header('Location: signup.php?error=sign_up_fail');
    }
    unset ($_SESSION["password"]);
    $conn->close();
?>