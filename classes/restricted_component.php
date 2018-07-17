<?php
	session_start();
	if (!isset($_SESSION['IsAdmin']) || ($_SESSION['IsAdmin'] != 'Boss' && $_SESSION['IsAdmin'] != 'Admin')) {
		die("You don't have permission to access this content!");
	}
?>
