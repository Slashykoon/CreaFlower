<!DOCTYPE html>

<?php
require_once "config/Rubriques.php";
$rubriques = new Rubriques();
?>


<!-- Header de navigation -->
<header style="">

    <div class="navbar">

        <a href="index.php">
        <div class="btn_cart">
                <span class="content"><i class="fa-solid fa-mobile-screen fa-xl"></i></span>
            </div>
        </a>
        <a href="contact.php">
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
        <?php
        $rows_rubriques=$rubriques->findAll();
        if($rows_rubriques)
        {
            foreach ($rows_rubriques as $rubrique): 
        ?>
        <a class="h2 collection-navigation-rubrique rubrique-fx" href="Collections.php?rubrique=<?= $rubrique->nom;?>">
            <h2><?= $rubrique->nom;?></h2>
        </a>
        <?php endforeach; } ?>
    </div>

</header>