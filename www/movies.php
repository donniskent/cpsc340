<?php //start session to pass error messages to the user 
	session_start();
	session_regenerate_id(true);
	require_once("../config/pdo.php"); 
		require_once("../config/base.php"); 


//get the post variable, see where
	
 if(isset($_SESSION["username"])) {
	if(isset($_GET["search"])){
		$test = htmlentities($_GET["search"]);
	
	
	
	
	$sql = "SELECT * FROM movies WHERE movieTitle LIKE CONCAT('%', :name, '%');";
	$stmt = $pdo->prepare($sql); 
	$stmt->bindParam(':name',$test);
	$stmt->execute();
	}
	
	else {
		$sql = "SELECT movieTitle, movies.movieID, count(*) as num5s from ratings,movies
WHERE movies.movieID = ratings.movieID AND ratings.ratingValue = 5 AND ratings.username IN ( (SELECT newFriendUserName FROM friendships WHERE instigatorUsername = :user AND accepted =1) UNION (SELECT instigatorUsername FROM friendships WHERE newFriendUserName = :user AND accepted =1) )
GROUP BY movies.movieID;";

	$stmt = $pdo->prepare ($sql);
	$stmt->bindParam(":user", $_SESSION["username"]);
		
	$stmt->execute();
	
	
	
	
	
 } } else {
	 $sql = "SELECT * FROM movies ORDER BY movieTitle ASC;";
	$stmt = $pdo->prepare($sql); 
	
	$stmt->execute();
	 
 }
	
	
	echo '<div class="container">';
	$i = 1;
	
	
	?>
	<style>
		.movie {
			text-align: center;
			
		}
	
		.container {
			background-color: #f8f8f8;
		}
	
	</style>
	
	
	
	
	
	
	<h1 style=text-align:center> <?php 
	
	if(isset($_GET["search"])){
	echo 'Search results for: "'.$test. '"' ;}
	else {
		echo "Recommended Movies";
	}
	?></h1>
	
	
	
	
	
	<?php
	
	
	
	
//Columns must be a factor of 12 (1,2,3,4,6,12)
$numOfCols = 3;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;

if($stmt->rowCount() == 0) {
		echo "<br><h2 style='text-align: center'> No recommendations </h2>";
	}

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
    if($rowCount % $numOfCols == 0) { ?> </div> <?php } } 
		
	
 ?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
	
	
	
	
	
	