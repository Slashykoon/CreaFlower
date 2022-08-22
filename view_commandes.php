<!DOCTYPE html>
<html lang="fr">
<!-- HEY ! COUCOU TOI PETIT CURIEUX-->

<head>
    <title>Celine Levrechon Gardiennage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gardiennage d'animaux sur Liverdun et environs">
    <meta name="author" content="Tommy Jeanbille, Celine Levrechon">
    <!--<link href="css/style.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
require_once "config/Paiements.php";
require_once "config/Paniers.php";
require_once "config/Produit_Panier.php";
require_once "config/Sessions.php";


$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$paniers = new Paniers();
$produit_panier = new Produit_Panier();
$sessions = new Sessions();

$paiements = new Paiements();


/*$rows_user = $users->findAll();
$rows_produits = $produits->findAll();*/
$rows_paiements=$paiements->findAll();
?>


<body style="background-color:#ECECEC">
    <div class="mb-2">
        <button class="btn mt-3 btn-info" onclick="location.href='index.php';"> <i class="fas fa-reply"></i>
            RETOUR A LA GALLERIE</button>
    </div>


    <!--TABLEAU EDITION -->
    <h1 style="text-align:center;">TABLEAU RECAPITULATIF DES PAIEMENTS / COMMANDES</h1>
    <table>
        <tr style="border: solid 2px;text-align:center;">
            <th>Ref panier</th>
            <th>Id paiement</th>
            <th>Status paiement</th>
            <th>Montant transaction</th>
            <th>Currency transaction</th>
            <th>Date transaction</th>
            <th>Email client</th>
            <th>Numéro facture</th>
        </tr>
        <?php 
            foreach ($rows_paiements as $paiement)
            {
        ?>
        <tr style="border: solid 2px;font-size:1.1em;">
            <td style="border: solid 2px;padding:4px;"><?= $paiement->produit; ?></td>
            <td style="border: solid 2px;padding:4px;"><?= $paiement->payment_id; ?></td>
            <td style="border: solid 2px;padding:4px;"><?= $paiement->payment_status; ?></td>
            <td style="border: solid 2px;padding:4px;"><?= $paiement->payment_amount; ?>€</td>
            <td style="border: solid 2px;padding:4px;"><?= $paiement->payment_currency; ?></td>
            <td style="border: solid 2px;padding:4px;"><?= $paiement->payment_date; ?></td>
            <td style="border: solid 2px;padding:4px;"><?= $paiement->payer_email; ?></td>
            <td style="border: solid 2px;padding:4px;"><?= "FAC_".$paiement->num_facture; ?></td>
            <td style="border: solid 2px;"><button class="btn btn-warning"
                    onclick="ActionOnProduct(<?= $paiement->produit; ?>,2)"><i class="fas fa-marker"></i>Changer status</button></td>

        </tr>

        <?php } ?>
    </table>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Resultat de l'action</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="exampleModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    </br>
    </br>
    </br>

</body>

<script>

</script>


</html>