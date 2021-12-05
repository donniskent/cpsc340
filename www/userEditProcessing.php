<?php 
	//need to figure out GET if doesnt exist
	//properly fit the img for username 
	// fix XSS everywhere
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require_once("../config/pdo.php"); 
	session_start();
	$user = $_SESSION['username'];


$sql = 'UPDATE USERS SET bio = :bio WHERE username= :uname ';
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':uname',$_SESSION["username"]);
	$stmt->bindParam(':bio',$_POST["bio"]);

	$stmt->execute();
	
	
	
	
	if($_FILES["fileUpload"]["error"] == UPLOAD_ERR_OK){
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$ftype = $finfo->file ($_FILES['fileUpload']['tmp_name']);
		var_dump($ftype);
		if($ftype != "image/jpeg") {
		$errors = "Error updating pic. Please try again";
		$_SESSION["errors"] = $errors;
		header("Location: userEdit.php?user=$user");
		}
		else {
		$image = imagecreatefromjpeg($_FILES["fileUpload"]["tmp_name"]);
		$width = imagesx ($image);
		$height = imagesy ($image);
		$thumbHeight = 600;
		$thumbWidth = floor ($width * ($thumbHeight/$height));
		$thumbnail = imagecreatetruecolor ($thumbWidth, $thumbHeight);
		imagecopyresampled ($thumbnail, $image, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width,
		$height);
		$newName = $_SESSION["username"];
		$FILE_DIR = "C:\\Users\\dkent\\UniServerZ\\www\\movieSite\\images\\";
		
		$thumbName = $FILE_DIR.$newName.".jpg";
		
		imagejpeg($thumbnail, $thumbName);
		
		$sql = 'UPDATE USERS SET profilePicture = 1 WHERE username= :uname ';
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':uname',$_SESSION["username"]);
	

	$stmt->execute();
	
		
		
		
		
		
		header("Location: userEdit.php?user=$user");
		}
	}
	
	else {
		
		header("Location: userEdit.php?user=$user");
		
	
	} } 
	
	
	else {
		
		header("Location: userEdit.php?user=$user");
	
	}

?>