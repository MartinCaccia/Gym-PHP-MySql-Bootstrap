<?php
include '../../include/db_conn.php';
//Include functions file
include('../../include/functions.php');
page_protect();

if (isset($_POST['dni'])) {
    
    $Dni_id  = rtrim($_POST['dni']);
	$id  	 = rtrim($_POST['userId']);
    
	if (
	   !empty($_POST['Tipo']) && !empty($_POST['Valor']) &&
	   is_array($_POST['Tipo']) && is_array($_POST['Valor']) &&
	   count($_POST['Tipo']) === count($_POST['Valor'])
	) {
		$Tipo_array = $_POST['Tipo'];
		$Valor_array = $_POST['Valor'];
		for ($i = 0; $i < count($Tipo_array); $i++) {

			$Tipo = $Tipo_array[$i]; //mysqli_real_escape_string($Tipo_array[$i]);
			$Valor = $Valor_array[$i]; //mysqli_real_escape_string($Valor_array[$i]);
			if ($Valor != NULL){
				$query_upd = "UPDATE Mediciones SET FechaHasta ='".date('Y-m-d')."', Activo = 0 WHERE Dni_id=".$Dni_id." and Tipo=".$Tipo." and Activo=1";
				$query_ins = "INSERT INTO Mediciones (Dni_id, Tipo, Valor, Activo, FechaDesde) VALUES (".$Dni_id.",".$Tipo.",".$Valor.",1,'".date('Y-m-d')."')";				
				//echo "<pre>".$query_ins."</pre>";
				//echo "<pre>".$query_upd."</pre>";
				mysqli_query($con, $query_upd);
				mysqli_query($con, $query_ins);				
			}
		} 
	}
    //die();
    //echo "<meta http-equiv='refresh' content='0; url=new_health_status.php?id=".$id.">";
	mysqli_close($con);
	$location = 'new_health_status.php?id='.$id;
	//Llamado a la funcion:
	header_redirect($location, true, 303);
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=view_health.php'>";
    
}
?>
