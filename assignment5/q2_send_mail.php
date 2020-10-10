<!DOCTYPE html>
<html lang='en'>
<head>
<title>Send feedback</title>
</head>
<body>
<form action="#" method="POST">
<input type="text" name="name" placeholder="name" required><br>
<input type="email" name="email" required ><br>
Enter Feedback:<br>
<input type="textarea" name="feedback" required>
<input type="submit" value="submit">
</form>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $to=$_POST['email'];
    $feedback=$_POST['feedbaack'];
    $subject="Thank you for your feedback!";
    $body = "Thank you, $name! Here's what we got from you.\n" . $feedback;
        if(!mail($to, $subject, wordwrap($body,70)))
        {
            echo "Failed to send mail to " . $to;
        }

        $adminemail = "admin@company.com";
        $subject = "Feedback from $name";
        $body = "Received feedback from $name\n\nemail address: $to\n\nFeedback: $feedback";
        if(!mail($adminemail, $subject, wordwrap($body,70)))
        {
            echo "Failed to send mail to admin: " . $adminemail;
        }

}


?>