<?php
require_once "config/Users.php";
require_once "config/Produits.php";
require_once "config/Options.php";
require_once "config/Specifications.php";
require_once "config/Paiements.php";
require_once "config/Produit_Panier.php";

require_once "PayPalPayment.php";



$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$paiements = new Paiements();
$produit_panier = new Produit_Panier();


$success = 0;
$msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...";
$paypal_response = [];
 
if (!empty($_POST['paymentID']) AND !empty($_POST['payerID'])) {
   $paymentID = htmlspecialchars($_POST['paymentID']);
   $payerID = htmlspecialchars($_POST['payerID']);
 
   $payer = new PayPalPayment();
   $payer->setSandboxMode(1);
   $payer->setClientID("AeIBakz8rXg1v2EQmZUO9xOHKzInEDpKlqbvEsT0OwjqBaxo7itYQADAebBeCFNXsUgZUlke0wfry_pT");
   $payer->setSecret("EI-29-i6d3fOW9SnUBf3wRLe8UoIqq90M0tUVzZn3CGOCPXqL-jTyGzvi0sWOEwqtbwA7wGpPcuJDQYa"); // On indique son Secret
 
   $payment = $paiements->find($paymentID);
 
   if ($payment) {

      $paypal_response = $payer->executePayment($paymentID, $payerID);
      $paypal_response = json_decode($paypal_response);
 
      $update_payment=$paiements->edit($paypal_response->state, $paypal_response->payer->payer_info->email, $paymentID);

      if ($paypal_response->state == "approved") {
         $success = 1;
         //clear le panier TODO remplacer par sauvegarde et renouvellement d'un id de panier pour la sessions courante
         //$ret_supp=$produit_panier->DeleteAllFromPanier($ref);
         $msg = "";
      } else {
         $msg = "Une erreur est survenue durant l'approbation de votre paiement. Merci de réessayer ultérieurement ou contacter un administrateur du site.";
      }
   } else {
      $msg = "Votre paiement n'a pas été trouvé dans notre base de données. Merci de réessayer ultérieurement ou contacter un administrateur du site. (Votre compte PayPal n'a pas été débité)";
   }
}
echo json_encode(["success" => $success, "msg" => $msg, "paypal_response" => $paypal_response]);