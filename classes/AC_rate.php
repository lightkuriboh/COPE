<?php
	$query = "SELECT * FROM highest_score where 1";
	$result = mysqli_query ($con, $query);
	$tried = 0;
	global $ac;
	$ac	= 0;
	while ($row2 = mysqli_fetch_array($result)) {
		if ($row2[$ar[$i]['ID']] != NULL) {
			if ((double)$row2[$ar[$i]['ID']] >= 100) $ac++;
			$tried++;
		}		
	}
	/*
	if ($tried != 0) 
		//echo "<a href = 'Ranking.php?Pro=".$ar[$i]['ID']."'>".round(100 * (double)$ac/$tried, 2)."%" ."</a>";
		echo "<a href = '/Ranking/".$ar[$i]['ID']."'>".round(100 * (double)$ac/$tried, 2)."%" ."</a>";
	else
	if ($tried > 0 && $tried == $ac)
		//echo "<a href = 'Ranking.php?Pro=".$ar[$i]['ID']."'>".'100.00%'."</a>";
		echo "<a href = '/Ranking/".$ar[$i]['ID']."'>".'100.00%'."</a>";
	else
		//echo "<a href = 'Ranking.php?Pro=".$ar[$i]['ID']."'>"."0%"."</a>";
		echo "<a href = '/Ranking/".$ar[$i]['ID']."'>"."0%"."</a>";
	*/
	//echo "<img id = 'status' src = '/img/solved.jpg'> </img>";
	//echo "<a href = '/Ranking/".$ar[$i]['ID']."'>"."x".$ac."</a>";
?>
