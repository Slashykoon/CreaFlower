<?php

require_once "config/Produits.php";
require_once "config/Options.php";
require_once "config/Specifications.php";

$produits = new Produits();
$options = new Options();
$specifications = new Specifications();


$cde_action=$_POST['cde_action'];

$id_article = $_POST['id_article'];
$nom = $_POST['nom'];
$description = $_POST['description'];
$composition = $_POST['composition'];
$dimensions = $_POST['dimensions'];
$prix=$_POST['prix'];
$dict_specif_opt=$_POST['specif_opt'];

$TextReturn="";


  //AJOUTER
  if($cde_action == 1)
  {
  
    if(isset($nom,$description,$composition,$dimensions,$prix))
    {
      //genere une clé unique pour le dossier
      $VarUniqID=uniqid("", true);
      if (!file_exists('img_produits/'.$VarUniqID)) {
          mkdir('img_produits/'.$VarUniqID, 0777, true);
      }
      //copy du temp vers dossier courant
      $src='uploads';
      $dst='img_produits/'.$VarUniqID;
      
      // open the source directory
      $dir = opendir($src); 
      // Make the destination directory if not exist
      @mkdir($dst); 
      // Loop through the files in source directory
      foreach (scandir($src) as $file) { 
          if (( $file != '.' ) && ( $file != '..' )) { 
              if ( is_dir($src . '/' . $file) ) 
              { 
                  // Recursively calling custom copy function
                  // for sub directory 
                  custom_copy($src . '/' . $file, $dst . '/' . $file); 
              } 
              else { 
                  copy($src . '/' . $file, $dst . '/' . $file); 
              } 
          } 
      } 
      closedir($dir);
      
      // List of name of files inside
      // specified folder
      $files = glob($src.'/*'); 
        
      // Deleting all the files in the list
      foreach($files as $file) {
        
          if(is_file($file)) 
          
              // Delete the given file
              unlink($file); 
      }
      // Ajoute le produit
      $ret_id_prod=$produits->add($nom ,nl2br($description),nl2br($composition),nl2br($dimensions),$prix,$VarUniqID);

      // Ajoute la/les specifications
      $obj = json_decode($dict_specif_opt);
      foreach($obj as $mydata)
      {   
              // Ajoute la valeur de specif
              $ret_id_specif=$specifications->add($ret_id_prod ,$mydata->{'specification'});
              //Ajoute les options
              for ($i = 0; $i <= count($mydata->{'option'})-1; $i++) {
                $ret=$options->add($ret_id_specif,$mydata->{'option'}[$i],$mydata->{'prix'}[$i]);
              }

      }  


      $TextReturn="Article correctement ajouté !";
    }
    else
    {
      $TextReturn="Un des champs n'a pas été rempli";
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
  

  $rows_specifications=$specifications->GetAllSpecificationOfProduct($id_article);
  if(!empty($rows_specifications))
  {
      foreach ($rows_specifications as $spec)
      {
          $i=0;
          $specifications->delete($spec['pk_sp']);
          $rows_options = $options->findAllOptionsOfSpecification($spec['pk_sp']);
          foreach ($rows_options as $specif_options)
          {
              $options->delete($rows_options[$i]["fk_sp"]);
              $i=$i+1;
              //$options->delete($specif_options['fk_sp']);
          }
      }
  }
  
  $produits->delete($id_article );
  


  /*if (! is_dir($dirPath)) {
    throw new InvalidArgumentException("$dirPath must be a directory");
  }
  if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
      $dirPath .= '/';
  }
  $files = glob($dirPath . '*', GLOB_MARK);
  foreach ($files as $file) {
      if (is_dir($file)) {
          self::deleteDir($file);
      } else {
          unlink($file);
      }
  }
  rmdir($dirPath);*/

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