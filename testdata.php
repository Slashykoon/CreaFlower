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

require_once 'logger.php';
$logger = Logger::get_logger();


$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$paniers = new Paniers();
$produit_panier = new Produit_Panier();
$sessions = new Sessions();

$paiements = new Paiements();


$success = 0;
$msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...";
$paypal_response = [];

$testref="8ekl6a8kpk706pmpi00b8hm0vj";
$arr_items=array();


if (true) 
{ 
   //recupere l'id de session ou du user (todo)
   $row_session = $sessions->find($testref);
   $rows_produits_panier = $produit_panier->findAllProduct_With_PanierID($row_session["fk_panier"]);
   $bresult=false;
   //print_r($row_session );
   //print_r("<br/>");
   //print_r($rows_produits_panier);
   //print_r("<br/>");
   //print_r("<br/>");
   if($rows_produits_panier)
   {
      $bresult=true;
      foreach($rows_produits_panier as $prod_panier)
      {
         //print_r($prod_panier);
         //print_r("<br/>");
         //print_r($prod_panier->fk_produit);
         $produit = $produits->findwithPK($prod_panier->fk_produit);
         //print_r($produit);
         //print_r("<br/>");
         if(!empty($produit))
         {

            $bresult = $bresult && true;
            //on pourra remettre ici les articles de la cart car verif en bdd
            $arr_temp_item = array(
               "sku" => $produit["ref"], // SKU (Stock Keeping Unit) correspond à la référence de notre item
               "quantity" => $prod_panier->quantity, //
               "name" => $produit["nom"], // Le titre de notre produit
               "price" => strval($produit["prix"]), // Son prix, toujours au format chaîne de caractères
               "currency" => "EUR"
            );

            array_push($arr_items, $arr_temp_item);
         }
         else
         {
            $bresult= $bresult && false;
         }

      }   
   }

}


$payment_data = [
   "intent" => "sale",
   "redirect_urls" => [
      "return_url" => "http://ecommerce/index.php",
      "cancel_url" => "http://ecommerce/index.php"
   ],
   "payer" => [
      "payment_method" => "paypal"
   ],
   "transactions" => [
      [
         "amount" => [
            "total" => strval(5*2), // Prix total de la transaction, ici le prix de notre item. ATTENTION ! PayPal attend des prix de type chaîne de caractères (string), d'où le "strval()" de notre prix enregistré comme flottant en base de données.
            "currency" => "EUR" // USD, CAD, etc.
         ],
         
         "item_list" => [
            "items" => [
            ]
         ],
         
         "description" => "Commande effectuée auprés de Celine création !" // Description du paiement. S'il n'y a qu'un seul item, on pourrait éventuellement passer la description du produit ici, mais ça n'a pas grand intérêt.
      ]
   ]
];


$payment_data["transactions"][0]["item_list"]["items"]=$arr_items;

print_r($payment_data);
print_r("<br/>");
print_r("<br/>");
print_r("<br/>");



$a = array('green', 'red', 'yellow');
$b = array('avocado', 'apple', 'banana');
//$c = array_combine($a, $b);

$arr_temp_item1= [
   "sku" => "a", // SKU (Stock Keeping Unit) correspond à la référence de notre item
   "quantity" => "9", //
   "name" => "dfh", // Le titre de notre produit
   "price" => strval(85.00), // Son prix, toujours au format chaîne de caractères
   "currency" => "EUR"
  ];
  $arr_temp_item2 = [
   "sku" => "b", // SKU (Stock Keeping Unit) correspond à la référence de notre item
   "quantity" => "9", //
   "name" => "dfh", // Le titre de notre produit
   "price" => strval(85.00), // Son prix, toujours au format chaîne de caractères
   "currency" => "EUR"
  ];
  $arr_temp_item3 = [
   "sku" => "b", // SKU (Stock Keeping Unit) correspond à la référence de notre item
   "quantity" => "9", //
   "name" => "dfh", // Le titre de notre produit
   "price" => strval(85.00), // Son prix, toujours au format chaîne de caractères
   "currency" => "EUR",
   
  ];
  $c = array_combine($arr_temp_item1, $arr_temp_item2);
  //$arr_temp_item2[sku]="grrgr";
  //array_push($arr_temp_item2, ("sku" => "dfdfdfdffdfe"));






       // prepare paypal data
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

      //
      // prepare basic payment details
      $payment_data['transactions'][0] = array(
                        'amount' => array(
                           'total' => '0.03',
                           'currency' => 'EUR',
                           'details' => array(
                                 'subtotal' => '0.02',
                                 'tax' => '0.00',
                                 'shipping' => '0.01'
                                 )
                           ),
                        'description' => 'This is the payment transaction description 1.'
                        );

      //
      // prepare individual items
      $payment_data['transactions'][0]['item_list']['items'][] = array(
                                    'quantity' => '1',
                                    'name' => 'Womens Large',
                                    'price' => '0.01',
                                    'currency' => 'USD',
                                    'sku' => '31Wf'
                                    );
      $payment_data['transactions'][0]['item_list']['items'][] = array(
                                    'quantity' => '1',
                                    'name' => 'Womens Medium',
                                    'price' => '0.01',
                                    'currency' => 'USD',
                                    'sku' => '31WfW'
                                    );

                                    print_r($payment_data);



