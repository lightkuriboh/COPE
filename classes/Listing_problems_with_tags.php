<?php
	function cmpac($a, $b) {
		return $a['acs'] < $b['acs'];
	}
?>
<?php	
	function check ($tag, $s) {
		if ($tag == "") return 1;
		$tag = strtolower($tag);
		$s = strtolower($s);

		$size_of_tag = strlen($tag);
		$size_of_S = strlen($s);					
		if ($size_of_S < $size_of_tag) return 0;		
		for ($i = 0; $i < $size_of_S - $size_of_tag + 1; $i++) {
			$ok = 1;			
			for ($j = 0; $j < $size_of_tag; $j++)				
				if ($s[$i + $j] != $tag[$j]) $ok = 0;			
			if ($ok == 1) return 1;
		}			
		return 0;
	}
	include("connect_problems.php");
	$query = "select * from problems_info where 1";
	$result = mysqli_query($con, $query);
	if ($result) {
		$ar = array();
		$size = 0;
		while ($row = mysqli_fetch_array($result)) if ($row['Visibility'] != 0) {
			$search = "";
			if (isset($_REQUEST['search'])) $search = $_REQUEST['search'];
			$tag = $row['Tags'];
			if (check($search, $tag) == 1) {
				$ar[$size] = $row;
				$ar[$size]['ok'] = true;			
				$size++;
			}			
		}
		$ar = array_reverse($ar);
		for ($i = 0; $i < sizeof($ar); $i++) {
			include("AC_rate.php");
			$ar[$i]['acs'] = $ac;
		}
		if (isset($_REQUEST['sort']))
			usort($ar, 'cmpac');
		$pages = 1;
		if (isset($_REQUEST['page'])) $pages = $_REQUEST['page'];			
		for ($i = 20 * ($pages - 1); $i < min($size, 20 * $pages); $i++) if ($ar[$i]['ok']) {
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
			echo "<a href ='/problems/".$ar[$i]['ID']."';> ".$ar[$i]['ID']." </a>";
			echo "</td>";
			echo "<td style = 'color:green;'>";
			echo $ar[$i]['Name'];
			echo "</td>";
			//echo "<td>";
			//echo "<p> ".$ar[$i]['ScoringType']." </p>";
			//echo "</td>";
			echo "<td>";
			echo "<img id = 'status' src = '/img/solved.jpg'> </img>";
			echo $ar[$i]['acs'];
			echo "</td>";
			echo "<td>";
			echo $ar[$i]['Tags'];
			echo "</td>";
			echo "</tr>";
		}
	}
?>
