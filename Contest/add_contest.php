<!DOCTYPE html>
<html>
	<title>
		Kuriboh Kute
	</title>
	<head>		
		<?php
			include("../header.php");
		?>				
	</head>
	<body>				
		<div class = "session_classes">
			<?php
				include("../session.php");
			?>
		</div>
		<div id = "main_block">
			<div id= "header">
				<?php
					include("../logo.php");
				?>		
			</div>
			<?php
				include ("Origin.php");
			?>			
			<div id = "main">
				<div id = "main_content">
					<section>
						<?php
							//include ("./classes/connect_user.php");
							include("../Forms/add_contest_form.php");
						?>
					</section>
					<aside style = "color:green;">						
					</aside>
				</div>
			</div>			
		</div>
	</body>
</html>
