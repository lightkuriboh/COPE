<?php
	function Not_logged_in()
	{
		return !isset($_SESSION['UserName']) || !$_SESSION['UserName'];
	}
	function isAdmin() {
		return !(!isset($_SESSION['IsAdmin']) || ($_SESSION['IsAdmin'] != 'Boss' && $_SESSION['IsAdmin'] != 'Admin'));
	}
?>
