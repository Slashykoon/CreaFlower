<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './vendors/phpmailer/phpmailer/src/PHPMailer.php';
require './vendors/phpmailer/phpmailer/src/Exception.php';
require './vendors/phpmailer/phpmailer/src/SMTP.php';



require_once "config/Users.php";
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
$specification_panier = new Specifications_Panier();


/*$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];*/

$Payment_ID=$_GET['pid'];

$row_paiement=$paiements->find($Payment_ID);

if ($row_paiement)
{
  header('Content-Type: application/json');
  /*if ($name === ''){
    print json_encode(array('message' => 'Nom ne peut pas être vide', 'code' => 0));
    exit();
  }*/
  /*if ($email === ''){
    print json_encode(array('message' => 'Email ne peut pas être vide', 'code' => 0));
    exit();
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    print json_encode(array('message' => 'Format Email invalide', 'code' => 0));
    exit();
    }
  }*/
  /*if ($message === ''){
    print json_encode(array('message' => 'Le message ne peut pas être vide', 'code' => 0));
    exit();
  }*/
  $row_panier=$paniers->findwithPK($row_paiement["produit"]);
  $rows_produits_panier=$produit_panier->findAllProduct_With_PanierID($row_paiement["produit"]);


  /*$content="Message de : $name \n  depuis adresse Email: $email \n  Message: $message";*/
  $content="<h1 style='color:#DDAF94;text-align:center;'><b>Merci pour votre achat chez Créa'Flower</b></h1><br/><br/>";
  $content=$content."<h2 style='color:#DDAF94'><b>identifiant de paiement : </b></h2>";
  $content=$content.$Payment_ID."<br/><br/>";
  $content=$content."<h2 style='color:#DDAF94'><b>numero de facture : </b></h2>";
  $content=$content."FAC_".$row_paiement["num_facture"]."<br/><br/>";
  

  $content=$content."<h2 style='color:#DDAF94'><b>contenu du panier : </b></h2>";
  $content=$content."<div style='background-color: #FDF8F5;text-align:center;'>";
  $content=$content."<hr style='height:2px;border-width:0;color:gray;background-color:gray'>"; 



  $sum_opt_prix_total = 0.0;
  //iteration des produits du panier
  foreach($rows_produits_panier as $produit_panier)
  {
      $produit_iter = $produits->findwithPK($produit_panier["fk_produit"]);
      //recupere les specification pour vérifier les options
      $rows_specifications_panier=$specification_panier->findAllOptionsOfProdPanier($produit_panier["pk_produit_panier"]);

      $content=$content."<h3 style='color:#DDAF94;'><b>".$produit_iter["nom"]."</b></h3>";
      $content=$content."<b>quantité : </b>".$produit_panier["quantity"]."<br/>";   

      $opt_prix_add_total = 0.0; 
      //affiche la totalité des prix additionels et des noms des options
      if(!empty($rows_specifications_panier))
      {
          foreach ($rows_specifications_panier as $sp_panier)
          {
              $row_opt_panier = $options->TestIfOptionExist($sp_panier["fk_option"]); //=> changer nom testif todo
              $row_spec = $specifications->find($row_opt_panier["fk_sp"]); //recuperation du nom de la specification
              $content = $content."<b>".$row_spec["nom_specification"]." : </b>";
              //print_r("<p style='margin-top:5px;margin-bottom:2px;'>: ".$row_spec["nom_specification"]."</p>");
              $temp_prix_add = (( floatval($row_opt_panier["prix_add"]) > 0.0) ? " (+".strval($row_opt_panier["prix_add"])."e)"  : "");
              //$content=$content."<ul style='margin-top:0px;margin-bottom:0px;background-color: #FDF8F5;'>";
              //$content=$content."<li>";
              //$content=$content."<p style='margin-top:0px;margin-bottom:0px;background-color: #FDF8F5;' >";
              $content=$content.$row_opt_panier["nom_option"]." ".$temp_prix_add."<br/>";
              //$content=$content."</p>";
              //$content=$content."</li>";
              //$content=$content."</ul>";
              $opt_prix_add_total = ($opt_prix_add_total + floatval(($row_opt_panier["prix_add"]) * floatval(($produit_panier["quantity"]) )));   
          }
          $sum_opt_prix_total=$sum_opt_prix_total+$opt_prix_add_total;
      }
      $temp_total= floatval(($produit_iter["prix"]) * floatval(($produit_panier["quantity"]))) + $opt_prix_add_total;
      $content=$content."<b>prix (options inclues) : </b>".number_format((float)$temp_total, 2, '.', '')."e " ;
      $content=$content."<hr style='height:2px;border-width:0;color:gray;background-color:gray'>"; 
  }
  $content=$content."</div>";

 //on trouve le produit dans le panier
 if(!empty($rows_produits_panier))
 {
     //calcul des totaux
     $sous_total=0;
     if(!empty($rows_produits_panier))
     {
         foreach($rows_produits_panier as $prod_panier)
         {
             $_produit = $produits->findwithPK($prod_panier["fk_produit"]);
             if(!empty($_produit))
             {
                 //calcul du sous total 
                 $sous_total = $sous_total + (float)$_produit["prix"]*(float)$prod_panier["quantity"] ;
                 $livraison = 5.0;  
             }
         }   
         //calcul du sous total avec options prise en comtpes
         $sous_total = $sous_total + $sum_opt_prix_total;
         $total = $sous_total + $livraison ;
     }


  $content=$content."<h3 style='color:#DDAF94'>Sous-total : </h3>".$sous_total."e <br/>";
  $content=$content."<h3 style='color:#DDAF94'>Frais de livraison :</h3> 5e <br/>";
  $content=$content."<h3 style='color:#DDAF94'>Total : </h3>".$total."e <br/><br/><br/><br/>";

  
  $content=$content."<div style='text-align:center;'>";
  $content=$content."ENTREPRISE INDIVIDUELLE <b>CELINE LEVRECHON</b> <br/>"; 
  $content=$content."N° SIRET 91789930400013 <br/>";
  $content=$content."T.V.A non applicable <br/>";
  $content=$content."</div>";
  }


  


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
  $mail->addAddress('celine.levrechon@gmail.com');     // Add a recipient
  //$mail->addReplyTo('info@example.com', 'Information');
  //$mail->addCC('cc@example.com');

  $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = utf8_decode("Votre commande Crea'Flower");
  $mail->Body    = utf8_decode($content);
  //$mail->AltBody = 'AUTRES';

  if(!$mail->send()) {
      //METTRE ICI UNE PAGE OU ON INDIQUE QUE LE PAIMENT CEST PAS BIEN PASSSE
      header("Location: http://ecommerce//index_error.php");
      //echo 'Message could not be sent.';
      //echo 'Mailer Error: ' . $mail->ErrorInfo;
      //print json_encode(array('message' => 'Erreur: ' . $mail->ErrorInfo, 'code' => 1));
  } else {
      //METTRE ICI UNE PAGE OU ON INDIQUE QUE LE PAIMENT CEST BIEN PASSE
      header("Location: http://ecommerce//Payment_accepted_redirection.php");
      //print json_encode(array('message' => 'Email a été correctement envoyé!', 'code' => 1));
      //echo 'Message has been sent';
  }
}

exit();

?>