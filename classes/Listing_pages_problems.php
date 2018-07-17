<?php 
	global $pages;
	$pages = 1;
	if (isset($_REQUEST['page']) && $_REQUEST['page'] != 0) $pages = $_REQUEST['page'];
	
	global $more;
	$more = "";
	$search = "";
	if (isset($_REQUEST['search'])) $search = $_REQUEST['search'];		
	if ($search != "")
		$more = "/".$search;
	if (isset($_REQUEST['sort'])) $more .= "/sort";
	if (isset($_REQUEST['page']) && $_REQUEST['page'] > 1) {
		echo "<li> <a href = '/problems".$more."/page/".($_REQUEST['page'] - 1)."'> Prev </a> </li>"; 
	}
?>
<?php	
	$num_rows = sizeof($ar);
	$lim = (int)($num_rows / 20) + ($num_rows % 20 > 0);
	echo "<li><a href = '/problems".$more."/page/"."1"."'> "."1"." </a> </li>";
	if ($pages == 1) {		
		if ($lim > 2) echo "<li><a href = ''> ... </a> </li>";
	} else 
	if ($pages == 2 && $lim > 2) {
		echo "<li><a href = '/problems".$more."/page/"."2"."'> "."2"." </a> </li>";
		if ($lim > 3) echo "<li><a href = ''> ... </a> </li>";
	} else
	if ($pages == $lim) {
		if ($lim > 2) echo "<li><a href = ''> ... </a> </li>";
	} else
	if ($pages == $lim - 1) {
		if ($lim > 3) echo "<li><a href = ''> ... </a> </li>";
		echo "<li><a href = '/problems".$more."/page/".$pages."'> ".$pages." </a> </li>";
	} else {
		echo "<li><a href = ''> ... </a> </li>";
		echo "<li><a href = '/problems".$more."/page/".$pages."'> ".$pages." </a> </li>";
		echo "<li><a href = ''> ... </a> </li>";
	}
	if ($lim > 1) echo "<li><a href = '/problems".$more."/page/".$lim."'> ".$lim." </a> </li>";
	/*1
	for ($i = 1; $i <= $lim; $i++) {		
		echo "<li><a href = '/problems".$more."/page/".$i."'> ".$i." </a> </li>";
	}
	*/
?>
<?php 
	//if (isset($_REQUEST['page']) && $_REQUEST['page'] < $lim) {
	$num_rows = sizeof($ar);
	$lim = (int)($num_rows / 20) + ($num_rows % 20 > 0);	
	$pageNow = 1;
	if (isset($_REQUEST['page'])) $pageNow = $_REQUEST['page'];
	if ($pageNow < $lim)
		echo "<li> <a href = '/problems".$more."/page/".($pageNow + 1)."'> Next </a> </li>"; 
	//}
?>
