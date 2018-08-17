<?php
	/*
	$query = "SELECT * FROM highest_score where 1";
	$result = mysqli_query ($con, $query);
	$tried = 0;
	$ac	= 0;
	while ($row2 = mysqli_fetch_array($result)) {
		if (is_numeric($row2[$ar[$i]['ID']]) && (double)$row2[$ar[$i]['ID']] >= 99.99) $ac++;
		if (is_numeric($row2[$ar[$i]['ID']]) ) $tried++;
	}
	*/

	$query = "SELECT ".$ar[$i]['ID']." FROM highest_score where 1";

	$result = mysqli_query ($con, $query);
	$tried = 0;
	$ac	= 0;
	while ($row2 = mysqli_fetch_array($result)) {
		if (is_numeric($row2[$ar[$i]['ID']]) && (double)$row2[$ar[$i]['ID']] >= 99.99) $ac++;
		//echo $row2[$ar[$i]['ID']];
		if (is_numeric($row2[$ar[$i]['ID']]) ) $tried++;
	}
?>
