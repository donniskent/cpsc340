<?php 
		
    if(!isset($_SESSION)) 
    { 
        session_start(); 
		
    }
	
		
		
		
		require_once("../config/pdo.php"); 


// query the db for all friend requests where current yser is newFriendUserName. 
	if (isset($_SESSION["username"])){
		echo  "Friends Requests:";
		echo "<ul>" ;
		$test = $_SESSION["username"];
$sql = "SELECT * from Friendships 
		WHERE newFriendUserName = :user AND accepted IS NULL;";
		$stmt = $pdo->prepare ($sql);
		$stmt->bindParam(":user", $_SESSION["username"]);
		
		$stmt->execute();
		foreach($stmt as $row) {
			$test = $row["instigatorUsername"];
			echo '<li>'. htmlentities($row["instigatorUsername"])."<button class='acceptFriend' value=$test > Accept </button> <button class='declineFriend' value=$test> Decline </button></li>";
		}
		
		//jquery 
		//1. On click of a button, use AJAX to process the FriendRequestForm. 
		//2. If it works, use AJAX to update the fields relating to the user's friend. 
		
		
	}

echo "</ul>";

?>