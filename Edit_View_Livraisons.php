<?php
require_once "config/Livraison.php";
require_once "config/Users.php";
require_once "config/Produits.php";
require_once "config/Options.php";
require_once "config/Specifications.php";
require_once "config/Paiements.php";
require_once "config/Paniers.php";
require_once "config/Produit_Panier.php";
require_once "config/Sessions.php";





$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$paniers = new Paniers();
$produit_panier = new Produit_Panier();
$sessions = new Sessions();
$livraisons = new Livraisons();

$paiements = new Paiements();



require_once "Session_management.php";
//require_once "Cart_Number_Update.php"; //pas d'update car c'est une requete ajax

$text_retour="Un problème est servenu !";
$type_choisi="";
$empty_txt="Pas de données trouvées";

$fk_panier = $_POST['fk_panier'];


$row_livraison = $livraisons->findwithPKPanier($fk_panier);

if(!empty($row_livraison)){
  $text_retour="Livraison trouvée";
  if( $row_livraison['type_choisi'] == "1")
  {
    $type_choisi="Livraison en point relais colis";
  }
  else{
    $type_choisi="Livraison à domicile";
  }
  $retour = array(
    'text_ret' => $text_retour,
    'type_choisi' => $type_choisi,
    'nom_relais' =>  $row_livraison['nom_relais'],
    'adresse_relais' =>  $row_livraison['adresse_relais'],
    'cp_relais' =>  $row_livraison['cp_relais'],
    'nom_domicile' =>  $row_livraison['nom_domicile'],
    'prenom_domicile' =>  $row_livraison['prenom_domicile'],
    'adresse_domicile' =>  $row_livraison['adresse_domicile'],
    'cp_domicile' =>  $row_livraison['cp_domicile'],
    'email' =>  $row_livraison['email']
  );
}
else{
  $text_retour="Pas de livraison associée à ce panier";
  $retour = array(
    'text_ret' => $text_retour,
    'type_choisi' => $empty_txt,
    'nom_relais' =>  $empty_txt,
    'adresse_relais' =>  $empty_txt,
    'cp_relais' =>  $empty_txt,
    'nom_domicile' =>  $empty_txt,
    'prenom_domicile' =>  $empty_txt,
    'adresse_domicile' => $empty_txt,
    'cp_domicile' => $empty_txt,
    'email' =>  $empty_txt
  );
}



echo json_encode($retour);

exit();
?>