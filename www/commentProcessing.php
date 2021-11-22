<?php 
	session_start();
	  session_regenerate_id(true);
	  require_once("../config/pdo.php");
 
	
	
	
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$message = htmlentities($_POST["comment"]);
		$user = htmlentities($_SESSION["username"]);
		$movieid = htmlentities($_SESSION["movieID"]);
		
		
		$sql = "INSERT INTO Comments(username, movieID, commentMessage,submittedDate)
		VALUES(:username, :movieID, :commentMessage, CURRENT_TIMESTAMP);";
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':username',$user);
	$stmt->bindParam(':movieID',$movieid);
	$stmt->bindParam(':commentMessage',$message);
	
	$stmt->execute();
	
	
	unset($_SESSION["movieID"]);
	header("Location: moviePage.php?id=$movieid");
		
	}
	else 
	{
		unset($_SESSION["movieID"]);
		header("Location: moviePage.php?id=$movieid");
	}







?> 



