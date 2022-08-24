<?php
/*Ce script necessite que la session ait été géré en amont*/

require_once "config/Produit_Panier.php";
$produit_panier = new Produit_Panier();


//récupération des produits du panier + quantité
$rows_produits_panier = $produit_panier->findAllProduct_With_PanierID($row_session["fk_panier"]);
$nb_panier = 0;

if($rows_produits_panier){
    foreach($rows_produits_panier as $prod_panier){
        $nb_panier++;
    }
}
$_SESSION['nb_articles_panier']=$nb_panier;
    echo "<input id='CartId' name='CartId' type='hidden' value='".$row_session["fk_panier"]."'>";
if($nb_panier <= 0){
    echo "<input id='DisablePaypalBtn' name='DisablePaypalBtn' type='hidden' value='1'>";
}
else{
    echo "<input id='DisablePaypalBtn' name='DisablePaypalBtn' type='hidden' value='0'>";
}

?>