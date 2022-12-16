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
require_once "config/Specifications_Panier.php";




$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$paniers = new Paniers();
$produit_panier = new Produit_Panier();
$sessions = new Sessions();
$livraisons = new Livraisons();
$specification_panier = new Specifications_Panier();

$paiements = new Paiements();



require_once "Session_management.php";
//require_once "Cart_Number_Update.php"; //pas d'update car c'est une requete ajax

$text_retour="Un problème est servenu !";
$empty_txt="Pas de données trouvées";
$content="";
$fk_panier = $_POST['fk_panier'];


$rows_produits_panier = $produit_panier->findAllProduct_With_PanierID($fk_panier);

if(!empty($rows_produits_panier)){
  $text_retour="Livraison trouvée";

  //iteration des produits du panier
  foreach($rows_produits_panier as $produit_panier)
  {
      $produit_iter = $produits->findwithPK($produit_panier["fk_produit"]);
      //recupere les specification pour vérifier les options
      $rows_specifications_panier=$specification_panier->findAllOptionsOfProdPanier($produit_panier["pk_produit_panier"]);

      $content=$content."<h3 style='color:#DDAF94;'><b>".$produit_iter["nom"]."</b></h3>";
      $content=$content."<b>quantité : </b>".$produit_panier["quantity"]."<br/>";   

      //$opt_prix_add_total = 0.0; 
      //affiche la totalité des prix additionels et des noms des options
      if(!empty($rows_specifications_panier))
      {
          foreach ($rows_specifications_panier as $sp_panier)
          {
              $row_opt_panier = $options->TestIfOptionExist($sp_panier["fk_option"]); //=> changer nom testif todo
              $row_spec = $specifications->find($row_opt_panier["fk_sp"]); //recuperation du nom de la specification

              $content = $content."<b>".$row_spec["nom_specification"]." : </b>";

              if($row_spec["type"] == 0) //seul les option select on des prix
              {
                $content=$content.$row_opt_panier["nom_option"]."<br/>";
              }
              if($row_spec["type"] == 4 || $row_spec["type"] == 1) //saisi ou date
              {
                $content=$content.$sp_panier["txt_saisi"]."<br/>";
              }
              if($row_spec["type"] == 2) //image
              {
                $content=$content."<a href=".$sp_panier["txt_saisi"].">Cliquez pour agrandir</a><br/>";
              }
          }
      }
      $content=$content."<hr style='height:2px;border-width:0;color:gray;background-color:gray'>"; 
  }
}
else{
  $content=$empty_txt;
}
$retour = array(
  'text_ret' => $text_retour,
  'ret_content_txt' => $content
);

echo json_encode($retour);

exit();
?>