<?php

session_start();

if(!isset($_SESSION['email']) || $_SESSION['type'] != "admin")
{
    header("Location: admin_login.php");
}

include('connect.php');

$id=$_GET['id'];
$stmt = $connect->prepare("SELECT * FROM student WHERE id=?");
$stmt->bind_param("i",$id);
if($stmt->execute())
{
    $result=$stmt->get_result();
    $student=array();
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $student['sname'] = $row['sname'];
            $student['email'] = $row['email'];
            $student['password'] = $row['password'];
            $student['php'] = $row['php'];
            $student['mysql'] = $row['mysql'];
            $student['html'] = $row['html'];
        }
    }
    else
    {
        die("Database Error");
    }
}
else
{
    echo "Error Occured: " . $stmt->error . "<br>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student</h2>
    <form action="edit_marks.php?id=<?php echo $id ?>" method="POST">
        <label>Name</label><br>
        <input type="text" name="sname" placeholder="Student Name" value=<?php echo $student['sname'] ?> required><br>
        <label>Email</label><br>
        <input type="text" name="email" placeholder="Email" value=<?php echo $student['email'] ?> required><br>
        <label>PHP</label><br>
        <input type="number" name="php" placeholder="Marks in PHP" value=<?php if($student['php'])echo $student['php'] ?> ><br>
        <label>MySQL</label><br>
        <input type="number" name="mysql" placeholder="Marks in MySQL" value=<?php if($student['mysql'])echo $student['mysql'] ?> ><br>
        <label>HTML</label><br>
        <input type="number" name="html" placeholder="Marks in HTML" value=<?php if($student['html'])echo $student['html'] ?> ><br>
        <button type="submit">Edit</button>
    </form>

    <?php

    if(isset($_POST['sname']) && isset($_POST['email']))
    {
        $sname=$_POST['sname'];
        $email=$_POST['email'];

        if(empty($_POST['php']) && empty($_POST['mysql']) && empty($_POST['html']))
        {
            $stmt = $connect->prepare("UPDATE student SET sname=?,email=? WHERE id=?");
            $stmt->bind_param("ssi",$sname,$email,$id);
        }
        else
        {
            $php=$_POST['php'];
            $mysql=$_POST['mysql'];
            $html=$_POST['html'];
            $stmt = $connect->prepare("UPDATE student SET sname=?,email=?,php=?,mysql=?,html=? WHERE id=?");
            $stmt->bind_param("ssiiii",$sname,$email,$php,$mysql,$html,$id);
        }

        if($stmt->execute())
        {
            echo "Record Updated Successfully<br>";
        }
        else
        {
            echo "Error Occured: " . $stmt->error . "<br>";
        }
    }

    echo "<a href='admin_page.php'>Click here</a> to go back to Dashboard.";
    $stmt->close();
    $connect->close();
    ?>

</body>
</html>
