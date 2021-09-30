<?php session_start();
		session_regenerate_id(true); ?>
<?php require_once("../config/pdo.php") ?>



<html> 
<body> 
    
<!--Use session info and php to decide what buttons are getting shown on the page -->
<?php 
	//if session, signout button and userpage. 
	
	if(isset($_SESSION["test"])) { 
	echo "hello ".
	$_SESSION["test"] . 
	"
	
	
<button>
    <a href=\"logout.php\">Logout </a>
</button>



<!--Will sign the user out and reload the homepage-->
<button>
    yourpage
</button>
";
}
// !session, login and register buttons. 
else {
	echo " 
	<button>
    <a href=\"login.php\">Sign In</a>
</button>
<!--Will sign the user out and reload the homepage-->



<button>
    <a href=\"registration.php\">Register</a>
</button>
	
	
	
	";
	
}


?>














<!--Takes the user to their specific user page-->



<h1 style="text-align: center;">Site name</h1>








<form>
    <label for="search-titles">
        Search our Titles
    </label>
    <input name="search-titles">
    <button name="submit-search-titles">GO!</button>
</form>
<!--Loads all the results of the search in the movie lookup page-->
<br> 
<form>
    <label for="search-friends">
        Search for Friends
    </label>
    <input name="search-friends">
    <button name="submit-search-friends">GO!</button>
</form> 
<!--Loads all the results of the search in the user lookup page-->

<br>

<form>
    <label for="search-by">
        Search by:
    </label>
    <select>
        <option>Genre</option>
        <option>Studio</option>
        <option>Director</option>
        <option>Actor</option>
    </select>
    
    <input name="search-by">
    <button name="submit-search-by">GO!</button>
</form> 
<!--Pick a table to query, load results based on input. Accepts all input
if no match: will be stated on next page-->











<h3>Recently Added</h3>
<?php 
$sql = 'SELECT movieTitle, moviePosterFilePath, releaseYear FROM Movies ORDER BY movieID DESC LIMIT 10;';
$stmt = $pdo->prepare ($sql);
$stmt->execute();
echo "<ul>"; 
foreach ($stmt as $row)
{
	$year = $row["releaseYear"];
echo "<li>" . $row['movieTitle']. '('.  $row['releaseYear'] . ")". "</li>" ;
}

	echo "</ul>"; 
?>





<div>
Recent Comments by friends:
<ul> 
    <li>
        Name, Post, activity content (like, comment, rating)

    </li>


</ul>
Recently rated movies by your friends: 
<ul> 
    <li>
        Name, movie, rating 

    </li>
    <li>
        Name, movie, rating 

    </li>
    <li>
        Name, movie, rating 

    </li>

</ul>

</div>
<!-- If a user doesnt have any friends yet, these two lists will be empty
In this case, maybe the area should be populated with top ranked 
movies, or movies with the most rankings
something that is universal to friendless accounts. -->


</body>
</html>