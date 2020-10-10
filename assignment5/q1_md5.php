<!DOCTYPE html>
<html lang="en">
<head>
<title>md5</title>
</head>
<body>
<form action="#" method="POST">
<input type="text" name="username" placeholder="Username" required><br>
<input type="password" name="password" placeholder="Password" required><br>
<input type="submit" value="login">
</form>
</body>
</html>


<?php
$connect=mysqli_connect("localhost","root","","logindata") or die("connection failed!");
echo "connected!";
error_reporting(0);
echo "<br>";
if(isset($_POST['username'])&&isset($_POST['password']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $pswd=md5($password);
    $query="INSERT INTO loginfo(username,passwordis)VALUES('$username','$pswd')";
    $data=mysqli_query($connect,$query);
    if($data){
        echo "you have logged in successfully";

    }else
    {
        echo "renter username and password";

    }

}
?>