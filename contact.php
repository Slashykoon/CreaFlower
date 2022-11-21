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


<div class="global-page">
<h1 style="margin-top:15px;margin-bottom:25px;"><i class="fas fa-store"></i> Contactez-moi</h1>
    <div class="" style="min-height:800px;display:flex; flex-direction:column; align-items: center;justify-content: center;">

            <p><i class="fas fa-calendar-alt fa-lg"></i> Une réponse vous sera apportée sous 48h ouvrées</p><br/>
            
            <div class="container-contact">
                <form action="/form/submit" method="POST">
                    <label for="input_prenom">Prenom</label>
                    <input type="text" id="input_prenom" name="name" placeholder="Entrez votre prenom">
                    <label for="input_nom">Nom</label>
                    <input type="text" id="input_nom" name="surname" placeholder="Entrez votre nom">
                    <label for="input_email">Adresse mail</label>
                    <input type="text" id="input_email" name="email" placeholder="Entrez votre e-mail">
                    <label for="ci">Motif</label>
                    <select id="input_raison" name="raison">
                        <option value="1">Question sur un article</option>
                        <option value="2">Envoi de photos</option>
                        <option value="3">Question générale</option>
                    </select>
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Entrez votre message" style="height:200px"></textarea>
                    <input type="submit" value="Envoyer">
                </form>
            </div>
    </div>
</div>

</body>

<!-- footer -->
<?php include('footer.php') ?>

<script>
</script>

</html>