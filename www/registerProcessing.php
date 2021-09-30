<?php require_once("../config/pdo.php") ?>
<?php
// error checking section. Creates user if it passes validation
// firstly, no fields can be left empty 


//get all the inputs from the form, store in variables 
$username = "";
$firstname = "";
$lastname = '';
$email = '';
$password1 = '';
$password2 = '';

$errors = array(); 



//if issset($_SESSION['user'])) {reroute to homepage}


if($_SERVER["REQUEST_METHOD"] == "POST") {
$username = $_POST['uname'];
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$email = $_POST['email'];
$password1 = $_POST['pword1'];
$password2 = $_POST['pword2'];


if (empty($username)) {
	array_push($errors, "Must enter a username");
}

if (empty($firstname)) {
	array_push($errors, "Must enter a first name");
}

if (empty($lastname)) {
	array_push($errors, "Must enter a last name");
}

if (empty($email)) {
	array_push($errors, "Must enter a email");
}
if (empty($password1) || empty($password2)) {
	array_push($errors, "Must enter password twice");
}

else if ($password1 != $password2) {
	array_push($errors, "Passwords don't match. Try again");
}


	//using pdo, query for the username where username = $username 
	$sql = "SELECT * FROM Users WHERE username = :test"; 
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':test',$username);
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	//if row is false, no values exist, so the 
	if($row == true) {
		array_push($errors, "Username is taken");
		$username= "";
	}
	
	
	//using pdo, query for the username where email = $email 
	$sql = "SELECT * FROM Users WHERE email = :test"; 
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':test',$email);
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	//if row is false, no values exist, so the 
	if($row == true) {
		array_push($errors, "Email is taken");
		$email ="";
	}



if (count($errors) == 0) {
	
	// create the user 
	echo "Creating user  ";
	$sql = "INSERT INTO Users (firstname,lastname,username,email,password)
			VALUES(:firstname, :lastname, :username,:email,:password)"; 
	
	$stmt = $pdo->prepare($sql); 
	$encryptedPass = password_hash($_POST['pword1'],PASSWORD_BCRYPT);
	
	$stmt->bindParam(':firstname',$firstname);
	$stmt->bindParam(':lastname',$lastname);
	$stmt->bindParam('username',$username);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':password',$encryptedPass);
	
	
	$stmt->execute();
	echo "created user"; 

	// start a session, reroute to the home page 
	session_start();
	session_regenerate_id(true);
	$_SESSION["test"] = $firstname;
	header('Location: homepage.php');

}











}















?>