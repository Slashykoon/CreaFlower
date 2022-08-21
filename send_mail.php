<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './vendors/phpmailer/phpmailer/src/PHPMailer.php';
require './vendors/phpmailer/phpmailer/src/Exception.php';
require './vendors/phpmailer/phpmailer/src/SMTP.php';


$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

header('Content-Type: application/json');
if ($name === ''){
  print json_encode(array('message' => 'Nom ne peut pas être vide', 'code' => 0));
  exit();
}
if ($email === ''){
  print json_encode(array('message' => 'Email ne peut pas être vide', 'code' => 0));
  exit();
} else {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
  print json_encode(array('message' => 'Format Email invalide', 'code' => 0));
  exit();
  }
}
if ($message === ''){
  print json_encode(array('message' => 'Le message ne peut pas être vide', 'code' => 0));
  exit();
}

$content="Message de : $name \n  depuis adresse Email: $email \n  Message: $message";
//$recipient = "youremail@here.com";
//$mailheader = "From: $email \r\n";


$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();

// Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'tommy.jeanbille@gmail.com';                 // SMTP username
$mail->Password = 'vwqvenoziwapzycg';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->From = 'from@example.com';
$mail->FromName = 'Contact Site Web';
$mail->addAddress('celine.levrechon@gmail.com');     // Add a recipient
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'CECI EST LE SUJET';
$mail->Body    = $content;//'CECI EST LE CONTENU DU HTML EMBARQUE <b>MEULITOOOOOO!</b>';
//$mail->AltBody = 'AUTRES';

if(!$mail->send()) {
    //echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
    print json_encode(array('message' => 'Erreur: ' . $mail->ErrorInfo, 'code' => 1));
} else {
    print json_encode(array('message' => 'Email a été correctement envoyé!', 'code' => 1));
    //echo 'Message has been sent';
}

//mail($recipient, $subject, $content, $mailheader) or die("Error!");
//print json_encode(array('message' => 'Email successfully sent!', 'code' => 1));

exit();






?>