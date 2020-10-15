<?php

include('connect.php');

session_start();

if(isset($_SESSION['email']) && $_SESSION['type']=="admin")
{
    $stmt = $connect->prepare("DELETE FROM student WHERE id=?");
    $stmt->bind_param("i",$_GET['id']);
    if($stmt->execute())
    {
        echo "Record Deleted Successfully<br>";
    }
    else
    {
        echo "Error Occured: " . $stmt->error . "<br>";
    }
    echo "<a href='admin_dashboard.php'>Click here</a> to go back to Dashboard.";
    $stmt->close();
}
else
{
    header("Location: admin_login.php");
}
$connect->close();
?>
