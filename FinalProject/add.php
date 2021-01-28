<?php
	require "default/navBoot.php";
	$admin = false;

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno){
		echo $mysqli->connect_error;
		exit();
	}

	if (isset($_SESSION['username'])) {
		$username="";
    	$username = '"'.$_SESSION["username"].'"';
    	$sqlAdmin = "select * from users where username like ". $username . "AND is_admin=1";
    	$resultsAdmin = $mysqli->query($sqlAdmin);
    	
    	if(!$resultsAdmin) {
			echo $mysqli->error;
			exit();
		}
		if($resultsAdmin->num_rows > 0){ //if the user/pass combo exists -- LOGIN SUCCESS
			$admin = true;
			echo "Admin controls enabled on this page";
		}
	}

	if(isset($_POST) && $admin){
		if ( !isset($_POST['title']) || empty($_POST['title']) 
		|| !isset($_POST['link']) || empty($_POST['link'])) {
			// Missing required fields.
			$error = "Please fill out all required fields.";
		}

		else{
			$success = false;
			$mysqli->set_charset("utf-8");

			if ( isset($_POST['description']) && !empty($_POST['description']) ) {
				$description = "'" . $_POST['description'] . "'";
			} else {
				$description = null;
			}

			$statement = $mysqli->prepare("INSERT INTO articles SET title=?, link=?, description=?");
			$statement->bind_param("sss", $_POST["title"], $_POST['link'], $_POST['description']); 
			$executed = $statement->execute(); 
			if(!$executed){
				echo $mysqli->error;
			}

			if($statement->affected_rows == 1){
				$success = true; 
				header("Location: resources.php");
			} 

			$statement->close();
			$mysqli->close();

			

		}
	}



?>


<!DOCTYPE html>
<html>
<head>
	<title>Add an article</title>
	<link rel="styleBoot" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/stylesheet.css">
	<style>
		button, #go-back{
			padding:10px;
		}

		#go-back{
			text-decoration: none;
			color:white;
			margin-left:15px;
		}
	</style>

</head>
<body>
	<?php if ( !$admin ) :?>
		<div class="text-danger">
			 <span class="font-italic">This page is for admins only.</span>
		</div>
	<?php endif; ?>

	<?php if ( isset($success) && !$success ) :?>
		<div class="text-danger">
			 <span class="font-italic">Failed to add entry</span>
		</div>
	<?php endif; ?>

	<?php if ( isset($error)) :?>
		<div class="text-danger">
			 <span class="font-italic"><?php echo $error ?></span>
		</div>
	<?php endif; ?>

<?php if ( $admin ) :?>
	<div class="container">
		<h1>Add an Article</h1>
		<br>
		<form action="add.php" method="POST">
			<div class="form-group row">
				<label for="title" class="col-sm-3 col-form-label text-sm-right">Article Title</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="title" id="title" required></input>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="link" class="col-sm-3 col-form-label text-sm-right">Article Link</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="link" id="link" required></input>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="description" class="col-sm-3 col-form-label text-sm-right">Description:</label>
				<div class="col-sm-9">
					<textarea name="description" id="description" class="form-control"></textarea>
				</div>
			</div><!-- .form-group -->

			<div class="form-group row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 mt-2">
						<button type="submit">Submit</button>
						<button type="reset">Reset</button>
						<a id="go-back" role="button" style="background-color: #FFCC00" href="resources.php">Go Back</a>
					</div>
			</div>
		</form>
	</div>
<?php endif; ?>
</body>
</html>