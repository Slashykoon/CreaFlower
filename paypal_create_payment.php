<?php
require_once "config/Users.php";
require_once "config/Produits.php";
require_once "config/Options.php";
require_once "config/Specifications.php";
require_once "config/Paiements.php";
require_once "config/Paniers.php";
require_once "config/Produit_Panier.php";
require_once "config/Sessions.php";

require_once "PayPalPayment.php";


$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$paniers = new Paniers();
$produit_panier = new Produit_Panier();
$sessions = new Sessions();

$paiements = new Paiements();


$success = 0;
$msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...!";
$paypal_response = [];

// On vérifie la présence de la référence du produit en paramètre d'URL ($_GET)
$arr_items = array();
if (!empty($_GET['ref'])) {
   //recherche des produits du panier
   $ref = htmlspecialchars($_GET['ref']);
   error_log( print_r($ref, TRUE) );
   $rows_produits_panier = $produit_panier->findAllProduct_With_PanierID($ref);
   error_log( print_r($rows_produits_panier, TRUE) );

   $bresult=false;
   $sous_total=0;
   if(!empty($rows_produits_panier))
   {
      $bresult=true;
      foreach($rows_produits_panier as $prod_panier)
      {
         $_produit = $produits->findwithPK($prod_panier["fk_produit"]);

         if(!empty($_produit))
         {
            $bresult = $bresult && true;
            //on pourra remettre ici les articles de la cart car verif en bdd
           $arr_temp_item = array(
               "sku" => $_produit["ref"], // Stock Keeping Unit
               "quantity" => strval($prod_panier["quantity"]), // Quantity
               "name" => $_produit["nom"], // titre du produit
               "price" => strval($_produit["prix"]), // prix au format chaîne de caractères
               "currency" => "EUR"
           );

           //calcul du sous total 
           $sous_total=$sous_total + (float)$_produit["prix"]*(float)$prod_panier["quantity"];

            array_push($arr_items, $arr_temp_item);
         }
         else
         {
            $bresult= $bresult && false;
         }
      }   
   }

   // On vérifie que le produit existe bien (<=> qu'il a été trouvé dans la base de données)
   if ($bresult) {

      $payer = new PayPalPayment();
      $payer->setSandboxMode(1);
      $payer->setClientID("AeIBakz8rXg1v2EQmZUO9xOHKzInEDpKlqbvEsT0OwjqBaxo7itYQADAebBeCFNXsUgZUlke0wfry_pT");
      $payer->setSecret("EI-29-i6d3fOW9SnUBf3wRLe8UoIqq90M0tUVzZn3CGOCPXqL-jTyGzvi0sWOEwqtbwA7wGpPcuJDQYa"); 


      //Init du header de transaction Paypal
      $payment_data = array(
         'intent' => 'sale',
         'redirect_urls' => array(
            'return_url' => 'http://ecommerce/index.php',
            'cancel_url' => 'http://ecommerce/index.php',
            ),
         'payer' => array(
            'payment_method' => 'paypal'
            )
      );

      // prepare basic payment details
      $payment_data['transactions'][0] = array(
                        'amount' => array(
                           'total' => strval($sous_total+5.00),
                           'currency' => 'EUR',
                           'details' => array(
                                 'subtotal' => strval($sous_total),
                                 'tax' => '0.00',
                                 'shipping' => '5.00'
                                 )
                           ),
                        'description' => 'Commande de produits artisanaux sur Celine Création'
                        );
      // prepare all items
      foreach($arr_items as $arr_item_add)
      {
         $payment_data['transactions'][0]['item_list']['items'][] = $arr_item_add;
      }       
          
      //error_log( print_r($payment_data, TRUE) );
      $paypal_response = $payer->createPayment($payment_data);
      $paypal_response = json_decode($paypal_response);
      
      if (!empty($paypal_response->id)) {
         // On oublie pas d'ajouter la référence de l'item dans le nouveau champ "produit" de notre table "paiements", afin de garder une trace du produit acheté !
         $ret_id_paiement=$paiements->add($ref,$paypal_response->id,$paypal_response->state,$paypal_response->transactions[0]->amount->total,$paypal_response->transactions[0]->amount->currency);

         if ($ret_id_paiement>0) {
            $success = 1;
            $msg = "";
         }

      } else {
         $msg = "Une erreur est survenue durant la communication avec les serveurs de PayPal. Merci de bien vouloir réessayer ultérieurement.";
      }
   } else {
      $msg = "Le produit que vous tentez d'acheter n'est pas disponible.";
   }
}
echo json_encode(["success" => $success, "msg" => $msg, "paypal_response" => $paypal_response]);
