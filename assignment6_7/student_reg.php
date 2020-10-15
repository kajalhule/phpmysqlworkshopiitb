<?php

include('connect.php');

session_start();

if(isset($_SESSION['email']) && $_SESSION['type']=="student")
{
    header("Location: student_page.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
</head>
<body>
<i><h1>REgister Here</h1></i>
    <form action="student_reg.php" method="POST">
        <input type="text" name="sname" placeholder="Student Name" required><br>
        <input type="text" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>

    <?php
    if(isset($_POST['sname']) && isset($_POST['email']) && isset($_POST['password']))
    {
        $email = $_POST['email'];
        $stmt=$connect->prepare("SELECT * FROM student WHERE email=?;");
        $stmt->bind_param("s", $email);
        if($stmt->execute())
        {            
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                echo "Student already exists<br><a href='student_login.php'>Click here</a> to go to login page.";
            }
            else //Student doesn't exist
            {
                $sname = $_POST['sname'];
                $hashedpassword = md5($_POST['password']);
                $stmt=$connect->prepare("INSERT INTO student(`sname`,`email`,`password`) VALUES(?,?,?);");
                $stmt->bind_param("sss",$sname,$email,$hashedpassword);
                if($stmt->execute())
                {
                    echo "Successfully Registered!<br><a href='student_login.php'>Click here</a> to go to login page.";
                }
                else
                {
                    die("Error Occured: " . $stmt->error);
                }
            }
        }
        else
        {
            die("Error Occured: " . $stmt->error);
        }
        $stmt->close();
        $conn->close();
    }

    ?>
</body>
</html>
