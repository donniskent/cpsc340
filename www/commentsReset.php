  <?php 
  	require_once("../config/utilities.php");

  
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
		

require_once("../config/pdo.php"); 

	if (isset($_SESSION["username"])){
		echo "Recent Comments by friends:";
		$sql = "SELECT * from Movies, Comments WHERE Movies.movieID = Comments.movieID AND Comments.username IN ((SELECT newFriendUserName FROM friendships WHERE instigatorUsername = :user AND accepted =1) UNION (SELECT instigatorUsername FROM friendships WHERE newFriendUserName = :user AND accepted =1)) ORDER BY Comments.submittedDate DESC LIMIT 5" ;
		$stmt = $pdo->prepare ($sql);
		$stmt->bindParam(":user", $_SESSION["username"]);
		
		$stmt->execute();		
		echo '<ul>';		
		foreach($stmt as $row) {
			echo '<li>'. makeUserLink($row["username"])." ". makeMovieLink($row["movieID"], $row["movieTitle"]). " ". htmlentities($row["commentMessage"]). "</li><br>";
			
		}		
		echo '</ul>';
	}
?>