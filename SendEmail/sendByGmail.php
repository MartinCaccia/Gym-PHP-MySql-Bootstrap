<?php
// manage errors
error_reporting(E_ALL); // php errors
define('DISPLAY_XPM4_ERRORS', true); // display XPM4 errors
// path to 'MAIL.php' file from XPM4 package
require_once '../XPM4/MAIL.php';
// initialize MAIL class
$m = new MAIL;
// set from address
$m->From('gymeidos@gmail.com');
// add to address
$m->AddTo('martin.caccia@gmail.com');
// set subject
$m->Subject('Eidos Gym');
// set HTML message
$m->Html('<b>HTML</b> <u>Un mensaje en html aca</u>.');
// connect to MTA server 'smtp.gmail.com' port '465' via SSL ('tls' encryption)
// with authentication: 'username@gmail.com'/'password'
// set the connection timeout to 10 seconds, the name of your host 'localhost'
// and the authentication method to 'plain'
// make sure you have OpenSSL module (extension) enable on your php configuration
//$c = $m->Connect('smtp.gmail.com', 465, 'gymeidos@gmail.com', 'GEidos12345', 'tls', 10, 'pcse2pp1de0738', null, 'plain') or die(print_r($m->Result));
$c = $m->Connect('smtp.gmail.com', 465, 'gymeidos@gmail.com', 'GEidos12345') or die(print_r($m->Result));
// send mail relay using the '$c' resource connection
echo $m->Send($c) ? 'Mail sent !' : 'Error !';
// disconnect from server
$m->Disconnect();
?>