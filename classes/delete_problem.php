<div id = "resp">
	<?php				
		include ("connect_problems.php");
		include ("restricted_component.php");
		if ($_REQUEST['id'] != "") {
			$query = "select * from problems_info where ID = '".$_REQUEST['id']."'";
			$result = mysqli_query ($con, $query);
			if ($result && mysqli_num_rows($result) > 0) {
				$result = mysqli_fetch_array($result);
				
				//$path = "../Problems/".$_REQUEST['id'].".txt";
				$path = "../".$result['Location'];
				//echo $path;
				if (file_exists($path)) {
					if (unlink($path)) {
						echo "Deleted problem file successfully\n";
					} else {
						echo "Access to problem file denied!\n";
					}
				}
				
				$query_delete = "delete from problems_info where ID = '".$_REQUEST['id']."'";
				if (mysqli_query($con, $query_delete)) {
					echo "Deleted infomation on server successfully!\n";
				} else {
					echo "Deleted failed!\n";
				}
				//Delete image of problems
				$path_image = "../Problems_img/".$_REQUEST['id'].".jpg";
				
				if (file_exists($path_image)) {
					if (unlink($path_image)) {
						echo "Deleted problem's image successfully\n";
					} else {
						echo "Access to image denied!\n";
					}
				} else echo "Image not exists \n";
				//Drop column in Highest_score database
				$query_drop_col = "alter table highest_score drop ".$_REQUEST['id'];
				if (mysqli_query($con, $query_drop_col)) {
					echo "All done!";
				} else {
					echo "Drop column failed!";
				}
				
			} else {
				echo "Cannot find this problem! \n";
			}
		} else {
			echo "Please enter Problems's ID! \n";
		}
	?>
</div>
