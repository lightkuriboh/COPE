<?php
	include ("connect_user.php");
?>
<div id = 'resp'>
<?php		
	function check_letters_in_username() {
		$un = $_REQUEST['username'];
		if (strlen($un) > 30 || strlen($un) < 6) {
			echo("username's length ivalid (6 -> 30)");
			return false;
		}
		for ($i = 0; $i < strlen($un); $i++) {
			$id = ord($un[$i]);
			if ((47 < $id && $id < 58) || (64 < $id && $id < 91) || (96 < $id && $id < 123) || $un[$i] == "_" || $un[$i] == " ") continue;
			else {
				echo("ivalid username");
				return false;
			}
		}
		return true;
	}
	function check_letters_in_password() {
		$pw = $_REQUEST['password'];
		if (strlen($pw) > 30 || strlen($pw) < 6) {
			echo ("password's length ivalid (6 -> 30)");
			return false;
		}
		for ($i = 0; $i < strlen($pw); $i++) {
			$id = ord($pw[$i]);
			if ((47 < $id && $id < 58) || (64 < $id && $id < 91) || (96 < $id && $id < 123)) continue; 
			else {
				echo ("ivalid password");
				return false;
			}
		}
		return true;
	}
	function NotsamePassword() {
		if ($_REQUEST['password'] != $_REQUEST['rePassword'])
		{
			echo ('ivalid repeat password');
			return true;
		}
	}
	function check_all() { 
		if (!check_letters_in_username())
			return false;
		if (!check_letters_in_password())
			return false;
		if (NotsamePassword())
			return false;
		return true;
	}

	function query_in_server() {
		$con = mysqli_connect('localhost', 'root', 'Matkhaula123', '');
		mysqli_select_db($con, 'infoDB');
		$query = "SELECT * FROM user_infomation";
		$user_info = mysqli_query($con, $query);
		while ($row = mysqli_fetch_array($user_info))
			if ($row['UserName'] == $_REQUEST['username'])
			{
				echo ('duplicated username');
				return false;
			}
		$qrID = "SELECT max(ID) AS mxx FROM user_infomation";
		$mx = mysqli_query($con, $qrID);
		$mx_row = $mx->fetch_object();
		$md5pass = md5($_REQUEST['password']);
		$qr_insert = "
				INSERT INTO user_infomation
					(UserName, Password, Name, School, ID, Power)
				VALUES 
					('".
						$_REQUEST['username']."', '".$md5pass."', '".
						$_REQUEST['name']."', '".$_REQUEST['school']."', '".($mx_row->mxx + 1)."', '"."Citizen".
					"')";
		$add = mysqli_query($con, $qr_insert);	
		return true;
	}	
	function add_rows_to_highest_score() {
		$con = mysqli_connect('localhost', 'root', 'Matkhaula123', '');
		mysqli_select_db($con, 'infoDB');
		$query_insert_row = "
				INSERT INTO highest_score 
					(User) 
				VALUES
					('".
						$_REQUEST['username'].
					"')";
		$cur = mysqli_query($con, $query_insert_row);
	}
	//----------------------------------------------------------------------------------------------------------------------------------
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];	
	if (check_all()) {
		if(query_in_server()) {
			add_rows_to_highest_score();
			echo "Success, please login!";
		}
	}
?>
</div>
