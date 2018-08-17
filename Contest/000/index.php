<!DOCTYPE html>
<html>
	<title>
		Kuriboh Kute
	</title>
	<head>		
		<?php
			include("../../header.php");
		?>				
	</head>
	<body>				
		<div class = "session_classes">
			<?php
				include("../../session.php");
			?>
		</div>
		<div id = "main_block">
			<div id= "header">
				<?php
					include("../../logo.php");
				?>		
			</div>
			<?php
				include ("Origin.php");
			?>			
			<div id = "main">
				<div id = "main_content">
					<section>
						<b>Before registeration</b>: 
						<p id="demo"></p>
						<b>Contest will start one day later.</b>
					</section>
					<aside>						
					</aside>
				</div>
			</div>			
		</div>
		<script>			
			var countDownDate = new Date("Nov 30, 2017 17:00:00").getTime();
			
			var x = setInterval(function() {
			  
			  var now = new Date().getTime();
			  
			  var distance = countDownDate - now;
			  
			  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			  
			  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
			  + minutes + "m " + seconds + "s ";
			  
			  if (distance < 0) {
				clearInterval(x);
				document.getElementById("demo").innerHTML = "EXPIRED";
			  }
			}, 1000);
		</script>
	</body>
</html>