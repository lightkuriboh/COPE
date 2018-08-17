<?php
	$extend = "";
	for ($i = 0; $i < strlen($_REQUEST['file']); $i++) 
	{
		if ($_REQUEST['file'][$i] == '.')
		{
			for ($j = $i; $j < strlen($_REQUEST['file']); $j++) $extend .= $_REQUEST['file'][$j];
			break;
		}
	}
	$extend = strtolower($extend);

	

	$file = "source/".$_REQUEST['file'];
	if ($extend == '.txt')
		$file = "result/".$_REQUEST['file'];

	if ($fi = fopen($file, "r")) {
				echo"<textarea>";
		while (!feof($fi))
			echo fgets($fi);
		fclose($fi);	
				echo"</textarea>";
	} else echo "You cannot see";
?>
