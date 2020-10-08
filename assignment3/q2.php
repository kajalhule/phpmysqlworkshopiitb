<?php
$connect=mysqli_connect("localhost","root","","result") or die("connection failed!");
echo "connected!";

$sub5=0;
$sub5after=99;
$totalmo=0;
$percent=0;

$result=$connect->query("SELECT * FROM class1 WHERE 'studentname'='Rohan'");
while($row=$result->fetch_assoc())
{
    $sub5 =$row['sub5'];
    $totalmo=$row['totalmo'];

}
$totalmo=$totalmo-$sub5+$sub5after;
$percent=$totalmo/5;

$stmt=$connect->prepare("UPDATE class1 SET'sub5'=?, 'totalmo'=?, 'percent'=? WHERE 'studentname'='Rohan'");
$stmt->bind_param("iid", $sub5after,$totalmo,$percent);
if($stmt->execute()){
    echo "<br>record updated<br>";
}else{
    echo "<br> Update failed<br>";
}
$stmt->close();
mysqli_close($connect);


?>