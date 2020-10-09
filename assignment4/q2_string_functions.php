
<!DOCTYPE html>
<html lang="en">
<head>
<title>string functions</title>
</head>
<body>
<form action="#" method="post">
<input type="text" name="string"><br>
<input type="submit" value="submit">
</form>
</body>

<?php
if(isset($_POST['string']))
{
    $str=$_POST['string'];
    echo "String: $str <br>";
    echo "Number of characters in the string: ". strlen($str);
    echo "<br>String to Array: ";
    print_r(explode(" ", $str));
    echo "<br>Reversing the String: " . strrev($str);
    echo "<br>To lowercase: " . strtolower($str);
    echo "<br>To UPPERCASE: " . strtoupper($str);
    echo "<br>Replace Substring: " . substr_replace($str, "and",4 , 8);

}

?>