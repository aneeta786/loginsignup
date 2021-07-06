<?php
$connection = new mysqli("localhost", "root", "", "college");
session_start();
if(isset($_POST['but_submit'])){
$uname = $connection,$_POST['name'];
$password = $connection,$_POST['password'];

if ($uname != "" && $password != ""){

    $sql_query = "select count(*) as cntUser from registration where name='".$uname."' and password='".$password."'";
    $result = mysqli_query($connection,$sql_query);
    $row = mysqli_fetch_array($result);

    $count = $row['cntUser'];

    if($count > 0){
        $_SESSION['name'] = $uname;
        echo 1;
    }else{
        echo 0;
    }

}
}
?>