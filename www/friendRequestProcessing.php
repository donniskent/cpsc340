<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
session_start();
require_once("../config/pdo.php"); 
		session_regenerate_id(true);
	//update the friendship 
		$sql = "UPDATE Friendships 
			SET accepted = :value
			WHERE instigatorUsername = :inst AND newFriendUserName = :user ;";
		$stmt = $pdo->prepare ($sql);
		$stmt->bindParam(":inst", $_POST["inst"]);
		$stmt->bindParam(":user", $_SESSION["username"]);
		$stmt->bindParam(":value", $_POST["response"]);
		$stmt->execute();
		
		
		//return the updated 
		$data = array();
		$data[] = "success";
		
		
		
		
		echo json_encode($data);
		
} 
else{
	
		header("Location: homePage.php");
}









?>