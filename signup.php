<?php 
  session_start();

  if (!isset($_SESSION['email'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat App - Sign Up</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" 
	      href="css/style.css">
	<link rel="icon" href="img/logo.png">
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
	 <div class="w-400 p-5 shadow rounded">
	 	<form method="post" 
	 	      action="app/http/signup.php"
	 	      enctype="multipart/form-data">
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

	 		<img src="img/logo.png" 
	 		     class="w-25">
	 		<h3 class="display-4 fs-1 
	 		           text-center">
	 			       Sign Up</h3>   
	 		</div>

	 		<?php if (isset($_GET['error'])) { ?>
	 		<div class="alert alert-warning" role="alert">
			  <?php echo htmlspecialchars($_GET['error']);?>
			</div>
			<?php } 
              
              if (isset($_GET['fname'])) {
              	$fname = $_GET['fname'];
              }else $fname = '';

              if (isset($_GET['lname'])) {
              	$lname = $_GET['lname'];
              }else $lname = '';

              if (isset($_GET['email'])) {
              	$email = $_GET['email'];
              }else $email = '';
			?>

	 	  <div class="mb-3">
		    <label class="form-label">
		          First Name</label>
		    <input type="text"
		           name="fname"
		           value="<?=$fname?>" 
		           class="form-control">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		          Last Name</label>
		    <input type="text"
		           name="lname"
		           value="<?=$lname?>" 
		           class="form-control">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Email</label>
		    <input type="email" id="email"
		           class="form-control"
		           value="<?=$email?>" 
		           name="email">
		  </div>

		  <div class="mb-3">
		  	<label class="form-label">
		  			Enter your phone number:</label>
			<input type="tel" id="phone" name="phone">
		  </div>

		  <div class="mb-3">
		  	<label class="form-label">
		  			Gender</label>
						<span style="margin-left: 40px; margin-right: 5px"> 
						Male </span> 
						<input type="radio" name="gender" value="male"  style="margin-right: 15px;">
							Female 
						<input type="radio" name="gender" value="female" style="margin-left: 5px;"><br>
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Password</label>
		    <input type="password" 
		           class="form-control"
		           name="password" id="txtPassword">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Confirm Password</label>
		    <input type="password" 
		           class="form-control"
		           name="confirm_password" id="txtConfirmPassword">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">
		           Profile Picture</label>
		    <input type="file" 
		           class="form-control"
		           name="pp">
		  </div>
		  
		  <button type="submit" 
		          class="btn btn-primary" onclick="return Validate()">
		          Sign Up</button>
		  <a href="index.php">Login</a>
		</form>
	 </div>
</body>

<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("txtPassword").value;
        var confirm_password = document.getElementById("txtConfirmPassword").value;
        if (password != confirm_password) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>



</html>
<?php
  }else{
  	header("Location: home.php");
   	exit;
  }
 ?>