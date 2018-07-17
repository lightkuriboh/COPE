<div id = "resp">
<?php			
	include ("restricted_component.php");
	include('connect_problems.php');
	if ($_REQUEST['PI'] != '') {
		if (isset($_FILES['txt']) && $_FILES['txt']['size'] > 0) {
			if (isset($_FILES['test']) && $_FILES['test']['size'] > 0) {

				$query_check_dup = "SELECT * from problems_info where ID = '".$_REQUEST['PI']."'";
				$Problems_ID_list = mysqli_query($con, $query_check_dup);
				global $ok;
				$ok = 1;
				global $num_rows;
				$num_rows = 0;
				if ($Problems_ID_list) $num_rows = mysqli_num_rows ($Problems_ID_list);
			
				if ($num_rows != 0) $ok = 0;
				if ($ok == 1) {			
				
					$path = "tmp/";
//					$path = "Problems/";
					if (isset($_REQUEST['PI'])) $PI = $_REQUEST['PI']; else $PI = "";
					if (isset($_REQUEST['PN'])) $PN = $_REQUEST['PN']; else $PN = "";
					if (isset($_REQUEST['PT'])) $PT = $_REQUEST['PT']; else $PT = "";
					if (isset($_REQUEST['TL'])) $TL = $_REQUEST['TL']; else $TL = "";
					if (isset($_REQUEST['ML'])) $ML = $_REQUEST['ML']; else $ML = "";
					if (isset($_REQUEST['T'])) $T = $_REQUEST['T']; else $T = "";
					$PS = $_SESSION['UserName'];
					if (isset($_REQUEST['S'])) $S = $_REQUEST['S']; else $S = "";
					if (isset($_REQUEST['visible'])) $Visibility = $_REQUEST['visible']; else $Visibility = "";
					$extend = "";
					$tmp_name = $_FILES['txt']['name'];
					for ($i = strlen($tmp_name); $i >= 0; $i--) {
						$extend = $tmp_name[$i].$extend;
						if ($tmp_name[$i] == '.') break;
					}
				
					$query = "
							INSERT INTO problems_info 
								(ID, Name, ScoringType, Location, TimeLimit, MemoryLimit, Tags, Setter, INPUT, OUTPUT, Source, Visibility) 
							VALUES 
								('".
									$PI."', '".$PN."', '"."oi"."', '".
									$path.$PI.$extend.
									"', '".$TL."', '".$ML."', '".$T."', '".$PS.
									"', 'standard input', 'standard output', '".$S."', '".$Visibility.
							"')";

					$added = mysqli_query($con, $query);
					if ($added) echo " Add problems successfully\n";
					else echo "Not add successfully\n";

					$query = "ALTER TABLE highest_score ADD COLUMN ".$_REQUEST['PI']." DOUBLE";
					$xxx = mysqli_query($con,  $query);
					//------------------------------------------------------------------------------
					$new_name = $PI.$extend;			
					if (isset($_FILES['txt'])) {
						if (move_uploaded_file($_FILES['txt']['tmp_name'], "../".$path.$new_name)) echo "Uploaded Succesfully \n"; 
						else echo "UpLoad File Error \n";

						if (move_uploaded_file($_FILES['test']['tmp_name'], "../".$path.$_FILES['test']['name'])) 
							echo "Uploaded test successfully\n";
						else
							echo "Uploaded test error\n";
					}			
					
				} else echo "Problem's ID Duplicated\n";
			} else echo "Test not set\n";
		} else echo "File not set! \n";
	} else echo "Problem's ID not set\n";
	
?>
</div>

