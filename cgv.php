<!DOCTYPE html>
<html lang="fr">

<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->
<!--     Site web by Tommy JEANBILLE     -->
<!-- /|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\/|\-->

<head>
    <title>CGV - Vente de cadres décorés</title>
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

    <meta property="og:title" content="CGV - Vente de cadres décorés">
    <meta property="og:type" content="website">
    <meta property="og:updated_time" content="2022-12-01 10:21:17">
    <meta property="og:url" content="https://crea-flower.fr/cgv.php">
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
    require_once "Cart_Number_Update.php";
?>


<!-- Header -->
<?php include('header.php') ?>

<body style="background-color:#FDF8F5">


<div class="global-page" style="min-height:900px;">
<h1 style="margin-top:15px;margin-bottom:25px;"><i class="fas fa-balance-scale"></i> Conditions générales de vente</h1>
    <div class="cgv-mention-container">

<h2>ARTICLE 1 : DOMAINE D’APPLICATION</h2>
<p>Les commandes sont régies sans exception par les conditions générales de vente ci-dessous. Elles prévalent sur toute autre stipulation ou documents émanant de nos clients. Ces conditions générales de vente s’appliquent de façon exclusive aux relations commerciales actuelles et futures existantes entre https://crea-flower.fr et l’auteur de la commande, ci-après désigné le Client. Toute commande adressée par le client emporte son adhésion sans restriction ni réserve aux présentes conditions générales de vente.</p>

<h2>ARTICLE 2 : PRIX</h2>
<p>Les prix sont libellés en euros (TVA non applicable, art. 293B du CGI). https://crea-flower.fr se réserve le droit de modifier ses prix à tout moment, en fonction des conditions économiques ou réglementaires. La facturation s’effectue selon le tarif en vigueur au jour de la commande. Tous les prix sont donnés sous réserve d’erreur typographique manifeste.</p>

<h2>ARTICLE 3 : PRODUIT</h2>
<p>Les photos des articles représentés sur https://crea-flower.fr sont non contractuelles et sont susceptibles d’être modifiées à tout moment. Lors de rupture de stock chez nos fournisseurs, https://crea-flower.fr se réserve le droit d’échanger les variétés manquantes par des variétés semblables. Les compositions ne devront pas être altérées.</p>

    <h2>ARTICLE 4 : PAIEMENT</h2>
    <p>Le prix est exigible à la commande. Cette dernière n’est traitée qu’à réception et validation du paiement, qui peut se faire par Paypal ou par carte bancaire via notre module de paiement sécurisé Paypal. Dans ce dernier cas, les informations bancaires du client ne sont jamais communiquées à https://crea-flower.fr, mais traitées directement par le serveur sécurisé et crypté de la banque. Le paiement via un code de carte cadeau ne peut pas se cumuler avec un autre code en cours.</p>

    <h2>ARTICLE 5 : DÉLAI DE CRÉATION</h2>
    <p>Nos délais de création sont exprimés en jours/heures ouvré(e)s. Les articles non personnalisés (type photophores ou cadres simples) sont expédiés sous 48 heures ouvrées. Les articles personnalisées (avec prénoms, étiquettes) nécessitent un délai de fabrication dépendant du volume de la commande (exemple : 150 porte-noms pour un mariage nécessiteront plusieurs jours de création). Il faut ensuite ajouter les délais de livraison propres à chaque transporteur. Pendant les fêtes ou les périodes exceptionnelles les délais de création peuvent être rallongés. Nous communiquons sur nos différents réseaux (site web, réseaux sociaux) des délais supplémentaires. En cas de relivraison devant intervenir à la suite d’une erreur du transporteur ou de Créa’Flower, des délais supplémentaires peuvent s’appliquer. Dans le cas d’une rupture de stock imprévue pour un article commandé, le client sera averti immédiatement par https://crea-flower.fr afin de l’informer du délai éventuel et lui permettre, le cas échéant, d’annuler sa commande et d’obtenir le remboursement sous 15 jours maximum des sommes déjà versées, ou bien de remplacer le(les) article(s) indisponible(s) par un(des) article(s) similaire(s) affiché(s) au même prix que le(les) article(s) non disponible(s).</p>

    <h2>ARTICLE 6 : LIVRAISON</h2>
    <p>https://crea-flower.fr propose 2 modes de livraisons : à domicile (France métropolitaine) ou en point relais (uniquement pour la France métropolitaine) Livraison à domicile avec Colissimo. Livraison en point relais avec Relais Colis.
    Les opérations promotionnelles visant à proposer la gratuité des frais de port ne s’appliqueront qu’aux livraisons à destination de la France Métropolitaine pour un service de type Colissimo ou Relais Colis. </p>
    <p>Délais de livraison : La livraison est réalisée après la création de la commande. Le délai de livraison au sein de la CEE ne saurait excéder 15 jours ouvrés, sauf cas de force majeure. Les délais de livraison généralement constatés (à titre indicatif) sont : France métropolitaine : Colissimo : 48 à 96 heures (hors dimanche et jours fériés). Par ailleurs, des délais particuliers de livraison pourront être appliqués lors d’opérations spécifiques avec nos partenaires ou lors de la mise en place de ventes privées. Tous les délais indiqués ci-dessus sont exprimés en jours/heures ouvré(e)s. 
En cas de retard de livraison par rapport à la date que nous vous avons indiqué dans le mail d’expédition, nous vous demandons de nous signaler ce retard en nous contactant via la rubrique Contact du site internet. Nous contacterons alors le transporteur choisi pour faire démarrer une enquête. Une enquête Colissimo peut durer jusqu’à 21 jours à compter de la date de début de l’enquête. Si pendant ce délai, le produit est retrouvé, il sera ré-acheminé immédiatement à votre domicile (la majorité des cas). 
Si en revanche le produit n’est pas retrouvé à l’issue du délai de 21 jours d’enquête, la Poste considère le colis comme perdu. C’est seulement à ce moment que nous pouvons vous renvoyer un produit de remplacement, à nos frais. Nous ne pourrons pas être tenus responsables en cas de retard des transporteurs. Avec la Covid-19, les délais de livraison des transporteurs peuvent être rallongés. </p>
<p>Adresse et suivi de livraison : Chaque envoi bénéficie d’un numéro de suivi (sauf spécificité liée au transporteur) envoyé par email et/ou SMS selon le transporteur sélectionné, permettant ainsi au client de suivre l’acheminement de sa commande. </p>
<p>Livraison à domicile : La livraison est faite à l’adresse que le client aura indiquée lors de sa commande. Le client doit s’assurer au moment de la validation de sa commande d’avoir communiqué les informations exactes, précises et complètes concernant l’adresse de livraison (N° et nom de rue, du bâtiment, d’escaliers, codes d’accès, interphone…). En cas d’erreur sur l’adresse de livraison renseignée au moment de la validation d’une commande, Créa-Flower ne garantit pas la possibilité de modifier les informations, et ne pourra être tenu responsable d’un éventuel retard ou problème de livraison survenant à la suite de cette erreur. </p>
<p>Livraison en point relais : La livraison via Relais Colis s’effectue dans le point relais sélectionné par le client au moment de la commande, sous réserve d’acceptation du colis par ce point relais au moment de la livraison. Si le point relais choisi initialement est indisponible, le colis sera alors mis à disposition dans un point relais à proximité. Le client sera alors averti par le transporteur du nouveau point de retrait. En cas de retard ou impossibilité de livraison dû à une erreur de la part du client (adresse de livraison erronée ou incomplète), ou en cas d’absence de retrait de la part du client en point de retrait dans le délai indiqué par le transporteur, https://crea-flower.fr ne pourra pas être tenu pour responsable, et aucune réexpédition ne pourra être effectuée. Le client sera remboursé de la commande (hors frais de livraison) dans un délai de 15 jours après réception du colis dans nos locaux.</p>

<h2>ARTICLE 7 : RÉCLAMATION, DÉLAI DE RÉTRACTATION, RETOURS</h2>
<p>Le client dispose d’un délai légal de rétractation de 14 jours pour annuler sa commande après réception de celle-ci pour toutes les commandes qui ne sont pas “sur mesure”.
Les articles doivent être retournés dans leur emballage d’origine au 25 chemin du Mongambé, 54460 Aingeray, dans un état permettant leur re-commercialisation. Passé ce délai, aucun remboursement ni retour de marchandise ne pourra être envisagé sans accord préalable du Service Client. Les frais de retour des produits sont à la charge du client. Le remboursement des produits ne sera possible qu’après réception effective des articles dans nos locaux et après un contrôle qualité. Afin de permettre un traitement plus rapide de votre demande, nous vous recommandons de joindre la facture d’origine de votre achat. Le client sera prévenu par e-mail à l’adresse qu’il aura utilisé pour effectuer sa commande de la bonne réception du retour produit et des suites données après contrôle de ce dernier. Les commandes “sur mesure” ne disposent pas d’un délai de rétractation post paiement puisque les produits ne peuvent être re-commercialisés. Pour plus de renseignements, veuillez adresser un email au Service Client à contact@crea-flower.fr</p>

<h2>ARTICLE 8 : GARANTIE</h2>
<p>Passé le délai de rétractation évoqué à l’article 7, le client pourra renvoyer son article sous réserve de l’obtention d’un accord préalable du service client de https://crea-flower.fr. Pour ce faire, le client contactera le service client de https://crea-flower.fr au choix par email à l’adresse contact@crea-flower.fr ou en utilisant le formulaire de contact du site, par courrier à l’adresse : 25 chemin du Mongambé, 54460 Aingeray. Le service client confirmera par email l’accord de retour. Afin de permettre un traitement plus rapide de votre demande, nous vous recommandons de joindre la facture d’origine de votre achat. Le client sera prévenu par e-mail à l’adresse qu’il aura utilisé pour effectuer sa commande de la bonne réception du retour produit et des suites données après contrôle de ce dernier. Les cas suivants ne sont pas couverts par la garantie : les produits utilisés de manière non conforme à l’usage pour lequel ils sont prévus, les produits transformés ou modifiés.</p>

<h2>ARTICLE 9 : RÉSERVE DE GARANTIE</h2>
<p>Créa’Flower se réserve la propriété des marchandises vendues livrées et désignées sur ses factures jusqu’à leur paiement effectif et intégral (application de la loi n° 80-3355 du 12 mai 1980). Les frais engendrés par la nécessité d’un recouvrement en contentieux demeurent à la charge du client (y compris les honoraires d’officiers ministériels et les intérêts pour retard de paiement).</p>

<h2>ARTICLE 10 : COMPÉTENCE ET CONTESTATION</h2>
<p>Seront seuls compétents en cas de litige de toute nature ou de contestation de la commande, les tribunaux français. Cette clause s’applique même en cas de référé, de demande incidente ou de pluralité des défendeurs.</p>


<h2>ARTICLE 11 : CRÉATION DE COMPTE</h2>
<p>Lors de la création du compte, nous collections les données que vous renseignez volontairement. Votre email est la seule donnée obligatoire pour créer votre compte. Certaines données optionnelles seront sauvegardées automatiquement sur votre compte lorsque vous effectuez une commande. Les données optionnelles sont les suivantes : nom, prénom, adresse, code postal, ville, pays, numéro de téléphone. Les données suivantes : nom, prénom, adresse, code postal, ville, pays, numéro de téléphone sont en revanche obligatoires pour passer commande.</p>

<h2>ARTICLE 12 : COOKIE</h2>
<p>Seuls les cookies analytiques cookies sont utilisés sur notre site : Il s’agit des cookies qui nous permettent de connaître l’utilisation et les performances de notre site et d’en améliorer le fonctionnement (par exemple, les pages le plus souvent consultées ou recherches des internautes dans le moteur). 
Vous pouvez à tout moment choisir de restreindre, bloquer, supprimer ou désactiver l’utilisation des cookies en modifiant la configuration de votre navigateur. Votre navigateur peut également être paramétré pour vous signaler les cookies qui sont déposés dans votre terminal et vous demander de les accepter ou non. Vous pouvez accepter ou refuser les cookies au cas par cas ou bien les refuser systématiquement une fois pour toutes. Vous pouvez effectuer ces opérations à tout moment.</p>
    </br>
    </div>
</div>

</body>

<!-- footer -->
<?php include('footer.php') ?>

<script>
</script>

</html>