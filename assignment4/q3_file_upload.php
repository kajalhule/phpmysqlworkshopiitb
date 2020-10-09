<!DOCTYPE html>

<html lang="en">
<head>
<title>File upload</title>
</head>
<body>
<h1>Upload file here..</h1>
<form action="q3_file_upload.php" method="post" enctype='multipart/form-data'>
<input type="file" name="myFile"><br>
<input type="submit" value="upload">
</form>
</body>
</html>




<?php
 if(isset($_FILES['myFile']))
 {
     $file = $_FILES['myFile'];
     echo "<h3>Properties of the file</h3>";
     echo "Name: " . $file['name'] . "<br>";
     echo "Type: " . $file['type'] . "<br>";
     echo "Size: " . $file['size'] . " bytes<br>";
     echo "Temp Directory: " . $file['temp_name'] . "<br>";
 }

 

?>
