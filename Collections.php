<!DOCTYPE html>
<html lang="fr">

<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->
<!--     Site web by Tommy JEANBILLE     -->
<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->

<head>
    <title>Collections - Vente de cadres décorés</title>
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

    <meta property="og:title" content="Collections - Vente de cadres décorés">
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
    include("Cart_Number_Update.php");

    //Gestion des rubriques et produits 
    if(isset($_GET['rubrique']))
    {
        $row_rubrique = $rubriques->GetPKofRubriqueName($_GET['rubrique']);
        $rows_produits = $produits->findAll_With_RubriqueFK($row_rubrique['pk_rubrique']);
        
        //die('Erreur 404 : Données introuvables');
    }
    else{
        header('HTTP/1.0 404 Not Found');
        die;
    }
?>



<!-- Header -->
<?php include('header.php') ?>

<body style="background-color:#FDF8F5">


<div class="global-page" style="position:relative;" >

<!--<img src="img/1553459034.svg" class="img-decoration-up" alt="Nature"   style="">
<img src="img/1553459034.svg" class="img-decoration-down" alt="Nature"   style="">-->
<h1 style="margin-top:15px;margin-bottom:25px;"><i class="fas fa-store-alt"></i> Collection <?= $row_rubrique['nom'];?></h1>

    <p class="p-increased p-centered" style=""><?= $row_rubrique['description'];?></p>

    <div class="container-collection-product">
        <!--Start iteration for all products-->
        <?php foreach ($rows_produits as $produit): 
                    //Recuperation de la première image de présentation
                    $directory = "img_produits/".$produit['ref'];
                    $files = scandir ($directory);
                    $firstFile = $directory ."/" . $files[2];
        ?>
        <div id=<?=$produit['ref'];?> class="container-product">
            <div class="product-img-grp">
                <img src=<?php echo $firstFile;?> class="img-product" alt="...">
                <div class="product-banner-hover">Découvrir ce produit</div>
            </div>
            <div class="product-content-grp">
                <div class="product-content-title"><?= $produit['nom'];?></div>
                <div class="product-content-price"><?= $produit['prix'];?> €</div>
            </div>
        </div>
        <?php endforeach; ?>
        <!--End iteration for all products-->
    </div>


        </div>

</body>

<!-- footer -->
<?php include('footer.php') ?>

<script>
function getRefProduct(el) {
    var ref = $(el).attr('id');
    var refdata = {
        'ref': ref
    }
    return refdata;
}

$('.container-product').click(function() {
    var ref_product = JSON.stringify(getRefProduct(this));
    window.location.href ="ref_product_details.php?ref="+ getRefProduct(this).ref;

});
</script>

</html>