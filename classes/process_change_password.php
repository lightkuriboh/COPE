<div id = 'resp'>
	<?php
		function check_letters_in_password() {
			$pw = $_REQUEST['np'];
			if (strlen($pw) > 30 || strlen($pw) < 6) {
				echo ("new password's length ivalid (6 - 30)");
				return false;
			}
			for ($i = 0; $i < strlen($pw); $i++) {
				$id = ord($pw[$i]);
				if ((47 < $id && $id < 58) || (64 < $id && $id < 91) || (96 < $id && $id < 123)) continue; 
				else {
					echo ("ivalid new password");
					return false;
				}
			}
			return true;
		}
		
		if ($_REQUEST['np'] == $_REQUEST['rnp']) {
			session_start();
			include ("connect_user.php");
			$query = "select * from user_infomation where UserName = ?";
			$stmt = $con->prepare($query);					
			$stmt->bind_param("s", $_SESSION['UserName']);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if ($result) {
				$pass_now = (mysqli_fetch_array($result))['Password'];
				$in_pass_now = $_REQUEST['cp'];
				$in_pass_now = md5($in_pass_now);
				if ($in_pass_now == $pass_now) {
					if (check_letters_in_password()) {
						$np = $_REQUEST['np'];
						$np = md5($np);
						$query = "update user_infomation set Password = '".$np."'". " where UserName = '".$_SESSION['UserName']."'";
						if (mysqli_query($con, $query)) {
							echo "Success";
						} else {
							echo "System failure";
						}
					}
				} else {
					echo "Wrong current password!";
				}
			} else {
				echo "Failure";
			}
		} else {
			echo "Two new password have to be same";
		}		
	?>
</div>
