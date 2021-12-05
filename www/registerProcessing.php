<?php //start session to pass error messages to the user 
	session_start();
	session_regenerate_id(true);
	
?>
<?php require_once("../config/pdo.php") ?>
<?php
// error checking section. Creates user if it passes validation
// firstly, no fields can be left empty 


//get all the inputs from the form, store in variables 


$errors = array(); 



//if issset($_SESSION['user'])) {reroute to homepage}


if($_SERVER["REQUEST_METHOD"] == "POST") {
$username = htmlentities($_POST['uname']);
$firstname = htmlentities($_POST['fname']);
$lastname = htmlentities($_POST['lname']);
$email = htmlentities($_POST['email']);
$password1 = htmlentities($_POST['pword1']);
$password2 = htmlentities($_POST['pword2']);

// set session variables, to refill the inputs on errors
$_SESSION["firstname"] = htmlentities($firstname);
$_SESSION["lastname"] = htmlentities($lastname);
$_SESSION["email"] = htmlentities($email);



//methodize, return errors array 
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
	$sql = "SELECT * FROM Users WHERE username = :user"; 
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':user',$username);
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	//if row is false, no values exist, so the 
	if($row == true) {
		array_push($errors, "Username ".$username. " is taken");
		$username= "";
	}
	
	
	//using pdo, query for the username where email = $email 
	$sql = "SELECT * FROM Users WHERE email = :email"; 
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':email',$email);
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	//if row is false, no values exist, so the 
	if($row == true) {
		array_push($errors, "Email is taken");
		$email ="";
		$_SESSION["email"] = $email;
	}


// if no errors, create the user. 
if (count($errors) == 0) {
	
	// create the user 
	//methodize this 
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
	$_SESSION["username"] = $username;
	header('Location: homepage.php');

}
//if errors exist, add the errors array to the session, pass it
//to registration 
else {
	$_SESSION["errors"] = $errors;
	header('Location: registration.php');
}
}  
// if not a post request, redirect. 
else {
	header("Location: homePage.php");
}

?>