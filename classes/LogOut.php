<?php 
	if (isset($_REQUEST['action'])) {
		session_start();
		session_destroy();
	}
?>
