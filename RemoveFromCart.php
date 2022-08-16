<?php
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


session_start();
//Verif si une session est ouverte sur cet id
$row_session = $sessions->find(session_id());
if(empty($row_session)){
    $ret_id_session=$sessions->add(session_id(),"");
    $ret_id_panier=$paniers->add("Temp_".session_id());
    $ret_session_updt=$sessions->edit(session_id(),$ret_id_panier);
    //recherche a nouveau pour recuperer la structure
    $row_session = $sessions->find(session_id());
}

$text_retour="Un problème est servenu !";
//recupere les variables post
$Reference = $_POST['ref'];

//cherche le produit associé à la ref
$row_produit = $produits->find($Reference);
if(!empty($row_produit))
{
  $row_prod_exist = $produit_panier->DeleteOneFromPanier($row_produit["pk_pr"]);
  //error_log( print_r($row_produit["pk_pr"], TRUE) );

  if(!empty($row_prod_exist)){
    $text_retour="Produit supprimé correctement du panier.";
  }
  else {
    $text_retour="Une erreur est survenue pendant la suppression";
  }
}



$retour = array(
  'text_ret' => strval($text_retour)
);

echo json_encode($retour);

exit();
?>