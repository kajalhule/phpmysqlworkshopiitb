<?php

include('connect.php');

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

    if(isset($_SESSION['email']) && $_SESSION['type']=="admin")
    {
        echo "<br>Admin Dashboard <a href='logout.php'>Logout</a><br>";
        $email = $_SESSION['email'];
        $result=$connect->query("SELECT * FROM student;");
        $students = array();
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $students [$row['id']] ['sname'] = $row['sname'];
                $students [$row['id']] ['email'] = $row['email'];                
                $students [$row['id']] ['php'] = $row['php'];
                $students [$row['id']] ['mysql'] = $row['mysql'];
                $students [$row['id']] ['html'] = $row['html'];
            }
        }
        else
        {
            die("No students");
        }
        
    }
    else
    {
        header("Location: admin_login.php");
    }

    $connect->close();
    ?>
    <h2>Student Record</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>PHP</th>
                <th>MySQL</th>
                <th>HTML</th>
                <th>Total Obtained</th>
                <th>Total Marks</th>
                <th>Percentage</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>            
            <?php
                foreach($students as $id => $data)
                {
                    if(!isset($data['php']) && !isset($data['mysql']) && !isset($data['html']))
                    {
                        echo "<tr><td>" . $id . "</td><td>" . $data['sname'] . "</td><td>" . $data['email'] . "</td><td></td><td></td><td></td><td></td><td>300</td><td></td><td><a href='edit_marks.php?id=" . $id . "'>Edit</a></td><td><a href='delete_student.php?id=" . $id . "'>Delete</a></td></tr>";
                    }
                    else
                    {
                        $total = $data['php'] + $data['mysql'] + $data['html'];
                        $percent = $total*100/300;
                        echo "<tr><td>" . $id . "</td><td>" . $data['sname'] . "</td><td>" . $data['email'] . "</td><td>" . $data['php'] . "</td><td>" . $data['mysql'] . "</td><td>" . $data['html'] . "</td><td>" . $total . "</td><td>300</td><td>" . $percent . "%</td><td><a href='edit_marks.php?id=" . $id . "'>Edit</a></td><td><a href='delete_student.php?id=" . $id . "'>Delete</a></td></tr>";
                    }
                }
            ?>
        </tbody>        
    </table>
    <br><a href='add_student.php'>Add Student</a><br>
</body>
</html>
