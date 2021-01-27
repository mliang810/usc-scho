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
		@import url(@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap');
		* {
			box-sizing: border-box;
		}
		html,body{
			margin: 0;
			padding: 0;
			font-family: 'Noto Sans', sans-serif;
			font-size: 18px;
		}

		ul{
			list-style: none;
		}
		li{
			display:inline;
		}
		.navbar{
			display:flex;
			flex-direction: row; 
			justify-content: flex-start;
			margin-top:10px;
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

		.user{
			border-radius: 0;
			position:absolute;
			top:0;
			right:230px;
			color:#990000;
			padding:10px;
			border: 2px solid #990000;
			width:150px !important;
		}
		.search{
			width:200px !important;

			position:absolute;
			top:5px;
			right:0;

			border: 2px solid lightgray;
			text-align: left;
			height:40px;
			font-size: 18px;

		}

		.active{
			color:#990000;
		}

		.item:hover{
			background-color: rgba(255, 0, 0, 0.2);
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

		@media(max-width: 795px){
			.navbar{
				flex-wrap: wrap;
				justify-content: space-between;
			}
			.item{
				width:100%;
			}
		}
			

	</style>
</head>
<body>
	<div class="navbar">
		<ul>
			<li><a href="home.php" class="logo">hi<img class="logopic" src="images/navlogo2.png"></a></li>
			<li><a href="home.php" class="<?php if($thispage == "home") echo "active";?> item"><strong>HOME</strong></a></li>
			<li><a href="#" class="<?php if($thispage == "about") echo "active";?> item">ABOUT</a></li>
			<li></li><a href="#" class="<?php if($thispage == "events") echo "active";?> item">EVENTS</a></li>
			<li><a href="#" id="tool" class="<?php if($thispage == "matching_tool") echo "active";?> item">HEATLHCARE TOOL</a></li>
			<?php if($loggedin) echo '<li><a href="#" class="user item"> Log Out</a></li>';?>
			<?php if(!$loggedin) echo '<li><a href="#" class="user item"> Login/Sign Up</a></li>';?>
			<li><form>
				<input type="text" class="search item" placeholder="Search"></input>
			</form></li>
		</ul>
	</div>
</body>
</html>