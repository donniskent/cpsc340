<?php session_start();
		session_regenerate_id(true);
		require_once("../config/pdo.php"); 
		require_once("../config/base.php");
	?>



<html> 

<body> 
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script src='homePage.js'> </script>




<style>
.what ul {
  list-style-type: none;
  
 
}

	body {background: #f8f8f8}

</style>
<!--Use session info and php to decide what buttons are getting shown on the page -->














<!--Takes the user to their specific user page-->



<h1 style="text-align: center;">Home</h1>








<form action="movies.php"> 
    <label for="search-titles">
        Search our Titles
    </label>
    <input name="search">
    <button>GO!</button>
</form>
<!--Loads all the results of the search in the movie lookup page-->

<br> 










<?php 
	if(!isset($_SESSION["username"])){
echo "<h3>Recently Added</h3>";
echo "<div class='what'>";

$sql = 'SELECT movieID, movieTitle, hasPoster, releaseYear FROM Movies ORDER BY movieID DESC LIMIT 10;';
$stmt = $pdo->prepare ($sql);
$stmt->execute();
echo " <ul>"; 
foreach ($stmt as $row)
{
	$year = $row["releaseYear"];
	$id = $row["movieID"];
echo "<li> <a href='moviePage.php?id=$id' > " . htmlentities($row['movieTitle']). '('.  htmlentities($row['releaseYear']) . ")". " </a></li> " ;
}

	echo "</ul> </div>"; 

	}
	else {
		//need the current users friends
		//need the 10 most recent ratings of the friends 
		//need the names of each ratings. 
		
		
		$sql = "SELECT * from Ratings, Movies WHERE Movies.movieID = Ratings.movieID AND Ratings.username IN 
		((SELECT newFriendUserName FROM friendships WHERE instigatorUsername = :user AND accepted =1) UNION (SELECT instigatorUsername FROM friendships WHERE newFriendUserName = :user AND accepted =1)) 
		ORDER BY Ratings.submitDate DESC LIMIT 5" ;

		$stmt = $pdo->prepare ($sql);
		$stmt->bindParam(":user", $_SESSION["username"]);
		
		$stmt->execute();		
		
?>
		
		<div id="ratings">
<?php		
		
		
	require_once("ratingsReset.php");
		
		
		
	}
	?>
</div>



<div id="comments">
<?php
require_once("commentsReset.php");
?>
</div>




<div id="friendrequests">

<?php 
	require_once("friendsReset.php");

?>
</div>




</body>
</html>