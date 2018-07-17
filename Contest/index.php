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
						<table id = "table_list">
							<?php
								include ("./classes/check_login.php");
								if (isAdmin()) echo "<tr> <button id = 'add_contest'> Add Contest </button></tr>";
							?>
							<tr style = "font-size:180%;color:green;"> <th> Contest Name </th> <th> Writer </th> </tr>
							<tr>
								<td>
									<p> CSP beta Contest #000 </p> <a href = "000"> Enter </a>
								</td>
								<td>
									<p style = "color:red;"> Kuriboh_On_Fire </p>
								</td>
							</tr>							
						</table>
					</section>
					<aside style = "color:green;">						
					</aside>
				</div>
			</div>			
		</div>
	</body>
	<script>		
		$("button#add_contest").click(function() {
			//window.open("add_contest", "", "height=500px,width=500px;");
			window.location.href = "add_contest";
		});
	</script>
</html>
