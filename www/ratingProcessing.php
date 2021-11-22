<?php 
session_start();
session_regenerate_id(true); 
require_once("../config/pdo.php");


if($_SERVER["REQUEST_METHOD"] == "POST") {
	$answer = htmlentities($_POST["rating"]);
	$user = htmlentities($_SESSION["username"]);
	$movieid = htmlentities($_SESSION["movieID"]);
	if(!empty($answer)) {
		$sql = "INSERT INTO Ratings(username, movieID, ratingValue)
		VALUES(:username, :movieID,:rating);";
		$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':username',$user);
	$stmt->bindParam(':movieID',$movieid);
	$stmt->bindParam(':rating',$answer);
	
	$stmt->execute();
	
	
	unset($_SESSION["movieID"]);
	header("Location: moviePage.php?id=$movieid");
		
}
else 
	{
		unset($_SESSION["movieID"]);
		header("Location: moviePage.php?id=$movieid");
	}



}
	else 
	{
		unset($_SESSION["movieID"]);
		header("Location: moviePage.php?id=$movieid");
	}
		
		
		
		
		
	
	
	
	
	
	
	
	
	
	










?>


















