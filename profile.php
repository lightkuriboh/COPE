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
				<div id = "main_content" style = "text-align:center;">
						<section>
							<p>					
								Solved
							</p>
							<?php
								if (isset($_REQUEST['username'])) {
									include("classes/connect_problems.php"); 							
									$query = "select * from highest_score";
									$returned_result = mysqli_query($con, $query);
									$fields = array();
									while ($field = mysqli_fetch_field($returned_result)) {
										$fields[] = $field->name;
									}
									$query = "select * from highest_score where User = ?";
									$stmt = $con->prepare($query);					
									$stmt->bind_param("s", $_REQUEST['username']);
									$stmt->execute();
									$returned_result = $stmt->get_result();
									$stmt->close();

									//$returned_result = mysqli_query($con, $query);
									$none_accept_pros = array();	
									while ($row = mysqli_fetch_array($returned_result)) {
										foreach ($fields as $field) {
											if (is_numeric($row[$field]) && (double)$row[$field] >= 99.99) 
												//echo "<a href = 'submission.php?Pro=".$field."&User=".$_REQUEST['username']."'>".$field. "</a> | ";
												echo "<a href = '/submission/user/".$_REQUEST['username']."/problem/".$field."'>".$field. "</a> | ";
											else
												if ($field != 'User' && is_numeric($row[$field]))
													$none_accept_pros[] = $field;
										}
									}
								}
							?>
							<hr style = 'border-width:5px;'/>
							<p style = 'color:red;'> Not solved </p>
							<?php
								if (isset($_REQUEST["username"]))
									foreach ($none_accept_pros as $name) 
										echo "<a href = '/submission/user/".$_REQUEST['username']."/problem/".$name."'>".
											$name. "</a> | ";													
							?>
							<hr style = 'border-width:5px;'>
							<?php
								if (isset($_REQUEST['username']))
									echo "
									<a href = '/submission/user/".$_REQUEST['username']."'>".
										"Recent submissions". 
									"</a>";
							?>
						</section>
						<aside>
							<?php
								if (isset($_REQUEST['username']) && isset($_SESSION['UserName']) && $_REQUEST['username'] == $_SESSION['UserName']) {
									if (isset($_REQUEST['Action']) && $_REQUEST['Action'] == "change_password")
										include ("Forms/change_password_form.php");																			
								}
								include("Forms/login_panel.php");
							?>
						</aside>			
			</div>			
		</div>
	</body>
</html>
