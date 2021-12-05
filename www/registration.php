


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


  <div class="container py-3 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100 ">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong mb-4" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-1">Create Your Free Account</h3>
			<form action="registerProcessing.php" method="POST">
            
			<div class="form-outline mb-3">
              <input name="fname" class="form-control form-control-lg"value=<?php if(isset($_SESSION["firstname"])){echo $_SESSION["firstname"];}?> >
              <label class="form-label" for="typeEmailX-2">First Name</label>
            </div>
			<div class="form-outline mb-3">
              <input name="lname" class="form-control form-control-lg" value=<?php if(isset($_SESSION["lastname"])){echo $_SESSION["lastname"];}?>>
              <label class="form-label" for="lname">Last Name</label>
            </div>
			<div class="form-outline mb-3">
              <input name="uname" class="form-control form-control-lg" value=<?php if(isset($_SESSION["username"])){echo $_SESSION["username"];}?>>
              <label class="form-label" for="uname">Username</label>
            </div>
			<div class="form-outline mb-3">
              <input name="email" class="form-control form-control-lg" value=<?php if(isset($_SESSION["email"])){echo $_SESSION["email"];}?>>
              <label class="form-label" for="email">Email</label>
            </div>
            <div class="form-outline mb-3">
              <input type="password" name="pword1" class="form-control form-control-lg" >
              <label class="form-label" for="pword1">Password</label>
            </div>
			<div class="form-outline">
              <input type="password" name="pword2" class="form-control form-control-lg" >
              <label class="form-label" for="pword2">Confirm Password</label>
            </div>
			
            <!-- Checkbox -->
           
			<div style="color: red;"> 
			<?php if (isset($_SESSION["errors"])) {
echo "<br>";
foreach ($_SESSION["errors"] as $error) {
echo "<br> <div class=\"errorMessage\">".$error . " </div> <br>" ;}
	
	session_unset();
	session_destroy();
}?>
			</div>


            </div>
			
            <button class="btn btn-primary btn-lg btn-block mx-5 mb-4" type="submit">Sign Up</button>
	
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




