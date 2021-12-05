<?php 

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();
	session_regenerate_id(true);
	require_once("../config/pdo.php");
	require_once("../config/base.php");
	require_once("../config/utilities.php");





//insert into the likes table a row using the above values 


	$sql = "INSERT INTO LIKES (username, commentID) 
			VALUES (:name, :comment);"; 
	$stmt = $pdo->prepare ($sql);
		$stmt->bindParam(":name", $_SESSION["username"]);
		$stmt->bindParam(":comment", $_POST["testing"]);
		
		$stmt->execute();	
		
	$movieid = $_SESSION["pastID"];
		unset($_SESSION["pastID"]);
		header("Location: moviePage.php?id=$movieid");
		
	}

	else {
		
		header("Location: homePage.php");
	}









?>