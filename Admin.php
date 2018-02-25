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
				<section>
					<?php					
						include ("restricted_component.php");
					?>
					<table id = "table_list">
						<tr>
							<td>
								<!-- <a href = "Admin.php?Action=addpro"/> Add new Problem </a> -->
								<a href = "/Admin/addpro"/> Add new Problem </a>
								<?php						
									if (isset($_REQUEST["Action"]) && $_REQUEST["Action"] == "addpro") {
										include("Forms/add_problem_form.php");						
									}							
								?>
							</td>
						</tr>
						<tr>
							<td>
								<!-- <a href = "Admin.php?Action=edit_problem"> Edit Problem </a> -->
								<a href = "/Admin/edit_problem"> Edit Problem </a>							
								<?php
									if (isset($_REQUEST['Action']) && $_REQUEST['Action'] == "edit_problem")
										include ("Forms/edit_problem_fields.php");
								?>
							</td>
						</tr>
						<tr>
							<td>
								<!-- <a href = "Admin.php?Action=delete_problem"> Delete Problem </a> -->
								<a href = "/Admin/delete_problem"> Delete Problem </a>
								<?php
									if (isset($_REQUEST["Action"]) && $_REQUEST["Action"] == "delete_problem") {
										include ("Forms/delete_pro_form.php");
									}
								?>
							</td>
						</tr>
						<tr>
							<td>
								<!-- <a href = "register.php"> Add account </a> -->
								<a href = "/register"> Add account </a>
							</td>
						</tr>
<!--
						<tr>
							<td>
								<a href = "/Admin/reset_password"> Reset Password </a>
								<?php
									
									if (isset($_REQUEST["Action"]) && $_REQUEST["Action"] == "reset_password") {
										include ("Forms/reset_pass_form.php");
									}								
								?>
							</td>
						</tr>
-->
						<tr>
							<td>
								
								<?php
									if ($_SESSION['IsAdmin'] == 'Boss')
										echo "<a href = '/Admin/edit_admin'> Edit admin </a>";
									if ($_SESSION['IsAdmin'] == 'Boss' && isset($_REQUEST["Action"]) && $_REQUEST["Action"] == "edit_admin") {
										include ("Forms/change_admin_form.php");
									}
								?>
							</td>
						</tr>
					</table>
				</section>
			</div>			
		</div>								
	</body>
</html>
