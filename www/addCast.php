<?php 
session_start();
require_once("../config/adminAuth.php");

session_regenerate_id(true);


	
	require_once("../config/pdo.php");
	//SCRAP ADDCAST FOR NOW. WILL ADD ON ACTOR PAGES. 
	//TOO COMPLEX OTHERWISE.




?>

<!-- If you add [] to values, becomes an array that is returned-->
<body>
<form method="POST" action="addCastProcessing.php">
<label for="movies">
Movie
</label>
<select  name="movies" >
<?php 
		
		
		//Multitable
		//SELECT ActorID FROM Appearances 
		//WHERE NOT movieID 
		
		
		
		
		
		
		
		
		
		$sql = "SELECT movieID,movieTitle FROM movies"; 
		$stmt = $pdo->prepare($sql); 
		$stmt->execute();
		
		
		foreach ($stmt as $row){
		echo "<option value=".$row["movieID"]."> " . $row["movieTitle"] . " </option>";
		}
			
			?>

</select>
<br>
<br>
<label for="actors">
Actors
</label>
<select  name="actors" >
<?php 
		
	
		
		$sql = "SELECT * FROM actors"; 
		$stmt = $pdo->prepare($sql); 
		$stmt->execute();
		
		
		foreach ($stmt as $row){
		echo "<option value=".$row["actorID"]."> " . $row["actorName"] . " </option>";
		}
			
			?>

</select>

<br>
<br>



<button>
Submit
</button>




</form>



</body>





