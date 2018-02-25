<html>
	<body>
		<div onload = 'change()'>
			<?php 
				include('classes/connect_problems.php'); 
				include("classes/session.php");
			?>
			<?php
				global $status;
				if(isset($_FILES['code'])) {
					$maxFileSize = 1024 * 1024;
					if($_FILES['code']['size'] > 0 && $_FILES['code']['size'] <= $maxFileSize) {
						
						//$path = $main_directory."/data/";
						$path = "data/";
						
						//Find out next submition id
						$qrID = "SELECT max(Submission_ID) AS mxx FROM submission";
						$mx = mysqli_query($con, $qrID);
						$mx_row = $mx->fetch_object();
						
						if (strlen($mx_row->mxx) == 0) $mx_row->mxx = -1;
						// Set name of submition
						$new_name = "[".($mx_row->mxx + 1)."]"."[".$_SESSION['UserName']."][".$_REQUEST['pro']."]";
						$cur_name = $_FILES['code']['name'];
						$new_ID = $mx_row->mxx + 1;
						// Determine the extend of submit file
						$extend = "";
						for ($i = 0; $i < strlen($cur_name); $i++) 
						{
							if ($cur_name[$i] == '.')
							{
								for ($j = $i; $j < strlen($cur_name); $j++) $extend .= $cur_name[$j];
								break;
							}
						}
						$extend = strtolower($extend);

						// Copy file
						if ($extend == ".cpp" || $extend == ".pas" || $extend == ".py" || $extend == ".java") {
							$info = move_uploaded_file($_FILES['code']['tmp_name'], "tmp/".$new_name.$extend);
							if ($info) {
								$query_room = "select * from room_number where 1";
								$room_number = mysqli_fetch_array(mysqli_query($con, $query_room))['number'];
								$max_room = mysqli_fetch_array(mysqli_query($con, $query_room))['max'];
								
//								echo "queue/room".$room_number."/".$new_name.$extend."<br>";
								//exit;
								copy("tmp/".$new_name.$extend, "source/".$new_ID.$extend);

								copy("tmp/".$new_name.$extend, "queue/room".$room_number."/".$new_name.$extend);

								//copy("tmp/".$new_name.$extend, "judge/submissions/".$new_name.$extend);

								$query_update_room = "update room_number set number = ".(($room_number + 1) % $max_room)." where 1";
								if (mysqli_query($con, $query_update_room)) echo "update room success\n";
								// Temporary result
								$result = "Judging...(in queue)";
								//$result = 0;
								//Set submit time
								date_default_timezone_set("Asia/Jakarta");
								$Date = date("Y-m-d H:i:s");	
								//Set language
								$language = "C++";
								if ($extend == ".pas")
									$language = "Pascal";
								//Insert into database
								
								$insertqr = "insert into submission 
									(Submission_ID, Problems_ID, Problems_Name, User_Name, Language, Score, Submit_Time, Status)
										values
										('".($mx_row->mxx + 1)."', '".$_REQUEST['pro']."', '".
										$_REQUEST['pros_name']."', '".$_SESSION['UserName']."', '".$language
										."', '"."0"."', '".$Date.  "', '"."$result"."')
								";
								if (mysqli_query($con, $insertqr)) echo "query success"; else echo mysqli_error($con);
								//$insertqr = "insert into Compiler(Task) values ('"."/var/www/html/judge/submissions/".$new_name.$extend."')";
								//$insertqr = "insert into Compiler(Task) values ('"."".$new_name.$extend."')";
								//mysqli_query($con, $insertqr);
							} else echo "cannot move file<br>";
							// Give status of query to insert into database
							$status = "Success!";
						} else {
							$status = "Not support this file!";
						}
					} else {
						$status = "Too big file!";
					}
				} 
				else {
					$status = "File not set!";
				}

			?>			
		</div>
		<script type = "text/javascript">
			setTimeout(function change() {	
				//$.notify(<?php echo $status; ?>, "info");
				window.location.replace('submission.php?page=1');
			}, 000);	
		</script>
	</body>
</html>
