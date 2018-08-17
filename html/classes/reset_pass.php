
<?php
	include ("restricted_component.php");
	if ($_REQUEST['un'] != "") {
		include ("connect_user.php");
		$query1 = "select * from user_infomation where UserName = '".$_REQUEST['un']."'";
		$result1 = mysqli_query($con, $query1);
		if (mysqli_num_rows($result1)) {
			$result = mysqli_fetch_array(mysqli_query($con, $query1));
			if ($result['Power'] != 'Boss') {
				$newPass = "123456789";
				$newPass = md5($newPass);    
				$query = "UPDATE user_infomation SET Password = '".
							$newPass."' where UserName = '".$_REQUEST['un']."'";
				if (mysqli_query ($con, $query)) echo "Success"; else echo "Failure";    
			} else echo "You don't have enough power!";
		} else {
			echo "Cannot find username!"
		}
	} else {
		echo "Enter a username!";
	}
?>

