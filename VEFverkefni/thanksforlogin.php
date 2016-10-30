

<?php 
include_once'./includes/login_area.php';
$_SESSION['timedout'] = null;
$now = time();//Returns current time
$timelimit = 15*60;//Session time is set to 15 minutes

if(!isset($_SESSION['adminpass']) || $_SESSION['adminpass'] != 1){
    header("Location: ./login.php");
}

//If time now is greater than session that was set during login, session expires.
if (isset($_SESSION['start']) && $now > $_SESSION['start'] + $timelimit){

 	unset($_SESSION['adminpass']);//unset the session.
 	$_SESSION['timedout'] = 'Your session has timed out. Please login again.';

    header("Location: ./login.php");
}

echo '<p>The form is submitted, You are logged in</p>

<form action="" method="POST">
<button name="logout">Log Me Out</button>
</form>';

/*
else{
	header("Location: login.php");
}
*/
if(isset($_POST['logout'])){

unset($_SESSION['adminpass']);

header("Location: login.php");
}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
</body>
</html>

