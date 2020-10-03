<!DOCTYPE html>
<html lang="eng">
<head>
<title>special variables</title>
</head>
<body>
<form action="q6_1_special_variables_html.php" method="GET">
side a:<input type="number" name="side1">
side b:<input type="number" name="side2">
side c:<input type="number" name="side3">
<input type="submit" value="calculate">
</form>
</body>
</html>


<?php 

 if($_GET['side1']===$_GET['side2']&&$_GET['side2']===$_GET['side3'])
{
    echo "Equilateral triangle";
}
else if($_GET["side1"]===$_GET["side2"]||$_GET["side2"]===$_GET["side3"]||$_GET["side3"]===$_GET["side1"])
{
    echo "Isosceles triangle";
}
else{
    echo "Scalene triangle";
}

?>