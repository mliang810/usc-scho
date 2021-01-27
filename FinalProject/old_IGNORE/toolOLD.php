<?php require "navBoot.php"?>
<!DOCTYPE html>
<html>
<head>
	<title>Healthcare Matching Tool</title>
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<link rel="stylesheet" href="css/stylesheet.css">
	<link rel="stylesheet" href="css/slick.css">
	<link rel="stylesheet" href="css/slick-theme.css">

	<style>
		.slider{
			width: 80%;
			margin-left:auto;
			margin-right: auto;
		}
		.slider div{
			width: 100%;
			height:600px;
			max-width: 1600px;
			background-color: rgba(153, 0, 0, 1);

			margin-bottom: 20px;
			overflow: hidden;
		}

		.hi{
			background-color: blue !important;
		}

		.slick-prev:before {
		  color: #990000;
		}

		.slick-next:before {
		  color: #990000;
	</style>
</head>
<body>
	<br><br>
	<div class="slider" id="wrapper">
		
			<div></div>
		
	</div>

	<?php
		require "footer.php";
	?>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"> </script>
	<script src="js/slick.js" type="text/javascript"> </script>
	<script>
		$(document).ready(function(){
			$(".slider").slick({
				dots: true,
				arrows:true,	
			});
		});
	</script>
</body>
</html>