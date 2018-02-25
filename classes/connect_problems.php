<?php
	$con = mysqli_connect('localhost', 'root', 'cottoncandy', '');
	if ($con) {
		mysqli_select_db($con, "infoDB");
	}
	else

	echo " falure";
		
?>
