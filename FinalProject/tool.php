<?php 
	require "default/navBoot.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tool</title>
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<link rel="stylesheet" href="css/stylesheet.css">
	<link rel="stylesheetBoot" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->

	<style>
		body{
			font-size:20px;
		}
		#carousel{
			width: 100%;
			height:700px;
			background-color:lightgray;
			overflow: hidden;
			position:relative;
		}

		.carousel-item{
			width: 100%;
			height:700px;
		}
		.carousel-item img{
			width: 80%;
			opacity: 0.2;
		}
		.welcome{
			margin:0;
			padding:0;
			position: absolute;
			top: 50%;
			left: 50%;
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
		}

		#startbutton, #nextButton{
			position: absolute;
			left: 50%;
			transform: translate(-50%, -50%);
			margin:0;
			margin-top: 20px;
		}

		.welcome h1, p{
			text-align: center;
		}

		.next{
			color:royalblue;
		}
		.basics{
			padding:20px;
		}
		.basics p{
			text-align: left;
		}

		.survey{
			padding:40px;
		}
		@media(max-width: 376px){
			body{
				font-size:13px;
			}
			h1{
				font-size:25px;
			}
			h2{
				font-size: 20px;
			}
			.welcome{
				width: 100%;
				/*overflow: hidden;*/
			}

		}

	</style>
</head>
<body>
	<div id="carousel" class="carousel slide" data-ride="carousel" data-interval="false" data-wrap="false">
		<ol class="carousel-indicators">
		    <li data-target="#carousel" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel" data-slide-to="1"></li>
		    <li data-target="#carousel" data-slide-to="2"></li>
	    </ol>
	    <div class="carousel-inner">
		    <div class="carousel-item active"> <!--put active class in later-->
		    	<div class="welcome">
		    		<h1>Welcome!</h1>
		    		<p>This is our health care tool. It can help you determine what public healthcare plan is best for you and provides information on the plans you may qualify for. </p>
		    		<p class="next"><strong>Please click the right arrow to advance</strong></p>
		    	</div>
		    </div>    
		    <div class="carousel-item">
		    	<div class="welcome">
		    		<h1>Notice</h1>
		    		<p>What happens to your information?</p>
		    		<ul>
		    			<li>We will not be asking for any identifying personal information.</li>
		    			<li>Your information will remain private.</li>
		    			<li>If you are logged in, we will save the results of this survey to your account!</li>
		    		</ul>
		    		<p class="next"><strong>Please click the right arrow to advance</strong></p>
		    	</div>		
		    </div>
		    <div class="carousel-item">
		    	<div class="welcome">
		    		<h1>Directions</h1>
		    		<p>Please fill out the fields in the following survey as accurately as possible so we can provide you accurate, helpful results. Press the button below to begin!</p>

		    		<button id="startbutton">Start Survey</button>
		    	</div>		
		    </div>
	    </div>
		<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
	 	</a>
	  	<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
	  	</a>
	</div>
	<div class="basics">
		<h2>Healthcare Basics: </h2>
		<h4>Why should you get health insurance?</h4>
		<p>blah blah blah blahblah blah blah blah blah blah blah blah blah blah blah blah
		blah blah blah blahblah blah blah blahblah blah blah blahblah blah blah blah</p>
		<h4>Why should you get health insurance?</h4>
		<p>blah blah blah blahblah blah blah blah blah blah blah blah blah blah blah blah
		blah blah blah blahblah blah blah blahblah blah blah blahblah blah blah blah</p>
		<h4>Why should you get health insurance?</h4>
		<p>blah blah blah blahblah blah blah blah blah blah blah blah blah blah blah blah
		blah blah blah blahblah blah blah blahblah blah blah blahblah blah blah blah</p>
	</div>
	<?php 
		require "default/footer.php";
	?>
	
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		$("#carousel").carousel({
			  wrap: false
		});

		let j = 3;
		$("#startbutton").on("click",function(){
			console.log("Clicked start");
			console.log(j + " If j is three, then generate new start slide");
			if(j==3){
				console.log("Made new slide");
				let newSlide = document.createElement("div");
				let newIndicator = '<li data-target="#carousel" data-slide-to="'+j+'"></li>';
				j=j+1;
				$(newSlide).html("hihihihi");
				$(newSlide).addClass("carousel-item");


				$(".carousel-inner").append(newSlide);
				$(newIndicator).appendTo('.carousel-indicators');

				$('.carousel-item').removeClass('active');
				$('.carousel-indicators > li').removeClass('active');

				// hide the direction slides once they click start.
				$('.carousel-item').addClass('hidden');
				$('.carousel-indicators > li').addClass('hidden');

				// make the survey visible
				$('.carousel-item').eq(3).removeClass('hidden');
				$('.carousel-indicators > li').eq(3).removeClass('hidden');

				$('.carousel-item').eq(3).addClass('active');
				$('.carousel-indicators > li').eq(3).addClass('active');

				//load the html onto the slide of question
				$('.carousel-item').eq(3).attr('id', 'formDiv');
				$('#formDiv').load("slides.html #page1"); 

				$('#carousel').carousel();
			}
		});

		$("#carousel").on("click", "#nextButton", function() {
			console.log("ASDASDASDASDAS")
		})

/*
		$("#nextButton").on("click",function(){
			event.stopPropagation();
		    console.log("Hello");
		});
*/
		// $(function() {
		// 	$('#tool-form').submit(function() {
		//   		console.log("Submitted data.");

		//     	$.ajax({
	 //            	type: 'POST',
		//             url: 'page1.php',
		//             data: { age: $(this).inlineRadioYesNo.value}
	 //       		});

		//     	return false;
		//   	});
		// });

	</script>

</body>
</html>