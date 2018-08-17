<?php
	function check_letters_in_username($un) {
		if (strlen($un) > 30 || strlen($un) < 6) {
			return false;
		}
		for ($i = 0; $i < strlen($un); $i++) {
			$id = ord($un[$i]);
			if ((47 < $id && $id < 58) || (64 < $id && $id < 91) || (96 < $id && $id < 123) || $un[$i] == "_" || $un[$i] == " ") continue;
			else {
				return false;
			}
		}
		return true;
	}
	function query_in_server()
	{
		include ("connect_user.php");
		$query = "select * from user_infomation where UserName = ?";
		$stmt = $con->prepare($query);					
		$stmt->bind_param("s", $_REQUEST['username']);
		$stmt->execute();
		$user_info = $stmt->get_result();
		$stmt->close();
		$md5ps = md5($_REQUEST['password']);		
		while ($row = mysqli_fetch_array($user_info))
			if ($row['Password'] == $md5ps) {
				session_start();
				$_SESSION['UserName'] = $username;
				$_SESSION['IsAdmin'] = $row['Power'];
				$_SESSION['NickName'] = $row['Name'];
				return true;
			}
		return false;
	}
	//----------------------------------------------------------------------------------------------
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	if (!check_letters_in_username($username)) {
		exit('false');
	}
	else
	if (query_in_server()) 
	{
		//session_start();
		$_SESSION['UserName'] = $username;
		exit('true');
	}
	else 
	{
		exit('false');
	}
?>

