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


    require_once "Session_management.php";
    require_once "Cart_Number_Update.php";
?>


<!-- Header -->
<?php include('header.php') ?>

<body style="background-color:#FDF8F5">


<div class="global-page" style="min-height:900px;">
<h1 style="margin-top:15px;margin-bottom:25px;"><i class="fas fa-file-contract "></i> Mentions légales</h1>
    <div class="cgv-mention-container">

        <h2>1 – Édition du site</h2>
        <p>En vertu de l’article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l’économie numérique, il est précisé aux utilisateurs du site internet https://www.crea-flower.fr l’identité des différents intervenants dans le cadre de sa réalisation et de son suivi :</p>
        <p>Propriétaire du site : Céline Levrechon
        Contact : contact@crea-flower.fr
        Adresse : 25 chemin du Mongambé, 54460 Aingeray 
        Identification de l’entreprise : Céline Levrechon, Entreprise Individuelle 
        n° SIRET : 91789930400013
        RM : 917 899 304 RM 54
        Hébergeur : Hostinger.com</p>

        <p>Délégué à la protection des données : Tommy JEANBILLE – tommy.jeanbille@gmail.com
        Crédits photos : Céline Levrechon</p>

        <h2>2 – Propriété intellectuelle et contrefaçons.</h2>
        <p>Céline Levrechon est propriétaire des droits de propriété intellectuelle et détient les droits d’usage sur tous les éléments accessibles sur le site internet, notamment les textes, images, graphismes, logos, vidéos, architecture, icônes et sons.
        Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de Céline Levrechon.
        Toute exploitation non autorisée du site ou de l’un quelconque des éléments qu’il contient sera considérée comme constitutive d’une contrefaçon et poursuivie conformément aux dispositions des articles L.335-2 et suivants du Code de Propriété Intellectuelle.</p>
        <h2>3 – Limitations de responsabilité.</h2>
        <p>Céline Levrechon ne pourra être tenue pour responsable des dommages directs et indirects causés au matériel de l’utilisateur, lors de l’accès au site https://www.crea-flower.fr.
        Céline Levrechon décline toute responsabilité quant à l’utilisation qui pourrait être faite des informations et contenus présents sur https://www.crea-flower.fr
        Céline Levrechon s’engage à sécuriser au mieux le site https://www.crea-flower.fr, cependant sa responsabilité ne pourra être mise en cause si des données indésirables sont importées et installées sur son site à son insu.
        Des espaces interactifs (espace contact) sont à la disposition des utilisateurs.
        Céline Levrechon se réserve également la possibilité de mettre en cause la responsabilité civile et/ou pénale de l’utilisateur, notamment en cas de message à caractère raciste, injurieux, diffamant, ou pornographique, quel que soit le support utilisé (texte, photographie …).</p>
        <h2>4 – CNIL et gestion des données personnelles.</h2>
        <p>Conformément aux dispositions de la loi 78-17 du 6 janvier 1978 modifiée, l’utilisateur du site https://www.crea-flower.fr dispose d’un droit d’accès, de modification et de suppression des informations collectées.
        Pour exercer ce droit, envoyez un message à notre Délégué à la Protection des Données : Tommy JEANBILLE - tommy.jeanbille@gmail.com</p>
        <h2>5 – Liens hypertextes et cookies</h2>
        <p>Le site https://www.crea-flower.fr contient des liens hypertextes vers d’autres sites et dégage toute responsabilité à propos de ces liens externes ou des liens créés par d’autres sites vers https://www.crea-flower.fr
        Un « cookie » est un fichier stocké sur votre ordinateur qui sauvegarde des informations (variables) relatives à la navigation d’un utilisateur sur un site.
        Vous avez la possibilité d’accepter ou de refuser les cookies en modifiant les paramètres de votre navigateur. Aucun cookie ne sera déposé sans votre consentement.</p>
        <h2>6 – Droit applicable et attribution de juridiction.</h2>
        <p>Tout litige en relation avec l’utilisation du site https://www.crea-flower.fr est soumis au droit français. En dehors des cas où la loi ne le permet pas, il est fait attribution exclusive de juridiction aux tribunaux compétents de Nancy.</p>
        </br>

    </div>
</div>

</body>

<!-- footer -->
<?php include('footer.php') ?>

<script>
</script>

</html>