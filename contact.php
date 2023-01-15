<!DOCTYPE html>
<html lang="fr">

<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->
<!--     Site web by Tommy JEANBILLE     -->
<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->

<head>
    <title>Contacte - Vente de cadres décorés</title>
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

    <meta property="og:title" content="Contacte - Vente de cadres décorés">
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


<div class="global-page" style="position:relative;" >

    <!--<img src="img/1553459034.svg" class="img-decoration-up" alt="Nature"   style="">
    <img src="img/1553459034.svg" class="img-decoration-down" alt="Nature"   style="">-->
    
    <h1 style="margin-top:15px;margin-bottom:25px;"><i class="fas fa-mail-bulk"></i> Contactez-moi</h1>
    <div class="" style="display:flex; flex-direction:column; align-items: center;justify-content: center;">

            <p><i class="fas fa-calendar-alt fa-lg"></i> Une réponse vous sera apportée sous 48h ouvrées</p><br/>
            
            <div class="container-contact">

            <form id="contact-form" class="form_section_layout" name="contact-form" action="contact.php" method="POST" onsubmit="return false">

                <form id="contact-form" action="/form/submit" method="POST">
                    <label for="input_prenom">Prenom</label>
                    <input type="text" id="input_prenom" name="name" placeholder="Entrez votre prenom">
                    <label for="input_nom">Nom</label>
                    <input type="text" id="input_nom" name="surname" placeholder="Entrez votre nom">
                    <label for="input_email">Adresse mail</label>
                    <input type="text" id="input_email" name="email" placeholder="Entrez votre e-mail">
                    <label for="ci">Motif</label>
                    <select id="input_raison" name="raison">
                        <option value="Question/Réclamation sur un article">Question/Réclamation sur un article</option>
                        <option value="Déclarer un bug">Déclarer un bug</option>
                        <option value="Demande spécifique">Demande spécifique</option>
                    </select>
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Entrez votre message" style="height:200px"></textarea>
                    <input type="submit" onclick="ValidateForm()" value="Envoyer">
                    <div id="status" style="text-align:center;"></div>
                </form>
            </div>

    </div>
    <br/>
</div>

</body>

<!-- footer -->
<?php include('footer.php') ?>

<script>
function ValidateForm() {
    document.getElementById('status').innerHTML = "Envoi en cours...";

    formData = {
        'prenom': $('input[name=name]').val(),
        'name': $('input[name=surname]').val(),
        'raison': $('select[name=raison]').val(),
        'email': $('input[name=email]').val(),
        'message': $('textarea[name=message]').val()
    };

    $.ajax({
        type: "POST",
        url: "send_mail_contact.php",
        dataType: 'json',
        data: formData,
        success: function(data, textStatus, jqXHR) {

            $('#status').text(data.message);
            if (data.code) //Si mail envoyé alors reset
                $('#contact-form').closest('form').find("input[type=text], textarea").val("");
                //$('#SuccessMessage').removeClass("d-none");;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#status').text(jqXHR);
        }
    });
}
</script>

</html>