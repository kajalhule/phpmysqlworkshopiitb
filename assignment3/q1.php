<?php
$connect=mysqli_connect("localhost","root","","result") or die("connection failed!");
echo "connected!";
error_reporting(0);
echo "<br>";
?>

<html>
<body>
<form action="" method="POST">

Name of the student: <input type="text" name="studentname" required><br>
Marks in each subject:<br>
subject1: <input type="number" name="sub1" min="0" max="100" required><br>
subject2: <input type="number" name="sub2" min="0" max="100" required><br>
subject3: <input type="number" name="sub3" min="0" max="100" required><br>
subject4: <input type="number" name="sub4" min="0" max="100" required><br>
subject5: <input type="number" name="sub5" min="0" max="100" required><br>
<input type="submit" value"submit"><br>

</form>
</body>
</html>

<?php



$sname=$_POST['studentname'];
$sub1=$_POST['sub1'];
$sub2=$_POST['sub2'];
$sub3=$_POST['sub3'];
$sub4=$_POST['sub4'];
$sub5=$_POST['sub5'];
$totalmo=$sub1+$sub2+$sub3+$sub4+$sub5;
echo "Total marks obtained: $totalmo<br>";

$total=500;
echo "Total: $total<br>";
$percent=($totalmo/$total)*100;
echo "Percent: $percent<br>";
$query="INSERT INTO class1(studentname,sub1,sub2,sub3,sub4,sub5,totalmarksobtained,totalmarks,percent)VALUES('$sname','$sub1','$sub2','$sub3','$sub4','$sub5','$totalmo','$total','$percent')";
$data=mysqli_query($connect,$query);

if($data)
{
    echo"data is inserted";
}
else{
    echo "data is not inserted";
}

?>