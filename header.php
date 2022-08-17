<!DOCTYPE html>

<script>
/*$('.btn_cart').click(function() {
    //var ref_product = JSON.stringify(getRefProduct(this));
    window.location.href ="ref_product_details.php?ref="+ ;

});*/
</script>
<!-- Header de navigation -->
<header style="position:relative;display:flex;flex-direction:column;margin-bottom:0;overflow: hidden;">

    <div class="navbar" style="display:flex;align-items:center;justify-content:space-between;">
        <a href="index.php">
        <div class="btn_cart">
                <span class="content"><i class="fa-solid fa-camera fa-xl"></i></span>
            </div>
        </a>
        <a href="Collections.php">
        <div class="btn_cart">
                <span class="content"><i class="fa-solid fa-mobile-screen fa-xl"></i></span>
            </div>
        </a>
        <a href="#contact">
            <div class="btn_cart">
                <span class="content"><i class="fa-solid fa-envelope-open-text fa-xl"></i></span>
            </div>
        </a>
        <a href="cart_details.php">
            <div class="btn_cart">
                <span class="content"><i class="fas fa-cart-arrow-down fa-xl"></i></span>
                <span class="badge_cart"><?php echo $_SESSION['nb_articles_panier']; ?></span>
            </div>
        </a>
    </div>

    <!-- Banniere -->
    <div class="wave-header text-center">
        <h1 class="header_title">Créa' Flower</h1></span>
        <h2>Vente de décorations artisanales</h2>
    </div>


    <div class="container-collection-navigation">

        <a class="h2 collection-navigation-rubrique rubrique-fx" href="Collections.php?rubrique=rubrique_1">
            <h2>Rubrique 1</h2>
        </a>
        <a class="h2 collection-navigation-rubrique rubrique-fx">
            <h2>Rubrique 2</h2>
        </a>
        <a class=" collection-navigation-rubrique rubrique-fx">
            <h2>Rubrique 3</h2>
        </a>
    </div>

</header>