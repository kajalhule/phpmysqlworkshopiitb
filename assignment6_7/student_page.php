<?php

include('connect.php');

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        table,th,td {
            border: 1px solid gray;
            border-collapse: collapse;
            padding: 5px;
            
        }
    </style>
</head>
<body>
    <?php

    if(isset($_SESSION['email']) && $_SESSION['type']=="student")
    {
        echo "<br><i>Student Dashboard</i><br> <a href='logout.php'>Logout</a><br>";
        $email = $_SESSION['email'];
        $stmt=$connect->prepare("SELECT * FROM student WHERE email=?;");
        $stmt->bind_param("s", $email);
        if($stmt->execute())
        {
            $result = $stmt->get_result();
            $db_sname = "";
            $db_email = "";
            $marks = array();

            while($row = $result->fetch_assoc())
            {
                $db_email = $row['email'];
                $db_sname = $row['sname'];
                $marks['php'] = $row['php'];
                $marks['mysql'] = $row['mysql'];
                $marks['html'] = $row['html'];
            }
            echo "Name: " . $db_sname . "<br>";
            echo "Email: " . $db_email . "<br>";
            $marksUploaded=false;
            $total=0;
            $percent=0;
            if(isset($marks['php']) && isset($marks['mysql']) && isset($marks['html']))
            {
                $marksUploaded=true;
                $total = $marks['php'] + $marks['mysql'] + $marks['html'];
                $percent = $total * 100 / 300;                
            }

        }
        else
        {
            die("Error Occured: " . $stmt->error);
        }
        
        $stmt->close();
    }
    else
    {
        header("Location: student_login.php");
    }

    $connect->close();
    ?>
    <table>
        <thead>
            <tr><th>Subject</th><th>Marks</th></tr>
        </thead>
        <tbody>            
            <?php
                foreach($marks as $sub => $sub_marks)
                {
                    echo "<tr><td>$sub</td><td>$sub_marks</td></tr>";
                }
            ?>
        </tbody>        
    </table>
    <?php
    if($marksUploaded)
    {
        echo "Total Obtained: $total<br>Total Marks: 300<br>Percentage: $percent%<br>";
        if($percent>60) echo "Congratulation!<br>";
    }
    else
    {
        echo "Marks Not Yet Uploaded";
    }
    ?>
    <form action="student_page.php" method="POST">
        <br><label>Mail Marksheet</label><br>
        <input type="email" name="mail_to" placeholder="Email" required><br>
        <button type="submit">Mail</button>
    </form>
    <?php
    if(isset($_POST['mail_to']))
    {
        $body="Name: $db_sname\n";
        if($marksUploaded)
        {
            $body .= "Marks:\n";
            foreach($marks as $sub => $sub_marks)
            {
                $body .= "$sub = $sub_marks\n";
            }
            $body .= "Total Obtained: $total\nTotal Marks: 300\nPercentage: $percent%\n";
            if($percent>60) $body .= "Congratulation you are passed!\n";
        }
        else
        {
            $body .= "Marks Not Yet Uploaded\n";
        }

        mail($_POST['mail_to'],"Marksheet",$body);
        echo "Mailed to: " . $_POST['mail_to'];
    }
    ?>
</body>
</html>
