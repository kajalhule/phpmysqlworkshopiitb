<?php
session_start();
session_unset();
session_destroy();
echo "Successfully Logged Out<br><a href='index.php'>Click here</a> to go to homepage.";
?>
