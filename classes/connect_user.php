<?php	
	$con = mysqli_connect('localhost', 'myroot', 'csp4ever', '');
	if ($con) {
		mysqli_select_db($con, 'infoDB');
	}
?>
