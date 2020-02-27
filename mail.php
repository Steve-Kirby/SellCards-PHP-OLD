<?php
require 'PHPMailer/PHPMailerAutoload.php';
include("PHPMailer/class.phpmailer.php");
include("PHPMailer/class.smtp.php");

$action=$_GET['action'];
$fname=$_GET['fname'];
$lname=$_GET['lname'];
    $email=$_GET['email'];
    $phone=$_GET['phone'];
    $message=$_GET['message'];

$mail = new PHPMailer();

$mail->SMTPDebug = false;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '';                 // SMTP username
$mail->Password = '';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('', $fname.' '.$lname.' ('.$email.')');
$mail->addAddress('','');     // Add a recipient
//$mail->addAddress('kiabs@hotmail.com');               // Name is optional
//$mail->addReplyTo('', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $phone;
$mail->Body    = 'Sent using Contact form on website! '.$message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
						

					