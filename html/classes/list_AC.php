
	<tr>
		<th>
			<p> UserName </p>
		</th>
			
		<th>
			<p> Name </p>
		</th>
		<th>
			<p> Điểm cao nhất </p>
		</th>
		<th>
			<p> Số lần sub không AC </p>
		</th>
	</tr>
<?php
	function cmp($a, $b) {
		return $a[1] - $b[1] < 0;
	}
	include ("connect_problems.php");
	//include ($directory_of_tables."/Submission_table.php");
	$query_now = "select * from highest_score where 1";
	$result_now = mysqli_query ($con, $query_now);	
	$ar = array(array());
	$cnt = 0;
	while ($r = mysqli_fetch_array($result_now)) {
		if ($r[$_REQUEST['Pro']] != NULL) {
			$ar[$cnt][0] = $r['User'];
			$ar[$cnt][1] = $r[$_REQUEST['Pro']];
			$cnt++;
		}
	}
	
	global $problem_Now;
	$problem_Now = $_REQUEST['Pro'];
	
	if ($cnt > 0) {
		usort($ar, 'cmp');
		foreach ($ar as $row_now) {
			$User_Now = $row_now[0];
			//-------------------------------------------------------
			echo "<tr> <td> "."<a href = '/user/".$row_now[0]."'>".$row_now[0]."</a>"."</td>";
			//-------------------------------------------------------
			include ("connect_user.php");
			$query = "select * from user_infomation where UserName = '".$row_now[0]."'";
			$result = mysqli_query($con, $query);
			if ($result) {
				$result = mysqli_fetch_array($result);
				echo "<td>"."<p style = 'color:blue;'>".$result['Name']."</p>"."</td>";
			}
			//-------------------------------------------------------
			echo "<td> "."<p style = 'color:green;'>".$row_now[1]."</p>"." </td>";
			//-------------------------------------------------------
			include ("connect_problems.php");
			$query = "select * from submission where Problems_ID = ? and User_Name = ?";
			$stmt = $con->prepare($query);
			$stmt->bind_param("ss", $problem_Now, $User_Now);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if ($result) {
				$cnt_None_AC = 0;
				while ($r = mysqli_fetch_array($result)) {					
					if ($r['Status'] >= 0.0 && $r['Status'] < 100.0)
						$cnt_None_AC++;
				}
				echo "<td>"."<p style = 'color:red;'>".$cnt_None_AC."</p>"."</td>";
			}
			//-------------------------------------------------------
			echo "</tr>";	
		}
	}
?>
