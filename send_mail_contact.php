<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './vendors/phpmailer/phpmailer/src/PHPMailer.php';
require './vendors/phpmailer/phpmailer/src/Exception.php';
require './vendors/phpmailer/phpmailer/src/SMTP.php';



/*require_once "config/Users.php";
require_once "config/Produits.php";
require_once "config/Options.php";
require_once "config/Specifications.php";
require_once "config/Paiements.php";
require_once "config/Paniers.php";
require_once "config/Produit_Panier.php";
require_once "config/Sessions.php";
require_once "config/Specifications_Panier.php";

$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$paiements = new Paiements();
$paniers = new Paniers();
$produit_panier = new Produit_Panier();
$sessions = new Sessions();
$specification_panier = new Specifications_Panier();*/

$prenom = $_POST['prenom'];
$name = $_POST['name'];
$raison = $_POST['raison'];
$email = $_POST['email'];
$message = $_POST['message'];

//$Payment_ID=$_GET['pid'];



if (true)
{
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

  $content="<h1 style='color:#DDAF94;text-align:center;'><b>Formulaire de contacte</b></h1><br/><br/>";
  $content=$content."<h2 style='color:#DDAF94;text-align:center;'><b> $raison </b></h2><br/>";
  $content=$content."<h2 style='color:#DDAF94;'><b> Message de : </b></h2><h2><b>$prenom  $name </b></h2><br/>";
  $content=$content."<h2 style='color:#DDAF94;'><b> depuis adresse Email: </b></h2><h2><b> $email </b></h2><br/>";
  $content=$content."<h2 style='color:#DDAF94;'><b> Contenu du Message: </b></h2><h2><b>".nl2br($message) ."</b></h2><br/>";
  

  //$recipient = "youremail@here.com";
  //$mailheader = "From: $email \r\n";
  $mail = new PHPMailer;

  $mail->SMTPDebug = 0;                               // Enable verbose debug output

  $mail->isSMTP();

  // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'tommy.jeanbille@gmail.com';                 // SMTP username
  $mail->Password = 'vwqvenoziwapzycg';                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                    // TCP port to connect to

  $mail->From = 'from@example.com';
  $mail->FromName = utf8_decode("Créa'Flower");
  $mail->addAddress('contact@crea-flower.fr');     // Add a recipient
  //$mail->addReplyTo('info@example.com', 'Information');
  //$mail->addCC('cc@example.com');

  $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = utf8_decode("Formulaire de contact Crea'Flower");
  $mail->Body    = utf8_decode($content);
  //$mail->AltBody = 'AUTRES';

  if(!$mail->send()) {
      //METTRE ICI UNE PAGE OU ON INDIQUE QUE LE PAIMENT CEST PAS BIEN PASSSE
      //header("Location: http://crea-flower.fr//index_error.php");
      print json_encode(array('message' => 'Erreur: ' . $mail->ErrorInfo, 'code' => 1));

  } else {
      //METTRE ICI UNE PAGE OU ON INDIQUE QUE LE PAIMENT CEST BIEN PASSE
      //header("Location: http://crea-flower.fr//Payment_accepted_redirection.php");
      print json_encode(array('message' => 'Email a été correctement envoyé!', 'code' => 1));
  }
}

exit();

?>