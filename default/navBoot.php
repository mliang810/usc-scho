<?php 
	require "config/config.php";
	if(!isset($_SESSION["logged_in"]) ||!($_SESSION["logged_in"])) {
		$loggedin = false;
	}
	else{
		$loggedin = true;
	}

?>

<!DOCTYPE html>
<html>
<head>

	<!--CSS-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<!-- JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600&display=swap');
		#nav img{
			height: 50px;
		}
		.navbar{
			background-color: transparent !important;
			font-family: 'Work Sans', sans-serif;
			font-color:#990000 !important;
			font-size: 17px;
			font-weight:500;
		}

		.user{
			color:#990000;
			background-color: transparent;
			padding:8px;
			border: 2px solid #990000;
			/*border-bottom: 2px solid #990000;*/
			border-radius: 10px;

			padding:10px;
			min-width: 100px;

			border-radius: 0px;
			transition: all 0.5s;
		}

		.user:hover{
			color:#990000;
			background-color: rgba(255,204,0, 0.3);
			border-color: #990000;
		}

		.nav-link{
			color: #777777 !important;
		}

		.nav-link:hover{
			color: #990000 !important;
		}


	</style>
</head>
<body>
	<!--navbar-->
	<div id="nav" class="container-fluid p-0">
		<nav class="navbar navbar-expand-md navbar-light bg-light">
			<a class="navbar-brand"href="home.php"><img class="logopic" src="images/navlogo2.png"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="home.php">HOME</a>
					</li>

					<li class="nav-item">
					       <a class="nav-link" href="about.php">ABOUT</a>
					</li>

					<li class="nav-item">
					    <a class="nav-link" href="resources.php">RESOURCES</a>
					</li>
					<!-- <li class="nav-item">
					    <a class="nav-link" href="login.php">Log In/Sign Up</a>
					</li> -->

					<li class="nav-item">
				        <a class="nav-link" href="tool.php">HEALTHCARE TOOL</a>
				     </li>
				</ul>  
				<form class="form-inline my-2 my-lg-0">
					    <!-- <a href="login/login.php" class="btn btn-secondary user " role="button" aria-pressed="true">LOG IN/SIGN UP</a> -->
					    <?php if($loggedin) echo '<a href="login/logout.php" class="btn btn-secondary user " role="button" aria-pressed="true">LOG OUT</a>';?>
						<?php if(!$loggedin) echo '<a href="login/login.php" class="btn btn-secondary user " role="button" aria-pressed="true">LOG IN/SIGN UP</a>';?>
				</form>
			</div>
		</nav>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"> </script>
	<script src="js/slick.js" type="text/javascript"> </script>
	<script>
		$(document).ready(function(){
			console.log("working....")
		});

	</script>
</body>
</html>