<?php  
	session_start();
	session_regenerate_id(true);
	require_once("../config/pdo.php");
	require_once("../config/base.php");

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
        <div>Cast</div>
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
	
	echo "<div id=comments>";
	foreach($stmt as $row) {
		
		$userCommentId = $row["username"];
		$sql = "SELECT username FROM users 
		WHERE username = :uname;";
	/*
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':uname',$userCommentId);
	$stmt->execute();
	$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
		*/
		
		
		echo $row["username"]. " ";
		echo "  ". $row["submittedDate"]. " ";
		if(isset($_SESSION["username"])){
		echo "<button onclick=like()>Like</button>". " " ;
		
		if($row["username"] != $_SESSION["username"]) 
		{
			
			echo "<button type='submit'  value='1' onclick=friend()>Friend</button>". "<br>";
		}
		else {
			echo "<br>";
		}}
		
		
		
		echo "    ". htmlentities($row["commentMessage"]). " <br> " ;
		
	
	
	
	}
		
		echo "</div>";
	
		
		//button needs to submit the username of the friend they want to add 
		//then remove the button using onclick and a remove function. 
		//on php load, the button should only appear if there isnt a pending friendrequest. 
		//query the friendships table for 
		
		
		
		
		
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


<script>

function friend() {
	alert(this);
	//go make the friend request, then remove the button 


}
function like() {
	alert(2);
	//go make the friend request, then remove the button 
	

}

</script>