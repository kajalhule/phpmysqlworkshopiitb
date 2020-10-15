<?php

session_start();

if(!isset($_SESSION['email']) || $_SESSION['type'] != "admin")
{
    header("Location: admin_login.php");
}

if(isset($_POST['sname']) && isset($_POST['email']) && isset($_POST['password']))
{
    include('connect.php');
    $sname=$_POST['sname'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $stmt;
    if(empty($_POST['php']) && empty($_POST['mysql']) && empty($_POST['html']))
    {
        $stmt = $connect->prepare("INSERT INTO student (`sname`,`email`,`password`) VALUES (?,?,?);");
        $stmt->bind_param("sss",$sname,$email,$password);
    }
    else
    {
        $php=$_POST['php'];
        $mysql=$_POST['mysql'];
        $html=$_POST['html'];
        $stmt = $connect->prepare("INSERT INTO student (`sname`,`email`,`password`,`php`,`mysql`,`html`) VALUES (?,?,?,?,?,?);");
        $stmt->bind_param("sssiii",$sname,$email,$password,$php,$mysql,$html);
    }
    
    if($stmt->execute())
    {
        echo "Record Added Successfully<br><a href='admin_page.php'>Click here</a> to go back to Dashboard.";
    }
    else
    {
        die("Error Occured: " . $stmt->error . "<br><a href='admin_page.php'>Click here</a> to go back to Dashboard.");
    }    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<body>
    <h1>Add Student</h1>
    <form action="add_student.php" method="POST">
        <input type="text" name="sname" placeholder="Student Name" required><br>
        <input type="text" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="number" name="php" placeholder="PHP marks"><br>
        <input type="number" name="mysql" placeholder="MySQL marks"><br>
        <input type="number" name="html" placeholder="HTML marks"><br>
        <button type="submit">Add</button>
    </form>
</body>
</html>
