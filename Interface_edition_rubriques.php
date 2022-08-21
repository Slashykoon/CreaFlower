<?php
require_once "config/Rubriques.php";
$rubriques = new Rubriques();


$cde_action=$_POST['cde_action'];
$nom_rubrique=$_POST['nom_rubrique'];
$description_rubrique= $_POST['description_rubrique'];
$TextReturn="";


//AJOUTER
if($cde_action == 1)
{

  if(isset($nom_rubrique))
  {
    $ret_insert_rub=$rubriques->add($nom_rubrique,nl2br($description_rubrique));

    /*if($rows_rubriques)
    {
        foreach ($rows_rubriques as $rubrique)
        {

        } 
    }*/

    $TextReturn="Rubrique correctement ajoutée !";
  }
  else
  {
    $TextReturn="Le nom de la rubrique n'a pas été rempli";
  }
}


//EDITER
if($cde_action == 2)
{
  //todo
  $TextReturn="Article correctement modifié !";
}

//supprimer
if($cde_action == 3)
{
  $TextReturn="Article correctement supprimé !";
}


$retour = array(
  'ret' => $TextReturn
);

header('Content-type: application/json');
echo json_encode($retour);
//print json_encode(array('message' => 'Erreur: ' . $id_to_supp , 'code' => 1));
exit();
?>