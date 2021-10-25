<?php 
	
	
//1. Check if username is set 
//2. If set, check the admin boolean for the user 
//3. If not true, could do some type of pop up or send them back to the home screen and print out some type of message 
	if(!isset($_SESSION["username"]) || !isset($_SESSION["admin"])){
		if($_SESSION["admin"] != True){
		header("Location: homePage.php"); 
		}
		
	}
	



?>