<?php 
 
 
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
		session_regenerate_id(true);

require_once("../config/pdo.php"); 

	$sql = "SELECT * from Ratings, Movies WHERE Movies.movieID = Ratings.movieID AND Ratings.username IN 
		((SELECT newFriendUserName FROM friendships WHERE instigatorUsername = :user AND accepted =1) UNION (SELECT instigatorUsername FROM friendships WHERE newFriendUserName = :user AND accepted =1)) 
		ORDER BY Ratings.submitDate DESC LIMIT 5" ;

		$stmt = $pdo->prepare ($sql);
		$stmt->bindParam(":user", $_SESSION["username"]);
		
		$stmt->execute();		
		echo "Recent Ratings by your Friends: <br><ul>";		
		foreach($stmt as $row) {
			echo '<li>'. htmlentities($row["username"])." ". htmlentities($row["movieTitle"]). " ". htmlentities($row["ratingValue"]). "</li><br>";
			
		}		
		echo '</ul>';
	
?>