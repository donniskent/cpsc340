
<?php require_once("../config/pdo.php") ?>
<?php 
//if session already exists, redirect to the homepage. 

$errors = array();

$username = "";
$password = ""; 



// 1. check if empty. If so, retry 
//2. check if username is in the db
	//3. if yes, see if passwords match 
		//4. If yes, start session and log in

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username = $_POST["username"];
$password = $_POST["pword"];
	
	//using pdo, query for the username where username = $username 
	$sql = "SELECT password FROM Users WHERE username = :test LIMIT 1"; 
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':test',$username);
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	
	
if (empty($password)) {
	array_push($errors, "Must enter a password");
}
	
	else if ($row["password"] != $password){
		array_push($errors,"Wrong password");
	}
	
	
	
	if (empty($username)) {
	array_push($errors, "Must enter a username");
	
	}
	
	
	//if row is false, no values exist, so the 
	else if($row == false && !empty($username)) {
		
		array_push($errors, "Username does not exist.");
		$username= "";
	}



if (empty($errors)) {
	//continue
	echo "success";
	//if succesful, start a session and reroute to the homepage 
	session_start();
	session_regenerate_id(true);
	$_SESSION["test"] = $username;
	header('Location: homepage.php');
}



}
?>