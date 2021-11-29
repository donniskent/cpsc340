<?php 
	
function makeUserLink($name) {
	return "<a href=user.php?user=$name> $name </a>";
	
}


function makeMovieLink($movieID, $movieTitle) {
	return "<a href=moviePage.php?id=$movieID> $movieTitle </a>";
	
}



?>