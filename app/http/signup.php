<?php  

if(isset($_POST['email']) &&
   isset($_POST['password']) &&
   isset($_POST['fname'])){

   include '../db.conn.php';
   
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $password = $_POST['password'];
   $confirm_password = $_POST['confirm_password'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $gender = $_POST['gender'];

   $data = 'fname='.$fname.'&email='.$email;

   if (empty($fname)) {
   	  $em = "Name is required";

   	  header("Location: ../../signup.php?error=$em");
   	  exit;
   }else if(empty($email)){
      $em = "Email is required";

   	  header("Location: ../../signup.php?error=$em&$data");
   	  exit;
   }else if(empty($gender)){
      $em = "Please select your gender";

      header("Location: ../../signup.php?error=$em&$data");
      exit;
   }else if(empty($password)){
   	  $em = "Password is required";

   	  header("Location: ../../signup.php?error=$em&$data");
   	  exit;
   }else {
   	  $sql = "SELECT email 
   	          FROM users
   	          WHERE email=?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$email]);

      if($stmt->rowCount() > 0){
      	$em = "The email ($email) is taken";
      	header("Location: ../../signup.php?error=$em&$data");
   	    exit;
      }else {
      	if (isset($_FILES['pp'])) {
      		$img_name  = $_FILES['pp']['name'];
      		$tmp_name  = $_FILES['pp']['tmp_name'];
      		$error  = $_FILES['pp']['error'];

      		if($error === 0){
               
               $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

               $img_ex_lc = strtolower($img_ex);

				$allowed_exs = array("jpg", "jpeg", "png");

				if (in_array($img_ex_lc, $allowed_exs)) {
					$new_img_name = $email. '.'.$img_ex_lc;

					$img_upload_path = '../../uploads/'.$new_img_name;

					  move_uploaded_file($tmp_name, $img_upload_path);
				}else {
					$em = "You can't upload files of this type";
			      	header("Location: ../../signup.php?error=$em&$data");
			   	    exit;
				}

      		}
      	}

      	$password = password_hash($password, PASSWORD_DEFAULT);
        $confirm_password = password_hash($confirm_password, PASSWORD_DEFAULT);

      	if (isset($new_img_name)) {

      		$sql = "INSERT INTO users
                    (fname, lname, email, phone, gender, password, confirm_password, p_p)
                    VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fname, $lname, $email, $phone, $gender, $password, $confirm_password, $new_img_name]);
      	}else {
            $sql = "INSERT INTO users
                    (fname, lname, email, phone, gender, password, confirm_password)
                    VALUES (?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fname, $lname, $email, $phone, $gender, $password, $confirm_password]);
      	}

      	$sm = "Account created successfully";

      	header("Location: ../../index.php?success=$sm");
     	exit;
      }

   }
}else {
	header("Location: ../../signup.php");
   	exit;
}