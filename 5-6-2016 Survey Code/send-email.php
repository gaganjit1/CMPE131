<?php session_start();
require 'PHPMailerAutoload.php';
require '/class.phpmailer.php';

$Rec_Major = $_SESSION['Rec_Major'];
$email = $_POST['email'];

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
 
 
$mail->Username = "thesmartmajor@gmail.com";
$mail->Password = "CMPE130/131";
 
$mail->IsHTML(true);
$mail->SingleTo = true;
 
$mail->From = "thesmartmajor@gmail.com";
$mail->FromName = "The Smart Major";
 
$mail->addAddress($email,"User 1");

 
$mail->Subject = "Your Major Recommendation!";
$mail->Body = "Hello,<br /><br />Your Major Recommendation is $Rec_Major.<br /><br />Sincerely, <br />The Smart Major";
 
if(!$mail->Send()){
    echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
	header('refresh:3;url=/results.php');
}
else{
    echo "Message has been sent.<br />Redirecting to home page in 3 seconds...";
	header('refresh:3;url=/');
}


