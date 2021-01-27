<?php
	require "../config/config.php";
	// var_dump($_SESSION);
	// var_dump($_POST);
	/*
	if((isset($_POST['checker'])) && $_POST['checker']=="register"){
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
				$error = "Username or email has already been taken. Please choose another one.";
			}
			else{
				//feel free to add username to database
				$password = hash('sha256', $_POST["password"]);
				
				//INSERT INTO users table
				$sql = "INSERT into users(username, email, password, admin) VALUES('".$_POST["username"]."', '".$_POST['email']."', '".$password. "', 0)";

				echo "<hr>" .$sql ."<hr>";

				$results = $mysqli->query($sql);
				if(!$results){
					echo $mysqli->error;
					exit();
				}
				$mysqli->close();
			}			

		}
	}
	*/
	if((isset($_POST['checker'])) && $_POST['checker']=="login"){
		if(!isset($_SESSION["logged_in"]) ||!($_SESSION["logged_in"])) {
		if ( isset($_POST['username']) && isset($_POST['password']) ) {
			if ( empty($_POST['username']) || empty($_POST['password']) ) {
				$error = "Please enter username and password.";
			}

			else {
				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

				if($mysqli->connect_errno) {
					echo $mysqli->connect_error;
					exit();
				}

				$passwordInput = hash("sha256",$_POST['password']);

				$sql = "SELECT * FROM users
							WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";

				// echo "<hr>" . $sql . "<hr>";
				
				$results = $mysqli->query($sql);

				if(!$results) {
					echo $mysqli->error;
					exit();
				}

				if($results->num_rows > 0){ //if the user/pass combo exists -- LOGIN SUCCESS

					//set session variables to rememebr the user
					//associated array
					$_SESSION["username"] = $_POST["username"];
					$_SESSION["logged_in"] = true;
					//redirect user to the homepage
					header("Location: ../home.php");		
				}
				else {
					$error = "Invalid username or password.";
				}
			} 
		}
		}
		// if the user is already logged in, don't let them access this page - redirect them to the home page
		else{
			header("Location: ../home.php");
		}
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log In/Sign Up</title>
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600&display=swap');
		html, body{
			font-family: 'Work Sans', sans-serif;
			margin:0;
			padding:0;
			background-color: #990000;
			overflow-x:hidden
		}
		.container{
			background-color: white;
			width:60%;
			max-width: 700px;
			border:2px solid white;
			margin-left: auto;
			margin-right:auto;

			padding:80px;
			margin-top: 30px;
			border-radius: 10px;
			box-sizing: border-box;
		}
		.butt{
			display:block;
			margin-left: auto;
			margin-right:auto;
			padding:10px;
			width: 200px;
			box-sizing: border-box;

			color:#990000;
			border: 2px solid #990000;
			font-size:15px;

			overflow:hidden;
			text-align: center;
			text-decoration: none;

			border-radius: 10px;
			transition: all 0.5s;
		}

		.butt:hover{
			box-shadow: 5px 10px;
		}

		.home .butt{
			margin-top: 15px;
			background-color:white;
			border:black;
		}

		.home .butt:hover{
			background-color: rgba(255, 255, 127);
		}

		button{
			background-color: white;
			font-family: 'Work Sans', sans-serif;
			cursor: pointer;
		}

		.hidden{
			display: none;
		}

		.error{
			color: red;
		}

		h1{
			margin:0;
			padding:0;
			text-align: center;
		}

		hr{
			width: 60%;
			margin-top: 10px;
			margin-bottom: 30px;
		}

		.spot{
			margin-top:10px;
			margin-bottom:10px;
			width: 80%;
			display: block;
			margin-left: auto;
			margin-right:auto;

			
			text-align: center;
		}

		input{
			margin:10px;
			height:35px;
			width: 75%;
			border-radius: 10px;
			border:1px solid black;
			font-size:15px;
			padding:5px;
		}


		/*resized*/
		@media(max-width: 991px){
			.container{
				width: 70%;
			}
		}

		@media(max-width: 768px){
			html, body{
				background-color: white;
			}
			.container{
				width: 100%;
				margin-top: 60px;
				padding:25px;
			}
			input{
				width: 80%;
			}
			.spot{
				width: 95%;
			}
		}
	</style>
</head>
<body>
	<div class="home">
		<a href="../home.php" class="home butt">Back to home</a>
	</div>
	<div class="container">
		<div class="login-container">
			<div class="error-message">
				<?php
					if ( isset($error) && !empty($error) ) {
						echo "<span style='color:red'>".$error."</span>";
					}
				?>
			</div>
			<br>
			<h1>Log In</h1><hr>
			<form action="login.php" method="POST" class="login">
				<div class="spot">
					<label class="lab">
						<strong>Username:</strong> <br>
						<input type="text" placeholder="Username" class="username-input" name="username">
					</label>
				</div>
				

				<div class="spot">
					<label>
						<strong>Password:</strong> <br>
						<input type="password" placeholder="Password" name="password" class="pass-input">
					</label>
				</div>
				<button type="submit" class="butt">Log In</button>
				<input type="hidden" name="checker" value="login"></input>
			</form>
			<br><br>
			<h1>OR</h1>
			<br><br>
			<a href="#" id="signup" class="butt"> Sign Up</a>
		</div>

		

		<div class="signup-container hidden">
			<div class="error-message">
				<?php
					if ( isset($errorRegister) && !empty($errorRegister) ) {
						echo "<span style='color:red'>".$errorRegister."</span>";
					}
				?>
			</div>

			<h1>Sign Up</h1><hr>
			<form action="register_confirmation.php" method="POST" class="register">
				<div class="spot">
					<label class="lab">
						<strong>Email:</strong> <br>
						<input type="text" placeholder="Email" id="email" class="email-input" name="email">
					</label>
				</div>
				<div class="error hidden" id="email-empty">Email field musn't be empty</div>

				<div class="spot">
					<label class="lab">
						<strong>Username:</strong> <br>
						<input type="text" placeholder="Username" id="username" class="username-input" name="username">
					</label>
				</div>
				<div class="error hidden" id="user-empty">Username field musn't be empty</div>

				<div class="spot">
					<label>
						<strong>Password:</strong> <br>
						<input type="password" placeholder="Password" id="password" name="password" class="">
					</label>
				</div>
					<div class="error hidden" id="match">Passwords much match</div>
					<div class="error hidden" id="pass-empty">Password field musn't be empty</div>

				<div class="spot">
					<label>
						<strong>Re-enter Password:</strong> <br>
						<input type="password" placeholder="Re-enter Password" id="password-again" name="confirm-pass-input" class="">
					</label>
					<div class="error hidden" id="match">Passwords must match</div>
					<div class="error hidden" id="pass-empty2">Password field musn't be empty</div>
				</div>
				<button type="submit" class="butt">Sign Up</button>
				<input type="hidden" name="checker" value="register"></input>

				<br><br>
				<h1>OR</h1>
				<br>
				<a href="#" id="login" class="butt"> Login</a>
			</form>

		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"> </script>
	<script src="js/slick.js" type="text/javascript"> </script>
	<script>
		$(document).ready(function(){
			console.log("working....")
		});

		document.querySelector("#login").onclick= function(){
			//the following code will happen each time someone clicks on #btn-click
			$(".login-container").removeClass("hidden");
			$(".signup-container").addClass("hidden");
			console.log("clicked login, showing login info")
		}

		document.querySelector("#signup").onclick= function(){
			//the following code will happen each time someone clicks on #btn-click
				$(".signup-container").removeClass("hidden");
				$(".login-container").addClass("hidden");
				console.log("clicked signup, showing signup info")
		}

		$(".register").on("submit", function() {
			return validateRegistration();
		})

		function validateRegistration(){
			let errors = false;
			if ( document.querySelector('#email').value.trim().length == 0 ) {
				errors = true;
				document.querySelector('#email-empty').classList.remove('hidden');
			} else {
				document.querySelector('#email-empty').classList.add('hidden');
			}

			if ( document.querySelector('#username').value.trim().length == 0 ) {
				errors = true;
				document.querySelector('#user-empty').classList.remove('hidden');
			} else {
				document.querySelector('#user-empty').classList.add('hidden');
			}

			if ( document.querySelector('#password').value.trim().length == 0 ) {
				errors = true;
				document.querySelector('#pass-empty').classList.remove('hidden');
			} else {
				document.querySelector('#pass-empty').classList.add('hidden');
			}

			if ( document.querySelector('#password').value.trim().length == 0 ) {
				errors = true;
				document.querySelector('#pass-empty2').classList.remove('hidden');
			} else {
				document.querySelector('#pass-empty2').classList.add('hidden');
			}

			if(document.querySelector('#password').value.trim().length !=0 && document.querySelector('#password-again').value.trim().length !=0){
				if(document.querySelector('#password').value.trim() != document.querySelector('#password-again').value.trim()){
					document.querySelector('#match').classList.remove('hidden');
					errors = true;
				}
				else{
					document.querySelector('#match').classList.add('hidden');
				}
			}

			return !errors;

			// return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}

	</script>
</body>
</html>