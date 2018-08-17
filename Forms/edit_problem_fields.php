<form method = "post" id = "edit_problem_form" onsubmit = "return false">
	<input name = 'ID' placeholder = "Problem's ID"> </br>
	Field: 
	<select id = 'edit_field' name = "field">
		<option> Tags </option>	
		<option> Name </option>	
		<option> ScoringType </option>
		<option> TimeLimit </option>
		<option> MemoryLimit </option>		
		<option> INPUT </option>	
		<option> OUTPUT </option>	
		<option> Source </option>	
		<option> Visibility </option>	
	</select>
	</br>
	<input name = 'new_val' placeholder = "New value">
	</br>
	<button id= "edit_but">
		Commit change
	</button>
</form>