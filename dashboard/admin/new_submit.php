<?php
include '../../include/db_conn.php';
//Include functions file
include('../../include/functions.php');
page_protect();

//Inicio de debug params post:
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
  if (isset($_POST['Mediciones'])){
	$Mediciones = $_POST['Mediciones'];
  }else{
	$Mediciones = "";  
  }	
  $Observations = $_POST['Obs'];
  $SleepHours = $_POST['SleepHours'];
  //$amigos = isset($_POST['duallistbox_demo2']) ? 0 : $_POST['duallistbox_demo2']; //Persiste en otra tabla
  if (isset($_POST['duallistbox_demo2'])){
	$amigos = $_POST['duallistbox_demo2'];
  }else{
	$amigos = "";  
  }
echo "<pre>";
echo "<br/>arrayMediciones: ". is_array($Mediciones);
echo "<br/>arrayAmigos: ". is_array($amigos);
if (is_array($amigos)==1){
	echo "<br/>arrayAmigos";
}	
if (is_array($Mediciones)==1){
	echo "<br/>arrayMediciones<br/>";
}	
print_r($amigos);
print_r($Mediciones);
echo "</pre>";
die(); 
*/
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
	mysqli_close($con);
	header_redirect($location, true, 303);	

}
//Fin validacion DNI
/*
    function getRandomWord($len = 3)
    {
        $word = array_merge(range('a', 'z'), range('0', '9'));
        shuffle($word);
        return substr(implode($word), 0, $len);
    }
    
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
  `TipoDoc` varchar(20) DEFAULT NULL,
  `Dni` bigint(20) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Sex` int(1) NOT NULL,
  `nacionalidad` varchar(25) DEFAULT NULL,
  `UserPicProfile` varchar(250) DEFAULT NULL,
  `Address` varchar(250) NOT NULL,
  `CellPhone` varchar(50) DEFAULT NULL,
  `LinePhone` varchar(50) DEFAULT NULL,
  `EmergencyPhone` varchar(50) DEFAULT NULL,
  `EmergencyContactPerson` varchar(50) DEFAULT NULL,
  `EmergencyKinship` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `BirthDate` date NOT NULL,
  `Age` int(11) NOT NULL,
  `Height` int(11) NOT NULL,
  `SleepHours` int(11) NOT NULL,
  `GymAnterior` varchar(25) DEFAULT NULL,
  `yearstraining` int(2) DEFAULT NULL,
  `mem_type_id` int(11) NOT NULL,
  `observations` varchar(250) DEFAULT NULL,
  `Activo` int(1) DEFAULT NULL,
  `cuser` varchar(20) NOT NULL,
  `cdate` date NOT NULL,
  `muser` varchar(20) DEFAULT NULL,
  `mdate` date DEFAULT NULL,
*/

  $login_id = 'prueba';
  $pass_key = '12345';
  $security = 'Zero';
  $level = 0;
  $Sex = $_POST['sex'];
  $name = $_POST['p_name'];
  $LastName = $_POST['Apellido'];
  $full_name = $name." ".$LastName; 
  //$UserPicProfile = $_POST['UserPicProfile'];
  $UserPicProfile = null;
  $Address = $_POST['add'];
  $CellPhone = $_POST['Cel'];
  $LinePhone = $_POST['TeLinea'];
  $EmergencyPhone = $_POST['contacTel'];
  $EmergencyContactPerson = $_POST['contactName'];
  $EmergencyKinship = $_POST['Parentesco'];
  $BirthDate = $_POST['birthdate'];
  $TipoDoc = $_POST['Ident'];
  $Dni = $_POST['NroDNI'];
  //session_start();
  $_SESSION['DNI_Value']=$Dni;
  $nacionalidad = $_POST['nationality'];
  $Age = $_POST['age'];
  $Height = $_POST['height'];
  //$Weight = $_POST['weight']; //Persiste en otra tabla
  //$BMI = $_POST['BMI']; //Persiste en otra tabla
  //$Mediciones = isset($_POST['Mediciones']) ? 0 : $_POST['Mediciones']; //Persiste en otra tabla
  if (isset($_POST['Mediciones'])){
	$Mediciones = $_POST['Mediciones'];
  }else{
	$Mediciones = "";  
  }	
  $Observations = $_POST['Obs'];
  $SleepHours = $_POST['SleepHours'];
  //$amigos = isset($_POST['duallistbox_demo2']) ? 0 : $_POST['duallistbox_demo2']; //Persiste en otra tabla
  if (isset($_POST['duallistbox_demo2'])){
	$amigos = $_POST['duallistbox_demo2'];
  }else{
	$amigos = "";  
  }
  $GymAnterior = $_POST['previousgym'];
  $yt = $_POST['yearstraining'];
  $yearstraining = isset($yt) ? 0 : $yt; 
  //Falta fecha inscripcion (FechaIns). Aunque podria ser cdate
  $mem_type_id = $_POST['mem_type'];
  $cuser = 'mcaccia';
  $cdate = date('Y-m-d');
  //$muser = 'mcaccia';
  //$mdate = date();
  $Email = $_POST['email'];
//Fin obtener valores del formulario.  

//$p_id = $row['newid'];            
//mysqli_query($con, "UPDATE Persons SET name='$full_name', address='$address', zipcode='$zipcode', birthdate='$birthdate', contact='$contact', email='$email', height='$height', weight='$weight', nationality='$nationality', facebookaccount='$facebookaccount', twitteraccount='$twitteraccount', contactperson='$contactperson', previousgym='$previousgym', yearstraining='$yearstraining', joining='$date', age='$age', proof='$proof', other_proof='$other_proof', sex='$sex' WHERE wait='yes'");          

$Ins_Query = "INSERT INTO Persons (login_id, pass_key, security, level, Sex, name, LastName, UserPicProfile, Address, CellPhone, LinePhone, EmergencyPhone, EmergencyContactPerson,EmergencyKinship, BirthDate, TipoDoc, Dni, 
nacionalidad, Age, Height, observations, SleepHours, GymAnterior, yearstraining, mem_type_id, cuser, cdate, Email)
VALUES('$login_id', '$pass_key', '$security', '$level', '$Sex', '$name', '$LastName', '$UserPicProfile', '$Address', '$CellPhone', '$LinePhone', '$EmergencyPhone', '$EmergencyContactPerson', '$EmergencyKinship', '$BirthDate',
'$TipoDoc', $Dni, '$nacionalidad', '$Age', '$Height', '$Observations', '$SleepHours', '$GymAnterior', $yearstraining, '$mem_type_id', '$cuser', '$cdate', '$Email')";

//echo "Ins_Query: ". $Ins_Query;
//die(); 
//mysqli_query($con, $Ins_Query);

if (mysqli_query($con, $Ins_Query)) {
//echo "Entre ACA";
//die();
	
	//Amigos:
	$sql = array(); 	
	if (is_array($amigos)==1){
		//echo "Entre array amigos";
		//die();
		foreach( $amigos as $key => $value ) {
			if (!empty($value)){
				$sql[] = "(".$Dni.",".$value.")";
			}
		}
		$Query_amigos = "INSERT INTO amigos (Dni_id, Amigo_id) VALUES ".implode(',', $sql);
		//echo "Query_amigos: ".$Query_amigos;
		if (mysqli_query($con, $Query_amigos)){	
			//Inserto bien.								
		}
		else {
			$InsError = "No fue posible insertar los amigos del nuevo socio. <br/> Error: " . $Ins_Query . "<br/>" . mysqli_error($con);
			//echo "InsError: ". $InsError;
			//die();
			$location = 'new_entry.php?DNIValidation='.$InsError;
			mysqli_close($con);
			//Llamado a la funcion:
			header_redirect($location, true, 303);	
		}
	}
	//Mediciones:
	$sql = array(); 	
	if (is_array($Mediciones)==1){
		//echo "Entre array Mediciones";
		//die();
		foreach( $Mediciones as $key => $value ) {
			if (!empty($value)){
				$sql[] = "(".$Dni.",".$key.",".$value.",1,'".date('Y-m-d')."')";
			}
		}
		$Query_Mediciones = "INSERT INTO Mediciones (Dni_id, Tipo, Valor, Activo, FechaDesde) VALUES ".implode(',', $sql);
		//echo "Query_Mediciones: ".$Query_Mediciones;
		if (mysqli_query($con, $Query_Mediciones)){
			//echo "Inserto bien.";
			//die();
		}	
		else {
			$InsError = "No fue posible insertar las mediciones del nuevo socio. <br/> Error: " . $Ins_Query . "<br/>" . mysqli_error($con);
			//echo "InsError: ". $InsError;
			//die();
			$location = 'new_entry.php?DNIValidation='.$InsError;
			mysqli_close($con);
			//Llamado a la funcion:
			header_redirect($location, true, 303);	
		}
	}
	//echo "New record created successfully";
	//die();
	$location = 'new_socio.php?DNI='.$Dni;
	mysqli_close($con);
	header_redirect($location, true, 303);
	//$location = 'new_entry.php?DNIValidation=Nuevo socio ingresado correctamente.';
	//header_redirect($location, true, 303);		
} else {
    $InsError = "No es posible insertar el nuevo socio. <br/> Error: " . $Ins_Query . "<br/>" . mysqli_error($con);
	//echo "InsError: ". $InsError;
	//die();
	$location = 'new_entry.php?DNIValidation='.$InsError;
	mysqli_close($con);
	//Llamado a la funcion:
	header_redirect($location, true, 303);	
}
//die();
/*								
//echo "<html><head><script>alert('Member Added ,');</script></head></html>";            
//mysqli_query($con, "UPDATE Persons SET wait='no' WHERE wait='yes'");                   
} else {
    echo "<head><script>alert('Profile NOT Added, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=new_entry.php'>";
*/	
}    

?>