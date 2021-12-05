<?php  
	session_start();
	session_regenerate_id(true);
	require_once("../config/pdo.php");
	require_once("../config/base.php");
	require_once("../config/utilities.php");
//check admin status and logged in status 
//also, get request for editing the movie 
//cast added at the admin page 
	

?>






<?php 
// on a get request, pull in the relevant information based on the pk 
//of the movie 
//pass just the movieid to the 
if(!isset($_GET["id"])) {
	header("Location: homePage.php");
}



$id = $_GET["id"];


 






	$sql = "SELECT * FROM movies 
	WHERE movieID = :id;";
	
	$stmt = $pdo->prepare($sql); 
	
	
	$stmt->bindParam(':id',$id);
	
	$stmt->execute();
	
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row == false) {
			header("Location: homePage.php");
		}
		
		
		
		
		$title =  $row["movieTitle"];
		$releaseDate = $row["releaseYear"];
		$director = $row["directorID"];
		$hasPoster = $row["hasPoster"];
		$movieDescription = $row["movieDescription"];


?>


<html>



    <body> 
        <div style="text-align: center;">
        <h1><?php echo $title ?>  </h1>
        <h2><?php echo $releaseDate ?></h2>
        <h3><?php 
		$sql = "SELECT * FROM Directors 
		WHERE directorID = :id;";
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':id',$director);
	$stmt->execute();
	
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		echo $row["directorName"];
		
		
		
		
		?></h3>
        <div id=image>
		<?php if($hasPoster = True) {
		$path = "../images/".$id.".jpg";
		
		
		 echo "<img src='../images/".$id.".jpg' style='width:404px;height:600px;'>";
		//need to resize the image before storage
		
		} ?>
		
		
		
		
		
		</div>    
        <br>
        <div>
	<h2> Cast: </h2>
		 <h3><?php 
		$sql = "SELECT actorName, Actors.actorID, appearances.ActorID, movieID FROM Appearances, Actors
		WHERE movieID = :id AND appearances.actorID = Actors.actorID;";
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':id', $_GET["id"]);
	$stmt->execute();
	
		
		foreach($stmt as $row){
		echo $row["actorName"]. "<br>";
		}
		
		
		
		?></h3>
		
		
		
	<?php 
	if(isset($_SESSION["username"])) {
	
	//query the rating table to see if an entry exists
	$sql = "SELECT * FROM Ratings 
		WHERE movieId = :id AND username = :username;";
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':username',$_SESSION["username"]);
	$stmt->execute();
	
	if($stmt->rowCount() > 0) {
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		echo "Your rating:" . $row["ratingValue"];
	}
	else {
	$_SESSION["movieID"] = $_GET["id"]; 
	echo '<form method="POST" action="ratingProcessing.php">'.
		'<select name="rating">'. 
		'<option value="">  </option>'.
		'<option value=1> 1 </option>'. 
		'<option value=2> 2 </option>'. 
		 '<option value=3> 3 </option>'. 
		 '<option value=4> 4 </option>'. 
		 '<option value=5> 5 </option>'. '</select>'.
		'<button> Submit Rating </button> </form>';
		
	}
	
	
	
	
	}
	$sql = "SELECT AVG(ratingValue) AS averageRating FROM Ratings 
			WHERE movieID = :id";
	
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	echo "<br> Average Rating:" . $row["averageRating"];
	


?>

		</div>
        <br>
       
        <br>
		<div><?php echo $movieDescription?></div>
        <br>
        <div>
		<?php 
		
		
		
		
		
		
		
		
		
		$sql = "SELECT * FROM Comments
		WHERE movieId = :id ORDER BY submittedDate DESC LIMIT 10;";
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	
	echo "<div id=comments><form method='POST' action='newFriendProcessing.php'>";
	foreach($stmt as $row) {
		
		$userCommentId = $row["username"];
		
		$sql ="SELECT * FROM Friendships 
			WHERE instigatorUsername = :me1 AND newFriendUserName = :them1
			UNION SELECT * FROM Friendships WHERE newFriendUserName = :me1 AND instigatorUsername = :them1 ;";
			$stmt = $pdo->prepare($sql); 
			$stmt->bindParam(':them1',$row["username"]);
			$stmt->bindParam(':me1',$_SESSION["username"]);
			$stmt->execute();
			$exists = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
	
	
		
		$newFriend = $row["username"];
		$current = $row["commentID"];
		
		
	
		
		
		
		
		
		
		
		
		echo makeUserLink($row["username"]). " ";
		echo "  ". $row["submittedDate"]. " ";
		//see if the current user has liked the comment, 
		//if not, like button. 
		$sql ="SELECT * FROM Likes 
			WHERE commentID = :comment AND username = :name;";
			$stmt3 = $pdo->prepare($sql); 
			$stmt3->bindParam(':comment',$current);
			$stmt3->bindParam(':name',$_SESSION["username"]);
			$stmt3->execute();
			$result = $stmt3->fetch(PDO::FETCH_ASSOC);
			if($result == false && isset($_SESSION["username"])) 
			{
				$_SESSION["pastID"] = $_GET["id"]; 
				echo "<button name=testing formaction='likeProcessing.php' value=$current> Like </button>";
			}
			
			
		if($exists == false && $row["username"] != $_SESSION["username"]  && isset($_SESSION["username"])) {
			$_SESSION["pastID"] = $_GET["id"];
			echo "<button name='newFriend' value='$newFriend'>friend</button> <br>";
		}
		else {
			echo "<br>";
		}
		
		echo "    ". htmlentities($row["commentMessage"]). " <br> " ;
		$sql = "SELECT COUNT(*) AS numLikes FROM Likes 
			WHERE commentID = :id";
	
		$stmt = $pdo->prepare($sql); 
		$stmt->bindParam(':id',$current);
		$stmt->execute();
		$bb = $stmt->fetch(PDO::FETCH_ASSOC);
		echo "Likes: " . $bb["numLikes"]. "<br>";
	
	
	
	}
		
		echo "</form></div>";
	
		
		
		
		
		
		
		?>
		
		
		
		
		
		
		
		
		
		
		
		
		
		</div>
        
		<br>
       <?php if (isset($_SESSION["username"])) {
	  
	  
	  
	  echo  '<form method="POST" action="commentProcessing.php">'.
           ' <label name=comment> Leave a comment:</label>'
            .'    <br>
                <br>'.
           ' <input name="comment"> ';
            $_SESSION["movieID"] = $_GET["id"]; 
			
			
			echo '
			<button>Submit comment</button>
            <br>
            <br> 
            
        </form>';
	   }
	   ?>
    </div>
    
        
    </body>



</html>


