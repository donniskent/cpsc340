<?php session_start();
	  session_regenerate_id(true); 
	   require_once("../config/loginAuth.php");
	  
	  ?>
<html>
<body> 
	<style> 

.errorMessage {
	color: red;
}


</style>

  
<h1>  User Registration
     </h1>
<form method= "POST" action="registerProcessing.php">
<label for="fname">First Name:</label>
<br>
<input name="fname" value=<?php if(isset($_SESSION["firstname"])){echo $_SESSION["firstname"];}?>>
<br>
<label for="lname">Last Name:</label>
<br>
<input name="lname" value=<?php if(isset($_SESSION["lastname"])){echo $_SESSION["lastname"];}?>>
<br>

<label for="email"> Email</label>
<!--First, check if email is of proper format 
Check error: 
1. See if the email is already taken by a user in the DB 
-->
<br>
<input name="email" value=<?php if(isset($_SESSION["email"])){echo $_SESSION["email"];}?>>
<br>
<label for="uname">User Name:</label>
<br>
<input type="text" name="uname">
<!--Check if the username is already stored in the DB, prompt user if taken -->

<br>
<label for="pword1">Password:</label>
<br>
<input type="password" name="pword1">
<!--Returns an error if the password doesnt conform to standards
     Passoword should have: a capital, a character, a number, etc - talk with customer about this business/app rule -->
<br>
<label for="pword2"> Re-enter Password:</label>
<br>
<input type="password" name="pword2">
<!--Returns an error if the passwords do not match-->
<br>
<br>
<button>Create Account</button>
<?php if (isset($_SESSION["errors"])) {
echo "<br>";
foreach ($_SESSION["errors"] as $error) {
echo "<br> <div class=\"errorMessage\">".$error . " </div> <br>" ;}
	
	session_unset();
	session_destroy();
}

?>

<!--Button will reroute to the home page if succesful
     Otherwise will refresh page and give the proper error message-->
<h3>Already have an account? Sign in <a href="login.php">here</a> </h3>
<!--Href will be the path to the sign in page -->
</form>


</body>


</html> 


