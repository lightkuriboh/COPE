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
	<body onload = "Reload()">
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
					<table id = "table_list">	
<!--			
						<tr>
							<th  colspan = "6", style = "text-align:center; color:red; font-size:200%;cellpadding:5px;">
								Listing Submissions
							</th>
						</tr>
-->
						<?php
							include ("Table/Submission_table.php");
						?>
						<?php
							if (isset($_REQUEST['User']) || isset($_REQUEST['Pro'])) 
								include('classes/specific_require_in_listing_submissions.php');
							else
								include('classes/Listing_submissions.php');
						?>	
					</table>
		
					<ul class = 'pagination'>
						<?php
							include('classes/Listing_pages_submission.php');
						?>
					</ul>								    
				</div>		
			</div>			
		</div>
		<script>
			setTimeout( function Reload() {
				window.location.reload(true);
			}, 5000);
		</script>
	</body>
</html>
