<?php 
	session_start();
	  session_regenerate_id(true);
	  require_once("../config/pdo.php");
?>
<?php 
	
//title cant be empty 
// YoR cant be empty, must be a number 





if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$title = htmlentities($_POST["title"]);
	$director = htmlentities($_POST["director"]);
	$genre = htmlentities($_POST["genre"]);
	$studio = htmlentities($_POST["studio"]);
	$year = htmlentities($_POST["year"]);
	$length = htmlentities($_POST["length"]);
	$description = htmlentities($_POST["description"]);
	
	
	$errors = array();
	
	//take care of image here 
	/* $_FILES    UPLOAD_ERR_NO_FILE
	UPLOAD_ERR_OK   use this to make sure that a file was picked 
	$finfo  = finfo(FILEINFO_MIME_TYPE)
	$ftype = $finfo->file($_FILES['fileUpload']["temp_name"];
		
		move_uploaded_file($_FILES['fileUpload']["temp_name"], "files/".$movieID.".jpg");
		
		
		*/
	
	
	
	
	
	
	
	if(empty($title) || empty($director)
		|| empty($genre) || empty($studio) 
	|| empty($year) || empty($length) || empty($description)) {
		array_push($errors,"Must fill out all fields");
	}
	
	if(!is_numeric($year)) {
		array_push($errors,"Year must only be numbers");
	} 
	
	
	
		
		
		
		
		
		if(empty($errors)) {
		
		
		
	$sql = "INSERT INTO Movies (movieTitle,directorID,genreType,studioName,releaseYear, movieLength, movieDescription)
			VALUES(:title, :director, :genre,:studio, :year, :length, :description)"; 
	
	$stmt = $pdo->prepare($sql); 
	
	
	var_dump($year);
	$stmt->bindParam(':title',$title);
	$stmt->bindParam(':director',$director);
	$stmt->bindParam('genre',$genre);
	$stmt->bindParam(':studio',$studio);
	$stmt->bindParam(':year',$year);
	$stmt->bindParam(':length',$length);
	$stmt->bindParam(':description',$description);
	
	
	
	$stmt->execute();
	
		
		if($_FILES["fileUpload"]["error"] == UPLOAD_ERR_OK){
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$image = imagecreatefromjpeg($_FILES["fileUpload"]["tmp_name"]);
		$width = imagesx ($image);
		$height = imagesy ($image);
		$thumbHeight = 600;
		$thumbWidth = floor ($width * ($thumbHeight/$height));
		$thumbnail = imagecreatetruecolor ($thumbWidth, $thumbHeight);
		imagecopyresampled ($thumbnail, $image, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width,
		$height);
		$newName = $pdo->lastInsertId();
		$FILE_DIR = "C:\\Users\\dkent\\UniServerZ\\www\\movieSite\\images\\";
		
		$thumbName = $FILE_DIR.$newName.".jpg";
		
		imagejpeg($thumbnail, $thumbName);
		
		
		
		
	//	$ftype = $finfo->file($_FILES["fileUpload"]["tmp_name"]);
	//	$newName = $pdo->lastInsertId();	
	//	$thumbName = 
		
		
		
		
		//$FILE_DIR = "C:\\Users\\dkent\\UniServerZ\\www\\movieSite\\images\\";
		//move_uploaded_file($_FILES['fileUpload']['tmp_name'], $FILE_DIR.$newName.".jpg");	
		
		$poster = True;
		
		
	}
	else {
		$poster = False; 
	}
	
	// upfate the poster field 
		$sql = "UPDATE movies 
				SET hasPoster = :poster
				WHERE movieID = :movie;"; 
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':poster',$poster);
	$stmt->bindParam(':movie',$newName);
	$stmt->execute();
	
	
	
		
		
		
		
		
		
		
		
		
		
		header("Location: admin.php");
		
	}
	else {
		
		$_SESSION["errors"] = $errors;
		
		header("Location: admin.php");
	}
	
	
	
	
	
}	
	else {
		header("Location: admin.php");
		
	}
	
	
	
	
		










?> 