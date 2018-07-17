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
					<div style = "width:35%;margin:0px auto;text-align:center;">
						<?php
							include("Forms/login_panel.php");
						?>
					</div>
				</div>
			</div>			
		</div>
	</body>
</html>