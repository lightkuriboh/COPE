
	<div class = "panel panel-primary">	
		<div class = "panel-heading ">
			<?php								
				if (isset($_REQUEST['username'])) echo "".$_REQUEST['username']."";
				else {
					if (!Not_logged_in()) 
						echo "".$_SESSION['UserName']. "";
					else echo "Log in";
				}
			?>
		</div>
		<div class = "panel-body">
			<div id = 'change_to_reg'>
				<?php
					if (isset($_REQUEST['username'])) {
						include("classes/connect_user.php");
						//$query = "select * from user_infomation where UserName = '".$_REQUEST['username']."'";
						$query = "select * from user_infomation where UserName = ?";
						$stmt = $con->prepare($query);					
						$stmt->bind_param("s", $_REQUEST['username']);
						$stmt->execute();
						$returned_info = $stmt->get_result();
						$stmt->close();
						$row = mysqli_fetch_array($returned_info);
					} else {
						if (Not_logged_in()) 						
							include("Forms/login_form.php");
						else 
						{
							include("classes/connect_user.php");
							$query = "select * from user_infomation where UserName = '".
										$_SESSION['UserName']."'";
							$returned_info = mysqli_query($con, $query);
							$row = mysqli_fetch_array($returned_info);
						}
					}
				?>	
				<p style = "font-size:100%;text-align:left;">
					<?php
						if (isset($_REQUEST['username'])) {
							echo "Name: ".$row['Name']."<br>"; 
							echo "School: ".$row['School']."<br>";
							if (!Not_logged_in() && $_REQUEST['username'] == $_SESSION['UserName'])
								//echo "<a href = 'profile.php?username=".$_SESSION['UserName']."&Action=change_password'> Change Password </a> ";
								echo "<a href = '/user/".$_SESSION['UserName']."/change_password'><button class = 'btn btn-info'> Change Password</button> </a> ";
						}										
					?>
				</p>
			</div>
		</div>
		<div class = "panel-footer">
			<?php
				if (!Not_logged_in())
					echo "<form id = 'logOut'>
					<button class = 'btn btn-danger' id = 'btn_logout'> LogOut </button></form>";									
				else 
					//echo "<a href = 'register.php'> Register </a>";
					echo "<a href = '/register'><button class = 'btn btn-info'> Register</button> </a>";
			?>
		</div>
	</div>
