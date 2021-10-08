<?php 
	session_start();
	  session_regenerate_id(true);
	  require_once("../config/pdo.php");
?>
<?php 
	
//title cant be empty 
// YoR cant be empty, must be a number 





if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$title = $_POST["title"];
	$director = $_POST["director"];
	$genre = $_POST["genre"];
	$studio = $_POST["studio"];
	$year = $_POST["year"];
	
	$errors = array();
	
	if(empty($title) || empty($director)
		|| empty($genre) || empty($studio) 
	|| empty($year)) {
		array_push($errors,"Must fill out all fields");
	}
	
	if(!is_numeric($year)) {
		array_push($errors,"Year must only be numbers");
	} 
	
	if(empty($errors)) {
		echo "Creating user  ";
	$sql = "INSERT INTO Movies (movieTitle,directorID,genreType,studioName, releaseYear)
			VALUES(:title, :director, :genre,:studio, :year)"; 
	
	$stmt = $pdo->prepare($sql); 
	
	var_dump($genre);
	var_dump($director);
	var_dump($title);
	var_dump($studio);
	var_dump($year);
	
	$stmt->bindParam(':title',$title);
	$stmt->bindParam(':diretor',$director);
	$stmt->bindParam('genre',$genre);
	$stmt->bindParam(':studio',$studio);
	$stmt->bindParam(':year',$year);
	
	
	$stmt->execute();
	
	header("Location: admin.php");
	echo "created user";
		
		
		
		
		
		
	}
	else {
		
		$_SESSION["errors"] = $errors;
		
		header("Location: admin.php");
	}
	
	
	
	
	
}	
	
	
	
	
	
		










?> 