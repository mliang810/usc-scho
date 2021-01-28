<?php
//tp destroy a session (log out), must start a session.
	session_start();
	session_destroy();
	header("Location: ../home.php");	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout</title>
</head>
<body>
</body>
</html>