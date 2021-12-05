<?php session_start();
	  session_regenerate_id(true); 
	  require_once("../config/loginAuth.php");
	  require_once("../config/base.php");
	  ?>
<style> 
body {
	background-color: #f8f8f8;
}
</style>


  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>
			<form action="loginProcessing.php" method="POST">
            <div class="form-outline mb-4">
              <input name="username" class="form-control form-control-lg" />
              <label class="form-label" for="typeEmailX-2">Username</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" name="pword" class="form-control form-control-lg" />
              <label class="form-label" for="typePasswordX-2">Password</label>
            </div>
			
            <!-- Checkbox -->
           

            </div>
			
            <button class="btn btn-primary btn-lg btn-block mx-5 mb-4" type="submit">Login</button>
	
	</form>
	
	<div style="text-align: center; color: red">
	<?php if (isset($_SESSION["errors"])) {

foreach ($_SESSION["errors"] as $error) {
echo "<br> " .$error . " <br>" ;}
	
	session_unset();
	session_destroy();
	}

?>
</div>
	
	
	
	<div style="text-align:center">
           <h3>Dont have an account? Make one <a href="registration.php">here</a> </h3>
	</div>
          
          </div>
        </div>
      </div>
    </div>
  </div>




