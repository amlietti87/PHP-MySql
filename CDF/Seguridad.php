<?php

	session_start();
	
	if(!isset($_SESSION['Validado']))
	{
		header("Location:index.php");
	}
		
?>

