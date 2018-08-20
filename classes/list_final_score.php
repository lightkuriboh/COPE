<?php
	//include ("class_directory.php");
	include ("connect_problems.php");
?>
<?php
	function cmp($a, $b) {
		return $a[4] - $b[4] < 0;
	}

	global $num_cols;
	global $num_rows;
	$query = 'select * from highest_score';	
	$success_query = mysqli_query($con, $query);
	$num_rows = mysqli_num_rows($success_query);
	$new_array = array();
	if ($success_query) {
		while ($row = mysqli_fetch_array($success_query)) $new_array[] = $row;	
		$query_cols = "SHOW COLUMNS FROM highest_score";
		$result_col = mysqli_query($con, $query_cols);
		$col_name = array();
		while ($col = mysqli_fetch_array($result_col))
			if ($col['Field'] != "User") $colname[] = $col['Field'];	
		foreach ($colname as $cur_col) $num_cols++;
		
		$ar = array(array());
		$size = 0;
		foreach ($new_array as $row) {
			//echo "<tr style = 'color:blue;'>";
			$UserName = $row['User'];
			$solved = 0;
			$not_solved = 0;
			$sum = 0;
			foreach ($colname as $cur_col) {				
				if ($row[$cur_col] != NULL) {
					if ((double)$row[$cur_col] >= 99.99) $solved++;
					else $not_solved++;
					$sum += (double)$row[$cur_col];
				}
			}			
			$ar[$size][0] = $UserName;
			$ar[$size][1] = $solved;
			$ar[$size][2] = $not_solved;
			$ar[$size][3] = $solved + $not_solved;
			$ar[$size][4] = $sum;
			$size++;
			/*
			
			*/
			//echo "</tr>";
		}	
		usort($ar, 'cmp');
		
		$page = 1;
		if (isset($_REQUEST['page'])) $page = $_REQUEST['page'];
		$king = $ar[0][4];
		$queen = 0;
		for ($i = 0; $i < $size; $i++)
			if ($ar[$i][4] < $king) {
				$queen = $ar[$i][4];
				break;
			}
		$jack = 0;
		for ($i = 0; $i < $size; $i++)
			if ($ar[$i][4] < $queen) {
				$jack = $ar[$i][4];
				break;
			}
		for ($i = ($page - 1) * 20; $i < min($size, $page * 20); $i++) {
			echo "<tr>";
			echo "<td>";
			//echo "<a href = 'profile.php?username=".$ar[$i][0]."'>".$ar[$i][0] . "</a>";
			if ($ar[$i][4] === $king) echo "<img id = 'status' src = '/img/king.jpg'></img> "; else
			if ($ar[$i][4] === $queen) echo "<img id = 'status' src = '/img/queen.jpg'></img> "; else 
			if ($ar[$i][4] === $jack) echo "<img id = 'status' src = '/img/jack.jpg'></img> "; else 
			echo "<img id = 'status' src = '/img/soldier.jpg'></img> ";
			echo "<a href = '/user/".$ar[$i][0]."'>".$ar[$i][0] . "</a>";
			if ($ar[$i][4] === $king) echo " <img id = 'status' src = '/img/king.jpg'></img>"; else 
			if ($ar[$i][4] === $queen) echo " <img id = 'status' src = '/img/queen.jpg'></img>"; else 
			if ($ar[$i][4] === $jack) echo " <img id = 'status' src = '/img/jack.jpg'></img>"; else
			echo " <img id = 'status' src = '/img/soldier.jpg'></img>";
			echo "</td>";
			
			echo "<td>";
			echo $ar[$i][1];
			echo "</td>";
			
			echo "<td>";
			echo $ar[$i][2];
			echo "</td>";
			
			echo "<td>";
			echo $ar[$i][3]. " / " . $num_cols ;
			echo "</td>";			
			
			echo "<td>";			
			echo round($ar[$i][4], 2);
			echo "</td>";
			
			echo "</tr>";
		}
	}
?>
