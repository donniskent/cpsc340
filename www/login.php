<?php require_once("loginProcessing.php"); ?>


<html> 


<body> 

<h1> User Login </h1>
<form method="Post"> 
    <label for="username">Username:</label> <br>
    <input type="text" name="username"> 
    <!--Possible errors: 
    1. The username doesnt match any in the DB
    Prompts the user to resubmit their username and password 
    -->
    <br>
    <label for="pword">Password:</label>
    <!--Possible errors: 
        1. Password doesnt match the Usernames stored pword
        Prompts the user to resubmit their username and password 
        

    -->
    <br>
    <input type="text" name="pword">
    <br> 
    <br>
    <button>Login</button> 
	<?php
echo "<br>";
foreach ($errors as $error) {
echo "<br>".$error . "<br>" ;}
?>
    <h3>Dont have an account? Make one <a href="registration.php">here</a> </h3>

</form>

</body>

</html>

