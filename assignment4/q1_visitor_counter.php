<?php
$file=file_get_contents("count.txt","r");
$visitors=$file;
echo "you had $visitors visitors";
$visitorsnew=$visitors+1;
$filenew=fopen("count.txt","w");
fwrite($filenew,$visitorsnew);

?>