<!DOCTYPE html>
<?php 
session_start();
if(empty($_SESSION['name'])){
  header('Location:registration.php');

}
?>
<html>
<head>
<style></style>
<title>Registration Form Using jQuery - Demo Preview</title>
<meta name="robots" content="noindex, nofollow">
<!-- Include CSS File Here -->
<link rel="stylesheet" href="style.css"/>
<!-- Include JS File Here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<div class="row">
<div class="col-md-6 main_frm">
<button type="button" id="formButton">Signup</button>
<div class="main" id="form1">
<form  class="form" enctype="multipart/form-data" method="post" action="#">

<label>Name :</label>
<input type="text" name="name" id="name">
<label>Email :</label>
<input type="text" name="email" id="email">
<label>Password :</label>
<input type="password" name="password" id="password">
<label>Confirm Password :</label>
<input type="password" name="cpassword" id="cpassword">
  <input type="file" name="image" id="fileToUpload">

<input type="submit" name="register" id="register" value="Register">
</form>
</div>
</div>
<!-------------login form code start--------------------------->
<div class="col-md-6 main_frm">
<?php

$connection = new mysqli("localhost", "root", "", "college");
 if(isset($_POST['submit'])){

 $email = trim($_POST['email']);
 $pwd   = trim($_POST['password']);
   
   $errmsg  ='';
   $passwordErr='';

  if(empty($email)){
    $errmsg = "Email is not valid"; 
    }
  if(empty($pwd)){
    $passwordErr= "Password is required" ;
    }

  if($email !='' &&  $pwd !='' ){
   $sql = "SELECT * FROM  registration where email='".$email."' AND password='".$pwd."'"; 

  $loginresult = mysqli_query($connection,$sql);
 
  $row1 = mysqli_num_rows($loginresult);
  
  if($row1 > 0){
     $session = mysqli_fetch_assoc($loginresult); 
     session_start();
    $_SESSION['name'] = $session['name'];
  //print_r($loginresult);
    $_SESSION['data'] = $session;
  header('location:admin.php');
  } else{
    
  }
}
  }
?>
<html>
<body>
  
  <button type="button" id="login_btn">Login</button>

  <div class="login_frm" id="login_frm">
 <form action="" method="post">
  
  Email<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"><span style="color:red;"><?php if(isset($errmsg)){echo $errmsg;} ?></span> <br><br>
  password<input type="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>"><span style="color:red;"><?php if(isset($passwordErr)) {echo $passwordErr;}?></span><br><br>
  <input type="submit" value="login" name="submit">
  </div>
  
  
  </form>
 
<body>
<html> 
</div>
</div>
<?php
$connection = new mysqli("localhost", "root", "", "college");
 if(isset($_POST['register'])){
$name=$_POST['name'];// Fetching Values from URL.
$email=$_POST['email'];
$password= $_POST['password']; // Password Encryption, If you like you can also leave sha1.
//$image1= $_POST['image1'];
    // Get image name
    $image = $_FILES['image']['name'];
    // Get text
    //$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

    // image file directory
    $target = "images/".basename($image);
  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
// Check if e-mail address syntax is valid or not
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "Invalid Email.......";
}else{
$result = mysqli_query($connection,"SELECT * FROM registration WHERE email='$email'");

$data = mysqli_num_rows($result);
if(($data)==0){
$query = mysqli_query($connection,"insert into registration(name, email, password,image) values ('$name', '$email', '$password', '$image')"); // Insert query
if($query){
echo "You have Successfully Registered.....";
}else
{
echo "Error....!!";
}
}else{
echo "This email is already registered, Please try another email...";
}
}
mysqli_close ($connection);
 }
?>
<script>
$("#formButton").click(function(){
        $("#form1").toggle();
    });
  
  $("#login_btn").click(function(){
        $("#login_frm").toggle();
    });
</script>
</body>
</html>