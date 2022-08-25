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

$row_livraison = $livraisons->findwithPKPanier($fk_panier);
if(empty($row_livraison))
{
  if(isset($name_relais) && isset($address_relais) && isset($city_relais) && isset($fk_panier))
  {
    $ret_insert_relais=$livraisons->add_relais($fk_panier,'1',$name_relais,$address_relais,$city_relais,'test'); //on force le type car un choix dispo pour le moment
    $text_retour="Le relais a bien été ajouté";
  
  }
  else{
    $text_retour="Une erreur est survenue dans lajout du relais";
  }
}
else
{
  //edit
}



$retour = array(
  'text_ret' => $text_retour
);

echo json_encode($retour);

exit();
?>