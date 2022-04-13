<?php
// Start a session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
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
        <h1>Login</h1>
        <form action="login.php" method="get">

        <div class=label>
            <label for="username">Username</label>
            <input id="username" type="text" name="username"/>
        </div>

        <div class=label>
            <label for="password">Password</label>
            <input id="password" type="password" name="password"/>
        </div>

        <input type="submit" name="login" value="Login"/>

        </form>
        <div class=center-row>
            <p>Don't have an account?  </p>
            <a href="signup.php">Create One</a>
        </div>
    </div>

    <?php
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
                $userQuery = "SELECT salt, hash FROM User WHERE username  = '" . $username . "'";
                $userObj = $conn->query($userQuery);
                if ($userObj->num_rows > 0) {
                    $user = $userObj->fetch_assoc();
                    $hash = hash('sha256', $password . $user["salt"]);
                    if($user["hash"] == $hash){
                        $_SESSION["username"] = $username;
                        header('Location: setup.php');
                    } else {
                        echo "Username or password not found";
                    }
                } else {
                    echo "Login Error";
                }
            } else {
                echo "Username or password not found";
            }
        }
        $conn->close();
    ?>
</body>
</html>