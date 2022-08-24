<?php
require_once "config/Produits.php";
require_once "config/Produit_Panier.php";

$produits = new Produits();
$produit_panier = new Produit_Panier();


$text_retour = "Un problème est servenu !";
$Reference = $_POST['ref'];

//cherche le produit associé à la ref du produit
$row_produit = $produits->find($Reference);
if(!empty($row_produit))
{
  $row_prod_exist = $produit_panier->DeleteOneFromPanier($row_produit["pk_pr"]);

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