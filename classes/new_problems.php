<?php
	include('connect_problems.php');	
	$query = 'select * from problems_info where 1';
	$Pros_info = mysqli_query($con, $query);
	$ar = array();
	if ($Pros_info)
		while ($row = mysqli_fetch_array($Pros_info)) 
			if ($row['Visibility'] == 1)
				$ar[] = $row;	
	$ar = array_reverse($ar);
	for ($i = 0; $i < min(sizeof($ar), 10); $i++) {
		echo "<tr><td>";
		if (isset($_SESSION['UserName'])) {
			$query = "select ".$ar[$i]["ID"]." from highest_score where User = '".$_SESSION['UserName']."'";
			$result = mysqli_query($con, $query);
			if ($result) {				
				$scoreNow = mysqli_fetch_array($result);				
				$scoreNow = $scoreNow[$ar[$i]["ID"]];
				if ($scoreNow == null) $scoreNow = "";
				if ((double)$scoreNow >= 100)					
					echo "<img id = 'status' src = '/img/AC.jpg'> </img>";
				else 
				if ((double)$scoreNow > 0 && (double)$scoreNow < 100)
					echo "<img id = 'status' src = '/img/O.jpg'> </img>";
				else
					if (strlen($scoreNow) > 0)
						echo "<img id = 'status' src = '/img/X.jpg'> </img>";
				else
					echo "";
			}
		}
		echo "<a href = '/problems/".$ar[$i]['ID']."'>".$ar[$i]['ID']."</a><br>";
		echo "</td></tr>";
	}
?>
