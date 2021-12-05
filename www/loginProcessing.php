<?php session_start(); 
	  session_regenerate_id(true);
?>
 
<?php require_once("../config/pdo.php") ?>

<?php 
//if session[user] already exists, redirect to the homepage. 

$errors = array();





// 1. check if empty. If so, retry 
//2. check if username is in the db
	//3. if yes, see if passwords match 
		//4. If yes, start session and log in

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username = htmlentities($_POST["username"]);
$password = htmlentities($_POST["pword"]);
	
	//using pdo, query for the username where username = $username 
	$sql = "SELECT * FROM Users WHERE username = :user LIMIT 1"; 
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':user',$username);
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($row["failedLoginTime"] != null) {
	$sql = 'SELECT TIMESTAMPDIFF(SECOND, :time, NOW()) as difference'; 
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':time',$row['failedLoginTime']);
	$stmt->execute();
	
	$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($row2["difference"] < 30) {
	
		array_push($errors,"Account locked. Please wait:". (30 - $row2["difference"]) . " seconds.");
		}
	}
	
	if (empty($username)) {
	array_push($errors, "Must enter a username");
	
	}
	
	
	//if row is false, no values exist, so the 
	else if($row == false && !empty($username)) {
		
		array_push($errors, "Username does not exist.");
		$username= "";
	}
	
	
	
	
else if (empty($password)) {
	array_push($errors, "Must enter a password");
}
	// need to unencrypt pword and compare it to input
	//password_verify ($password, $row["password"])
	else if (!password_verify($password, $row["password"])){
		
		$sql = "UPDATE Users
				SET failedLoginTime = NOW()
				WHERE username = :user;";
		$stmt = $pdo->prepare($sql); 
		$stmt->bindParam(':user', $username);
		$stmt->execute();	
		
		
		
		
		
		
		
		array_push($errors,"Wrong password");
	}
	
	
	
	



if (empty($errors)) {
	//continue
	//methodize 
	//if succesful, start a session and reroute to the homepage 
	session_unset();
	session_destroy();
	session_start();
	session_regenerate_id(true);
	$_SESSION["username"] = $username;
	if($row["admin"] == 1 ){
		$_SESSION["admin"] = true; 
	}
	
	
	header('Location: homepage.php');
}
//if errors > 0, pass the errors in the session to the homepage
else {
	$_SESSION["errors"] = $errors;
	header('Location: login.php');
}


}
//if not a post method, reroute to the homePage. Keeps people from visiting this page without submitting the form first
else {
	header("Location: homePage.php");
}


?>