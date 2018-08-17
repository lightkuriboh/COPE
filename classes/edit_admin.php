<div id = "resp">
	<?php		
		include ("restricted_component.php");
	?>
	<?php
		if (isset($_REQUEST['ID']) && $_REQUEST["ID"] != "") {		
			include ("connect_user.php");
			$query = "select * from user_infomation where UserName = '".$_REQUEST["ID"]."'";
			$result = mysqli_query($con, $query);				
			if (mysqli_num_rows($result)) {
				$query = "UPDATE user_infomation SET Power = ";
				$new_power = "Citizen";
				if ($_REQUEST['field'] == 'Promote') $new_power = "Admin";
				$more = "'".$new_power."' Where Username = '".$_REQUEST["ID"]."'";
				$query .= $more;
				if (mysqli_query($con, $query))
					echo "Success\n";
				else echo "Failure\n";						
			} else {
				echo "Cannot find username!\n";
			}
		} else {
			echo "Enter an username\n";
		}
	?>
</div>
