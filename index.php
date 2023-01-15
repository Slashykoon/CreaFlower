<!DOCTYPE html>
<html lang="fr">

<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->
<!--     Site web by Tommy JEANBILLE     -->
<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->

<head>
    <title>Accueil - Vente de cadres décorés</title>
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

    <meta property="og:title" content="Accueil - Vente de cadres décorés">
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

<body style="background-color:#FDF8F5" >


<div class="global-page" style="position:relative;" >

<!--<img src="img/1553459034.svg" class="img-decoration-up" alt="Nature"   style="">
<img src="img/1553459034.svg" class="img-decoration-down" alt="Nature"   style="">-->
<!--<img src="img/fleur_rampante_2.png" class="img-decoration-middle-right" alt="Nature"   style="">-->

<h1 style="margin-top:15px;margin-bottom:25px;"><i class="fas fa-leaf"></i> Accueil de Créa’ Flower</h1>
    <div class="accueil-section" >
    
        <div class="accueil-section-first">
            <span class="p_margin">
                <h2>Bienvenue sur Créa’ Flower, votre boutique en ligne d’objets artisanaux en fleurs séchées !</h2>
                <p>Ici, vous trouverez différents objets tels que des porte-noms originaux pour votre mariage, un anniversaire ou le baptême de votre enfant, des cadres à personnaliser pour une naissance, ou encore des cadres avec photo pour déclarer votre amour. </br>
                Tous ces objets sont faits main en Lorraine de manière artisanale et avec le plus grand soin.</br> 
                Toutes les fleurs séchées sont 100% naturelles, je n’utilise aucune fleur artificielle.</br>
                </p>
            </span>
            <span>
                <img src="img/flower_accueil.jpg" alt="Nature" class="responsive-img" width="600" height="400">
            </span>
        </div>
        <div class="accueil-section-second">
                <span>
                    <img src="img/flower2_accueil.jpg" alt="Nature" class="responsive-img" width="600" height="400">
                </span>
                <span class="p_margin">
                    <h2>Qui suis-je en quelque mots </h2> <p>je m’appelle Céline et j’ai toujours adoré les fleurs. Leurs couleurs, leurs odeurs, leur fragilité, il n’y en a pas une pareille ! Et puis j’ai découvert avec bonheur qu’il était possible de préserver la beauté de certaines fleurs dans le temps grâce au procédé des fleurs séchées.</br>
                    Après plusieurs années à avoir exercé un autre métier, il était temps pour moi de faire quelque chose qui me passionnait et était concret.</p>
                    <p>C’est pourquoi je me suis lancée dans ce beau projet de création d’objets en fleurs séchées, mais avec mon petit truc en plus : la possibilité de personnaliser vos objets afin qu’ils vous ressemblent le plus possible.</br>
                    Mon plus grand souhait serait que mes objets fassent partis des événements marquants de votre vie, ou bien illumine votre quotidien !</br>
                    Je vous souhaite une excellente visite sur Créa’ Flower !</p>
                </span>
        </div>
    </div>
    <br/>
</div>

</body>

<!-- footer -->
<?php include('footer.php') ?>

<script>
</script>

</html>