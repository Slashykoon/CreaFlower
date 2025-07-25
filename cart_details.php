<!DOCTYPE html>
<html lang="fr">

<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->
<!--     Site web by Tommy JEANBILLE     -->
<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->

<head>
    <title>Panier - Vente de cadres décorés</title>
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

    <meta property="og:title" content="Panier - Vente de cadres décorés">
    <meta property="og:type" content="website">
    <meta property="og:updated_time" content="2022-12-01 10:21:17">
    <meta property="og:url" content="https://crea-flower.fr/">
    <meta name="robots" content="follow,index">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="css/style.css" rel="stylesheet">
    <!-- Librairie JQuery pour requete AJAX-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="i18n/datepicker-fr.js"></script>
    <!-- Librairie FontAwesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css"
        integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b0f7e6ecb6.js" crossorigin="anonymous"></script>
    <!-- Importation de la SDK JavaScript PayPal -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.8.3/dist/css/autocomplete.min.css"/>-->
    <script src="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.8.3/dist/js/autocomplete.min.js"></script>

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
require_once "config/Livraison.php";

$users = new Users();
$produits = new Produits();
$options = new Options();
$specifications = new Specifications();
$paniers = new Paniers();
$produit_panier = new Produit_Panier();
$specification_panier = new Specifications_Panier();
$sessions = new Sessions();
$livraisons = new Livraisons();


require_once "Session_management.php";
require_once "Cart_Number_Update.php";

?>


<!-- Header -->
<?php include('header.php') ?>


<body style="background-color:#FDF8F5">
    <div class="global-page" style="position:relative;" >

        <!--<img src="img/1553459034.svg" class="img-decoration-up" alt="Nature"   style="">
        <img src="img/1553459034.svg" class="img-decoration-down" alt="Nature"   style="">-->
        <h1 style="margin-top:15px;margin-bottom:25px;"><i class="fas fa-shopping-cart"></i> Détails du panier</h1>
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
                                            
                                            if($row_spec["type"] == 0) //seul les option select on des prix
                                            {
                                                print_r("<li><span class='fa-li'><i class='fas fa-broom fa-sm'></i></span>"); 
                                                print_r("<p style='margin-top:0px;margin-bottom:0px;' >".$row_opt_panier["nom_option"].$temp_prix_add."</p>");
                                            }
                                            if($row_spec["type"] == 4 || $row_spec["type"] == 1) //saisi ou date
                                            {
                                                print_r("<li><span class='fa-li'><i class='	fas fa-pencil-alt fa-sm'></i></span>"); 
                                                print_r("<p style='margin-top:0px;margin-bottom:0px;' >".$sp_panier["txt_saisi"]."</p>");
                                            }
                                            if($row_spec["type"] == 2) //image
                                            {
                                                print_r('<img src="' .$sp_panier["txt_saisi"]. '" width="60px;" height="60px">' );
                                                //print_r("<li><span class='fa-li'><i class='	fas fa-pencil-alt fa-sm'></i></span>"); 
                                                //print_r("<p style='margin-top:0px;margin-bottom:0px;' >".$sp_panier["txt_saisi"]."</p>");
                                            }
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
                                $livraison = 0.0; //5.0
                                
                            }
                        }   
                        //calcul du sous total avec options prise en comtpes
                        $sous_total = $sous_total + $sum_opt_prix_total;
                        $total = $sous_total + $livraison ;
                        $_SESSION['sous_total'] = $sous_total;
                        $_SESSION['total'] = $total;
                    }
            ?>
            <div class="cart-product-checkout-details">
                <span class="text_bold">Choisissez votre mode de livraison :</span>
                <div style="display:flex;column-gap:20px;align-item:stretch;">
                    <div id="relais-colis-widget-container" class="btn-not-select" style="display:flex;"></div>
                    <div id="collisimo-container" class="btn-not-select"   style="display:flex;">
                        <img style='width:100%;cursor: pointer;min-width: 80px;min-height:50px;background-color: #DDAF94;align-items:center;justify-content:center;' src='img/colissimo-logo.svg'; />
                    </div>
                </div>
                <div class="section_relais_select" style="display:none;">
                    <p class="name_relais"></p>
                    <p class="address_relais"></p>
                    <p class="city_relais"></p>
                </div>

                <div class="text_bold">Date de l'evenement (marriage,baptême,etc..) :</div>
                <div class="input-container bottom-10px ">
                    
                    <input style="width:100%;height:25px;" type="text" id="datepicker_livraison" name="datepicker_livraison" onkeydown="event.preventDefault()" readonly="readonly"> 
                </div>

                <div class="text_bold">Vos coordonnées :</div>
                <form>
                    <div class="input-container">
                        <input type="text" required="required" name="nom_client" />
                        <label>Nom</label>		
                    </div>
                    <div class="input-container">
                        <input type="text" required="required" name="prenom_client" />
                        <label>Prenom</label>		
                    </div>
                    <div class="input-container">
                        <input type="email" required="required" name="email_client" />
                        <label>Email</label>		
                    </div>
                    <div class="auto-search-wrapper input-container bottom-10px" >
                        <input
                            type="text"
                            autocomplete="off"
                            id="search"
                            class="full-width"
                            placeholder="Entrez une adresse"
                            name="adresse_client"
                        />
                        <label>Adresse</label>	
                    </div>
                    
                </form>

                <div class="cart-details-totaux-section">
                        <p class="detail-prix-sous-total" style="margin-top:5px;margin-bottom:5px;">Sous total : <?php echo $sous_total; ?> €</p>  
                        <p class="detail-prix-livraison" style="margin-top:5px;margin-bottom:5px;">Livraison : <?php echo $livraison; ?> €</p>
                        <p class="detail-prix-total" style="margin-top:5px;margin-bottom:5px;">Total : <?php echo $total; ?> €</p>        
                </div>
                <div>
                    <p style="margin-bottom:5px;font-style: italic;">Il n'est pas obligatoire de posséder un compte Paypal pour commander.</p>
                </div>
                <div>
                    <p id="msg_unlock_pp" style="margin-bottom:5px;font-weight: bold;display:block;">Pour proceder au paiement, il est nécessaire de remplir les champs ci-dessus</p>
                </div>
                <!--Bouton Paypal-->
                <div id="bouton-paypal" style="display:none"></div>
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


<!--Relais colis script-->
<script type="text/javascript" src="js/Relais_Colis_Iframe.js"></script>


<!--scripts customisés-->
<script>
var choix_livraison = 0;
var bValidationOK=true;
//Relais colis management
callback = function(data) {
                //console.log('data here', data)
                $(".section_relais_select").css("display", "block");
                document.querySelector("p.name_relais").innerHTML=data.name;
                document.querySelector("p.address_relais").innerHTML=data.location.formattedAddressLine;
                document.querySelector("p.city_relais").innerHTML=data.location.formattedCityLine;    
                ActivatePP(Validate_user_data());
}
$('#relais-colis-widget-container').ready = generateHtmlButton(callback);


//Datepicker 
$( function() {
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
function RedirectToCart() {
    window.location = 'cart_details.php';
}

//animation btn
$('#relais-colis-widget-container').click(function() {
    
    var ss_total = '<?php echo $_SESSION['sous_total'] ; ?>'

    if ($('#collisimo-container').attr('class') == 'btn-select')
    {
        $('#collisimo-container').attr('class', 'btn-not-select');
    }
    $('#relais-colis-widget-container').attr('class', 'btn-select');
    choix_livraison = 1;
    document.querySelector(".detail-prix-livraison").innerHTML="Livraison : " + 4.50 + " €" ;
    document.querySelector(".detail-prix-total").innerHTML="Total : " +  (parseFloat(ss_total) +4.50) + " €" ;
    ActivatePP(Validate_user_data());
});

$('#collisimo-container').click(function() {

    var ss_total = '<?php echo $_SESSION['sous_total'] ; ?>'
    if ($('#relais-colis-widget-container').attr('class') == 'btn-select')
    {
        $('#relais-colis-widget-container').attr('class', 'btn-not-select');  
    }
    $('#collisimo-container').attr('class', 'btn-select');
    choix_livraison = 2;
    document.querySelector(".detail-prix-livraison").innerHTML="Livraison : " + 6.90 + " €" ;
    document.querySelector(".detail-prix-total").innerHTML="Total : " + (parseFloat(ss_total) +6.90) + " €" ;
    
    ActivatePP(Validate_user_data());
});

//Action de suppression d'un article
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


//Action d'ajout du choix relais colis
function AddSelectedRelaisColis(){
    formData = {
        'name_relais': document.querySelector("p.name_relais").innerHTML,
        'address_relais': document.querySelector("p.address_relais").innerHTML,
        'city_relais': document.querySelector("p.city_relais").innerHTML,
        'nom_client': document.querySelector("[name=nom_client]").value,
        'prenom_client': document.querySelector("[name=prenom_client]").value,
        'email_client': document.querySelector("[name=email_client]").value,
        'adresse_client': document.querySelector("[name=adresse_client]").value,
        'date_evt': document.querySelector("[name=datepicker_livraison]").value,
        'choix_livraison':choix_livraison
    }; 
    $.ajax({
        type: "POST",
        url: "AddToLivraisons.php",
        dataType: 'json',
        data: formData,
        success: function(data, textStatus, jqXHR) {   
             //console.log(textStatus);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}


function validateEmail(email){
    var emailReg = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i);
    return emailReg.test(email);
}

function Validate_user_data()
{
    mValidationOK=true;
    if (!document.querySelector("[name=nom_client]").value){
        mValidationOK= mValidationOK && false;
    }
    if (!document.querySelector("[name=prenom_client]").value){
        mValidationOK= mValidationOK && false;
    }
    if (!document.querySelector("[name=email_client]").value){
        mValidationOK= mValidationOK && false;
    }
    if(!validateEmail(document.querySelector("[name=email_client]").value))
    {
        mValidationOK= mValidationOK && false;
    }
    if (!document.querySelector("[name=adresse_client]").value){
        mValidationOK= mValidationOK && false;
    }
    if (choix_livraison == 0){
        mValidationOK= mValidationOK && false;
    }
    if (choix_livraison == 1){
       
        if(!document.querySelector("p.name_relais").innerHTML)
        {
            mValidationOK= mValidationOK && false;
        }
    }
return mValidationOK

}

function ActivatePP(pvalid)
{
    if(!pvalid)
    {
        $("#bouton-paypal").css("display", "none");
        
        $("#msg_unlock_pp").css("display", "block");
    }
    else{
        $("#bouton-paypal").css("display", "block");
        $("#msg_unlock_pp").css("display", "none");
    }
}

jQuery('input[name=nom_client]').on('input', function() {
    bValidationOK=Validate_user_data();
    //alert(bValidationOK);
    ActivatePP(bValidationOK);
});
jQuery('input[name=prenom_client]').on('input', function() {

    ActivatePP(Validate_user_data());
    //alert(bValidationOK);
});
jQuery('input[name=email_client]').on('input', function() {
    bValidationOK=Validate_user_data();
    ActivatePP(bValidationOK);
    //alert(bValidationOK);
});
jQuery('input[name=adresse_client]').on('input', function() {
    bValidationOK=Validate_user_data();
    ActivatePP(bValidationOK);
    //alert(bValidationOK);
});




//Gestion de Paypal
if ($('input[name=DisablePaypalBtn]').val() == 0) //evite de charger le btn pour eviter les soucis si aucun article
{
    paypal.Button.render({
        env: 'production', // Ou 'production',
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

            //ajoute le point relais colis
            AddSelectedRelaisColis();
            // créer le paiement
    
            var CREATE_URL = 'paypal_create_payment.php?ref='+ $('input[name=CartId]').val();
            // On exécute notre requête pour créer le paiement
            return paypal.request.post(CREATE_URL).then(function(data) { //JSON data
                    if (data.success) { // Si success est vrai (<=> 1), on peut renvoyer l'id du paiement généré par PayPal
                        return data.paypal_response.id;
                    } 
                    else { // Sinon, il y a eu une erreur quelque part. retourne false, pour stopper net le processus de paiement.
                        alert("paypal_create_payment response  :"+ data.msg);
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
                    if (data.success) { // Si le paiement a bien été validé, on peut rediriger l'utilisateur vers une nouvelle page.
                        ShowModalAfterPayment("Votre commande à été correctement effectué. Redirection en cours...");
                        window.location.replace("send_mail.php?pid="+data.pay_id); //utilisation de la redirection pour afficher une page de remerciement
                    } else {
                        //exécution du paiement a échoué.
                        alert(data.msg);
                    }
                });
        },
        onCancel: function(data, actions) {
            //alert("Paiement annulé : vous avez fermé la fenêtre de paiement.");
        },
        onError: function(err) {
            alert(err);
            alert("Paiement annulé : une erreur est survenue. Merci de bien vouloir réessayer ultérieurement.");
        }
    }, '#bouton-paypal');
}



new Autocomplete("search", {
  // default selects the first item in
  // the list of results
  selectFirst: true,
  // The number of characters entered should start searching
  howManyCharacters: 2,
  // onSearch
  onSearch: ({ currentValue }) => {
    // You can also use static files
    // const api = '../static/search.json'
    const api = `https://nominatim.openstreetmap.org/search?format=geojson&limit=5&street=${encodeURI(
      currentValue
    )}`;

    return new Promise((resolve) => {
      fetch(api)
        .then((response) => response.json())
        .then((data) => {
          resolve(data.features);
        })
        .catch((error) => {
          console.error(error);
        });
    });
  },
  // nominatim GeoJSON format parse this part turns json into the list of
  // records that appears when you type.
  onResults: ({ currentValue, matches, template }) => {
    const regex = new RegExp(currentValue, "gi");

    // if the result returns 0 we
    // show the no results element
    return matches === 0
      ? template
      : matches
          .map((element) => {
            return `
          <li class="loupe">
            <p>
              ${element.properties.display_name.replace(
                regex,
                (str) => `<b>${str}</b>`
              )}
            </p>
          </li> `;
          })
          .join("");
  },
  // we add an action to enter or click
  onSubmit: ({ object }) => {
    //console.log(object.properties.display_name);
  },
  // get index and data from li element after
  // hovering over li with the mouse or using keyboard
  onSelectedItem: ({ index, element, object }) => {
    //console.log("onSelectedItem:", index, element, object);
  },
  // the method presents no results element
  noResults: ({ currentValue, template }) =>
    template(`<li>Aucun résultat trouvé: "${currentValue}"</li>`),
});

</script>

</html>



