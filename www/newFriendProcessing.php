<?php 

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
session_start();
require_once("../config/pdo.php"); 
		session_regenerate_id(true);
	//update the friendship 
		$sql = "INSERT into Friendships(instigatorUsername,newFriendUserName)
			VALUES (:inst, :user);";
			
		$stmt = $pdo->prepare ($sql);
		$stmt->bindParam(":inst", $_SESSION["username"]);
		$stmt->bindParam(":user", $_POST["newFriend"]);
		$stmt->execute();
		
		
		$movieid = $_SESSION["pastID"];
		unset($_SESSION["pastID"]);
		header("Location: moviePage.php?id=$movieid");
		
	} 
	
	else {
		header("Location: homePage.php);
	}
		



	// next: turn all movies into links 
	// bootstrap each page 
	// links for each user 
	// friendrequests on user page if session matches get 
	// double checking on XSS 
	// keeping people from typing in the processing pages 
	// 





?>