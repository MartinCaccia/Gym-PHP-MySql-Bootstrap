<?php
/*
account gmail
tls on
tls_certcheck off
auth on
host smtp.gmail.com
port 587
user user1@gmail.com
from user1@gmail.com
password yourgmailPassw0rd
*/
ini_set("SMTP","smtp.gmail.com" ); 
ini_set('smtp_port',587);
ini_set('sendmail_from', 'gymeidos@gmail.com'); 

// Varios destinatarios
//$para  = 'martin.caccia@gmail.com' . ', '; // atención a la coma
//$para .= 'rcaccia@hospitalaleman.com';

//Un solo destinatario
$para  = 'martin.caccia@gmail.com';

// título
$título = 'Recordatorio de cumpleaños para Agosto';

// mensaje
$mensaje = '
<html>
<head>
  <title>Recordatorio de cumpleaños para Agosto</title>
</head>
<body>
  <p>¡Estos son los cumpleaños para Agosto!</p>
  <table>
    <tr>
      <th>Quien</th><th>Día</th><th>Mes</th><th>Año</th>
    </tr>
    <tr>
      <td>Joe</td><td>3</td><td>Agosto</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17</td><td>Agosto</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
//$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$cabeceras .= 'To: '.$para."\r\n";
$cabeceras .= 'From: Gym Eidos <gymeidos@gmail.com>' . "\r\n"; //pass: GEidos12345
//$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
//$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Enviarlo
//mail($para, $título, $mensaje, $cabeceras);
$success = mail($para, $título, $mensaje, $cabeceras);
if (!$success) {
    $errorMessage = error_get_last()['message'];
}
?>