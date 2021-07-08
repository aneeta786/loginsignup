<?php
  // Create database connection
  $connection = new mysqli("localhost", "root", "", "college");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
    // Get image name
    $image = $_FILES['image']['name'];
    // Get text
    //$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

    // image file directory
    $target = "images/".basename($image);

    $sql = "INSERT INTO upload_image (image) VALUES ('$image')";
    // execute query
    mysqli_query($connection, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
  }
  
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css"/>
</head>
<header id="header">

<div class="topnav">
  <a class="active" href="#home">Logout</a>
 
</div>
</header>
<body>
<div class="container">
<form  method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="image" id="fileToUpload">
  <input type="submit" id="submits" value="Upload Image" name="upload">
</form>
</div>
</body>
</html>
