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

require_once "Session_management.php";
require_once "Cart_Number_Update.php";


//Recuperation du détail des produits
$row_produit = $produits->find(strval($_GET["ref"]));
$rows_specifications=$specifications->GetAllSpecificationOfProduct($row_produit["pk_pr"]);

//Recuperation de la première image de présentation
$directory = "img_produits/".$row_produit["ref"];
$files = scandir ($directory);


//pour variable globale javascript
echo "<input id='ProdPrice' name='ProdPrice' type='hidden' value='".$row_produit["prix"]."'>";

?>


<!-- Header -->
<?php include('header.php') ?>


<body style="background-color:#FDF8F5">
    <div class="global-page">
        <h1 style="margin-top:15px;margin-bottom:25px;"><i class="fas fa-tags"></i> Détails du produit</h1>
        <!--grid 2 col-->
        <div class="container-detail-product">
            <!--flex 2 cols-->
            <div class="container-img">
                <!--row 1 no flex-->
                <div class="container-img-carousel">
                    <?php 
                foreach ($files as $file): 
                $IterateFile = $directory ."/" . $file; 
                if( $file !== "." && $file !== ".." ) 
                { 
                ?>
                    <div class="carousel-img-slide">
                        <img class="img-slide" src=<?php echo $IterateFile;?> style="" alt="...">
                    </div>
                    <?php 
                } 
                ?>
                    <?php endforeach; ?>
                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                    <a class="next" onclick="plusSlides(1)">❯</a>
                </div>

                <!--row 2 flex x col-->
                <div class="container-img-navigation">
                    <?php 
                    $i=0;
                    foreach ($files as $file): 
                    
                    $IterateFile = $directory ."/" . $file; 
                    if( $file !== "." && $file !== ".." ) 
                    { 
                        $i=$i+1;
                ?>
                    <img class="thumb" src=<?php echo $IterateFile;?> alt="..."
                        onclick="currentSlide(<?php echo $i ?>)">
                    <?php 
                    } 
                ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="product-content-details">
                <div class="product-content-nom">
                    <h1><?= $row_produit["nom"] ?></h1>
                </div>
                <div class="product-content-actions">
                    <select name="input_qte" id="input_qte" >
                        <?php 
                        for ($i = 1; $i <= 200; $i++) {
                            echo "<option style='text-align: center' value=".$i.">".$i."</option>";
                        }
                        ?>
                    </select>
                    <button style="flex:2" class="btn-add-cart" id=<?= $row_produit["ref"] ?> onclick="AddToCart()"> 
                        <i class="fas fa-cart-plus" style="color:white;"></i>
                        <span style="color:white;">AJOUTER AU PANIER - <?= $row_produit["prix"] ?> € </span>
                    </button>
                </div>
                <div class="product-content-opt-spec" >
                    <?php
                    if(!empty($rows_specifications))
                    {
                        foreach ($rows_specifications as $specification)
                        {
                            $i=0;
                            echo "<div style='display:flex;padding-bottom:15px;'>";

                                //affiche le nom de la specif car different du nom d'option
                                echo "<div style='flex: 1;padding: .2em 0.8em .2em 0;'>";
                                    echo "<p>";
                                        print_r($specification["nom_specification"]);
                                    echo "</p>";
                                echo "</div>";
                                //option select => select
                                if($specification["type"] == 0)
                                {
                                    echo "<select id='id_specif_choice' name='specif_choice' style='flex: 2;'>"; 
                                        $rows_options = $options->findAllOptionsOfSpecification($specification['pk_sp']);
                                        foreach ($rows_options as $specif_options)
                                        {
                                            echo "<option class='opt-data' id='".$rows_options[$i]["pk_op"]."' value='".$rows_options[$i]["pk_op"]."'>";
                                            echo "<p>";
                                            print_r($rows_options[$i]["nom_option"]);
                                            print_r(" : ");
                                            print_r($rows_options[$i]["prix_add"]);
                                            print_r("€");
                                            print_r("<br/>");
                                            echo "</p>";
                                            $i=$i+1;
                                            echo "</option>";
                                        }
                                    echo "</select>";
                                }
                                //option saisie => input text
                                if($specification["type"] == 1)
                                {
                                    $row_option = $options->findOptionOfSpecification($specification['pk_sp']);
                                    echo "<input type='text' id='id_specif_choice_input' name='specif_choice' class='".$row_option['pk_op']."' style='flex: 2;'>"; 
                                }
                                //option media => input image
                                if($specification["type"] == 2)
                                {
                                    $row_option = $options->findOptionOfSpecification($specification['pk_sp']);
                                    //echo "<input type='text' id='id_specif_choice_media' name='specif_choice' class='".$row_option['pk_op']."' style='flex: 2;'>"; 
                                    echo "<form method='post' action='' enctype='multipart/form-data' style='display:flex;flex-direction:column;align-items: center;justify-content: center;'>";
                                    echo"<input type='file' id='files' class='input_file' name='files[]' data-index-number = '".$row_option['pk_op']."' >";
                                    
                                    //echo "<input type='button' id='submit' value='Charger' >";
                                    echo "</form>";
                                    //<div id='preview'></div>
                                    echo "<input id='BlockBtnBuy' name='BlockBtnBuy' type='hidden' value='1'>";

                                }
                                //option saisie => input date
                                if($specification["type"] == 4)
                                {
                                    $row_option = $options->findOptionOfSpecification($specification['pk_sp']);
                                    echo "<input type='date' id='id_specif_choice_input' name='specif_choice' class='".$row_option['pk_op']."' style='flex: 2;'>"; 
                                }

                            echo "</div>";
                        }
                    }
                    ?>
                </div>
                <span>
                    <button class="accordion">Description</button>
                    <div class="panel">
                        <p><?= $row_produit["description"] ?></p>
                    </div>

                    <button class="accordion">Composition</button>
                    <div class="panel">
                        <p><?= $row_produit["composition"] ?></p>
                    </div>

                    <button class="accordion">Dimension</button>
                    <div class="panel">
                        <p><?= $row_produit["dimension"] ?></p>
                    </div>
                    <button class="accordion">Livraison</button>
                    <div class="panel">
                        <p>Nous proposons trois solutions :
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fa-solid fa-box-open"></i></span>Relais colis – 4.50€</li>
                            <li><span class="fa-li"><i class="fa-solid fa-box-open"></i></span>Colissimo à domicile – 6.90€</li>
                        </ul>
                        </p>

                        <p>
                            Les délais de livraison :
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>Relais colis – 72h</li>
                            <li><span class="fa-li"><i class="fa-solid fa-calendar-days"></i></span>Colissimo à domicile – 48h</li>
                        </ul>
                        </p>

                        <p> Sur Crea'Flower, nous vous proposons de livrer votre commande à la date de votre choix pour un evenement particuliers. Vous
                            pouvez sélectionner le jour souhaité directement sur la page panier.
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fa-solid fa-business-time"></i></span>
                                Les délais sont exprimés en jours ouvrés et sont à compter à partir de la remise des
                                commandes au transporteur. Nous remettons toutes les commandes passées avant 13h tous les jours (lundi / vendredi).
                            </li>
                        </ul>
                        </p>
                    </div>
                </span>
            </div>
        </div>
    </div>
</body>


<!-- footer -->
<?php include('footer.php') ?>


<!--Modal cachée (Panier)-->
<div class="modal">
    <div class="modal-dialog">
        <button class="close">✖</button>
        <div class="modal-content">
            <img src="img/shopping-cart.gif" alt="Credit : Freepik - flaticon.com" />
            <p class="message">L'article a été correctement ajouté au panier. Vous pouvez passer à l'achat ou continuer
                votre shopping.</p>
            <button onclick="RedirectToCart()" class="accept">Aller au panier</button>
        </div>
    </div>
</div>


<script>

//Upload des images via php dans un dossier
$(document).ready(function() {

var element_blk_btn= document.querySelector("input[name=BlockBtnBuy]");
if (element_blk_btn.value == 1)
{
    document.querySelector("[class=btn-add-cart]").disabled = true;
    document.querySelector("[class=btn-add-cart]").className = "btn-add-cart-disabled";
}


//$('#submit').click(function() {
$('.input_file').change(function(e) {
    e.preventDefault();
    //Utilisation du formdata pour passer des files
    var form_data = new FormData();
    if(e.currentTarget.files.length > 0)
    {

        form_data.append("files[]", e.currentTarget.files[0]);
        //console.log(e.currentTarget.files[0]);
        form_data.append("num_files_limit",5); //not used
        
        // AJAX request
        $.ajax({
            url: 'upload_customer_img.php',
            type: 'post',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                /*for (var index = 0; index < response.length; index++) {
                    var src = response[index];
                    // Add img element in <div id='preview'>
                    $('#preview').append('<img src="' + src +
                        '" width="200px;" height="200px">');
                }*/
                
                if(response.errors != ""){
                    alert(response.errors);
                }
                else
                {
                    values_opt_file.push([e.currentTarget.getAttribute('data-index-number'),response.pathfile]); //todo push si pas existant en clé

                    var element_blk_btn= document.querySelector("input[name=BlockBtnBuy]");
                    if(element_blk_btn.value !=0) // savoir si il a deja ete deasactive
                    {
                        if(parseInt(values_opt_file.length) >= parseInt($( ".input_file" ).length))
                        {
                            element_blk_btn.value = 0;
                            document.querySelector("[class=btn-add-cart-disabled]").disabled = false;
                            document.querySelector("[class=btn-add-cart-disabled]").className = "btn-add-cart";
                        }
                    }
                    console.log(values_opt_file);
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
});

});




//Premier passage, on recupere les options select pour ajax ajout
var values_opt=[];
var values_opt_input=[];
var values_opt_file=[];
$( document ).ready(function() {
    values_opt = $("select[name='specif_choice']").map(function(){return $(this).val();}).get(); 
    //values_saisie_opt = $("input[name='specif_choice']").map(function(){return $(this).val();}).get(); 
    
});

//Calcul des changements d'options select puis recupere les options de nouveau pour ajax ajout
document.querySelectorAll('[id=id_specif_choice],[id=input_qte]').forEach(item => {
  item.addEventListener('change', event => {
        values_opt = $("select[name='specif_choice']").map(function(){return $(this).val();}).get(); 
        //console.log(values_opt); 
        var total_add = 0.0;
        var qte = 1;
        var constText = "AJOUTER AU PANIER - ";
        //quantity
        var element_qte = document.querySelector("[name=input_qte]>option:checked");
        qte= parseInt(element_qte.value);
        //total options
        document.querySelectorAll('[id=id_specif_choice]>option:checked').forEach(item => {
                var arr_ret = item.outerText.split(":");
                flt_val = parseFloat(arr_ret[1].replace('€', ''));
                total_add = total_add + (flt_val*qte);  
        })
        //total + upt btn
        var element_base_price = document.querySelector("input[name=ProdPrice]");
        var element = document.querySelector("[class=btn-add-cart]>span");
        var arr_ret_txt = element.textContent.split("-");
        element.textContent = constText + String(parseFloat(parseFloat(element_base_price.value)*qte + total_add).toFixed(2)) + " €";
  })
});

// Recupere les options input 
document.querySelectorAll('[id=id_specif_choice_input]').forEach(item => {
  item.addEventListener('change', event => {
    values_opt_input=[]; //reset lors du changement pour enlever les push
    tmp_values_saisie_opt = $("input[name='specif_choice']").map(function(){return $(this).val();}).get(); 
    tmp_values_saisie_id = $("input[name='specif_choice']").map(function(){return $(this).attr("class");}).get(); 
    for (var i = 0; i < tmp_values_saisie_opt.length; i++) {
        values_opt_input.push([tmp_values_saisie_id[i],tmp_values_saisie_opt[i]]);
    }
    //console.log(values_opt_input); 
  })
});



//Action ajouter au panier
function AddToCart() {
    formData = {
        'ref': $("button.btn-add-cart").attr("id"),
        'qte': parseInt($("#input_qte option:selected").text()),
        'arr_opt': (values_opt.length > 0 ? values_opt : "no"),
        'arr_opt_input': (values_opt_input.length > 0 ? values_opt_input : "no"),
        'arr_opt_file': (values_opt_file.length > 0 ? values_opt_file : "no")
    };

    $.ajax({
        type: "POST",
        url: "AddToCart.php",
        dataType: 'json',
        data: formData,
        success: function(data, textStatus, jqXHR) {
            ShowModal(data.text_ret);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}


//Modal management
function ShowModal(textToAdd) {
    $(".modal").css("display", "block");
    $(".message").text(textToAdd);
}
$('.close').click(function() {
    $(".modal").css("display", "none");
});
function RedirectToCart() {
    window.location = 'cart_details.php';
}


//Accordion management
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    //deroule tout avant
    acc[i].classList.toggle("active");
    var panel = acc[i].nextElementSibling;
    panel.style.maxHeight = panel.scrollHeight + "px";
    //
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}

//Carousel management
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("carousel-img-slide");
    let dots = document.getElementsByClassName("thumb");

    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    //captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

</html>