<?php
session_start();
# use keyword must be declared at the top level of a script. It cannot be nested inside a conditional statement.
if(!isset($_SESSION['adminpass']) || $_SESSION['adminpass'] != 1){
    header("Location: ../login.php");
    exit;
}

use File\Upload; # declaration, so you can refer to the class as Upload rather than using the fully qualified name
use Delete\deletefile;

global $new_first_name;
global $new_last_name;
global $new_email;
global $new_user;
global $new_pass;

require_once './includes/classes/upload.php';
require_once './includes/classes/delete.php';
require_once './includes/process.php';

$destination = $_SERVER['DOCUMENT_ROOT'] . "/2t/0901972749/VEFverkefni/uploads/";
$deletefile = new deletefile($destination);

$deletefile->display_files();

if (isset($_POST['upload'])) {
    
    echo "<pre>";
    print_r($_FILES);  # Skoðum skráarupplýsingar
    echo "</pre>";
    
    // Because the object might throw an exception
    try {
        // búum til upload object til notkunar.  Sendum argument eða slóðina að upload möppunni sem á að geyma skrá
         $loader = new Upload($destination);
        // köllum á og notum move() fallið sem færir skrá í upload möppu, þurfum að gera þetta strax.

        $loader->upload(true);

        $result = $loader->getMessages();

        // köllum á getMessage til að fá skilaboð (error or not).
       // $result = $loader->getMessages();

    } catch (Exception $e) {
        echo $e->getMessage();  # ef við náum ekki að nota Upload class
    }
}


?>

<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Solutions 6-2 - Upload File</title>
</head>

<body>
    <?php

        // Keyrir ef það er búið að smella á submit 
        if (isset($result)) {
            echo '<ul>';
            //  Birta skilboðin úr messages array (Upload class).
            foreach ($result as $message) {
                echo "<li>$message</li>";
            }
            echo '</ul>';
        }
   

 if (isset($_POST['update_submit'])) {
     $required_update_vals = ['new_first_name','new_last_name','new_email','new_user','new_pass','username_now'];
    $expected_update_vals = ['new_first_name','new_last_name','new_email','new_user','new_pass','username_now'];
     print_r($_POST);
     checkform($required_update_vals,$expected_update_vals);
     $secure_new_pass = password_hash($new_pass,PASSWORD_DEFAULT);
      echo "USERNAMEEE: ".$new_email;
     update_the_user($username_now,$new_first_name,$new_last_name,$new_email,$new_user,$secure_new_pass);

}

if (isset($_POST['update_image_submit'])) {

    $required_update_img = ['new_image_name','img','new_image_path','new_image_description'];
    $expected_update_img = ['new_image_name','img','new_image_path','new_image_description'];
    checkform($required_update_img,$expected_update_img);
    echo "IMAGE NAME: ".$img;

    updateimageinfo($img,$new_image_name,$new_image_path,$new_image_description);
}
            
    ?>
    <form action="" method="post" enctype="multipart/form-data" id="uploadImage">
        <p>
            <label for="image">Upload image:</label>
            <input type="file" name="image[]" id="image" multiple>
        </p>
        <p>
            <input type="submit" name="upload" id="upload" value="Upload">
        </p>

          </form>

         <form action="" method="post">
           <h1>Uppfæra notanda</h1>
           <label for="username_now">Username</label>
           <input type="text" name="username_now" placeholder="username now...">
           <label for="update_username">Update Username</label>
           <input type="text" name="new_user" placeholder="New Username">
           <label for="update_password">Update New password</label>
           <input type="password" name="new_pass" placeholder="New Password">
           <label for="update_first_name">Update First Name</label>
           <input type="text" name="new_first_name" placeholder="New First Name">
           <label for="update_lastname">Update Last Name>
           <input type="text" name="new_last_name" placeholder="Update Last Name">
           <label for="update_user_email">Update Email</label>
           <input type="email" name="new_email" placeholder="Update Email">
            <input type="submit" name="update_submit" value="Update User">
         </form>

<form action="" method="post">
<h1>Uppfæra myndir</h1>
<label for="update_image_name">Current Imagename</label>
<input type="text" name="img" placeholder="Name Of Current Image">
<label for="update_image_name">Update Imagename</label>
<input type="text" name="new_image_name" placeholder="Imagename">
<label for="update_image_path">Update Imagepath</label>
<input type="text" name="new_image_path" placeholder="Imagepath">
<label>Update Imagedescription</label>
<input type="text" name="new_image_description" placeholder="Imagedescription">
<input type="submit" name="update_image_submit" value="Update Images">

</form>


</body>
</html>