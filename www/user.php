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
	
	
	$bio = htmlentities($row["bio"]);
	$u = $_SESSION["username"];
	
	
	
?>

<style>
	.tester {
		text-align:center;
		background-color: white; 
		border-style: solid; 
		border-color: grey; 
		border-radius:2em; 
		border-width: thin;
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
	

</style>

<div class=container >

<div class="row justify-content-center banner" >
	<div class=col-md-6 style=text-align:center>
		<?php 
		
		
		
		if($row["profilePicture"] == 1) {
		$user = $row["username"];
		$update = filemtime("../images/$u.jpg");
		
		
	
		echo '<img class="pic" src="../images/'.$user.'.jpg?'.$update.'" width="200" height="200">';
			
		}
		
		
		else {
			echo '<img class="pic" src="../images/defaultUser.jpg" width="200" height="200">';
		}
		
		
		?>
		
		
		
		
	
	</div>
	<div style=text-align:center> <h2> <?php echo $row["firstname"] ." ". $row["lastname"];; ?> </h2> </div>
</div>
<div class="row justify-content-center mt-2 " style="height:20em;">
	<div class="col-md-3 tester">
		<h3>Friends List</h3>
		<ul class="list-inline justify-content-center"style="list-style-type:none;">
	<?php 
		$sql = '(SELECT newFriendUserName AS test FROM friendships WHERE instigatorUsername = :user AND accepted =1) UNION (SELECT instigatorUsername AS test FROM friendships WHERE newFriendUserName = :user AND accepted =1)';
		$stmt = $pdo->prepare($sql); 
		$stmt->bindParam(':user',$_GET["user"]);
		$stmt->execute();
	foreach($stmt as $row) {
		//var_dump($row["newFriendUserName"]);
		echo '<li>'. makeUserLink($row["test"]). '</li>';
	}
	
	?>
		
		</ul>
	
	</div>
	
	<div class='col-md-3 ms-md-5 tester' >
		<h3>About me:</h3>
		<ul class="list-inline justify-content-center" style="list-style-type:none;">
	
		<?php 
		echo $bio;
	
	?>
	</ul>
	</div>
	
	
	
	<div class="col-md-3 ms-md-5 tester">
		<h3>Recent Comments  </h3>
		<ul class="list-inline justify-content-center" style="list-style-type:none;">
	
		<?php 
		$sql = 'SELECT * FROM Comments,Movies WHERE username= :user AND Comments.movieID = Movies.movieID LIMIT 10';
		$stmt = $pdo->prepare($sql); 
		$stmt->bindParam(':user',$_GET["user"]);
		$stmt->execute();
	foreach($stmt as $row) {
		//var_dump($row["newFriendUserName"]);
		echo '<li>'. makeMovieLink($row["movieID"], $row["movieTitle"]). " ". htmlentities($row["commentMessage"]).'</li>';
	}
	
	
	?>
	</ul>
	</div>
	


</div>





</div>