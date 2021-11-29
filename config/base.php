<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<style>
a {
  text-decoration: none;
  color: black;
  
}



</style>


<?php 

if(isset($_SESSION['username'])){
$user= $_SESSION['username'];}?>









<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: white !important">
  <div class="container-fluid">
    <a class="navbar-brand" href="homepage.php">MetaMovie</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="homepage.php">Home</a>
        </li>
        <li class="nav-item">
          
		  <?php if (isset($_SESSION["username"])) {
			
			if(isset($_SESSION["admin"])) {
			echo '<a class="nav-link" href="admin.php">Admin</a>';}
		  
		  else {
			
			echo '<a class="nav-link" href="user.php?user='.$user.'">Your Page</a> ';

		  }
		  
		  
		  
		  
		  
		  }
		  
		  
		?>
		
		</li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Utilities
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php 
			if(isset($_SESSION["username"])){
				
				echo ' <li><a class="dropdown-item" href="movies.php">Recommended</a></li>';
				echo ' <li><hr class="dropdown-divider"></li>';
				echo '<li><a class="dropdown-item" href=userEdit.php?user='.$user.'>Edit Profile</a></li>';
				echo ' <li><a class="dropdown-item" href="logout.php">Logout</a></li>';
			}
			else {
				
				echo ' <li><a class="dropdown-item" href="login.php">Login</a></li>';
				echo ' <li><a class="dropdown-item" href="registration.php">Register</a></li>';
			}
			
			?>
			
			
			
           
          </ul>
        </li>
       
      </ul>
     <div>  <?php if (isset($_SESSION["username"])) { 
		echo "Hello $user";
	 
	 } ?></div>
    </div>
  </div>
</nav>

