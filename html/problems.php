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
			<div class="container-fluid" style="height:60px;">
				<?php
					include("logo.php");
				?>		
			</div>
			<?php
				include ("Origin.php");
			?>									
			<div id = "main">				
				<div id = "main_content" class = 'well'>							
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
