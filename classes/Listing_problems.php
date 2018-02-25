<?php
	function cmpac($a, $b) {
		return $a['acs'] < $b['acs'];
	}
?>
<?php
	global $page;
	if (!isset($_REQUEST['page'])) $page = 1;
	else $page = $_REQUEST['page'];
	$page = (int)$page; $page--;
	include('connect_problems.php');	
	$query = 'select * from problems_info where 1';
	$Pros_info = mysqli_query($con, $query);
	$ar = array();
	if ($Pros_info)
		while ($row = mysqli_fetch_array($Pros_info)) if ($row['Visibility'] == 1)
			$ar[] = $row;	
	$ar = array_reverse($ar);
	for ($i = 0; $i < sizeof($ar); $i++) {
		include("AC_rate.php");
		$ar[$i]['acs'] = $ac;
	}
	if (isset($_REQUEST['sort']))
		usort($ar, 'cmpac');	
	for ($i = 20 * $page; $i < min(sizeof($ar), 20 * ($page + 1)); $i++)
	{
		echo "<tr>";		
		if (isset($_SESSION['UserName'])) echo "<td>";
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
		if (isset($_SESSION['UserName'])) echo "</td>";
		
		echo "<td>";
		//echo "<a href ='problems.php?code=".$ar[$i]['ID']."';> ".$ar[$i]['ID']." </a>";
		echo "<a href ='/problems/".$ar[$i]['ID']."';> ".$ar[$i]['ID']." </a>";		
		echo "</td>";
		echo "<td style = 'color:green;'>";
		echo $ar[$i]['Name'];
		echo "</td>";
		//echo "<td>";
		//echo "<p> ".$ar[$i]['ScoringType']." </p>";
		//echo "</td>";
		echo "<td>";
		//include ("AC_rate.php");
		echo "<img id = 'status' src = '/img/solved.jpg'> </img>";
		echo $ar[$i]['acs'];
		echo "</td>";
		echo "<td>";
		echo $ar[$i]['Tags'];
		echo "</td>";
		echo "</tr>";
	}
?>
