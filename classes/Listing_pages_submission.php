<?php 
	global $pages;
	$pages = 1;
	if (isset($_REQUEST['page']) && $_REQUEST['page'] != 0) $pages = $_REQUEST['page'];
	
	global $more;
	$more = "";
	if (isset($_REQUEST['page']) && $_REQUEST['page'] > 1) {		
		if (isset($_REQUEST['User']) && isset($_REQUEST['Pro']))
			//$more = "User=".$_REQUEST['User']."&Pro=".$_REQUEST['Pro'];
			$more = "/user/".$_REQUEST['User']."/problem/".$_REQUEST['Pro'];
		else
			if (isset($_REQUEST['User']))
				//$more = "&User=".$_REQUEST['User'];
				$more = "/user/".$_REQUEST['User'];
		else
			if (isset($_REQUEST['Pro']))
				//$more = "&Pro=".$_REQUEST['Pro'];
				$more = "/problem/".$_REQUEST['Pro'];		
		echo
			"<li> 
				<a href = '/submission".$more."/page/".($_REQUEST['page'] - 1)."'> 
					Prev 
				</a> 
			</li>";		
	}
?>
<?php
	$query;
	global $num_rows;
	if (isset($_REQUEST['User']) || isset($_REQUEST['Pro'])) {
		if (isset($_REQUEST['User']) && isset($_REQUEST['Pro'])) {
			$query = "select * from submition where User_Name = '".
						$_REQUEST['User']."' and Problems_ID='".
				$_REQUEST['Pro']."' ";
			//$more = "User=".$_REQUEST['User']."&Pro=".$_REQUEST['Pro'];
			$more = "/user/".$_REQUEST['User']."/problem/".$_REQUEST['Pro'];
		}
		else
			if (isset($_REQUEST['User'])) {
				$query = "select * from submition where User_Name = '".$_REQUEST['User']."' ";
				//$more = "&User=".$_REQUEST['User'];
				$more = "/user/".$_REQUEST['User'];
			}
		else 
			if (isset($_REQUEST['Pro'])) {
				$query = "select * from submition where Problems_ID = '".$_REQUEST['Pro']."' ";
				//$more = "&Pro=".$_REQUEST['Pro'];
				$more = "/problem/".$_REQUEST['Pro'];
			}
	} 
	else
		$query = 'select * from submition';
	$pros = mysqli_query($con, $query);
	if ($pros)
		$num_rows = mysqli_num_rows($pros);
	$lim = (int)($num_rows / 20) + ($num_rows % 20 > 0);
	echo "<li><a href = '/submission".$more."/page/"."1"."'> "."1"." </a> </li>";
	if ($pages == 1) {		
		if ($lim > 2) echo "<li><a href = ''> ... </a> </li>";
	} else 
	if ($pages == 2 && $lim > 2) {
		echo "<li><a href = '/submission".$more."/page/"."2"."'> "."2"." </a> </li>";
		if ($lim > 3) echo "<li><a href = ''> ... </a> </li>";
	} else
	if ($pages == $lim) {
		if ($lim > 2) echo "<li><a href = ''> ... </a> </li>";
	} else
	if ($pages == $lim - 1) {
		if ($lim > 3) echo "<li><a href = ''> ... </a> </li>";
		echo "<li><a href = '/submission".$more."/page/".$pages."'> ".$pages." </a> </li>";
	} else {
		echo "<li><a href = ''> ... </a> </li>";
		echo "<li><a href = '/submission".$more."/page/".$pages."'> ".$pages." </a> </li>";
		echo "<li><a href = ''> ... </a> </li>";
	}
	if ($lim > 1) echo "<li><a href = '/submission".$more."/page/".$lim."'> ".$lim." </a> </li>";
	/*
	if ($lim > 7) {
		for ($i = 1; $i <= 3; $i++)
			echo "<li><a href = '/submission".$more."/page/".$i."'> ".($i)." </a> </li>";
		echo "<li><a href = ''> ... </a> </li>";
		for ($i = $lim - 2; $i <= $lim; $i++)
			echo "<li><a href = '/submission".$more."/page/".$i."'> ".($i)." </a> </li>";
	} else
	for ($i = 1; $i <= $lim; $i++)
		echo "<li><a href = '/submission".$more."/page/".$i."'> ".($i)." </a> </li>";
	*/
?>
<?php 	
	if (isset($_REQUEST['User']) && isset($_REQUEST['Pro']))
		//$more = "User=".$_REQUEST['User']."&Pro=".$_REQUEST['Pro'];
		$more = "/user/".$_REQUEST['User']."/problem/".$_REQUEST['Pro'];
	else
		if (isset($_REQUEST['User']))
			//$more = "&User=".$_REQUEST['User'];
			$more = "/user/".$_REQUEST['User'];
	else
		if (isset($_REQUEST['Pro']))
			//$more = "&Pro=".$_REQUEST['Pro'];
			$more = "/problem/".$_REQUEST['Pro'];
	if ($pages < $lim) {				
		echo
			"<li> 
				<a href = '/submission".$more."/page/".($pages + 1)."'> 
					Next 
				</a> 
			</li>";
	}
?>
