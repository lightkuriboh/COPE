<table  class="table table-bordered">				
<!--
	<tr>
		<th colspan = "5", style = "color:red;font-size:200%;">
			Listing Problems
		</th>
	</tr>
-->
	<tr>
		<th colspan = "5">		
			<?php
				
				include ("Forms/search_problem_form.php");
			?>
		</th>
	</tr>
	<tr>		
		<?php
			if (isset($_SESSION['UserName'])) echo "<th><p><p></th>";
		?>		
		<th>
			<p> Problem's ID </p>
		</th>
		<th>
			<p> Problem's Name </p>
		</th>
		<!--
		<th>
			<p> Type </p>
		</th>
		-->
		<th>
			<p>
				<a href = '<?php 
								$url = "/problems/sort/page/1";
								if (isset($_REQUEST['search']) && $_REQUEST['search'] != "")
									$url = "/problems/".$_REQUEST['search']."/sort/page/1";
								echo $url;
							?>'>
				ACs
				</a>
			</p>
		</th>
		<th>
			<p> Tags </p>
		</th>		
	</tr>	
	<?php
		if (isset($_REQUEST['search']))
			include('classes/Listing_problems_with_tags.php');
		else
			include('classes/Listing_problems.php');
	?>
</table> 
<ul class = 'pagination'>
	<?php
		include('classes/Listing_pages_problems.php');
	?>
</ul>
