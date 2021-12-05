<?php 
session_start();
require_once("../config/adminAuth.php");
require_once("../config/base.php");

session_regenerate_id(true);


	
	require_once("../config/pdo.php");
	



if(isset($_POST["actorName"])) {
	$value = $_POST["actorName"];
	
	$sql = "INSERT INTO actors (actorName)
			VALUES(:name);";
	
	$stmt = $pdo->prepare($sql); 
	
	$stmt->bindParam(':name', $value);
	$stmt->execute();
	
	
		
	
	
	
	
	
	
	
	
	
	
	

}

else if (isset($_POST["director"])) {
	$value = $_POST["director"];
	
	$sql = "INSERT INTO directors (directorName)
			VALUES(:name);";
	
	$stmt = $pdo->prepare($sql); 
	
	$stmt->bindParam(':name', $value);
	$stmt->execute();
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

else if (isset($_POST["genre"])) {
	$value = $_POST["genre"];
	try {
	$sql = "INSERT INTO genres (genreType)
			VALUES(:name);";
	
	$stmt = $pdo->prepare($sql); 
	
	$stmt->bindParam(':name', $value);
	$stmt->execute();
	} 
	catch (Exception $w) {
		 $error = "Entry already exists";
	}
	
	
	
	
	
	
	
	
	
	
	
	
}


else if (isset($_POST["studio"])) {
	
	$value = $_POST["studio"];
	try {
	$sql = "INSERT INTO studios (studioName)
			VALUES(:name);";
	
	$stmt = $pdo->prepare($sql); 
	
	$stmt->bindParam(':name', $value);
	$stmt->execute();
	} 
	catch (Exception $w) {
		 $error = "Entry already exists";
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}


	if(isset($error)) {
		
		header("Location: admin.php?error=$error");
		
	}
	else{
	header("Location: admin.php");
	}

?>
