<?php 

	require_once("../config/pdo.php"); 
	session_start();
	session_regenerate_id(true);
if(!isset($_SESSION["username"])){
	header("Location: homePage.php");
}
if($_SESSION["username"] != $_GET["user"]) {
	header("Location: homePage.php");
}
require_once("../config/base.php");
//goal: finish the edit page
// 

$sql = 'SELECT * FROM Users WHERE username=:uname';
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':uname',$_GET["user"]);
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	$user = $_SESSION["username"];
?>
<style> 
	textarea {resize:none;}


</style>


<form method=POST enctype="multipart/form-data" action="userEditProcessing.php">
	
	<label for=bio>Bio</label>
	<textarea name="bio" placeholder="Edit Bio:" cols=30 rows= 6><?php echo $row["bio"];?></textarea>
			<br>
	<h3>Change profile pic</h3>
	<input type="file" name="fileUpload" accept=".jpg">
	
	
	<button type="submit"> Make Changes </button>
	<button type="submit" formaction="user.php?user=<?php echo $user?>"> Discard Changes </button>

</form>

<?php if(isset($_SESSION["errors"])){
	echo $_SESSION["errors"];	
	unset($_SESSION["errors"]);
} ?>