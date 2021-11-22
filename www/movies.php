<?php //start session to pass error messages to the user 
	session_start();
	session_regenerate_id(true);
	require_once("../config/pdo.php"); 
		require_once("../config/base.php"); 


//get the post variable, see where
	
 $test = htmlentities($_GET["search"]);
	
	
	
	
	$sql = "SELECT * FROM movies WHERE movieTitle LIKE CONCAT('%', :name, '%');";
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':name',$test);
	$stmt->execute();
	
	
	
	echo '<div class="container">';
	$i = 1;
	
	
	?>
	<style>
		.movie {
			text-align: center;
			
		}
	
		.container {
			background-color:grey;
		}
	
	</style>
	
	
	
	
	
	
	<h1 style=text-align:center>Search results for: <?php echo '"'.$test. '"' ?></h1>
	
	
	
	
	<?php
	
//Columns must be a factor of 12 (1,2,3,4,6,12)
$numOfCols = 3;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
foreach ($stmt as $row){
 $movieID = $row["movieID"];
 if($rowCount % $numOfCols == 0) { ?> <div class="row justify-content-center"> <?php } 
    $rowCount++; ?>  
        <div class="col-md-<?php echo $bootstrapColWidth; ?>" >
            <div class="thumbnail">
             <?php echo "<div class='movie'><a href='moviePage.php?id=$movieID'>" . htmlentities($row["movieTitle"]) . '</a></div> '; 
				
				echo '<div class="movie"><img src="../images/'.htmlentities($row["movieID"]).'.jpg" class="img-fluid" style="width:404px;height:600px;"> </div>';
			 
			 
			 ?> 
            </div>
        </div>
		
<?php
    if($rowCount % $numOfCols == 0) { ?> </div> <?php } } ?>
	
	
	
	
	
	