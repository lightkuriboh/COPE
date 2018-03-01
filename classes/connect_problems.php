<?php
	$con = mysqli_connect('localhost', 'root', 'Matkhaula123', '');
	if ($con) {
		mysqli_select_db($con, "infoDB");
	}
	else

	echo " falure";
		
?>
