
<?php
session_start();
require_once './includes/process.php';


//For post values.
$name_signup = null;
$email_signup = null;
$email_login = null;
$pass_login = null;


//Verður að skilgreina error array fyrir aðferðina okkar í process.php
$errors = ['emailerr' => 'Tölvupóstur er tómur eða ekki réttur!', 'nameerr' => 'Nafn vantar!', 'passerr' => 'Lykilorð vantar!', 'wrongpass' => '<p>Rangt notandanafn eða lykilorð!</p>'];

// check if the form has been submitted
if (isset($_POST['send_signup'])) {
  
  /* to prevent an attacker from injecting other variables in
     the $_POST array in an attempt to overwrite your default values. By processing only those variables
     that you expect, your form is much more secure.
  */
    // list expected fields
    $expected_frm_signup = ['name_signup','email_signup', 'pass_signup'];
    $required_frm_signup = ['email_signup', 'pass_signup','name_signup'];
    // sækjum skrá sem vinnur með input gögnin úr formi, $_POST[]


if(isset($_POST['name_signup'])){
$name_signup = $_POST['name_signup'];
}

if(isset($_POST['email_signup'])){
$email_signup = $_POST['email_signup'];
}

if(isset($_POST['pass_signup'])){
$pass_signup = $_POST['pass_signup'];
}

checkform($required_frm_signup,$expected_frm_signup);

if($name_signup != null && $email_signup != null && $pass_signup != null){
header("Location: thanksforsignup.php");

}
}


if (isset($_POST['login'])) {

    $required_frm_login = ['email_login', 'pass_login'];
    $expected_frm_login = ['email_login','pass_login'];


if (isset($_POST['email_login'])) {
  $email_login = $_POST['email_login'];
}

checkform($required_frm_login,$expected_frm_login);
 
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
    <input type="text" name="email_login" class="form-control" placeholder="Netfang" value="<?php echo $email_login ?>" autofocus>
      <?php
   
    checkforerror('email_login','emailerr');

  ?>

     <label for="lykilorð">Lykilorð</label>
    <input type="password" name="pass_login" class="form-control" placeholder="Lykilorð">
      
    <?php checkforerror('pass_login','passerr');?>

    <button type="submit" name="login">Innskrá</button>
   </form>

    <?php
    
  
      if (isset($_POST['pass_login']) && $_POST['pass_login'] === '12345') {//Checks if the post variablse are correct, else Wrong password

        $_SESSION['adminpass'] = '12345';//Set the session
        $_SESSION['start'] = time();

       header("Location: thanksforlogin.php");
       
   }


  
  ?>
   
   </div>
  </div>

   <div class="box col-lg-12">

   <form action="" method="POST">
    
    <label for="Netfang">Netfang</label>
    <input type="email" name ="email_signup" class="form-control" value="<?php echo $email_signup ?>"  placeholder="Netfang">
    <?php
    
   checkforerror('email_signup','emailerr');
  ?>
    <label for="Nafn">Nafn</label>
      <input type="name" name="name_signup" class="form-control" value="<?php echo $name_signup ?>" placeholder="Nafn">
    <?php 
        checkforerror('name_signup','nameerr');
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