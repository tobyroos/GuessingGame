<?php
	session_start();
	
	//remove all session variables
	session_unset();
	
	//destroy the session
	session_destroy();
	
?>

<!DOCTYPE html>
<html>
<body>
<p> Session variable reset</p>
<a href+"testsession.php">Go Back to testsession.php</a>
</body>
</html>