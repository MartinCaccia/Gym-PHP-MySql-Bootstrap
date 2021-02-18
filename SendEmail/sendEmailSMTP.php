<?php
// manage errors
error_reporting(E_ALL); // php errors
define('DISPLAY_XPM4_ERRORS', true); // display XPM4 errors
// path to 'SMTP.php' file from XPM4 package
require_once '../XPM4/SMTP.php';
$f = 'gymeidos@gmail.com'; // from (Gmail mail address)
$t = 'martin.caccia@gmail.com'; // to mail address
$p = 'password'; // Gmail password
// standard mail message RFC2822
$m = 'From: '.$f."\r\n".
     'To: '.$t."\r\n".
     'Subject: test'."\r\n".
     'Content-Type: text/plain'."\r\n\r\n".
     'Text message.';
// connect to MTA server (relay) 'smtp.gmail.com' via SSL (TLS encryption) with 
// authentication using port '465' and timeout '10' secounds
// make sure you have OpenSSL module (extension) enable on your php configuration
$c = SMTP::connect('smtp.gmail.com', 465, $f, $p, 'tls', 10) or die(print_r($_RESULT));
// send mail relay
$s = SMTP::send($c, array($t), $m, $f);
// print result
if ($s) echo 'Sent !';
else print_r($_RESULT);
// disconnect
SMTP::disconnect($c);
?>