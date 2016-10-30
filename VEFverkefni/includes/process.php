<?php
 use Imageclass\Image;
$missing = [];

function checkform($required,$expected){

  global $missing;//$missing er global array
  
  foreach ($_POST as $key => $value) {
  global ${$key};

   ${$key} = $_POST[$key];

  
  $temp = is_array($value) ? $value : trim($value);

  if (empty($temp) && in_array($key, $required)) {
     $missing[] = $key;

    ${$key} = '';
  }
   
//Checka hvort að emailið sé rétt 

   /* elseif(filter_var($_POST['email_signup'], FILTER_VALIDATE_EMAIL) === false && isset($_POST['email_signup'])){
     
      $missing[] = $key;
   }*/

  elseif (in_array($key, $expected) && in_array($key,$required)) {
  ${$key} = htmlentities($temp);//Nota htmlentities() til að reyna að koma í veg fyrir að kóði gæti sendst þarna inn.
   
  }

}

}

function checkforerror($checkinput,$err){

global $missing;
global $errors;

if(isset($_POST['pass_login']) && $_SESSION['adminpass'] !== true && $checkinput === 'pass_login'){
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

else{
 insert_to_database();

}

}

function insert_to_database(){
  require "./includes/connection.php";
$errors = [];
    if (!empty($errors)) {
       
       foreach ($errors as $error => $value) {
         echo $error;
       }
    }

     if (isset($_POST['send_signup'])) {
     
    $dbUsers = new Users($conn);
     
     foreach ($_POST as $key => $value) {
         $temp = is_array($value) ? $value : trim($value);
         ${$key} = htmlentities($temp);

     }

     $securepass = password_hash($pass_signup,PASSWORD_DEFAULT);
    $status = $dbUsers->newUser($name_signup,$lastname_signup,$email_signup,$username_signup,$securepass);
    

    if ($status != null) {
        $success = "$username_signup has been registered. You may now log in.";
        echo $success;
    }
    else{
        $errors[] = "$username_signup is already in use. Please choose another username.";
    } 
  }

}

function validate_user($username,$password){
  
 if (isset($_POST['login'])) {
  
 require "./includes/connection.php";
  $dbval = new Users($conn);
$hashtocompare = $dbval->GetPasshash($username);

if (password_verify($password,$hashtocompare)) {
  
 $_SESSION['start'] = time();
 $_SESSION['adminpass'] = true;
 //$_SESSION['username'] = $username;
 header("Location: thanksforlogin.php");
 echo "Login succeed!";
       
   }

   else{
    $_SESSION['adminpass'] = null;
    echo "Login failed!";
       
   }

}
}

function update_the_user($username,$first_name,$last_name,$user_email,$user_name,$user_pass){
  require "./includes/connection.php";
  require_once './Users.php';

   $dbupdate =  new Users($conn);
    if (isset($_POST['update_submit'])) {
   echo "USERNAMEEE: ".$username;
      $dbupdate->updateUser($username,$first_name,$last_name,$user_email,$user_name,$user_pass);
    }
}

function updateimageinfo($img,$new_image_name,$new_image_path,$new_image_description){
   require "./includes/connection.php";
   require_once './Image.php';
   
 
$updateimg = new Image($conn);
      if (isset($_POST['update_image_submit'])) {
   $updateimg->updateImageInfo($img,$new_image_name,$new_image_path,$new_image_description);
}

}




