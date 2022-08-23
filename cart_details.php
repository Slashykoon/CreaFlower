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
    <!-- Importation widget Relais colis -->
    <!--<script type="text/javascript" src="https://service.relaiscolis.com/WidgetRC/scripts/widget.builder.js"></script>-->
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
if($nb_panier <= 0){
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
                    <div class="cart-product-flex-title-tab">
                        <div class="title-tab-name">Produit</div>
                        <div class="title-tab-qte">Quantité</div>
                        <div class="title-tab-price">Prix</div> 
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
                        <div class="cart-product-details-flex" style="">

                            <p style="font-weight: bold;margin-top:2px; "><?php echo $produit_iter['nom'];?></p>
                            <?php
                            $opt_prix_add_total=0.0;
                            
                            //affiche la totalité des prix additionels et des noms des options
                                if(!empty($rows_specifications_panier))
                                {
                                    
                                    foreach ($rows_specifications_panier as $sp_panier)
                                    {
                                        

                                        $row_opt_panier = $options->TestIfOptionExist($sp_panier["fk_option"]); //=> changer nom testif todo
                                        $row_spec = $specifications->find($row_opt_panier["fk_sp"]); //recuperation du nom de la specification
                                        print_r("<p style='margin-top:5px;margin-bottom:2px;'>: ".$row_spec["nom_specification"]."</p>");
                                        $temp_prix_add = (( floatval($row_opt_panier["prix_add"]) > 0.0) ? " (+".strval($row_opt_panier["prix_add"])."€)"  : "");
                                        print_r("<ul class='fa-ul' style='margin-top:0px;margin-bottom:0px;'>");
                                        print_r("<li><span class='fa-li'><i class='fas fa-broom fa-sm'></i></span>"); 
                                        
                                        print_r("<p style='margin-top:0px;margin-bottom:0px;' >".$row_opt_panier["nom_option"].$temp_prix_add."</p>");
                                        print_r("</li>");
                                        print_r("</ul>");
                                        $opt_prix_add_total = ($opt_prix_add_total + floatval(($row_opt_panier["prix_add"]) * floatval(($prod_panier["quantity"]) )));
                                        
                                    }
                                    $sum_opt_prix_total=$sum_opt_prix_total+$opt_prix_add_total;
                                    //print_r($sum_opt_prix_total);
                                }
                            ?>
                        </div>
                        <div class="cart_product-details-qte-price-erase">
                            <div class="cart-product-details-qte" >
                                <p><?php echo $prod_panier["quantity"];?></p>
                            </div>
                            <div class="cart-product-details-prix" >
                                <p> 
                                    <?php 
                                        $temp_total= floatval(($produit_iter["prix"]) * floatval(($prod_panier["quantity"]))) + $opt_prix_add_total;
                                        echo (number_format((float)$temp_total, 2, '.', '')."€") ;
                                    ?> 
                                    </p>
                            </div>
                            <div class="" style="">
                                <button id="<?php echo $produit_iter["ref"];?>" class="btn_supp_prod" style="background-color:#E8CEBF;	cursor: pointer;user-select: none;border: 1px solid black;"><i class='fas fa-trash-alt'></i></button>
                            </div>
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

                <div id="relais-colis-widget-container">Choisissez votre relais colis :

                </div>
                <div class="section_relais_select" style="display:none;">
                    <p class="name_relais"></p>
                    <p class="address_relais"></p>
                    <p class="city_relais"></p>
                </div>

                <div>
                    <p>Indiquez la date de l'evenement (marriage,baptême,etc..) :</p>
                    <p><input style="width:100%;height:25px;" type="text" id="datepicker_livraison" onkeydown="event.preventDefault()"></p>
                </div>

                <form>
                <ul class="wrapper">
                    <li class="form-row">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name">
                    </li>
                    <li class="form-row">
                    <label for="city">Adresse</label>
                    <input type="text" id="city" name="city">
                    </li>
                    <li class="form-row">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                    </li>
                </ul>
                </form>

                <div class="cart-details-totaux-section">
                        <p style="margin-top:5px;margin-bottom:5px;">Sous total : <?php echo $sous_total; ?> €</p>  
                        <p style="margin-top:5px;margin-bottom:5px;">Livraison : <?php echo $livraison; ?> €</p>
                        <p style="margin-top:5px;margin-bottom:5px;">Total : <?php echo $total; ?> €</p>        
                </div>
                <div>
                    <p style="margin-bottom:5px;">Il n'est pas obligatoire de posséder un compte Paypal pour commander.</p>
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




<script>
    function generateHtmlButton(callback) 
    {
    var myButton = document.createElement("div");
    
    if (location.protocol == "https:") {
        //myButton.innerHTML = "<img src='https://service.relaiscolis.com/widgetRC/ImagesRelaisColis/rco.png'/>";
        myButton.innerHTML = "<img style=' animation-name:displaceContent;animation-duration:1.5s;animation-delay:0.5s;animation-iteration-count :2;animation-fill-mode:forwards' src='img/icon_livraison_sm.png'/>";
    } else {
        myButton.innerHTML = "<img style=' animation-name:displaceContent;animation-duration:1.5s;animation-delay:0.5s;animation-iteration-count :2;animation-fill-mode:forwards' src='img/icon_livraison_sm.png'/>";
        //myButton.innerHTML = "<img src='http://service.relaiscolis.com/widgetRC/ImagesRelaisColis/rco.png'/>";
    }



    myButton.setAttribute('style', 'cursor: pointer; min-width: 80px;background-color: #DDAF94;border-style: solid;margin-top:8px;display:flex;flex-direction:column;align-items:center;justify-content:center; ');
    myButton.addEventListener("click", function (e) {
        displayPopUpRC();
        return false;
    }, false);

    //-------- Add iframe Listner
    window.addEventListener("message", receiveMessage, false);
    function receiveMessage(event)
    {
        //console.log("Received data (iframe) - src : ", event.data);
        if((event.data).hasOwnProperty("id")  && (event.data).hasOwnProperty("name") )
        {

            $("#overlay").css({"display": "none"});
            $("#myIframe").css({"display": "none"});
            callback(event.data);
        }

        if (event.origin !== "http://relaiscolis.com:8080")
            //console.log('origine ')
            return;
    }
    $("#relais-colis-widget-container").append(myButton);
}

function createIframeMap(callback) 
{
    var iframeDiv = document.createElement("iframe");
    //iframeDiv.setAttribute('id','popupWidget');

    iframeDiv.setAttribute('style', 'border:0; position:absolute; z-index:1000; left: calc(50% - 210px); top:350px ; background-color: #FDF8F5; animation: anim 1.3s ease-in-out;');
    
    iframeDiv.setAttribute('width', '420');
    iframeDiv.setAttribute('height', '590');
    iframeDiv.setAttribute('id', 'myIframe');

    if (location.protocol == "https:") {
        iframeDiv.setAttribute('src', 'https://service.relaiscolis.com/widgetrc/');
    } else {
        iframeDiv.setAttribute('src', 'http://service.relaiscolis.com/widgetrc/');
    }

    var overlay = document.createElement("div");
    overlay.setAttribute('id', 'overlay');
    overlay.setAttribute('style', 'position: fixed; top: 0;  left: 0;  width: 100%; height: 100%;  background: #000;  opacity: 0.5; filter: alpha(opacity=50);z-index:999;');

    overlay.addEventListener("click", function () {
        $("#overlay").css({"display": "none"});
       
        $("#myIframe").css({"display": "none"});
    }, false);

    callback(overlay, iframeDiv);
}

var displayPopUpRCalready = false;

/***
 * Cette fonction permet de vérifier si une une iframe exisite déja, si oui elle l'affiche,
 * sinon elle lance la méthode de création
 */
function displayPopUpRC()
{
    if (!displayPopUpRCalready) 
    {
        createIframeMap(function (overlay, iframeDiv) {
            $("body").append(iframeDiv);
            $("body").append(overlay);
        });
        displayPopUpRCalready = true;
    } 
    else 
    {
        $("#overlay").css({"display": "block"});
        $("#myIframe").css({"display": "block"});
    }
}
</script>


<!--scripts customisés-->
<script>


//Relais colis management
callback = function(data) {
                //console.log('data here', data)
                $(".section_relais_select").css("display", "block");
                document.querySelector("p.name_relais").innerHTML=data.name;
                document.querySelector("p.address_relais").innerHTML=data.location.formattedAddressLine;
                document.querySelector("p.city_relais").innerHTML=data.location.formattedCityLine;
}
$('#relais-colis-widget-container').ready = generateHtmlButton(callback);



//Datepicker JQUERY
$( function() {
    
    //("#datepicker_livraison").datepicker({ minDate: +20, maxDate: "+12M",regional:"fr" });
    $( "#datepicker_livraison" ).datepicker({ minDate: +20, maxDate: "+12M",regional:"fr" });
});

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
    // onInit is called when the button first renders
    onInit: function(data, actions) {
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
                    ShowModalAfterPayment("Votre commande à été correctement effectué. Nous vous remercions pour votre achat.");
                    window.location.replace("send_mail.php?pid="+data.pay_id);
                } else {
                    //exécution du paiement a échoué.
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