<?php 
	session_start();
	  session_regenerate_id(true);
	  require_once("../config/pdo.php");
?>
<?php 
	
//title cant be empty 
// YoR cant be empty, must be a number 


if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!empty($_POST["movies"]) || !empty($_POST["actors"])) {
	$movie = $_POST["movies"];
	$actor = $_POST["actors"];
	var_dump($movie);
	var_dump($actor);
	} 
	else {
		$errors = array();
		array_push($errors, "Must choose at least 1 movie and 1 actor");
	}
	
	//if errors empty, pdo to submit 
	
	
	
	
	$sql = "INSERT INTO Appearances (movieID, actorID)
			VALUES(:movie, :actor)"; 
	
	$stmt = $pdo->prepare($sql); 
	
	
	$stmt->bindParam(':movie',$movie);
	$stmt->bindParam(':actor',$actor);
	$stmt->execute();


	
	
	
	










}