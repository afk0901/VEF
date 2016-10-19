<?php
namespace Delete;

class deletefile{
protected $Destination;
protected $Messages;

public function __construct($dest){

$this->Destination = $dest;

}

 function display_files(){
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
   	 }
   }

 echo '</form>';
   }
}
?>