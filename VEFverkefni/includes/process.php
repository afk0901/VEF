<?php

$missing = [];


function checkform($required,$expected){
  global $missing;//$missing er global array

  foreach ($_POST as $key => $value) {
   
  $postkey = $_POST[$key];
  $temp = is_array($value) ? $value : trim($value);

  if (empty($temp) && in_array($key, $required)) {
     $missing[] = $key;

     ${$key} = '';
  }


//Checka hvort að emailið sé rétt 

elseif (isset($_POST['email_login'])) {
  

   if(filter_var($_POST['email_login'], FILTER_VALIDATE_EMAIL) === false){
     
      $missing[] = $key;
   }
}
    elseif(filter_var($_POST['email_signup'], FILTER_VALIDATE_EMAIL) === false && isset($_POST['email_signup'])){
     
      $missing[] = $key;
   }

  elseif (in_array($key, $expected) && in_array($key,$required)) {
   ${$key} = htmlentities($temp);//Nota htmlentities() til að reyna að koma í veg fyrir að kóði gæti sendst þarna inn.
   
  }

}

}

function checkforerror($checkinput,$err){

global $missing;
global $errors;

if(isset($_POST['pass_login']) && $_POST['pass_login'] !== '12345' && $checkinput === 'pass_login'){
     $wrongpass = '<p>Rangt lykilorð!</p>';
   }


elseif ($missing && in_array($checkinput, $missing)) {

    try {
     echo '<p>'.$errors[$err].'</p>';
}

  catch (Exception $e) {
  echo "Array expected, you have to decleare an array index for argument 2";
}


}



}