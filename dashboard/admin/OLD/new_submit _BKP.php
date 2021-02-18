<?php
//require 'db_conn.php';
include '../../include/db_conn.php';
page_protect();

//Include functions file
include('../../include/functions.php');

//Inicio de debug params post:
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
//die();
//Fin debug params post.

//if (isset($_POST['p_name']) && isset($_POST['mem_type']) && isset($_POST['total']) && isset($_POST['age']) && isset($_POST['paid'])) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {	

$NroDNI   = rtrim($_POST['NroDNI']);
//Valido que no exista un ingreso con el mismo DNI
$query2 = "select dni from Persons WHERE dni=".$NroDNI;
//echo $query2;
$result2 = mysqli_query($con, $query2);
//echo mysqli_affected_rows($con);
//die();

if (mysqli_affected_rows($con) >= 1) { 
	//echo "Entre";
	//die();
    //echo "<html><head><script>alert('No se puede dar de alta, DNI ya ingresado.');</script></head></html>";
    //echo "<meta http-equiv='refresh' content='0; url=new_entry.php'>";
	//session_destroy();
    //echo "<meta http-equiv='refresh' content='0; url=new_entry.php?DNIValidation=1'>";
	/* Redirecciona a una página diferente en el mismo directorio el cual se hizo la petición */
	//$host  = $_SERVER['HTTP_HOST'];
	//$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');	
	//header("Location: http://$host$uri/$extra");
	//echo "<meta http-equiv='refresh' content='0; url=".$host.$uri."/".$extra."'>";
	//echo $host.$uri."/".$extra;
	//die();	
    $location = 'new_entry.php?DNIValidation=No es posible dar de alta, DNI ya existente.';
	//Llamado a la funcion:
	header_redirect($location, true, 303);	

}
//Fin validacion DNI

    function getRandomWord($len = 3)
    {
        $word = array_merge(range('a', 'z'), range('0', '9'));
        shuffle($word);
        return substr(implode($word), 0, $len);
    }
/*    
    $proof = $_POST['proof'];
    if (isset($_POST['other_proof'])) {
        $other_proof = $_POST['other_proof'];
    } else {
        $other_proof = " ";
    }
    $invoice   = substr(time(), 2, 10) . getRandomWord();
*/

//Obtengo valores del formulario:	
/* Tabla Persons:  
  `login_id` varchar(20) NOT NULL,
  `pass_key` varchar(30) NOT NULL,
  `security` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `Sex` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `UserPicProfile` varchar(250) DEFAULT NULL,
  `Address` varchar(50) NOT NULL,
  `CellPhone` varchar(50) DEFAULT NULL,
  `LinePhone` varchar(50) DEFAULT NULL,
  `EmergencyPhone` varchar(50) DEFAULT NULL,
  `EmergencyContactPerson` varchar(50) DEFAULT NULL,
  `EmergencyKinship` varchar(50) DEFAULT NULL,
  `BirthDate` date NOT NULL,
  `Dni` int(11) NOT NULL,
  `Age` int(11) NOT NULL,
  `Height` int(11) NOT NULL,
  `observations` varchar(250) DEFAULT NULL,
  `SleepHours` int(11) NOT NULL,
  `cuser` varchar(20) NOT NULL,
  `cdate` date NOT NULL,
  `muser` varchar(20) NOT NULL,
  `mdate` date NOT NULL,
  `Email` varchar(100) DEFAULT NULL
*/

  $login_id = 'prueba';
  $pass_key = '12345';
  $security = 'Zero';
  $level = 0;
  $Sex = $_POST['sex'];
  $name = $_POST['p_name'];
  $LastName = $_POST['Apellido'];
  $full_name = $name." ".$LastName; 
  $UserPicProfile = 'PruebaPic';
  $Address = $_POST['add'];
  $CellPhone = $_POST['Cel'];
  $LinePhone = $_POST['TeLinea'];
  $EmergencyPhone = $_POST['contacTel'];
  $EmergencyContactPerson = $_POST['contactName'];
  $EmergencyKinship = $_POST['Parentesco'];
  $BirthDate = $_POST['birthdate'];
  //Falta tipo documento (Ident)
  $Dni = $_POST['NroDNI'];
  //Falta nacionalidad (nationality)
  $Age = $_POST['age'];
  $Height = $_POST['height'];
  $Weight = $_POST['weight'];
  $BMI = $_POST['BMI'];
  $Observations = $_POST['Obs'];
  $SleepHours = $_POST['SleepHours'];
  //Falta Gym anterior (previousgym)
  //Falta años entrenamiento (yearstraining)
  //Falta fecha inscripcion (FechaIns). Aunque podria ser cdate
  //Falta Tipo de membresia (mem_type)
  $cuser = 'mcaccia';
  $cdate = date('Y-m-d');
  //$muser = 'mcaccia';
  //$mdate = date();
  $Email = $_POST['email'];
//Fin obtener valores del formulario.  

 //$p_id = $row['newid'];            
 //mysqli_query($con, "UPDATE Persons SET name='$full_name', address='$address', zipcode='$zipcode', birthdate='$birthdate', contact='$contact', email='$email', height='$height', weight='$weight', nationality='$nationality', facebookaccount='$facebookaccount', twitteraccount='$twitteraccount', contactperson='$contactperson', previousgym='$previousgym', yearstraining='$yearstraining', joining='$date', age='$age', proof='$proof', other_proof='$other_proof', sex='$sex' WHERE wait='yes'");          

$Ins_Query = "INSERT INTO Persons (login_id, pass_key, security, level, Sex, name, LastName, UserPicProfile, Address, CellPhone, LinePhone, EmergencyPhone, EmergencyContactPerson,EmergencyKinship, BirthDate, Dni, Age, Height, 
observations, SleepHours, cuser, cdate, Email)
VALUES('$login_id', '$pass_key', '$security', '$level', '$Sex', '$name', '$LastName', '$UserPicProfile', '$Address', '$CellPhone', '$LinePhone', '$EmergencyPhone', '$EmergencyContactPerson', '$EmergencyKinship', '$BirthDate',
$Dni, '$Age', '$Height', '$Observations', '$SleepHours', '$cuser', '$cdate', '$Email')";

//echo "Ins_Query: ". $Ins_Query;
//die();
 
//mysqli_query($con, $Ins_Query);

if (mysqli_query($con, $Ins_Query)) {
    //echo "New record created successfully";
	//$location = 'new_entry.php?DNIValidation=Nuevo socio ingresado correctamente.';
	//header_redirect($location, true, 303);
?>
<!doctype html>

	<head>
		<meta charset="utf-8">
		<title>Recibo</title>
		<link rel="stylesheet" href="style.css">
		<script src="script.js"></script>
		<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="jquery-barcode.js"></script>
	</head>
	<body>
		<header>
			<a href="new_entry.php"><h1>Nuevo Socio Eidos Gym</h1></a>
			<span>
				<!-- img alt="" src="../../img/logo.png" -->
							<!-- logo -->
				<div class="logo">
					<a href="index.php">
						<!-- img src="../../img/logo.png" alt="" width="192" height="80" / -->
						<img src="../../img/EIDOS.jpg" width="150" height="150" alt="Eidos Gym" />
					</a>
				</div>
			</span>
		</header>
		<article>
			<table class="meta">
			<!-- img alt="" src="pic1.jpg" width="100" height="100" -->	
				<!--tr>
					<th><span  >Recibo #</span></th>
					<td><span  ><?php //echo $invoice; ?></span></td>
				</tr-->
				<tr>
					<th><span>Foto</span></th>
					<td><span><?php //echo $invoice; ?></span></td>
				</tr>
				<tr>
					<th><span>Fecha</span></th>
					<td><span><?php echo $cdate; ?></span></td>
				</tr>
				<tr>
					<th><span>ID Miembro / Reg ID</span></th>
					<td><span>
					<?php
					//		$regid = substr($p_id, 6, 10);
					//		echo $p_id . " / " . $regid;
					?>
					</span></td>
				</tr>
			</table>	
			<table class="meta">
				<tr>
					<th><span>Nombre y Apellido</span></th>
					<td><span><?php echo $full_name; ?></span></td>
				</tr>
				<tr>
					<th><span>Edad, Sexo</span></th>
					<td><span><?php echo $Age . " / " . $Sex; ?></span></td>
				</tr>
				<tr>
					<th><span>Altura / Peso</span></th>
					<td><?php echo $Height . "  cm / " . $Weight . " Kgr."; ?></span></td>
				</tr>
			</table>	
			<table class="inventory">
				<thead>
					<tr>
						<th><span>Tipo Membresia</span></th>
						<th><span>Detalles</span></th>
						<th><span>Expiracion de suscripción</span></th>
						
					</tr>
				</thead>

				<tbody>
					<tr>
						<td><span  ><?php //echo $name_type;?></span></td>
						<td><span  ><?php //echo $details . " For " . $days;?></span></td>
						<td><span  ><?php //echo $expiry;?></span></td>
					</tr>
				</tbody>
			</table>
									
			<table class="balance">
				<tr>
					<th><span>Total</span></th>
					<td><span data-prefix>$</span><span><?php //echo $total;?></span></td>
				</tr><tr>
					<th><span>Pagado</span></th>
					<td><span data-prefix>$</span><span><?php //echo $paid;?></span></td>
				</tr><tr>
					<th><span>Deuda</span></th>
					<td><span data-prefix>$</span><span><?php //echo $total - $paid;?></span></td>
				</tr>				
			</table>
		</article>
		<aside>
			<h2><span>Notas Adicionales</span></h2>
			<div>
				<p style="font-size:10px;">
				   1). Todos los miembros deben respetar nuestros TNC / normas normalmente de miembros podrán retirarse. </br> </br> 
				   2). El pago no es transferible y no es reembolsable. </br> </br> 
				   3). Comision en caso de presentarse dentro de los 5 días hábiles antes de la expiración sometidos , de lo contrario 100 PHP / día se le cobrará. </br> </br> 
				   4). Todos los usuarios deben vestir apropiadamente O según aconseja. </br> </br> 
				   5). Fumar NO está permitido en el gym. </br> </br> 
				   6). Un PHP 1000 para romper / scracthing gafas que pertenecen a "gimnasio Eidos" se impondrá.
				</p>   
			</div>
		</aside>
		<center><br><br><a href="view_mem.php">Eidos Gym</center>
	</body>
</html>
<?php

	//$location = 'new_entry.php?DNIValidation=Nuevo socio ingresado correctamente.';
	//header_redirect($location, true, 303);

} else {
    echo "Error: " . $Ins_Query . "<br>" . mysqli_error($con);
}

mysqli_close($con);

/*								
//echo "<html><head><script>alert('Member Added ,');</script></head></html>";            
//mysqli_query($con, "UPDATE Persons SET wait='no' WHERE wait='yes'");                   
} else {
    echo "<head><script>alert('Profile NOT Added, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=new_entry.php'>";
*/	
}    

?>