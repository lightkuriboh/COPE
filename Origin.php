<div id= "nav">
	
		<ul id = "menu">
			<li> 
				<a href = "/home" > Home
				</a> 
			</li>		
			<li> 
				<a href = "/problems" > Problems Set
				</a> 
			</li>
			<li>  <a href = "/Contest/" > Contest </a>  </li>
			<li>
				<a href = "/submission"> Submissions
				</a> 
			</li>	
			<li>
				<a href = "/Ranking"> Ranking
				</a>
			</li>
			<!-- <li> <a href = "/Library/"> Library </a> </li> -->
			<li>
				<?php
					if (!Not_logged_in())
						echo "<a href = '/user/".$_SESSION['UserName'].
						"'> Profile </a>";
				?>
			</li>	
		</ul>	
	
</div>
<?php
	if (!Not_logged_in() && isset($_SESSION['IsAdmin']) && 
					($_SESSION['IsAdmin'] == 'Boss' || $_SESSION['IsAdmin'] == 'Admin')) {
		echo "
			<div id = 'footer'>
				<ul id = 'menu' style = 'vertical-align: middle;'>
					<li>";		
							
		//echo "<a href = 'Admin.php'> <p>For Admin</p> </a>";			
		echo "<a href = '/Admin'> <p>For Admin</p> </a>";			
		echo "			</li>		
				</ul>
			</div>
		";
					}
?>
				
