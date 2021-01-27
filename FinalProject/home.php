<?php 
	require "default/navBoot.php";
	// require "config/config.php";
	if(isset($_POST) && isset($_POST["checker"])){
		if($_POST["checker"]=="newsletter"){
			if ( !isset($_POST['newsletter-who']) 
				|| !isset($_POST['email']) || empty($_POST['email'])) {
					// Missing required fields.
					$error = "Please fill out all required fields for the newsletter.";
			}
			else{
				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				if($mysqli->connect_errno){
					echo $mysqli->connect_error;
					exit();
				}
				$mysqli->set_charset("utf-8");

				$email = '"'.$_POST["email"].'"';

				// var_dump($_POST["newsletter-who"]);
				$findIDsql = "SELECT user_id FROM users WHERE email=".$email.";";
				$results = $mysqli->query($findIDsql);
				if ( $results == false ) {
					echo $mysqli->error;
					exit();
				}

				$row = $results->fetch_assoc();
				if(!empty($row)){
					$user_id = $row['user_id'];
					// var_dump($row['user_id']);
				}
				else{
					$user_id = null;
				}

				$statement = $mysqli->prepare("INSERT INTO newsletter SET email=?, subscriber_type=?, user_id=?"); //figure out how to do ON DUPLICATE KEY UPDATE
				$statement->bind_param("sii", $email, $_POST["newsletter-who"], $user_id); 
				$executed = $statement->execute(); 
				if(!$executed){
					echo $mysqli->error;
				}

				if($statement->affected_rows == 1){
					$success = true; 
				} 

				$statement->close();
				$mysqli->close();
			}

		}
		if($_POST["checker"]=="contact"){ //FIX THE EMAIL FUNCTION TO USE https://github.com/PHPMailer/PHPMailer
			if ( !isset($_POST['fname']) || empty($_POST['fname']) 
				|| !isset($_POST['lname']) || empty($_POST['lname'])
			|| !isset($_POST['email2']) || empty($_POST['email2'])
			|| !isset($_POST['message']) || empty($_POST['message'])) {
					// Missing required fields.
					$errorEmail = "Please fill out all required fields for the newsletter.";
			}
			else{
				$recipient="schealthcareoutreach@gmail.com";
			    $subject="Inquiry from our website";
			    $sender=$_POST["fname"]." ".$_POST["lname"];
			    $senderEmail=$_POST["email2"];
			    $message=$_POST["message"];

			    $mailBody="$message";

			    $outcome = mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>");
			    if($outcome){
			    	$thankYou="<p>Thank you! Your message has been sent.</p>";
			    	echo $thankYou;
			    }
			    else{
			    	echo "error";
			    }
			}

		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<link rel="stylesheet" href="css/stylesheet.css">
	<style>
		/*@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Raleway:wght@300;400;600;700&display=swap');*/
		
		.container{
			max-width: 1400px;
			margin-left: auto;
			margin-right:auto;
		}
		/*.logo-back{
			background-image: url("images/mainlogo.png");
			background-repeat: no-repeat;
			background-size: contain;
			background-position: center;
			height:600px;
		}*/
		.logo-back .imgdesk{
			width: 100%;
			max-height:800px;
		}

		.logo-back .imgmobile{
			margin-left: auto;
			margin-right: auto;
			max-height:500px;
			width:height;
			display: none;
		}

		.statement p{
			text-align: center;
			font-size: 35px;
			margin:0;
		}

		.inner{
			margin-left: auto;
			margin-right:auto;
			width:70%;
		}

		.row-links{
			display: flex;
			flex-direction: row; 
			flex-wrap: wrap;
			justify-content: space-between;
			margin-top:40px;
		}

		.row-links a{
			color:#990000;
			font-size: 20px;
			text-decoration: none;
			border-bottom:3px solid #990000;

			transition: all 0.3s;
		}

		.row-links a:hover{
			color:rgba(153, 0, 0, 0.6);
		}

		.newsletter{
			padding:30px;
			margin-top:40px;
			background-color: #bfc1c2;
			font-size: 20px;
		}

		.contact{
			padding:30px;
			margin-top:20px;
			font-size: 20px;
		}

		h2{
			margin:0;
			padding:0;
			margin-bottom: 25px;
		}
		ul{
			list-style-type:none;
		}

/*		button{
			margin-left: 10px;
			border-radius: 0px;
			padding:3px;
			padding-left: 5px;
			padding-right: 5px;

			color:white;
			background-color: #990000; 
			font-size: 15px;
			border: 2px solid #990000;
			cursor:pointer;
		}*/

		.name{
			width:250px;
		}

		.email2{
			max-width:500px;
			width: 100%;
		}


		@media(max-width: 991px){
			.logo-back .imgdesk{
				display:none;
			}
			.logo-back .imgmobile{
				display:block;
			}

			.item{
				width:100%;
			}
			.statement p{
				font-size: 30px
			}
		}

		@media(max-width: 768px){
			body{
				/*background-color: beige;*/
			}
			.row-links{
				width: 50%;
			}
			.row-links a{
				width: 100%;
				text-align: center;
				padding: 5px;

			}
			.statement p{
				font-size: 25px
			}
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="logo-back">
			<img class="imgdesk" src="images/mainlogo.png" alt="SCHO Home Page Logo"/>
			<img class="imgmobile" src="images/mobilehome.png" alt="SCHO Home Page Logo"/>
		</div>

		<div class="statement inner">
			<p>
				Southern California Healthcare Outreach is a student-run healthcare advocacy organization that works to expand healthcare coverage in Los Angeles. 
			</p>
			<div class="row-links inner">
				<a href="about.php?>" id="moving"><strong>Learn More</strong></a>
				<a href="resources.php" id="moving"><strong>Resources</strong></a>
				<a href="https://usc.campuslabs.com/engage/organization/schealthcareoutreach" id="moving"><strong>Find an Event</strong></a>
			</div>
		</div>

		<div class="newsletter">
			<div class="inner">
				<h2>Sign up for our Newsletter!</h2>
				<form class="newsletter-form" method="POST" action="home.php">
					<label>I am an: </label>

					<ul>
						<li><input type="radio" id="usc" name="newsletter-who" value="0"/>
						<label for="usc">USC Student</label></li>
						<br>
						<li><input type="radio" id="other" name="newsletter-who" value="1"/>
						<label for="other">Other</label></li>
					</ul>
					<input type="text" name="email" class="inputbox" placeholder="youremailhere@usc.edu" required/>
					<input type="hidden" name = "checker" value="newsletter">
					<button type="submit">SUBMIT</button>

				</form>
				<?php if ( isset($success)) :?>
					<div class="text-success">
						<span class="font-italic">You've been added to the newsletter</span>
					</div>
				<?php endif; ?>

				<?php if ( isset($error)) :?>
					<div class="text-danger">
						<span class="font-italic"><?php echo $error; ?></span>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="contact">
			<div class="inner">
				<h2>Contact Us</h2>
				<form class="contact-form" action="home.php" method="POST">
					<input type="text" name="fname" placeholder="First Name" class="name inputbox" required>
					<input type="text" name="lname" placeholder="Last Name" class="name inputbox" required>
					<input type="text" name="email2" placeholder="youremailhere@email.com" class="email2 inputbox" required>
					<input type="hidden" name = "checker" value="contact">
					<br>
					<textarea name="message" placeholder="Your message..." required></textarea>
					<br>
					<button type="submit">SUBMIT</button>
					<?php if ( isset($outcome)) :?>
						<div class="text-success">
							Email sent!
						</div>
					<?php endif; ?>
					<?php if ( isset($errorEmail)) :?>
						<div class="text-danger">
							<?php echo $errorEmail; ?>
						</div>
					<?php endif; ?>
				</form>
			</div>
		</div>
	</div>
	<?php 
		require "default/footer.php";
	?>
</body>
</html>