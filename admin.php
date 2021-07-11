<?php
  // Create database connection
  $connection = new mysqli("localhost", "root", "", "college");
session_start();
if(empty($_SESSION['name'])){
  header('Location:registration.php');

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
  <a class="active" href="registration.php">Logout</a>
 
</div>
</header>
<body>
<div class="container">
<span>Name: </span><h3><?php echo $_SESSION['name'];?> </h3>
<?php $sql = "SELECT * FROM  registration"; 

  $result = mysqli_query($connection,$sql);
 if ($result->num_rows >0) {
    // output data of each row
    $data = array();
    $row = $result->fetch_assoc();
      
        ?>
        <img width="400px" src="images/<?php echo $row['image'];  ?>">
        <?php
    }
  ?>
</div>
</body>
</html>
