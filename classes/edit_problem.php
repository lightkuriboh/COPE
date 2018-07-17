<div id = "resp">
	<?php
		include ("restricted_component.php");
		if (isset($_REQUEST['ID']) && $_REQUEST["ID"] != "") {			
			if (isset($_REQUEST["new_val"]) && $_REQUEST["new_val"] != "") {
				include ("connect_problems.php");
				$query = "select * from problems_info where ID = '".$_REQUEST["ID"]."'";
				$result = mysqli_query($con, $query);				
				if (mysqli_num_rows($result)) {
					$query = "UPDATE problems_info SET ";
					$more = $_REQUEST["field"]." = '".$_REQUEST["new_val"]."' Where ID = '".$_REQUEST["ID"]."'";
					$query .= $more;
					if (mysqli_query($con, $query))
						echo "Success\n";
					else echo "Failure\n";						
				} else {
					echo "Cannot find Problems!\n";
				}
			} else {
				echo "Enter a new value\n";
			}
		} else {
			echo "Enter an ID\n";
		}
	?>
</div>
