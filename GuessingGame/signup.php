<?php
// Start a session
session_start();
?>
<!DOCTYPE html>
<html>
<style>
.center-column {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.center-row {
    display: flex;
    flex-direction: row;
    gap: 5px;
    align-items: center;
}

.label {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
}

</style>
<body>
    <div class="center-column">
        <h1>Create Account</h1>
        <form action="signup.php" method="get">

            <div class=label>
                <label for="username">Username</label>
                <input id="username" type="text" name="username"/>
            </div>

            <div class=label>
                <label for="password">Password</label>
                <input id="password" type="password" name="password"/>
            </div>

            <input type="submit" name="signup" value="Create Account"/>

        </form>
        <div class=center-row>
            <p>Have an account?</p>
            <a href="index.php">Login</a>
        </div>
    </div>

    <?php
        echo $_GET['error'];
        if (isset($_GET['username'])){

            $username = $_GET["username"];
            $password = $_GET["password"];
            
            $servername = "sql204.epizy.com";
            $dbusername = "epiz_30809348";
            $dbpassword = "ZgcVz7gXGLF90Ye";
            $dbname = "epiz_30809348_GuessingGame";

            $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $checkUser = "SELECT username FROM User WHERE username = '" . $username . "'";
            $validUser = $conn->query($checkUser);
            if ($validUser->num_rows > 0) {
                echo "Username not valid";
            } else {
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                header('Location: createaccount.php');
            }
        }
        $conn->close();
    ?>
</body>
</html>