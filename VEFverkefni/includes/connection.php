<?php

$source = 'mysql:host=tsuts.tskoli.is;dbname=0901972749_picturebase';
$user = '0901972749';
$passw = 'mypassword';

// Sjá nánar um PDO t.d.: http://www.sitepoint.com/re-introducing-pdo-the-right-way-to-access-databases-in-php/ 
try {
	$conn = new PDO($source, $user, $passw);   
 	# Notum utf-8 og gerum það með SQL fyrirspurn exec sendir sql fyrirspurnir til database
 	$conn->exec('SET NAMES "utf8"');
echo 'Tenging tókst!';

} catch (PDOException $e) {
		echo 'Tenging mistókst: ' . $e->getMessage();
}
