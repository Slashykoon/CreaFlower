<?php
require_once "config/Users.php";
require_once "config/Produits.php";
require_once "config/Options.php";
require_once "config/Specifications.php";
require_once "config/Paiements.php";
require_once "config/Produit_Panier.php";
require_once "config/Paniers.php";

require_once "PayPalPayment.php";



$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$paiements = new Paiements();
$produit_panier = new Produit_Panier();
$paniers = new Paniers();


$success = 0;
$msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...";
$paypal_response = [];
 
if (!empty($_POST['paymentID']) AND !empty($_POST['payerID'])) {
   $paymentID = htmlspecialchars($_POST['paymentID']);
   $payerID = htmlspecialchars($_POST['payerID']);
 
   $payer = new PayPalPayment();
   $payer->setSandboxMode(1);
   $payer->setClientID("AeIBakz8rXg1v2EQmZUO9xOHKzInEDpKlqbvEsT0OwjqBaxo7itYQADAebBeCFNXsUgZUlke0wfry_pT");
   $payer->setSecret("EI-29-i6d3fOW9SnUBf3wRLe8UoIqq90M0tUVzZn3CGOCPXqL-jTyGzvi0sWOEwqtbwA7wGpPcuJDQYa"); 
 
   $payment = $paiements->find($paymentID);
   //$row_panier=$paniers->findwithPK($payment['produit']);
   

   if ($payment) {

      $paypal_response = $payer->executePayment($paymentID, $payerID);
      $paypal_response = json_decode($paypal_response);
 
      $update_payment=$paiements->edit($paypal_response->state, $paypal_response->payer->payer_info->email, $paymentID,0); //no facture wait to approve

      if ($paypal_response->state == "approved") {
         $success = 1;
         //Gestion des numéros de facture
         $facture = 0;
         $last_paiement=$paiements->search_last_facture();
         //error_log( print_r($last_paiement, TRUE) );
         error_log( print_r($last_paiement['MAX(num_facture)'], TRUE) );
         if(empty($last_paiement)){
            $facture = 1;
         }
         else{
            //$trimmed_facture=str_replace("FAC", "",$row_last_paiement['num_facture']);
            $facture = intval($last_paiement['MAX(num_facture)'])+1;
         }
         //update du numéro de facture 
         $update_payment=$paiements->edit($paypal_response->state, $paypal_response->payer->payer_info->email, $paymentID,$facture); //update facture
         //changement du statut  de panier afin de ne plus le rendre visible, mais archivé
         $ret_edit=$paniers->edit_statut($payment['produit'],"Paye");
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
echo json_encode(["success" => $success, "msg" => $msg, "paypal_response" => $paypal_response,"pay_id"=>$paymentID]);