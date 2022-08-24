<?php
require_once "config/Users.php";
require_once "config/Paniers.php";
require_once "config/Sessions.php";

$users = new Users();
$paniers = new Paniers();
$sessions = new Sessions();

session_start();

$row_session = $sessions->find(session_id());
//Si une Session n'existe pas déjà avec le même numéro
if(empty($row_session)){
    $ret_id_session=$sessions->add(session_id(),"");
    $ret_id_panier=$paniers->add("Temp_".session_id());
    $ret_session_updt=$sessions->edit(session_id(),$ret_id_panier);
    //recherche a nouveau pour recuperer la structure
    $row_session = $sessions->find(session_id());
}
//Si une Session avec le même numéro est déjà trouvée (cas d'un payement)
else{

    $row_panier=$paniers->findwithPK($row_session["fk_panier"]);
    //Contrôle du statut du panier associé. Si payé on génère un nouveau panier et on mets à jour le panier de la session
    if($row_panier["statut"]=='PAYE')
    {
        $ret_id_panier=$paniers->add("Temp_".session_id());
        $ret_session_updt=$sessions->edit(session_id(),$ret_id_panier);
        //recherche a nouveau pour recuperer la structure avec nouveau panier
        $row_session = $sessions->find(session_id());
    }
    //Aucun panier payé on fait rien
    else
    {

    }
}


?>