<?php 
session_start();
require_once("../config/adminAuth.php");
require_once("../config/base.php");

session_regenerate_id(true);
//1. authenticate based on admin bool 
//2. Give link (?) to add movie page or have it on the page 
//3. Search bars for movies and users 
//4. Logout button

	
	require_once("../config/pdo.php");
	




?> 




<body> 
<h1> Create New Movie </h1>
 
<form method="Post"  enctype="multipart/form-data" action="adminProcessing.php"> 
            <label for="title">
                Title
            </label>
            <input name="title">
            <br>
            <br>
            <label for="director">
                Director
            </label>
            <select name="director">
            <?php 
			$sql = "SELECT * FROM directors"; 
	
		$stmt = $pdo->prepare($sql); 
		//$stmt->bindParam(":table",$table);
		$stmt->execute();
		
		
		foreach ($stmt as $row){
		echo "<option value=".htmlentities($row["directorID"])."> " . htmlentities($row["directorName"]) . " </option>";
		}
			
			?>
            </select>
            <br>
            <br>

            <label for="genre">
                Genre
            </label>
            <select name="genre">
           
		   <?php 
			
		$sql = "SELECT * FROM Genres"; 
	
		$stmt = $pdo->prepare($sql); 
		//$stmt->bindParam(":table",$table);
		$stmt->execute();
		
		
		foreach ($stmt as $row){
		
		echo "<option value='".htmlentities($row["genreType"])."' > " . htmlentities($row["genreType"]) . " </option>";
		
		}
		
	
	
	
			?>
			
            </select>
			
            <br>
            <br>
            
            <label for="studio">
                Studio
            </label>
            <select name="studio">
            <?php 
			
		$sql = "SELECT * FROM studios"; 
	
		$stmt = $pdo->prepare($sql); 
		//$stmt->bindParam(":table",$table);
		$stmt->execute();
		
		
		foreach ($stmt as $row){
		
		echo "<option value='".htmlentities($row["studioName"])."' > " . htmlentities($row["studioName"]) . " </option>";
		
		
		}
		
	
	
	
			?>
			
			
			
			
			
			
			</select>
            <!--
                Director and studio wont be dropdowns, more of a searchable 
                structure. Current format just shows that the fields are foreign keys
                of validation tables. It may prove easiest to add by PK
            -->





            <br>
            <br>
            <label for="year">
                Year of release
            </label>
            <input name="year">
            <!--Errors:
              1. Will have to check that this year isnt in the future,
            nor too far in the past
            2. Cant contain text
            Neither involve the DB
        -->
            <br>
            <br>
            
			<label for="length">
                Movie Length
            <input name="length">
<br>
<br>
			<label for="description">
			Movie Description:
			</label>
			<br>
			<textarea name="description">
			
			</textarea>
            <br>
			<br>
           
		<input type="file" name="fileUpload" "accept=jpg">
		
		
		

			
            
             
            
            
            
            
            
            <button>Submit</button>
		
		
		
        </form>
<?php 


if (isset($_SESSION["errors"])) {

foreach ($_SESSION["errors"] as $error) {
echo "<br>" . $error;}
	unset($_SESSION["errors"]);
	
}

?>







</body> 



