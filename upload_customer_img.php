<?php
header('Content-Type: application/json');

require_once "Session_management.php";

// Count total files
$countfiles = count($_FILES['files']['name']);

// Upload Location
$upload_location = "uploads_customer/";

// To store uploaded files path
$data = array();
//$errors    = array();
$data['errors'] = "";
$limit_allowed = $_POST["num_files_limit"];

// Loop all files
for($index = 0;$index < $countfiles;$index++){

   if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != ''){
      //500000 = 500kb
      $maxsize    = 4194304;
      $acceptable = array(
          'application/pdf',
          'image/jpeg',
          'image/jpg',
          'image/gif',
          'image/png'
      );
      if(($_FILES['files']['size'][$index] >= $maxsize) || ($_FILES["files"]["size"][$index] == 0)) {
         $data['errors'] = 'Le fichier est trop large. Il doit être inférieur à 4Mo';
      }

     if((!in_array($_FILES['files']['type'][$index], $acceptable)) && (!empty($_FILES["files"]["type"][$index]))) {
         $data['errors'] = 'Type de fichier invalide. Seulement les types PDF, JPG, GIF and PNG sont acceptés.';
      }

      $temp = explode(".", $_FILES["files"]["name"][$index]);
      
      $VarUniqID=uniqid("", false);//genere une clé unique pour le dossier
      $newfilename = $VarUniqID. '.' . end($temp);
      if($data['errors'] === "") 
      {
         if(move_uploaded_file($_FILES["files"]["tmp_name"][$index], "uploads_customer/". $newfilename)){
            $data['pathfile'] = "uploads_customer/" . $newfilename;
         }
      }
   }
}
//error_log(print_r($data, TRUE) );
echo json_encode($data);
die;