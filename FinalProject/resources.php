<?php 
	require "default/navBoot.php";
	$admin = false;
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if($mysqli->connect_errno){
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset("utf-8");

	//SQL query
	$sql = "select * from articles";

	$results = $mysqli->query($sql);
	if(!$results){
		echo $mysqli->error;
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

	$isDeleted = false;
	// var_dump($_GET);
	if(!isset($_GET['article_id'])){
		$delError = "Invalid article.";
	}

	else{
		$statement = $mysqli->prepare("DELETE FROM articles WHERE article_id=?");
		$statement->bind_param("i", $_GET["article_id"]);
		
		$executed = $statement->execute(); //will return false if theres an error 
		if(!$executed){
			echo $mysqli->error;
		}

		if($mysqli->affected_rows == 1){
			$isDeleted = true;
		}
		$statement->close();
	}

	$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Resources</title>
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<link rel="stylesheet" href="css/stylesheet.css">
	<link rel="boot" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style type="text/css">
		html{
			margin-bottom: 15px;
		}

		.container{
			width: 80%;
			margin-left: auto;
			margin-right: auto;
		}

		h1{
			text-align: center;
		}

		.summary{
			width: 70%;
		}
		.name{
			width: 30%;
		}
		td{
			padding: 10px;
		}



		.row{
			width: 100%;
			margin-bottom: 10px;
			height:400px;
		}
		.col{
			width: 100%;
			float:left;
			box-sizing: border-box;
			overflow: hidden;
		}
		.clearfloat{
			clear:both;
		}

		.banner-container{
			overflow: hidden;
			height: 15%;
			max-height: 400px;
			margin-bottom: 20px;
		}
		.banner-container img{
			width: 100%;
		}
		embed{
			width: 100% !important;
			height:100%;
			min-height: 200px;
			max-height: 400px;
		}

		@media(max-width: 991px){
			.col{
				width:98%;
			}
			table{
				width: 100%
			}

		}

		@media(max-width: 768px){

		}

	</style>
</head>
<body>
	<div id="empty"><br><br></div>
	<div class="container">
		<h1>Resources</h1>
	</div>
	<div class="banner-container">
		<img class="rellax" data-rellax-speed="3" src="images/banner.jpg" alt="doheny">
	</div>
	<div class="container">
		<?php if ( $isDeleted ) :?>
			<div class="text-success"><span class="font-italic"><?php echo $_GET['title']; ?></span> was successfully deleted. Refresh the page to see a change.</div>
		<?php endif; ?>
		
		<h2>Featured Articles</h2>
		<table>
			<thead>
				<tr>
					<th class="name">Article</th>
					<th class="Summary">Summary</th>

					<?php if ($admin) : ?>
						<?php echo "<th><a role='button' class='btn btn-outline-primary' href='add.php'>Add</a></th>";?>
					<?php endif; ?>
					
				</tr>
			</thead>
			<tbody>
				<?php while($row = $results->fetch_assoc()): ?>
					<tr>
						<td><a href="<?php echo $row['link'];?>"><?php echo $row["title"];?></a></td>
						<td>
							<?php echo $row["description"];?>
						</td>
						<?php if ($admin) : ?>
						
							<td id="adminOnly">
								<a onclick="return confirm('You sure you want to delete this article?')" href="resources.php?article_id=<?php echo $row['article_id']; ?>&title=<?php echo $row['title']; ?>" class="btn btn-outline-danger delete-btn">Delete</a>
								<a role="button" href="edit.php?article_id=<?php echo $row['article_id']; ?>&title=<?php echo $row['title']; ?>&link=<?php echo $row['link']; ?>&description=<?php echo $row['description']; ?>" class="btn btn-outline-warning">Edit</a>
							</td>
						<?php endif; ?>

					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
		<br>
		<h2>Infographics</h2><br>
		<div class="container">
			<div class="row">
				<div class="col"> <embed src="images/dummy.pdf" type="application/pdf"></div>
			</div>
			<div class="clearfloat"></div>
		</div>
	</div>
	<?php 
		require "default/footer.php";
	?>

	<script src="js/rellax-master/rellax.min.js"></script>
	<script> 
		var rellax = new Rellax('.rellax'); 
	</script>
</body>
</html>