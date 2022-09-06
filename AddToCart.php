<?php
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
$paniers = new Paniers();
$produit_panier = new Produit_Panier();
$specification_panier = new Specifications_Panier();
$sessions = new Sessions();


require_once "Session_management.php";
//require_once "Cart_Number_Update.php"; //pas d'update car c'est une requete ajax

$text_retour="Un problème est servenu !";
//recupere les variables post
$Reference = $_POST['ref'];
$qte = $_POST['qte'];
$arr_opts = $_POST['arr_opt'];
$arr_opts_input = $_POST['arr_opt_input'];

//cherche le produit associé à la ref
$row_produit = $produits->find($Reference);
//error_log( print_r($row_produit, TRUE) );
if(!empty($row_produit))
{
  $row_prod_exist = $produit_panier->findOne_With_ProduitID($row_produit["pk_pr"],$row_session["fk_panier"]);

  if(!empty($row_prod_exist)){
    //update
    $ret_insert_prod_panier = $produit_panier->edit($row_produit["pk_pr"], $row_session["fk_panier"] , $qte);
    //error_log( print_r($ret_insert_prod_panier, TRUE) );
    $text_retour="L'article a été mis à jour dans le panier car il était déjà existant. Vous pouvez passer à l'achat ou continuer votre shopping.";
  }
  else {
    //add produit dans panier
    $ret_insert_prod_panier = $produit_panier->add($row_produit["pk_pr"], $row_session["fk_panier"], $qte);
    //add options select
    if(gettype($arr_opts)!= "string") // si il y a une specification alors array sinon string (défini dans requete ajax)
    {
      foreach ($arr_opts as $fk_opt)
      {
        $ret_exist=$options->TestIfOptionExist($fk_opt); //todo ameliroation : verifier si appartient bien au produit visé
        if(!empty($ret_exist)){
          //recupere l'id du prod panier et ajoute les options choisies
          $ret_insert_opt = $specification_panier->addChosenOption($ret_insert_prod_panier,$fk_opt,""); //no txt_saisi because it's select object
        }
        else{
          $text_retour="Erreur d'ajout : Les options selects renseignées sont incorrectes";
        }

      }
    }
    //add option input
    if(gettype($arr_opts_input)!= "string") 
    {
      foreach ($arr_opts_input as $arr_opt_input)
      {
        $ret_exist=$options->TestIfOptionExist($arr_opt_input[0]); //0=id option,1=valeur saisie
        if(!empty($ret_exist)){
          //recupere l'id du prod panier et ajoute les options choisies
          $ret_insert_opt = $specification_panier->addChosenOption($ret_insert_prod_panier,$arr_opt_input[0],$arr_opt_input[1]);
        }
        else{
          $text_retour="Erreur d'ajout : Les options input saisies sont incorrectes";
        }

      }
    }
    
    $text_retour="L'article a été ajouté au panier. Vous pouvez passer à l'achat ou continuer votre shopping.";
  }
}



$retour = array(
  'text_ret' => $text_retour
);

echo json_encode($retour);

exit();
?>