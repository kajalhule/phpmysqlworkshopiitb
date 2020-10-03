<DOCTYPE html>
<html lang="en">
<head>
<title>special variable2</title>
</head>
<body>
<form action="q6_2_special_variables_html.php" method="POST">
Name of student: <input type="text" name="Sname"><br>
Marks in each subject:<br>
subject 1:<input type="number" name="sub1" min="0" max="100"><br>
subject 2:<input type="number" name="sub2" min="0" max="100"><br>
subject 3:<input type="number" name="sub3" min="0" max="100"><br>
subject 4:<input type="number" name="sub4" min="0" max="100"><br>
subject 5:<input type="number" name="sub5" min="0" max="100"><br>
<input type="submit" value="submit">
</form>
</body>
</html>

<?php
$sum=$_POST['sub1']+$_POST['sub2']+$_POST['sub3']+$_POST['sub4']+$_POST['sub5'];
echo "total marks obtained: $sum<br>";
echo "total marks: 500<br>";
$persent=($sum/500)*100;
echo "Percentage: $persent";


?>