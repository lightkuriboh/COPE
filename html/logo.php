
<button type='button' class='btn btn-success'> CSP Online Practice Enviroment</button>
<div style = "float:right;">
	<?php
		if (Not_logged_in()) {
			echo "<ul class='pager'>";
			echo "<li><a href = '/login_page'>login</a></li>";
			echo "<li><a href = '/register'>register</a></li>";
			echo "</ul>";
			//echo "<a href = '/login_page'> <button type='button' class='btn btn-primary'> login</button></a>";
//			echo "<a href = '/register'> <button type='button' class='btn btn-primary'> Register </button></a>";
		}
		else 		
			echo "<form id = 'logOut'>
				<button id = 'btn_logout' class='btn btn-danger'> LogOut </button></form>";										
	
	?>
</div>
