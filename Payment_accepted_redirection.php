<!DOCTYPE html>
<html lang="fr">

<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->
<!--     Site web by Tommy JEANBILLE     -->
<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->

<head>
    <title>Confirmation - Vente de cadres décorés</title>
    <link rel="icon" type="image/x-icon" href="/img/creaflower-icon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Content-Language" content="fr">
    <meta name="Description" content="Vente de cadres décorés avec fleurs séchées">
    <meta name="Keywords" content="Vente de cadres décorés avec fleurs séchées">
    <meta name="Subject" content="Vente de cadres décorés avec fleurs séchées">
    <meta name="Copyright" content="Celine Levrechon">
    <meta name="Author" content="Celine Levrechon">
    <meta name="Publisher" content="Celine Levrechon">
    <meta name="Geography" content="Nancy, France,54000">
    <meta name="Category" content="decoration">

    <meta property="og:title" content="Confirmation - Vente de cadres décorés">
    <meta property="og:type" content="website">
    <meta property="og:updated_time" content="2022-12-01 10:21:17">
    <meta property="og:url" content="https://crea-flower.fr/">
    <meta name="robots" content="follow,index">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    require_once "Session_management.php";
    require_once "Cart_Number_Update.php";

?>




<!-- Header -->
<?php include('header.php') ?>

<body style="background-color:#FDF8F5">


<div class="global-page">
<h1 style="margin-top:15px;margin-bottom:25px;"><i class="fas fa-box-open"></i> Confirmation d'achat</h1>
    <div class="" style="display:flex;flex-direction:column;  align-items: center;justify-content: center;">
        <br/>
        <h1>Merci d'avoir passé commande chez Créa'Flower !</h2><br/>
        <h2>La commande sera traitée, puis mise à jour lors de l'expédition chez le transporteur</h2>
        <img src="img/Merci.jpg" alt="Nature" class="responsive-img-50" >
    </div>
</div>

</body>

<!-- footer -->
<?php include('footer.php') ?>

<script>
</script>

</html>