<?php

require '../config/config.php';
// var_dump($_POST);
//server side input validation
if ( !isset($_POST['email']) || empty($_POST['email'])
		|| !isset($_POST['username']) || empty($_POST['username'])
		|| !isset($_POST['password']) || empty($_POST['password']) ) {
			$errorRegister = "Please fill out all required fields.<br>";
		}
else{
	
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno){
		echo $mysqli->connect_error;
		exit();
	}
	//CHECK IF THE USERNAME OR EMAIL ADDRESS IS ALREADY USED/TAKEN
	$sql_registered = "SELECT * from users where username='". $_POST["username"] ."' OR email = '". $_POST["email"] ."';";
	$results_registered = $mysqli->query($sql_registered);
	if(!$results_registered){
		echo $mysqli->error;
		exit();
	}

	if($results_registered->num_rows >0){
		$errorReg = "Username or email has already been taken. Please choose another one.";
	}
	else{
		//feel free to add username to database
		$password = hash('sha256', $_POST["password"]);
		
		//INSERT INTO users table
		$sql = "INSERT into users(username, email, password) VALUES('".$_POST["username"]."', '".$_POST['email']."', '".$password. "')";

		echo "<hr>" .$sql ."<hr>";

		$results = $mysqli->query($sql);
		if(!$results){
			echo $mysqli->error;
			exit();
		}
		$mysqli->close();
		header("Location: login.php");
	}			

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">User Registration</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($errorReg) && !empty($errorReg) ) : ?>
					<div class="text-danger"><?php echo $errorReg; ?></div>
				<?php else : ?>
					<div class="text-success"><?php echo $_POST['username']; ?> was successfully registered.</div>
				<?php endif; ?>
		</div> <!-- .col -->
	</div> <!-- .row -->

	<div class="row mt-4 mb-4">
		<div class="col-12">
			<a href="login.php" role="button" class="btn btn-primary">Login</a>
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Back</a>
		</div> <!-- .col -->
	</div> <!-- .row -->

</div> <!-- .container -->

</body>
</html>