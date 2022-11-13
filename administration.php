<!DOCTYPE html>
<html lang="fr">

<head>
    <title>ADMINISTRATION</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vente de cadres de décoration">
    <meta name="author" content="Tommy Jeanbille, Celine Levrechon">

    <!-- Librairie JQuery pour requete AJAX-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css"
        integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b0f7e6ecb6.js" crossorigin="anonymous"></script>
</head>


<body style="background-color:#ECECEC">
    <div style="display:flex;  flex-direction: column; align-items: center;row-gap:40px;">
    <h1 style="margin-top:50px;margin-bottom:50px;"><i class="fas fa-store"></i> ADMINISTRATION DU SITE</h1>
    <button style="height:50px;" class="" onclick="location.href='edition_articles.php';"> <i class="fas fa-reply"></i>
        EDITION DES ARTICLES</button>
    <button style="height:50px;" class="" onclick="location.href='view_commandes.php';"> <i class="fas fa-reply"></i>
        VOIR LES COMMANDES</button>
    </div>
</body>

</html>