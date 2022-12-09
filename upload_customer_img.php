<?php
header('Content-Type: application/json');

require_once "Session_management.php";

// Count total files
$countfiles = count($_FILES['files']['name']);

// Upload Location
$upload_location = "uploads_customer/";

// To store uploaded files path
$files_arr = array();

$limit_allowed = $_POST["num_files_limit"];

//$toto=$_FILES['num_files_limit'];
// Loop all files
for($index = 0;$index < $countfiles;$index++){

   if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != ''){
      //error_log("fichier non vide",0);
      $errors     = array();
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
         $errors[] = 'Le fichier est trop large. Il doit être inférieur à 4Mo';
      }
 
     if((!in_array($_FILES['files']['type'][$index], $acceptable)) && (!empty($_FILES["files"]["type"][$index]))) {
         $errors[] = 'Invalid file type. Only PDF, JPG, GIF and PNG types are accepted.';
      }

  
      $temp = explode(".", $_FILES["files"]["name"][$index]);
      $newfilename = session_id() . '.' . end($temp);
      if(count($errors) === 0) 
      {
         if(move_uploaded_file($_FILES["files"]["tmp_name"][$index], "uploads_customer/" . $newfilename)){
            $files_arr[] = "uploads_customer/" . $newfilename;
         }
      }
      /*else 
      {
         foreach($errors as $error) {
               echo '<script>alert("'.$error.'");</script>';
         }
         die(); //Ensure no more processing is done
      }*/
   }
}
//echo $countfiles;

echo json_encode($errors);
die;