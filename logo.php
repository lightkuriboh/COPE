<a href = "https://www.facebook.com/phamngoc.hieu.161" target = "_blank"> 
		<img id = "mascot" src = "/img/Kuriboh.jpg" width = "8%" height = "140%" style = "border-radius: 100%;padding:5px;"> </img>
</a>
<div style = "float:right;">
	<?php
		if (Not_logged_in()) {
			echo "<a href = '/login_page'> Login </a> | ";
			echo "<a href = '/register'> Register </a>";
		}
		else 		
			echo "<form id = 'logOut'>
				<button id = 'btn_logout'> LogOut </button></form>";													
	?>
</div>
<!--
<img id = "mascot" src = "/img/duongluoibo.jpg" width = "10%" height = "80%"> </img>
-->
