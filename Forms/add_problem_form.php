
<form method = "post" enctype = "multipart/form-data" id = "add_pro_form" onsubmit = "return false">	
	<input type = 'file' name = 'txt' />  
    <input type = 'text' name = 'PI' placeholder = "Problem's ID"/>
    <input type = 'text' name = 'PN' placeholder = "Problem's Name"/>
	<br>	
    <!-- <input type = 'text' name = 'PT' placeholder = "Scoring Type"> -->
    <input type = 'text' name = 'TL' placeholder = "Time Limit (s)"/>
    <input type = 'text' name = 'ML' placeholder = "Momory Limit (MB)"/>
	<br>
    <input type = 'text' name = 'T' placeholder = "Tags"/>    
    <input type = 'text' name = 'S' placeholder = "Problem's Source"/>	
	<input type = 'file' name = 'IMG' accept ='image/jpg' />
	<br/>
	
    <button> Submit </button>
	<br>
	<input type = "reset" value = "Reset our love"> 
</form>

