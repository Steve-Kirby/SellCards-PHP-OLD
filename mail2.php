<?php
$action=$_GET['action'];
$fname=$_GET['fname'];
$lname=$_GET['lname'];
$email=$_GET['email'];
$phone=$_GET['phone'];
$message=$_GET['message'];

$to = "";
$subject = "Sent from contact form";
$txt = $fname." ".$lname." ('".$email."/".$phone."') ".$message;

mail($to,$subject,$txt);

header( 'Location: http://sellcards.steve-kirby.website/index.php' ) ;
?> 