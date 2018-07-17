<?php
	include('connect_problems.php');
?>
<?php
	if (isset($_REQUEST['User']) && isset($_REQUEST['Pro']))
        $queryy = "select * from submission where User_Name = ? and Problems_ID= ?";
    else
        if (isset($_REQUEST['User']))
            $queryy = "select * from submission where User_Name = ?";
    else
        if (isset($_REQUEST['Pro']))
            $queryy = "select * from submission where Problems_ID = ?";

    if (isset($_REQUEST['User']) || isset($_REQUEST['Pro'])) {

		$stmt = $con->prepare($queryy);

		if (isset($_REQUEST['User']) && isset($_REQUEST['Pro']))
			$stmt->bind_param("ss", $_REQUEST['User'], $_REQUEST['Pro']);
		else
		if (isset($_REQUEST['User']))
			$stmt->bind_param("s", $_REQUEST['User']);
		else
		if (isset($_REQUEST['Pro']))
			$stmt->bind_param("s", $_REQUEST['Pro']);

		$stmt->execute();
		$pros = $stmt->get_result();
		$stmt->close();
        $num_rows = mysqli_num_rows($pros);

        $lim = (int)($num_rows / 20) + ($num_rows % 20 > 0);
        global $page;
        if (!isset($_REQUEST['page'])) $page = '1';
        else $page = $_REQUEST['page'];
        $page = (int)$page;
        $mod = 20;
        if ($page == $lim) {
            $mod = $num_rows % 20;
            if ($mod == 0) $mod = 20;
        } else $mod = 20;	
		$submit_info = $pros;
        $result = array();
        while ($row = mysqli_fetch_array($submit_info)) $result[] = $row;
        $result = array_reverse($result);
		$ar = array();
		$size = 0;
		foreach ($result as $row) {
			$ar[$size] = $row;
			$size++;
		}		
		
        for ($i = 20 * ($page - 1); $i < min($size, 20 * ($page)); $i++) {
			$row = $ar[$i];
            if (isset($_SESSION['UserName']) && $_SESSION['UserName'] == $row['User_Name']) $more = "background-color: #DEFBDE;";
			if ((int)$row['Status'][0] >= 0 && (int)$row['Status'][0] <= 9 && strlen($row['Status']) > 2 && (double)$row['Status'] >= 100) {
				echo "<tr style = 'color:green;".$more."'>";
			}
			else 
			if ((int)$row['Status'][0] >= 0 && (int)$row['Status'][0] <= 9 && (double)$row['Status'] <= 0) {
				echo "<tr style = 'color:red;".$more."'>";
			}
			else
			if ($row['Status'][0] == 'J') {
				echo "<tr style = 'color:#4f0707;".$more."'>";
			}
			else {
				echo "<tr style = 'color:#e58c39;".$more."'>";
			}
			echo  "<td>";
						$can = isset($_SESSION['UserName']) && ($row['User_Name'] == $_SESSION['UserName'] || $_SESSION['IsAdmin'] == 'Boss' || $_SESSION['IsAdmin'] == 'Admin');

            if (isset($_SESSION['UserName']) && ($row['User_Name'] == $_SESSION['UserName'] || 
                    $_SESSION['IsAdmin'] == 'Boss' || $_SESSION['IsAdmin'] == 'Admin'))
                echo "<a href = '/watcher.php?file=".$row['Submission_ID'].
                        ".cpp' target='_blank'>".$row['Submission_ID']."</a>";
            else
                echo $row['Submission_ID'];
            echo "</td> <td>";
            //echo "<a href = 'problems.php?code=".$row['Problems_ID']."'>".$row['Problems_ID']."</a>";
            echo "<a href = '/problems/".$row['Problems_ID']."'>".$row['Problems_ID']."</a>";
            echo "</td><td>";
            //echo "<a href = 'profile.php?username=".$row['User_Name']."'>".$row['User_Name']."</a>";
            echo "<a href = '/user/".$row['User_Name']."'>".$row['User_Name']."</a>";
            echo "</td> <td>";
            echo $row['Language'];
            echo "</td> <td>";
			if ($can && is_numeric($row['Status'])) echo "<a href = '/watcher.php?file=".$row['Submission_ID'].".txt' target = '_blank'>";
			if (is_numeric($row['Status'])) echo round($row['Status'], 2); else echo $row['Status'];
			if ($can && is_numeric($row['Status'])) echo "</a>";
            echo "</td> <td>";
            echo $row['Submit_Time'];
            echo "</td></tr>";
        }
    }
?>
