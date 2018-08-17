<?php
	include('connect_problems.php');
	//include ("class_directory.php");
?>
<?php
		global $num_rows;
		$queryy = 'select * from submission';
		$pros = mysqli_query($con, $queryy);
		if ($pros)
			$num_rows = mysqli_num_rows($pros);
		$lim = (int)($num_rows / 20) + ($num_rows % 20 > 0);
		global $page;
		$page = 1;
		if (!isset($_REQUEST['page'])) $page = '1';
		else $page = $_REQUEST['page'];		
		$mod = 20;
		if ($page == $lim) {
			$mod = $num_rows % 20;
			if ($mod == 0) $mod = 20;
		} else $mod = 20;		
		$query = "select * from submission LIMIT ".(max(0, $num_rows - $page * 20)).", ".$mod;
		$submit_info = mysqli_query($con, $query);
		$result = array();
		if ($submit_info)
			while ($row = mysqli_fetch_array($submit_info)) $result[] = $row;
		$result = array_reverse($result);
		foreach ($result as $row)
		{						
			$more = "";
			if (isset($_SESSION['UserName']) && $_SESSION['UserName'] == $row['User_Name']) $more = "background-color: #DEFBDE;";
			if ((int)$row['Status'][0] >= 0 && (int)$row['Status'][0] <= 9 && strlen($row['Status']) > 2 && (double)$row['Status'] >= 100) {
				echo "<tr class = 'success'>";
			}
			else 
			if ((int)$row['Status'][0] >= 0 && (int)$row['Status'][0] <= 9 && (double)$row['Status'] <= 0) {
				echo "<tr class = 'danger'>";
			}
			else
			if ($row['Status'][0] == 'J') {
				echo "<tr class = 'info'>";
			}
			else {
				echo "<tr class = 'warning'>";
			}
			echo  "<td>";
			$can = isset($_SESSION['UserName']) && ($row['User_Name'] == $_SESSION['UserName'] || $_SESSION['IsAdmin'] == 'Boss' || $_SESSION['IsAdmin'] == 'Admin');
			if (isset($_SESSION['UserName']) && ($row['User_Name'] == $_SESSION['UserName'] || 
					$_SESSION['IsAdmin'] == 'Boss' || $_SESSION['IsAdmin'] == 'Admin'))
				{
					$extended = $row['Language'];
					if ($extended == "C++") $extend = ".cpp";
					else
					if ($extended == "Pascal") $extend = ".pas";
					echo 
					"<a href = '/watcher.php?file=".$row['Submission_ID'].$extend."' target='_blank'>".$row['Submission_ID']
					.
					"</a>";
				}
			else
				echo $row['Submission_ID'];
			echo "</td> <td>";
			echo "<a href = '/problems/".$row['Problems_ID']."'>".$row['Problems_ID']."</a>";
			echo "</td><td>";
			echo "<a href = '/user/".$row['User_Name']."'>".$row['User_Name']."</a>";
			echo "</td> <td>";
			echo $row['Language'];
			echo "</td> <td>";
			if ($can && is_numeric($row['Status'])) echo "<a href = '/watcher.php?file=".$row['Submission_ID'].".txt' target = '_blank'>";
			if (is_numeric($row['Status'])) echo round($row['Status'], 2); else echo $row['Status'];
			if ($can && is_numeric($row['Status'])) echo "</a>";
			echo "</td> <td>";
			echo $row['Submit_Time'];
			//echo "</td> <td>";
			//echo $row['Status'];
			echo "</td></tr>";
		}
	?>
