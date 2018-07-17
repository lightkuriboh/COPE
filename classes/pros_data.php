
<?php 
	include('connect_problems.php');  
	include('stmt.php');
?>
<?php
	
	if ($stmt = $con->prepare("select * from problems_info where ID = ?")) {
		$stmt->bind_param("s", $_REQUEST['code']);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
	}
	$row = $result->fetch_array();
?>

<aside>		
	<div class = "panel panel-primary">
		<div class = "panel-heading">								
			<?php
				echo $row['ID']."<br>";
			?>			
		</div>
		<div class = "panel-body" style = 'color:green;'>
			<?php
				echo "Score type: ".$row['ScoringType']."<br>";
				echo "Time Limit: ".$row['TimeLimit']."s<br>";
				echo "Memory Limit: ".$row['MemoryLimit']."MB<br>";
				echo "Input: ".$row['INPUT']."<br>";
				echo "Output: ".$row['OUTPUT']."<br>";
				echo "<hr>";				
				echo "Tags: ".$row['Tags']."<br>";
				echo "Setter: ".$row['Setter']."<br>";
				echo "Source: ".$row['Source']."<br>";
			?>
		</div>
		<div class = "panel-footer">
			<h5 style = 'color:red;'> Your Best Score: </h5>
			<?php						
				if (!Not_logged_in()) {
					$qr = "select * from highest_score where User = ?";
					$answer = NULL;
					$stmt = $con->prepare($qr);					
					$stmt->bind_param("s", $_SESSION['UserName']);
					$stmt->execute();
					$answer = $stmt->get_result();
					$stmt->close();						
					if ($answer) {
						$YourBestScore = mysqli_fetch_array($answer);
						$YourBestScore = $YourBestScore[$_REQUEST['code']];
						if (is_null($YourBestScore)) $YourBestScore = "You haven't submited solution for this problem!";
						echo $YourBestScore;
					} else echo "Error";				
				}
				else echo 'You have to log in to see your score!';							
			?>
			<hr style = "border-width:10px;">
			<?php 
				echo "<form id = 'ulform' action = '../uploadfile.php?pro=".$_REQUEST['code'].
				"&pros_name=".$row['Name']."' method = 'POST' enctype = 'multipart/form-data'>"; ?>
				<input type = "file" name = "code" style = "max-width:200px;"> <br>
				<?php
					if (!Not_logged_in())
					{
						if ($row['Visibility'] != 0)
							echo "<button id = 'ul_btn' type = 'submit' name = 'CCode' > submit</button><br>";
						else
							echo "Cannot submit solution for this problem at this time!";
					}
					else
						echo "You have to log in to submit the solution!";
				echo "</form>";
			?>				
		</div>
	</div>
</aside>
<section>

	<?php 
		//echo "<a href = 'submission.php?Pro=".$_REQUEST['code']."'> Status </a>"; 
		//echo " | <a href = 'Ranking.php?Pro=".$_REQUEST['code']."'> Rank </a>"; 
		echo "<a href = '/submission/problem/".$_REQUEST['code']."'> Status </a>"; 
		echo " | <a href = '/Ranking/".$_REQUEST['code']."'> Rank </a>"; 
	?>
	<h2 style = 'text-align:center;'>
		<?php echo "<p style = 'color: red;'>".$row['Name']."</p>"; ?>
	</h2>
	<?php
		if ($row['Visibility'] != 0) {
			if($row['Location'][strlen($row['Location']) - 1] == 'f')
				echo "<iframe style = 'width:100%;height:500px;' src = '/Problems/".$_REQUEST['code'].".pdf' /> ";
			else {
				if($fi = fopen($row['Location'], "r"))
				{
					echo "<p style = 'color: #258225;'>";
					while (!feof($fi))
						echo fgets($fi)."<br>";
					fclose($fi);
					echo "</p>";
				} else echo "File loi";	
			}
		}
	?>
	<?php
		/*
		if ($row['Visibility'] != 0) {
			//echo "<p style = 'color: #258225;'>";
			if($fi = fopen($row['Location'], "r"))
			{
				while (!feof($fi))
					echo fgets($fi)."<br>";
				fclose($fi);
			} else echo "File loi";	
			//echo "</p>";
			//--------------------------------------------------------------			
			$url_of_image = "Problems_img/".$_REQUEST['code'].".jpg";					
			if (file_exists($url_of_image)) {				
				echo "<img src = '../Problems_img/".$_REQUEST['code'].".jpg' width = '50%' height = '50%'> </img>";			
			}
		}
		*/
	?>		
		
</section>
