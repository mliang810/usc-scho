<?php
	$hasError = false;
	if(!isset($_GET['article_id']) || empty($_GET['article_id'])){
		echo "Invalid article ID";
		$hasError = true;
		exit();
	}

	else{	
		require "default/navBoot.php";
		
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if(!$mysqli){
			echo $mysqli->connect_error;
			exit();
		}
		$mysqli->set_charset('utf8');


		if($mysqli->connect_errno){
				echo $mysqli->connect_error;
				exit();
		}

		$statement_id = "SELECT * from articles where article_id=". $_GET["article_id"]. ";";
		$results_id= $mysqli->query($statement_id); //run 
		//error checking
		if(!$results_id){
			echo $mysqli->error;
			exit();
		}
		$info = $results_id->fetch_assoc();
		// var_dump($info);
	}

	if(isset($_POST) && !empty($_POST)){
		// var_dump($_POST);
		$success = false;
		if(!isset($_POST['title']) || empty($_POST['title']) || 
		!isset($_POST['link']) || empty($_POST['link'])){
			echo "Please fill out required fields";
			$hasError = true;
			exit();
		}

		else {
		
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if ( $mysqli->connect_errno ) {
				echo $mysqli->connect_error;
				exit();
			}

			//Cover optional field
			if ( isset($_POST['description']) && !empty($_POST['description']) ) {
				$description = "'" . $_POST['description'] . "'";
			} else {
				$description = null;
			}

			// s- strong, i-int, d-double, b-blob
			$statement = $mysqli->prepare("UPDATE articles SET title=?, link=?, description=? WHERE article_id=?");
			$statement->bind_param("sssi", $_POST["title"], $_POST['link'], $_POST['description'], $_POST['article_id']); 
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
	<title>Edit Form</title>
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<link rel="stylesheet" href="css/stylesheet.css">
	<link rel="styleBoot" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<style>
		#title, #link{
			width:60%;
		}
		
		button, #go-back{
			padding:10px;
		}

		#go-back{
			text-decoration: none;
			color:white;
			margin-left:15px;
		}


		.row h1{
			margin-top: 20px;
			margin-bottom: 20px;
		}

		@media(max-width: 576px){
			#title, #link{
			width:90%;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Editing Article</h1>
		<div class="col-12 text-danger">
			<?php if($hasError): ?>
				Could not edit form
			<?php endif; ?>
		</div>

		<div class="col-12 text-danger">
			<?php if(isset($success)): ?>
				<?php if(!$success): ?>
					<?php echo $info["title"]; ?> failed to update.
					NOTE: Must change something for successful update.
				<?php endif; ?>
			<?php endif; ?>
		</div>

		<form method = "POST" action="edit.php?article_id=<?php echo $_GET['article_id']; ?>&title=<?php echo $_GET['title']; ?>&link=<?php echo $_GET['link']; ?>&description=<?php echo $_GET['description']; ?>">
			<input type="hidden" name="article_id" value="<?php echo $_GET['article_id']; ?>">

			<div class="form-group row">
				<label for="title" class="col-sm-3 col-form-label text-sm-right">Article Title</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="title" id="title" value="<?php echo $info["title"];?>"></input>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="link" class="col-sm-3 col-form-label text-sm-right">Article Link</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="link" id="link" value="<?php echo $info["link"];?>"></input>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="description" class="col-sm-3 col-form-label text-sm-right">Description:</label>
				<div class="col-sm-9">
					<textarea name="description" id="description" class="form-control"><?php echo $info["description"];?></textarea>
				</div>
			</div><!-- .form-group -->

			<div class="form-group row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 mt-2">
						<button type="submit">Submit</button>
						<button type="reset">Reset</button>
						<a id="go-back" role="button" style="background-color: #FFCC00" href="resources.php">Go Back</a>
					</div>
			</div> <!-- .form-group -->

		</form>

	</div>
</body>
</html>

