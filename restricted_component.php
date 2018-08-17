<?php
	if (Not_logged_in() || (!isset($_SESSION['IsAdmin'])) || 
	($_SESSION['IsAdmin'] != 'Boss' && $_SESSION['IsAdmin'] != 'Admin')) {
		Die("You don't have permission to access this content!");
	}
?>