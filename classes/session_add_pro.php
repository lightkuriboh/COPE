<div id = "resp">
<?php			
	include ("restricted_component.php");
	include('connect_problems.php');
	if ($_REQUEST['PI'] != '') {
		if (isset($_FILES['txt'])) {
			$query_check_dup = "SELECT * from problems_info where ID = '".$_REQUEST['PI']."'";
			$Problems_ID_list = mysqli_query($con, $query_check_dup);
			global $ok;
			$ok = 1;
			global $num_rows;
			$num_rows = 0;
			if ($Problems_ID_list) $num_rows = mysqli_num_rows ($Problems_ID_list);
			
			if ($num_rows != 0) $ok = 0;
			if ($ok == 1) {			
				
				//$path = $main_directory."/Problems/";
				$path = "Problems/";
				if (isset($_REQUEST['PI'])) $PI = $_REQUEST['PI']; else $PI = "";
				if (isset($_REQUEST['PN'])) $PN = $_REQUEST['PN']; else $PN = "";
				if (isset($_REQUEST['PT'])) $PT = $_REQUEST['PT']; else $PT = "";
				if (isset($_REQUEST['TL'])) $TL = $_REQUEST['TL']; else $TL = "";
				if (isset($_REQUEST['ML'])) $ML = $_REQUEST['ML']; else $ML = "";
				if (isset($_REQUEST['T'])) $T = $_REQUEST['T']; else $T = "";
				$PS = $_SESSION['UserName'];
				if (isset($_REQUEST['S'])) $S = $_REQUEST['S']; else $S = "";
				$query = "
						INSERT INTO problems_info 
							(ID, Name, ScoringType, Location, TimeLimit, MemoryLimit, Tags, Setter, INPUT, OUTPUT, Source, Visibility) 
						VALUES 
							('".
								$PI."', '".$PN."', '"."oi"."', '".
								$path.$PI.".txt".
								"', '".$TL."', '".$ML."', '".$T."', '".$PS.
								"', 'standard input', 'standard output', '".$S."', '"."1".
						"')";

				mysqli_query($con, $query);
				
				$query = "ALTER TABLE highest_score ADD COLUMN ".$_REQUEST['PI']." DOUBLE";
				mysqli_query($con,  $query);
				//------------------------------------------------------------------------------
				$new_name = $PI.".txt";				
				if (isset($_FILES['txt'])) {
					if (move_uploaded_file($_FILES['txt']['tmp_name'], "../".$path.$new_name)) echo "Uploaded Succesfully \n"; 
					else echo "UpLoad File Error \n";
				}			
				
				if (isset($_FILES['IMG'])) {
					if (move_uploaded_file($_FILES['IMG']['tmp_name'], "../Problems_img/".$PI.".jpg")) echo "Uploaded image Successfully\n";
					else echo "Not uploaded image\n";
				}
						
				echo "Added Problem Successfully\n";
			} else echo "Problem's ID Duplicated\n";
		} else echo "File not set! \n";
	} else echo "Problem's ID not set \n";
	
?>
</div>

