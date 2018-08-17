<div id= "nav">
	
		<ul id = "menu">
			<li> 
				<a href = "../../index.php" > Home
				</a> 
			</li>		
			<li> 
				<a href = "../../problems.php" > Problems Set
				</a> 
			</li>
			<li> 
				<a href = "../../Contest/" > Contest
				</a> 
			</li>
			<li>
				<a href = "../../submission.php?page=1"> Submissions
				</a> 
			</li>	
			<li>
				<a href = "../../Ranking.php"> Ranking
				</a>
			</li>
			<!-- <li> <a href = "/Library/"> Library </a> </li> -->
			<li>
				<?php
					if (!Not_logged_in())
						echo "<a href = 'profile.php?username=".$_SESSION['UserName'].
						"'> See my profile </a>";
				?>
			</li>
			<!--
			<li>
				<?php
					/*
					if (!Not_logged_in() && isset($_SESSION['IsAdmin']) && 
						($_SESSION['IsAdmin'] == 'Boss' || $_SESSION['IsAdmin'] == 'Admin'))
						echo "<a href = 'Admin.php'> For Admin </a>";
					*/
				?>
			</li>
			-->			
		</ul>	
	
</div>
<?php
	if (!Not_logged_in() && isset($_SESSION['IsAdmin']) && 
					($_SESSION['IsAdmin'] == 'Boss' || $_SESSION['IsAdmin'] == 'Admin')) {
		echo "
			<div id = 'footer'>
				<ul id = 'menu' style = 'vertical-align: middle;'>
					<li>";		
							
		echo "<a href = 'Admin.php'> <p>For Admin</p> </a>";			
		echo "			</li>		
				</ul>
			</div>
		";
					}
?>
				