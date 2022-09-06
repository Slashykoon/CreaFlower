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
require_once "config/Livraison.php";




$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$paniers = new Paniers();
$produit_panier = new Produit_Panier();
$sessions = new Sessions();
$livraisons = new Livraisons();

$paiements = new Paiements();


/*$rows_user = $users->findAll();
$rows_produits = $produits->findAll();*/
$rows_paiements=$paiements->findAll();
?>


<body style="background-color:#ECECEC">


    <button class="btn mt-3 btn-info" onclick="location.href='index.php';"> <i class="fas fa-reply"></i>
        RETOUR A LA GALLERIE</button>


    <!--TABLEAU EDITION -->
    <h1 style="text-align:center;  margin-left: auto; margin-right: auto; margin-bottom:25px;">TABLEAU RECAPITULATIF DES
        PAIEMENTS / COMMANDES</h1>
    <table style=" margin-left: auto; margin-right: auto;">
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
            <td style="border: solid 2px;"><button class="btn btn-info btn_open_livraison"
                    id="<?= $paiement->produit; ?>"><i class="fas fa-marker"></i>Info Livraison</button></td>
            <td style="border: solid 2px;"><button class="btn btn-warning"><i class="fas fa-marker"></i>Info
                    Panier</button></td>
            <td style="border: solid 2px;"><button class="btn btn-danger"><i class="fas fa-marker"></i>Changer
                    status</button></td>

        </tr>
        <?php 
        } 
        ?>
    </table>


    <!-- Modal Livraison-->
    <div class="modal fade" id="ModalCenter_livraison" tabindex="-1" role="dialog"
        aria-labelledby="ModalCenterTitle_livraison" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle_livraison">Livraison associée</h5>
                </div>
                <div class="modal-body" id="ModalBody_livraison">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-12 content_type_choisi fw-bold">Pas de données</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 fw-bold">Coordonnées du point relais</div>
                            <div class="col-md-12 content_relais_name">Pas de données</div>
                            <div class="col-md-12 content_relais_adresse">Pas de données</div>
                            <div class="col-md-12 content_relais_cp">Pas de données</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 fw-bold">Coordonnées du clients</div>
                            <div class="col-md-3">Nom :</div>
                            <div class="col-md-9 content_nom_client">Pas de données</div>
                            <div class="col-md-3">Prenom :</div>
                            <div class="col-md-9 content_prenom_client">Pas de données</div>
                            <div class="col-md-3">Adresse :</div>
                            <div class="col-md-9 content_adresse_client">Pas de données</div>
                            <div class="col-md-3">Email :</div>
                            <div class="col-md-9 content_email_client">Pas de données</div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer" id="ModalFooter_livraison">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
   <!-- Modal Contenu panier-->
   <div class="modal fade" id="ModalCenter_panier" tabindex="-1" role="dialog"
        aria-labelledby="ModalCenterTitle_panier" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle_panier">Panier associé à la commande</h5>
                </div>
                <div class="modal-body" id="ModalBody_panier">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-12 content_type_choisi fw-bold">Pas de données</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 fw-bold">Coordonnées du point relais</div>
                            <div class="col-md-12 content_relais_name">Pas de données</div>
                            <div class="col-md-12 content_relais_adresse">Pas de données</div>
                            <div class="col-md-12 content_relais_cp">Pas de données</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 fw-bold">Coordonnées du clients</div>
                            <div class="col-md-3">Nom :</div>
                            <div class="col-md-9 content_nom_client">Pas de données</div>
                            <div class="col-md-3">Prenom :</div>
                            <div class="col-md-9 content_prenom_client">Pas de données</div>
                            <div class="col-md-3">Adresse :</div>
                            <div class="col-md-9 content_adresse_client">Pas de données</div>
                            <div class="col-md-3">Email :</div>
                            <div class="col-md-9 content_email_client">Pas de données</div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer" id="ModalFooter_panier">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
function ShowModalLivraison(type_choisi, nom_relais, adresse_relais, cp_relais, nom_domicile, prenom_domicile,
    adresse_domicile, cp_domicile, email) {

    $(".content_type_choisi").text(type_choisi);
    $(".content_relais_name").text(nom_relais);
    $(".content_relais_adresse").text(adresse_relais);
    $(".content_relais_cp").text(cp_relais);
    $(".content_nom_client").text(nom_domicile);
    $(".content_prenom_client").text(prenom_domicile);
    $(".content_adresse_client").text(adresse_domicile);
    $(".content_email_client").text(email);

    $('#ModalCenter_livraison').modal('show');
}
$('#ModalFooter_livraison .btn').click(function() {

    $('#ModalCenter_livraison').modal('hide');
});


//Action de suppression d'un article
$('.btn_open_livraison').click(function() {
    formData = {
        'fk_panier': $(this).attr('id')
    };
    console.log(formData);
    $.ajax({
        type: "POST",
        url: "Edit_View_Livraisons.php",
        dataType: 'json',
        data: formData,
        success: function(data, textStatus, jqXHR) {
            ShowModalLivraison(data.type_choisi, data.nom_relais, data.adresse_relais, data
                .cp_relais, data.nom_domicile, data.prenom_domicile, data.adresse_domicile, data
                .cp_domicile, data.email);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
});
</script>


</html>