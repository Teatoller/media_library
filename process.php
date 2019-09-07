<?php
$posts =$_POST;

echo "<pre>";
$email_body = '';
$email_body .= "Name ". $posts['name'] . "\n";
$email_body .= "Email ". $posts['email'] . "\n";
$email_body .= "Details " .$posts['details'] . "\n";
echo $email_body;
echo "</pre>";
// To do: send email
header("location:thanks.php");
