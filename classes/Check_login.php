<?php
	function Not_logged_in()
	{
		return !isset($_SESSION['UserName']) || !$_SESSION['UserName'];
	}
?>
