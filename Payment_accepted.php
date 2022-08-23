<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Vente de cadres décorés</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vente de cadres de décoration">
    <meta name="author" content="Tommy Jeanbille, Celine Levrechon">
    <link href="css/style.css" rel="stylesheet">
    <!-- Librairie JQuery pour requete AJAX-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css"
        integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b0f7e6ecb6.js" crossorigin="anonymous"></script>
</head>


<?php
    require_once "config/Users.php";
    require_once "config/Produits.php";
    require_once "config/Options.php";
    require_once "config/Specifications.php";
    require_once "config/Rubriques.php";
    require_once "config/Paiements.php";
    require_once "config/Paniers.php";
    require_once "config/Produit_Panier.php";
    require_once "config/Sessions.php";

    $users = new Users();
    $produits = new Produits();
    $options = new Options();
    $specifications = new Specifications();
    $paiements = new Paiements();
    $paniers = new Paniers();
    $produit_panier = new Produit_Panier();
    $rubriques = new Rubriques();
    $sessions = new Sessions();

?>

<?php
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
//récupération des produits du panier + quantité
$rows_produits_panier = $produit_panier->findAllProduct_With_PanierID($row_session["fk_panier"]);
$nb_panier=0;
if($rows_produits_panier){
    foreach($rows_produits_panier as $prod_panier){
        $nb_panier++;
    }
}
$_SESSION['nb_articles_panier']=$nb_panier;

?>


<!-- Header -->
<?php include('header.php') ?>

<body style="background-color:#FDF8F5">


<div class="global-page">
<h1 style="margin-top:15px;margin-bottom:25px;"><i class="fas fa-store"></i> Accueil</h1>
    <div class="" style="min-height:800px;display:flex;flex-direction:column;  align-items: center;justify-content: center;">
        <h1>Merci d'avoir passé commande chez Créa'Flower !</h2><br/>
        <h3>La commande sera traitée, puis mise à jour lors de l'expédition chez le transporteur</h3>
    </div>
</div>

</body>

<!-- footer -->
<?php include('footer.php') ?>

<script>
</script>

</html>