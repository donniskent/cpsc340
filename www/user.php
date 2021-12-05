<?php 

session_start();
		session_regenerate_id(true);
		require_once("../config/pdo.php"); 
		require_once("../config/base.php");
		require_once("../config/utilities.php");
		

	/*
	if($_SESSION["username"] != $_GET["user"]) {
		header('Location: login.php');
	}
	*/
	
	/*
	Whats next - 
	1. Make below code dynamic
	2. Update / choose prof pic
	3. Be able to edit other information (Not sure what)
	
	
	
	
	*/
	
	
	
	
	$sql = 'SELECT * FROM Users WHERE username=:uname';
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':uname',$_GET["user"]);
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row == false) {
		header("Location: homepage.php");
	}
	
	
	$bio = htmlentities($row["bio"]);
	$u = $_SESSION["username"];
	
	
	
?>

<style>
	.tester::-webkit-scrollbar {
   display: none;
}


	.tester {
		text-align:center;
		background-color: white; 
		border-style: solid; 
		border-color: grey; 
		border-radius:2em; 
		border-width: thin;
		height: 25em;
	}
	body {
		background-color: #f8f8f8;
	}
	.banner {
		background-color: white;
		border-style: solid; 
		border-color: grey; 
		border-radius:2em; 
		border-width: thin;
	}
	
	.pic {
		margin-top: 1em;
		border-radius: 10em;
	}
	.comment {
		text-align: left;
	}
	

</style>

<div class="container h-100">

<div class="row justify-content-center banner shadow-lg my-3" >
	<div class="col-md-4 " style=text-align:center>
		<?php 
		
		
		
		if($row["profilePicture"] == 1) {
		$user = $row["username"];
		$update = filemtime("../images/$user.jpg");
		
		
	
		echo '<img class="pic" src="../images/'.$user.'.jpg?'.$update.'" width="200" height="200">';
			
		}
		
		
		else {
			echo '<img class="pic" src="../images/defaultUser.jpg" width="200" height="200">';
		}
		
		
		?>
		
		
		
		
	<div style=text-align:center> <h2> <?php echo $row["firstname"] ." ". $row["lastname"];; ?> </h2> </div>
	</div>
	
	
		
		
	<div  class="col-md-4 mt-5" style="text-align: center">
		
		<h2>  <?php echo $row["username"] ?> </h2>
		<?php 
		echo $bio;
	
	?>
</div>
	</div>





<div class="row justify-content-center h-auto mt-2" >
	<div class="col-lg-3 me-lg-5 mb-2  shadow-lg tester">
		<h3>Friends List</h3>
		<ul class="list-inline justify-content-center"style="list-style-type:none;">
	<?php 
		$sql = '(SELECT newFriendUserName AS friend FROM friendships WHERE instigatorUsername = :user AND accepted =1) UNION (SELECT instigatorUsername AS friend FROM friendships WHERE newFriendUserName = :user AND accepted =1)';
		$stmt = $pdo->prepare($sql); 
		$stmt->bindParam(':user',$_GET["user"]);
		$stmt->execute();
	foreach($stmt as $row) {
		//var_dump($row["newFriendUserName"]);
		echo '<li>'. makeUserLink($row["friend"]). '</li>';
	}
	
	?>
		
		</ul>
	
	</div>
	
	
	
	
	
	<div class="col-lg-3 mx-lg-5 shadow-lg mb-2  tester" style="overflow-y:auto">
		<h3>Recent Comments  </h3>
	
		<ul class="list-inline justify-content-center" style="list-style-type:none; ">
	
		<?php 
		$sql = 'SELECT * FROM Comments,Movies WHERE username= :user AND Comments.movieID = Movies.movieID ORDER BY SubmittedDate DESC ';
		$stmt = $pdo->prepare($sql); 
		$stmt->bindParam(':user',$_GET["user"]);
		$stmt->execute();
	foreach($stmt as $row) {
		//var_dump($row["newFriendUserName"]);
		echo '<hr><li class="comment"><b>'. makeMovieLink($row["movieID"], $row["movieTitle"]). "</b>  ". htmlentities($row["commentMessage"]).'</li> ';
	}
	
	
	?>
	</ul>
	</div>

	
	
	
	
	<div class="col-lg-3 ms-lg-5 mb-2 shadow-lg tester">
		<h3>Recent Ratings  </h3>
		<ul class="list-inline justify-content-center" style="list-style-type:none;">
	
		<?php 
		$sql = 'SELECT * FROM Ratings,Movies WHERE username= :user AND Ratings.movieID = Movies.movieID LIMIT 10';
		$stmt = $pdo->prepare($sql); 
		$stmt->bindParam(':user',$_GET["user"]);
		$stmt->execute();
	foreach($stmt as $row) {
		//var_dump($row["newFriendUserName"]);
		echo '<hr><li><b>'. makeMovieLink($row["movieID"], $row["movieTitle"]). "</b> ". htmlentities($row["ratingValue"]).'</li>';
	}
	
	
	?>
	</ul>
	</div>
	
	
	
	
	</div>
	
	






</div>