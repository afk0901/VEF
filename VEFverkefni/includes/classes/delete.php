<?php
namespace Delete;
 use Imageclass\Image;


class deletefile{

protected $Destination;
protected $Messages;

public function __construct($dest){

$this->Destination = $dest;

}

 function display_files(){
   require "./includes/connection.php";
   require_once './Image.php';
   $delete_from_database = new Image($conn);
   $files = scandir($this->Destination);
   
   echo '<form action="" method="post">';
   foreach ($files as $key => $value) {

   if ($files[$key] != '.' && $files[$key] != '..') {
   
   	 echo '<p>'.$files[$key].'<input type="submit" name="delete'.$key.'" value="Delete"></p>';
     }
   	 
   }

foreach ($files as $key => $value) {
	if (isset($_POST['delete'.$key])) {
   	 unlink($this->Destination.$files[$key]);
       $dest_no_slash = str_replace('/', '', $this->Destination.$files[$key]);
       $dest_no_slash_no_backslash = str_replace('\\','', $dest_no_slash);

         $delete_from_database->deleteImageInfo($dest_no_slash_no_backslash);
   	 }
   }

 echo '</form>';
   }
}
?>