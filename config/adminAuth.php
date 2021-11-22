<?php 
	require_once("../config/pdo.php"); 
	
//1. Check if username is set 
//2. If set, check the admin boolean for the user 
//3. If not true, could do some type of pop up or send them back to the home screen and print out some type of message 
//fix this by going out to the DB to verify admin 
	if(isset($_SESSION["username"])) {
	$sql = "SELECT admin FROM Users 
			WHERE username = :user;";
	
	$stmt = $pdo->prepare ($sql);
	$stmt->bindparam(':user', $_SESSION["username"]);
	$stmt->execute();	
	$row = $stmt->fetch(PDO::FETCH_ASSOC); 
	if ($row['admin'] != 1) {
		header("Location: homePage.php");
	}
	}
	else {
		header("Location: homePage.php");
	}
	/*
	if(!isset($_SESSION["username"]) || !isset($_SESSION["admin"])){
		if($_SESSION["admin"] != True){
		header("Location: homePage.php"); 
		}
		
	}
	*/



?>