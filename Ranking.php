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
	<body  onload = "Reload()">
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
			<div id = "main_content">				
				<table id = "table_list">												
					<?php
						if (!isset($_REQUEST['Pro']) || (isset($_REQUEST['Pro']) && $_REQUEST['Pro'] == ""))
						{
							include ("Table/FinalScore_table.php");
							include ("classes/list_final_score.php");
						} else {
							include ("classes/list_AC.php");
						}
					?>
				</table>
				<ul class = "pagination">
					<?php
						if (!isset($_REQUEST['Pro']) || (isset($_REQUEST['Pro']) && $_REQUEST['Pro'] == ""))
						{
							include("classes/List_page_rank.php");
						}
						
					?>
				</ul>				
			</div>				
		</div>
		<script>
			setTimeout( function Reload() {
				window.location.reload(true);
			}, 5000);
		</script>
	</body>
</html>