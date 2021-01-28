<?php
	// get url of page we're on to append "active" to one of the boxes
	$thispage = basename($_SERVER["SCRIPT_FILENAME"], '.php');
	$loggedin= false;
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, intial-scale=1">

	<style>
		/*@import url(@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap');*/
		@import url('https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600&display=swap');
		* {
			box-sizing: border-box;
		}
		html,body{
			margin: 0;
			padding: 0;
			/*font-family: 'Noto Sans', sans-serif;*/
			font-family: 'Work Sans', sans-serif;
			font-size: 20px;
		}
		.navbar{
			display:flex;
			flex-direction: row; 
			justify-content: flex-start;
			width: 100%;
			position:absolute;

		}
		.item{
			padding:10px;
			padding-top:14px;
			margin-right:10px;
			min-width: 100px;
			color:#777777;
			overflow:hidden;
			text-align: center;
			text-decoration: none;


			border-radius: 10px;
			transition: all 0.5s;
		}

		.item:hover{
			color:#990000;
			background-color: rgba(255,204,0, 0.3);
		}

		.active{
			color:#990000;
		}

		.logo{
			width:150px;
			overflow: hidden;
			padding:2px;
		}
		.logopic{
			height:50px;
			display:block;
			margin-left: auto;
  			margin-right: auto;
		}

/*----------right side*/
		.right{
			position: absolute;
			top:0;
			right:0;
			width: 30%;
			margin-top:10px;
			display: flex;
			justify-content: flex-end;

			margin-right:20px;
			padding-top:14px;
			font-size: 16px;
			/*border:2px solid red;*/
		}

/*		.user{
			color:#990000;
			padding:10px;
			border-bottom: 2px solid #990000;
			border-radius: 0;

			width:100%;

			margin-right:7px;
		}*/
		.search{
			width:100%;
			border: 2px solid lightgray;
			text-align: left;
			height:40px;

			/*font-family: 'Noto Sans', sans-serif;*/
			font-family: 'Work Sans', sans-serif;
			border-radius: 10px;
		}

		.hidden{
			display: none;
		}

		@media(max-width: 991px){
			.navbar{
				flex-wrap: wrap;
				justify-content: space-between;
			}
			.item{
				width:100%;
			}
		}

		@media(max-width: 768px){
			.search{
				display:none;
			}
		}
			

	</style>
</head>
<body>
	<div class="navbar">
			<a href="home.php" class="logo"><img class="logopic" src="images/navlogo2.png"></a>
			<a href="home.php" class="<?php if($thispage == "home") echo "active";?> item"><strong>HOME</strong></a>
			<a href="about.php" class="<?php if($thispage == "about") echo "active";?> item">ABOUT</a>
			<a href="resources.php" class="<?php if($thispage == "events") echo "active";?> item">RESOURCES</a>
			<a href="#" class="<?php if($thispage == "matching_tool") echo "active";?> item"><strike>HEATLHCARE TOOL</strike></a>
	</div>
	<div class="right">
		<div class="col">
			<?php if($loggedin) echo '<a href="#" class="user item"> Log Out</a>';?>
			<?php if(!$loggedin) echo '<a href="login.php" class="user item"> Login/Sign Up</a>';?>
		</div>
		<div class="col">
			<form><input type="text" class="search hidden" placeholder="Search"></input></form> <!--unhide the search button later TODO-->
		</div>
	</div>
</body>
</html>