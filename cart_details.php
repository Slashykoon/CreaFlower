<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Vente de cadres décorés</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vente de cadres de décoration">
    <meta name="author" content="Tommy Jeanbille, Celine Levrechon">
    <link href="css/style.css" rel="stylesheet">
    <!-- Librairie JQuery pour requete AJAX
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <!-- Just for datepicker
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>-->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="i18n/datepicker-fr.js"></script>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css"
        integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b0f7e6ecb6.js" crossorigin="anonymous"></script>

    <!-- Importation de la SDK JavaScript PayPal -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
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
require_once "config/Specifications_Panier.php";

$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$paniers = new Paniers();
$produit_panier = new Produit_Panier();
$specification_panier = new Specifications_Panier();
$sessions = new Sessions();
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
$nb_panier = 0;

if($rows_produits_panier){
    foreach($rows_produits_panier as $prod_panier){
        $nb_panier++;
    }
}
$_SESSION['nb_articles_panier']=$nb_panier;
    echo "<input id='CartId' name='CartId' type='hidden' value='".$row_session["fk_panier"]."'>";
if($nb_panier<=0){
    echo "<input id='DisablePaypalBtn' name='DisablePaypalBtn' type='hidden' value='1'>";
}
else{
    echo "<input id='DisablePaypalBtn' name='DisablePaypalBtn' type='hidden' value='0'>";
}


?>


<!-- Header -->
<?php include('header.php') ?>


<body style="background-color:#FDF8F5">
    <div class="global-page">
        <h1 style="margin-top:15px;margin-bottom:25px;"><i class="fas fa-tags"></i> Détails du panier</h1>
        <!--grid 2 col-->
        <div class="cart-products-grid">
            <!--flex 2 cols-->
            <div class="cart-products-flex">
                <?php           
                //on trouve le produit dans le panier
                if(!empty($rows_produits_panier))
                {
                    ?>
                    <div class="cart-product-flex">
                        <div style="padding-right:25px;">Produit</div>
                        <div style="padding-right:25px;">Quantité</div>
                        <div style="padding-right:25px;">Prix</div>
                    </div>
                    <?php
                    $sum_opt_prix_total=0.0;
                    //iteration des produits du panier
                    foreach($rows_produits_panier as $prod_panier)
                    {
                        $produit_iter = $produits->findwithPK($prod_panier["fk_produit"]);
                        //recupere les specification pour vérifier les options
                        $rows_specifications_panier=$specification_panier->findAllOptionsOfProdPanier($prod_panier["pk_produit_panier"]);

                        //Recuperation de la première image de présentation
                        $directory = "img_produits/".$produit_iter["ref"];
                        $files = scandir ($directory);
                        $firstFile = $directory ."/" . $files[2];
                    ?>
                    <div class="cart-product-flex">
                        <div>
                            <img src=<?php echo $firstFile;?> style="height:180px;width:180px;" alt="...">
                        </div>
                        <div class="cart-product-details-flex">
                            <p>Nom : <?php echo $produit_iter['nom'];?></p>
                            <?php
                            $opt_prix_add_total=0.0;
                            
                            //affiche la totalité des prix additionels et des noms des options
                                if(!empty($rows_specifications_panier))
                                {
                                    
                                    foreach ($rows_specifications_panier as $sp_panier)
                                    {
                                        
                                        $row_opt_panier=$options->TestIfOptionExist($sp_panier["fk_option"]); //=> changer nom testif todo
                                        $temp_prix_add=(( floatval($row_opt_panier["prix_add"]) > 0.0) ? " : +".strval($row_opt_panier["prix_add"])."€"  : "");
                                        print_r("<p>".$row_opt_panier["nom_option"].$temp_prix_add."</p>");
                                        $opt_prix_add_total = ($opt_prix_add_total + floatval(($row_opt_panier["prix_add"]) * floatval(($prod_panier["quantity"]) )));

                                    }
                                    $sum_opt_prix_total=$sum_opt_prix_total+$opt_prix_add_total;
                                    //print_r($sum_opt_prix_total);
                                }
                            ?>
                        </div>
                        <div class="" style="  padding-left:20px;padding-right:20px;">
                            <p>Quantité : <?php echo $prod_panier["quantity"];?></p>
                        </div>
                        <div class="" style="  padding-left:20px;padding-right:20px;">
                            <p>Prix : 
                                <?php 
                                    $temp_total= floatval(($produit_iter["prix"]) * floatval(($prod_panier["quantity"]))) + $opt_prix_add_total;
                                    echo ($temp_total."€") ;
                                ?> 
                                </p>
                        </div>
                        <div class="" style=" padding-left:20px;padding-right:20px;">
                            <button id="<?php echo $produit_iter["ref"];?>" class="btn_supp_prod" style="background-color:#E8CEBF;	cursor: pointer;user-select: none;border: 1px solid black;">✖</button>
                        </div>
                    </div>
                <?php } 
                }
                else{
                    print_r("<h3>Le panier est vide</h3>");
                }
                ?>
            </div>

            <?php           
                //on trouve le produit dans le panier
                if(!empty($rows_produits_panier))
                {
                    //calcul des totaux
                    $sous_total=0;
                    if(!empty($rows_produits_panier))
                    {
                        foreach($rows_produits_panier as $prod_panier)
                        {
                            $_produit = $produits->findwithPK($prod_panier["fk_produit"]);
                            if(!empty($_produit))
                            {
                                //calcul du sous total 
                                $sous_total = $sous_total + (float)$_produit["prix"]*(float)$prod_panier["quantity"] ;
                                $livraison = 5.0;
                                
                            }
                        }   
                        //calcul du sous total avec options prise en comtpes
                        $sous_total = $sous_total + $sum_opt_prix_total;
                        $total = $sous_total + $livraison ;
                    }
            ?>
            <div class="cart-product-checkout-details">

                <div>
                    <p>Indiquez la date de l'evenement (si c'est le cas) :</p>
                    <p>Date: <input type="text" id="datepicker_livraison"></p>
                </div>
                <div>
                    <p>Sous total : <?php echo $sous_total; ?> €</p>
                </div>
                <div>
                    <p>Livraison : <?php echo $livraison; ?> €</p>
                </div>
                <div>
                    <p>Total : <?php echo $total; ?> €</p>
                </div>
                <div>
                    <p>Il n'est pas obligatoire de posséder un compte Paypal pour commander.</p>
                </div>
                
                <!--Bouton Paypal-->
                <div id="bouton-paypal"></div>
            </div>
            <?php } ?>
        </div>
    </div>
    
</body>


<!-- footer -->
<?php include('footer.php') ?>


<!--Modal cachée (Achat)-->
<div class="modal">
    <div class="modal-dialog">
        <button class="close">✖</button>
        <div class="modal-content">
            <img src="img/shopping-cart.gif" alt="Credit : Freepik - flaticon.com" />
            <p class="message">Message</p>
            <button onclick="RedirectToCart()" class="accept aftersupp">OK</button>
            <button onclick="RedirectToGallerie()" class="accept afterpayment">Retour à la gallerie</button>
        </div>
    </div>
</div>



<!--scripts customisés-->
<script>


  $( function() {
    $( "#datepicker_livraison" ).datepicker({ minDate: +20, maxDate: "+12M",regional:"fr" });
  } );

//Modal
function ShowModalAfterRemove(textToAdd) {
    $(".modal").css("display", "block");
    $(".afterpayment").css("display", "none");
    $(".aftersupp").css("display", "block");
    $(".message").text(textToAdd);
}
function ShowModalAfterPayment(textToAdd) {
    $(".modal").css("display", "block");
    $(".aftersupp").css("display", "none");
    $(".afterpayment").css("display", "block");
    $(".message").text(textToAdd);
}

$('.close').click(function() {
    $(".modal").css("display", "none");
});

$('.btn_supp_prod').click(function() {
   
    formData = {
        'ref': $(this).attr('id')
    };

    $.ajax({
        type: "POST",
        url: "RemoveFromCart.php",
        dataType: 'json',
        data: formData,
        success: function(data, textStatus, jqXHR) {
            
            ShowModalAfterRemove(data.text_ret);
            
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

});

function RedirectToCart() {
    window.location = 'cart_details.php';
}

if ($('input[name=DisablePaypalBtn]').val() == 0) //evite de charger le btn pour eviter les soucis si aucun article
{
paypal.Button.render({
    env: 'sandbox', // Ou 'production',
    commit: true, // Affiche le bouton  "Payer maintenant"
    style: {
        color: 'gold', // ou 'blue', 'silver', 'black'
        size: 'responsive', // ou 'small', 'medium', 'large'
        layout: 'vertical',
        shape:  'rect'
    },
    payment: function() {
        // créer le paiement
        //var CREATE_URL = 'paypal_create_payment.php?ref=8ekl6a8kpk706pmpi00b8hm0vj';
        var CREATE_URL = 'paypal_create_payment.php?ref='+ $('input[name=CartId]').val();
        // On exécute notre requête pour créer le paiement
        return paypal.request.post(CREATE_URL).then(function(data) { //JSON data
                if (data.success) { // Si success est vrai (<=> 1), on peut renvoyer l'id du paiement généré par PayPal
                    return data.paypal_response.id;
                } 
                else { // Sinon, il y a eu une erreur quelque part. retourne false, pour stopper net le processus de paiement.
                    alert("paypal_create_payment response :"+ data.msg);
                    return false;
                }
            });
    },
    onAuthorize: function(data, actions) {
        // On indique le chemin vers notre script PHP qui se chargera d'exécuter le paiement (appelé après approbation de l'utilisateur côté client).
        var EXECUTE_URL = 'paypal_execute_payment.php';
        //  PayPal se charge de remplir le paramètre data :
        // - paymentID est l'id du paiement qu'on a demandé à PayPal de générer (côté serveur) 
        // - payerID est l'id PayPal du client
        var data = {
            paymentID: data.paymentID,
            payerID: data.payerID
        };
        //envoie de la requete
        return paypal.request.post(EXECUTE_URL,data).then(function(data) { //JSON data retour serveur
                if (data.success) { // Si le paiement a bien été validé, on peut rediriger l'utilisateur vers une nouvelle page, afficher un message indiquant que son paiement a bien été pris en compte.
                    // Exemple : window.location.replace("Une url");
                    //alert("Paiement approuvé ! Merci !");
                    ShowModalAfterPayment("Votre commande à été correctement effectué. Nous vous remercions pour votre achat.");
                } else {
                    //exécution du paiement a échoué.
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

}

</script>

</html>