<?php
require_once "config/Livraison.php";


$livraisons = new Livraisons();

require_once "Session_management.php";
//require_once "Cart_Number_Update.php"; //pas d'update car c'est une requete ajax

$text_retour="Un problème est servenu !";

$name_relais = $_POST['name_relais'];
$address_relais = $_POST['address_relais'];
$city_relais = $_POST['city_relais'];
$fk_panier = $row_session['fk_panier'];

$nom_client = $_POST['nom_client'];
$prenom_client = $_POST['prenom_client'];
$adresse_client = $_POST['adresse_client'];
$email_client = $_POST['email_client'];

$date_evt = $_POST['date_evt'];
$choix_livraison = $_POST['choix_livraison'];

$row_livraison = $livraisons->findwithPKPanier($fk_panier);
if(empty($row_livraison))
{
  if(isset($name_relais) && isset($address_relais) && isset($city_relais) && isset($fk_panier))
  {
    $ret_insert_relais=$livraisons->add_relais_and_domicile($fk_panier,$choix_livraison,$name_relais,$address_relais,$city_relais,$email_client,$nom_client,$prenom_client,$adresse_client,$date_evt); //on force le type car un choix dispo pour le moment
    $text_retour="Le relais a bien été ajouté";
  }
  else
  {
    $text_retour="Une erreur est survenue dans lajout du relais";
  }
}
else
{
  //edit
  $ret_insert_relais=$livraisons->edit_relais_and_domicile($fk_panier,$choix_livraison,$name_relais,$address_relais,$city_relais,$email_client,$nom_client,$prenom_client,$adresse_client,$date_evt);
  $text_retour="Le relais a bien été modifié";
}



$retour = array(
  'text_ret' => $text_retour
);

echo json_encode($retour);

exit();
?>