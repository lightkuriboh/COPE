<!DOCTYPE html>
<html>
	<title>
		Kuriboh Kute
	</title>
	<head>
		<?php
			include("header.php");
		?>
	</head>
	<body>
		<div class = "session_classes">
			<?php
				include("session.php");
			?>
		</div>
		<div id = "main_block">
			<div id= "header">
				<?php
					include("logo.php");
				?>		
			</div>
			<?php
				include ("Origin.php");
			?>									
			<div id = "main">				
				<div id = "main_content">							
					<?php  										
						if (!isset($_REQUEST['code']))
						{							
							include('Problems_list.php');
						}
						else
						{
							include('classes/pros_data.php');							
						}
					?>								    
				</div>		
			</div>			
		</div>
	</body>
</html>
