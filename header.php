<!DOCTYPE html>

<?php
require_once "config/Rubriques.php";
$rubriques = new Rubriques();
?>


<!-- Header de navigation -->
<header >

    <div class="navbar">

        <div class="hamburger-menu">
            <input id="menu__toggle" type="checkbox" />
            <label class="menu__btn" for="menu__toggle">
                <span></span>
            </label>
            <ul class="menu__box">
                <li><a class="menu__item" href="index.php">Accueil</a></li>
                <li><a class="menu__item" href="contact.php">Me contacter</a></li>
                <?php
                    $rows_rubriques=$rubriques->findAll();
                    if($rows_rubriques)
                    {
                        foreach ($rows_rubriques as $rubrique): 
                    ?>
                    <li>        
                        <a class="menu__item" href="Collections.php?rubrique=<?= $rubrique->nom;?>">
                            <?= $rubrique->nom;?>
                        </a>
                    </li>
                <?php endforeach; } ?>

            </ul>
        </div>

        <a href="index.php">
            <div class="btn_cart">
                <span class="content"><i class="fas fa-home fa-xl"></i></span>
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
        <h2>Créations artisanales en fleurs séchées</h2>
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