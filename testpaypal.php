<!DOCTYPE html>
<html lang="fr">
<!-- HEY ! COUCOU TOI PETIT CURIEUX-->

<head>
    <title>Celine Levrechon Gardiennage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gardiennage d'animaux sur Liverdun et environs">
    <meta name="author" content="Tommy Jeanbille, Celine Levrechon">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Librairie JQuery pour requete AJAX-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b0f7e6ecb6.js" crossorigin="anonymous"></script>

    <!-- Leaflet JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>


    <!-- 1. Importation de la SDK JavaScript PayPal 
    <script src="https://www.paypal.com/sdk/js?client-id=AeIBakz8rXg1v2EQmZUO9xOHKzInEDpKlqbvEsT0OwjqBaxo7itYQADAebBeCFNXsUgZUlke0wfry_pT"></script>-->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>


    <?php
        header('Content-Type: text/html; charset=UTF-8');

        require_once "config/Users.php";
        require_once "config/Produits.php";

        $produits = new Produits();

        $rows_produits = $produits->findAll();

    ?>



</head>

<!-- SVGs -->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="home" viewBox="0 0 16 16">
        <path fill="#C0C0C0"
            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z">
        </path>
    </symbol>
    <symbol id="speedometer2" viewBox="0 0 16 16">
        <path fill="#C0C0C0"
            d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z">
        </path>
        <path fill="#C0C0C0" fill-rule="evenodd"
            d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z">
        </path>
    </symbol>
    <symbol id="table" viewBox="0 0 16 16">
        <path fill="#C0C0C0"
            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z">
        </path>
    </symbol>
</svg>

<!-- Header -->
<?php include('header.php') ?>
<div class="row mb-1" style="position:relative;">
    <div class="header-triangle" style="position:absolute;bottom:-40px;transform: scale(-1, -1);"></div>
</div>
</br>


<body style="background-color: #F1F1ED;">

    <div class="container shadow-color-green p-4 mt-5 mb-5" style="position:relative;border-radius: 25px;">
        <div class="grand-titre">
            <h1>Test PayPal</h1>
            <div class="grand-titre-left"></div>
            <div class="grand-titre-right"></div>
        </div>


        <!--START GALLERY-->
        <div class="container d-flex justify-content-center mt-50 mb-50">

            <div class="row">

                <?php foreach ($rows_produits as $produit): ?>
                <div class="col-md-4 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <?php
                                    $directory = "img_produits/".$produit->ref;;
                                    $files = scandir ($directory);
                                    $firstFile = $directory ."/" . $files[2];
                                    
                                ?>
                                <span class="prod" style="cursor: pointer;" id=<?=$produit->ref;?>><img
                                        src=<?php echo $firstFile; ?> class="card-img img-fluid" width="96" height="450"
                                        alt=""></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light text-center">
                        <div class="mb-2">
                            <h6 class="font-weight-semibold mb-2">
                                <a href="#" class="text-default mb-2" data-abc="true"><?= $produit->nom; ?></a>
                            </h6>
                            <a href="#" class="text-muted" data-abc="true"><?= $produit->description; ?></a>
                        </div>
                        <h3 class="mb-0 font-weight-semibold"><?= $produit->prix; ?>€</h3>
                        <div>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                        </div>
                        <div class="text-muted mb-3">
                            3 avis
                        </div>
                        <!--<button type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i> Ajouter au
                            panier</button>-->
                    </div>
                </div>
                <?php endforeach; ?>


            </div>

        </div>
        <!--END GALLERY-->

        <!-- Le conteneur des boutons PayPal -->
        <div class="row mt-5" style="text-align:center">
            <div id="bouton-paypal"></div>
        </div>

        <div class="row mt-5" style="text-align:center">
            <button class="btn btn-info" onclick="location.href='TestBDD.php';"> <i class="fas fa-reply"></i>
                ALLER A L'EDITION</button>
        </div>



        <hr class="mb-5" />



    </div>


    </div>




</body>

</br>
<div class="row" style="position:relative;">
    <div class="header-triangle" style="position:absolute;bottom:0;"></div>
</div>

<!-- Footer -->
<?php include('footer.php') ?>





<script>
paypal.Button.render({
    env: 'sandbox', // Ou 'production',
    commit: true, // Affiche le bouton  "Payer maintenant"
    style: {
        color: 'gold', // ou 'blue', 'silver', 'black'
        size: 'responsive' // ou 'small', 'medium', 'large'
        // Autres options de style disponibles ici : https://developer.paypal.com/docs/integration/direct/express-checkout/integration-jsv4/customize-button/
    },
    payment: function() {
        // On crée une variable contenant le chemin vers notre script PHP côté serveur qui se chargera de créer le paiement
        var CREATE_URL = "paypal_create_payment.php?ref=";
        // On exécute notre requête pour créer le paiement
        return paypal.request.post(CREATE_URL).then(function(data) { // Notre script PHP renvoie un certain nombre d'informations en JSON (vous savez, grâce à notre echo json_encode(...) dans notre script PHP !) qui seront récupérées ici dans la variable "data"
                if (data.success) { // Si success est vrai (<=> 1), on peut renvoyer l'id du paiement généré par PayPal et stocké dans notre data.paypal_reponse (notre script en aura besoin pour poursuivre le processus de paiement)
                    return data.paypal_response.id;
                } 
                else { // Sinon, il y a eu une erreur quelque part. On affiche donc à l'utilisateur notre message d'erreur généré côté serveur et passé dans le paramètre data.msg, puis on retourne false, ce qui aura pour conséquence de stopper net le processus de paiement.
                    alert(data.msg);
                    return false;
                }
            });
    },
    onAuthorize: function(data, actions) {
        // On indique le chemin vers notre script PHP qui se chargera d'exécuter le paiement (appelé après approbation de l'utilisateur côté client).
        var EXECUTE_URL = 'paypal_execute_payment.php';
        // On met en place les données à envoyer à notre script côté serveur
        // Ici, c'est PayPal qui se charge de remplir le paramètre data avec les informations importantes :
        // - paymentID est l'id du paiement que nous avions précédemment demandé à PayPal de générer (côté serveur) et que nous avions ensuite retourné dans notre fonction "payment"
        // - payerID est l'id PayPal de notre client
        // Ce couple de données nous permettra, une fois envoyé côté serveur, d'exécuter effectivement le paiement (et donc de recevoir le montant du paiement sur notre compte PayPal).
        // Attention : ces données étant fournies par PayPal, leur nom ne peut pas être modifié ("paymentID" et "payerID").

        var data = {
            paymentID: data.paymentID,
            payerID: data.payerID
        };
        
        //var EXECUTE_URL = 'paypal_execute_payment.php?paymentID='+data.paymentID+'&payerID='+data.payerID;
        // On envoie la requête à notre script côté serveur
        return paypal.request.post(EXECUTE_URL,data).then(function(data) { // Notre script renverra une réponse (du JSON), à nouveau stockée dans le paramètre "data"
                if (data.success) { // Si le paiement a bien été validé, on peut par exemple rediriger l'utilisateur vers une nouvelle page, ou encore lui afficher un message indiquant que son paiement a bien été pris en compte, etc.
                    // Exemple : window.location.replace("Une url quelconque");
                    alert("Paiement approuvé ! Merci !");
                } else {
                    // Sinon, si "success" n'est pas vrai, cela signifie que l'exécution du paiement a échoué. On peut donc afficher notre message d'erreur créé côté serveur et stocké dans "data.msg".
                    //alert("meumeule");
                    alert(data.msg);
                }
            });
    },
    onCancel: function(data, actions) {
        alert("Paiement annulé : vous avez fermé la fenêtre de paiement.");
    },
    onError: function(err) {
        alert(err);
        alert("Paiement annulé : une erreur est survenue. Merci de bien vouloir réessayer ultérieurement.");
    }
}, '#bouton-paypal');



</script>






</html>