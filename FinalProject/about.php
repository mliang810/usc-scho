<?php 
	require "default/navBoot.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>About Us</title>
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<link rel="stylesheet" href="css/stylesheet.css">
	<link rel="stylesheet" href="css/slick.css">
	<link rel="stylesheet" href="css/slick-theme.css">


	<style>
		@import url('https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600&display=swap');
		html, body{
			font-family: 'Work Sans', sans-serif;
		}
		
		
		.people{
			width: 80%;
			margin-left: auto;
			margin-right:auto;
			display: flex;
			flex-wrap: wrap;
			flex-direction: row;
			justify-content: space-between;
			align-content:space-between;
		}
		.profile{
			/*border-radius: 50%;*/
			width:30%;
			margin:10px;
			height: width;
			overflow: hidden;
		}

		.people img{
			padding:10px;
			border-radius: 50%;
			display: block;
			width: 80%;
			margin-left: auto;
			margin-right: auto;
		}
		h1{
			text-align:center;
			margin-top:40px;
		}


		#wrapper{
			width: 90%;
			margin: 0 auto;

		}

		#wrapper img{
			width: 100%;

		}

		.slick-prev:before {
		  color: #990000;
		}
		.slick-next:before {
		  color: #990000;
}

		@media(max-width: 991px){
			.profile{
				width: 40%;
			}

		}

		@media(max-width: 768px){
			.profile{
				width: 100%;
				margin-left: auto;
				margin-right: auto;
			}
			.people{
				margin-left: auto;
				margin-right: auto;
			}
		}
	</style>
</head>
<body>
	<br><br>
	<div class="slider" id="wrapper">
		<div><img src="images/mainlogo.png" alt="will be replaced"></div>
		<div><img src="images/mainlogo.png" alt="will be replaced"></div>
		<div><img src="images/mainlogo.png" alt="will be replaced"></div>
	</div>
	<div class="container">
		<h1> About Us </h1>
		<div class="people">
			<div class="profile">
				<img src="images/fakeperson.jpg" alt="person1">
			</div>
			<div class="profile">
				<img src="images/fakeperson.jpg" alt="person2">
			</div>
			<div class="profile">
				<img src="images/fakeperson.jpg" alt="person3">
			</div>
			<div class="profile">
				<img src="images/fakeperson.jpg" alt="person4">
			</div>
			<div class="profile">
				<img src="images/fakeperson.jpg" alt="person5">
			</div>
			<div class="profile">
				<img src="images/fakeperson.jpg" alt="person6">
			</div>
		</div>
	</div>

	<?php 
		require "default/footer.php";
	?>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"> </script>
	<script src="js/slick.js" type="text/javascript"> </script>
	<script>
		$(document).ready(function(){
			$(".slider").slick({
				dots: true,
				arrows:true
			});
		});

		function note(){
			alert("Slider images and officer profile images will be updated with mission statement at a further time");
		}

		note();
	</script>
</body>
</html>