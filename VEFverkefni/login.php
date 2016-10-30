
<?php
session_start();
unset($_SESSION['adminpass']);
global $username;
global $pass_login;
global $name_signup;
global $lastname_signup;
global $email_signup;
global $pass_signup;
global $username_signup;

require_once './includes/process.php';
require_once './includes/connection.php';
require_once 'Users.php';
//print_r($_POST);
//For post values.

//Verður að skilgreina error array fyrir aðferðina okkar í process.php
$errors = ['emailerr' => 'Tölvupóstur er tómur eða ekki réttur!', 'nameerr' => 'Nafn vantar!', 'passerr' => 'Lykilorð vantar!', 'wrongpass' => '<p>Rangt notandanafn eða lykilorð!</p>', 'usernameerr'=> 'Notandanafn vantar!'];

// check if the form has been submitted
if (isset($_POST['send_signup'])) {
  
  /* to prevent an attacker from injecting other variables in
     the $_POST array in an attempt to overwrite your default values. By processing only those variables
     that you expect, your form is much more secure.
  */
    // list expected fields
    $expected_frm_signup = ['name_signup','email_signup','username_signup' ,'pass_signup','lastname_signup'];
    $required_frm_signup = ['email_signup', 'username_signup' ,'pass_signup','name_signup','lastname_signup'];
    // sækjum skrá sem vinnur með input gögnin úr formi, $_POST[]
checkform($required_frm_signup,$expected_frm_signup);

}


if (isset($_POST['login'])) {

    $required_frm_login = ['username', 'pass_login'];
    $expected_frm_login = ['username','pass_login'];
    checkform($required_frm_login,$expected_frm_login);
    $_SESSION['username'] = $username;
    validate_user($username,$pass_login);
  }

?>

<!DOCTYPE html>
<html>
<?php 
include_once './includes/header.php';
?>
<head>

</head>
<body>

<div class="container">

<?php 
include './includes/banner.php';
include './includes/menu.php';
 ?>

 <div class="content">
 
<div class="row">

  <div class="box col-lg-6">
   
   <p><?php if(isset($_SESSION['timedout'])){ echo $_SESSION['timedout']; }?></p>

   <div class="formgroup">
   <form action="" method="POST">
    
    <label for="emailoruser">Netfang/notandanafn</label>
    <input type="text" name="username" class="form-control" placeholder="Notandanafn" value="<?php echo $username ?>" autofocus>
      <?php
   
    checkforerror('username','usernameerr');
    
  ?>

     <label for="lykilorð">Lykilorð</label>
    <input type="password" name="pass_login" class="form-control" placeholder="Lykilorð">
      
    <?php checkforerror('pass_login','passerr');?>

    <button type="submit" name="login">Innskrá</button>
    <?php /*echo $_POST['username'];
    echo $_POST['pass_login'];*/
    ?>
   </form>
   
   </div>
  </div>

   <div class="box col-lg-12">

   <form action="" method="POST">
    
    <label for="Netfang">Netfang</label>
    <input type="email" name ="email_signup" class="form-control" value="<?php echo $email_signup ?>"  placeholder="Netfang">
    <?php
    
   checkforerror('email_signup','emailerr');
   
  ?>
    <label for="Nafn">Fornafn</label>
      <input type="name" name="name_signup" class="form-control" value="<?php echo $name_signup ?>" placeholder="Nafn">
    <?php 
        checkforerror('name_signup','nameerr');
  ?>

  <label for="Nafn">Eftirnafn</label>
      <input type="name" name="lastname_signup" class="form-control" value="<?php echo $lastname_signup ?>" placeholder="Nafn">
    <?php 
        checkforerror('lastname_signup','nameerr');
  ?>

  <label for="Nafn">Notandanafn</label>
      <input type="name" name="username_signup" class="form-control" value="<?php echo $username_signup ?>" placeholder="Nafn">
    <?php 
        checkforerror('username_signup','nameerr');
  ?>

     <label for="lykilorð">Lykilorð</label>
    <input type="password" name="pass_signup" class="form-control" placeholder="Lykilorð">
  <?php 
  
      checkforerror('pass_signup','passerr');
   
?>
    <button type="submit" name="send_signup">Nýskrá Mig</button>
   </form>

  </div>

 </div>

</div>

</body>
</html>