<?php
//require 'db_conn.php';
include '../../include/db_conn.php';
page_protect();

//Include functions file
include('../../include/functions.php');

if (isset($_REQUEST['DNIValidation']))
{
	$DNIValidation = $_REQUEST['DNIValidation'];
}else {
	$DNIValidation = 0;
}	

//Si se inserto correctamente el nuevo socio:
if (isset($_REQUEST['DNI'])) {
    $NroDNI = $_REQUEST['DNI'];
//if ($DNIValidation == 1) {	
//$NroDNI   = rtrim($_SESSION['DNI_Value']);
//echo "NroDNI: ".$NroDNI;
//Traigo los datos del nuevo socio ingresado:
$query2 = "select * from Persons WHERE dni=".$NroDNI;
//echo $query2;
$result2 = mysqli_query($con, $query2);
//echo mysqli_affected_rows($con);


//Si existen los datos del nuevo socio:
if (mysqli_affected_rows($con) != 0) { 
$row = mysqli_fetch_array($result2, MYSQLI_ASSOC);
//Inicio obtener valores del socio:
  $id = $row['id'];
  $login_id = $row['login_id'];
  $pass_key = $row['pass_key'];
  $security = $row['security'];
  $level = $row['level'];
  $Sex = ($row['Sex'] == 1) ? 'Hombre' : 'Mujer';
  $name = $row['name'];
  $LastName = $row['LastName'];
  $full_name = $name." ".$LastName; 

  //Obtencion de la foto:
  //$UserPicProfile = $row['UserPicProfile'];
  //$img = imgPic($row['id'], "80", "80", "");
  //$img = imgPic($UserPicProfile, "", "", "");
  //echo "<img src='images/6.jpg' width='80' height='80' />";
  
  if (file_exists('images/'.$id.".jpg"))
  {
	$img = imgPic('../../dashboard/admin/images/'.$id.".jpg", "160", "120", "");
  }
  else
  {
	$img = imgPic(null, "", "", "");
  }
  
/*
  if (is_dir('images')){
	if ($dh = opendir('images')){
	  while (($file = readdir($dh)) !== false and ){
		//echo "filename:" . $file . "<br>";
		if ($file == $id."jpg") {$img=$id."jpg";} else {$filename=NULL;}
	  }
	  if ($filename==NULL) {$img = imgPic($row['UserPicProfile'], "80", "80", "");}
	  closedir($dh);
	}
  }

  $filelist = opendir('images') ;
  $photos = array();

	while ($campic = readdir($filelist)) 
		{
		if (strpos($campic, '.jpg') !== false  ) 
		{ $photos[] = $campic; }
		}
	closedir($filelist);
	rsort($photos);  # to display the most recent photos first

	foreach ($photos AS $photo ) 
		{ echo  ' <img width=320 height=240 src="images/'.$photo.'"> 
				<br> '.$photo.'<br> <br> <br>' ; }
*/
  //Fin obtencion de la foto
  $Address = $row['Address'];
  $CellPhone = $row['CellPhone'];
  $LinePhone = $row['LinePhone'];
  $EmergencyPhone = $row['EmergencyPhone'];
  $EmergencyContactPerson = $row['EmergencyContactPerson'];
  $EmergencyKinship = $row['EmergencyKinship'];
  $BirthDate = $row['BirthDate'];
  //Falta tipo documento (Ident)
  $Dni = $row['Dni'];
  //Falta nacionalidad (nationality)
  $Age = $row['Age'];
  $Height = $row['Height'];
  $Weight = 80; //$row['Weight']; //Va a venir de subquery de otra tabla
  //$BMI = $row['BMI']; //Va a venir de subquery de otra tabla
  $Observations = $row['observations'];
  $SleepHours = $row['SleepHours'];
  //Falta Gym anterior (previousgym)
  //Falta años entrenamiento (yearstraining)
  //Falta fecha inscripcion (FechaIns). Aunque podria ser cdate
  $mem_type_id = $row['mem_type_id'];
  $cuser = $row['cuser'];
  $cdate = $row['cdate'];
  //$muser = 'mcaccia';
  //$mdate = date();
  $Email = $row['Email'];
  $Datos = "Dirección: ".$Address."<br/>"."Email: ".$Email."<br/>"."Celular: ".$CellPhone;
//Fin obtener valores del socio. 

//Customizaciones:
$expiry = date('Y-m-d', strtotime("+1 months", strtotime($row['cdate'])));

$query = "select name from mem_types where id =".$mem_type_id;
//echo $query;
$result = mysqli_query($con, $query);
if (mysqli_affected_rows($con) != 0) {
 $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
 $mem_type_desc =$row2['name'];
}
//Fin customizaciones
?>
<!doctype html>
	<head>
		<meta charset="utf-8">
		<title>Recibo</title>		
		<link rel="stylesheet" href="../../neon/css/btn_glyphicon.css"  id="style-resource-3">	
		<link rel="stylesheet" href="style.css">
		
		<!-- script src="script.js"></script -->
		<script type="text/javascript" src="jquery-1.3.2.min.js"></script>

		<!-- link rel="stylesheet" href="../../neon/css/neon.css"  id="style-resource-5" -->
	</head>
	<body>
		<header>
			<!--a href="new_entry.php"--><h1>Nuevo Socio Eidos Gym</h1><!--/a-->

				<div style="width: 100%; display: table;">
					<div style="display: table-row">
						<!-- user Profile Pic -->
						<div style="display: table-cell; width: 33.33%;">
							<table class="inventory" style="width: 160;">
								<thead>
									<tr>
										<th style="text-align: center;">Foto</th>					
									</tr>				
								</thead>
								<tbody style="align: center;">
									<tr style="align: center;">
										<td style="align: center;"><?php echo $img; ?></td>
									</tr>
								</tbody>				
							</table>
						</div>
						<div style="display: table-cell; width: 33.33%;"></div>
						<!-- Logo EIDOS -->				
						<div style="display: table-cell; ">
							<a href="index.php">						
								<img src="../../img/EIDOS.jpg" width="150" height="150" alt="Eidos Gym" />
							</a>
						</div>
					</div>
				</div>

		</header>
		<article>
			<table class="inventory">
				<thead>
					<tr>
						<!-- th><span>Foto</span></th -->
						<th><span>ID Miembro / Reg ID</span></th>
						<th><span>Fecha Inscripción</span></th>
						<th><span>Datos</span></th>						
					</tr>				
				</thead>
				<tbody>
					<tr>
						<!-- td style="text-align: center;"><span><?php //echo $img; ?></span></td -->
						<td style="text-align: center;"><span><?php echo $id; ?></span></td>
						<td style="text-align: center;"><span><?php echo $cdate; ?></span></td>
						<td style="text-align: center;"><span><?php echo $Datos; ?></span></td>
					</tr>
				</tbody>				
			</table>	
			<table class="inventory">
				<thead>
					<tr>
						<th><span>Nombre y Apellido</span></th>
						<th><span>Edad, Sexo</span></th>
						<th><span>Altura / Peso</span></th>						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="text-align: center;"><span><?php echo $full_name; ?></span></td>
						<td style="text-align: center;"><span ><?php echo $Age . " / " . $Sex; ?></span></td>
						<td style="text-align: center;"><span><?php echo $Height . "  cm / " . $Weight . " Kgr."; ?></span></td>
					</tr>
				</tbody>
			</table>			
			<!-- Amigos -->
			<table class="inventory">
				<thead>
					<tr>
						<th>Amigos</th>									
					</tr>
				</thead>
					<tbody>
						<?php
							echo "<tr>";
							echo "<td>";
							echo "<div contenteditable>";
							//echo "<textarea rows='20' cols='80' name='amigos' id='amigos' wrap='hard' style='border: none;'>";
							//echo "<textarea name='amigos' id='amigos' wrap='hard' style='border: none; max-height: 200px; overflow: auto;'>";
								//Ejecuto query para traer la lista de socios y los amigos si tuviere por nro de dni.
								$query = "select  A.Amigo_id as dni, CONCAT(P.name,' ', P.lastName) as nombre from Persons P inner join amigos A on P.Dni = A.Amigo_id where A.Dni_id=".$Dni;
								$result = mysqli_query($con, $query);
								if (mysqli_affected_rows($con) != 0) {
									while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
										//Llamo funcion para renderizar el select option:
										//Html_OptionList_render($result, 1, "duallistbox_demo2[]", "");	
										//echo $row['nombre']." (Doc: ".$row['dni'].")\n";
										echo $row['nombre']." (Doc: ".$row['dni'].")<br/>";
									}
								}
							//echo "</textarea>";
							echo "</div>";
							echo "</td>";
							echo "</tr>";
						?>								
					</tbody>
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
						<td style="text-align: center;"><span><?php echo $mem_type_desc; ?></span></td>
						<td style="text-align: center;"><span><?php //echo $details . " For " . $days;?></span></td>
						<td style="text-align: center;"><span><?php echo $expiry; ?></span></td>
					</tr>
				</tbody>
			</table>				
									
			<table class="balance">
				<tr>
					<th><span>Total</span></th>
					<td><span data-prefix>$</span><span><?php //echo $total;?></span></td>
				</tr>
				<tr>
					<th><span>Pagado</span></th>
					<td><span data-prefix>$</span><span><?php //echo $paid;?></span></td>
				</tr>
				<tr>
					<th><span>Deuda</span></th>
					<td><span data-prefix>$</span><span><?php //echo $total - $paid;?></span></td>
				</tr>				
			</table>

			<div class="form-group">		
				<div class="col-sm-offset-3 col-sm-5">
				<?php
					//echo"	<a href='new_entry.php' class='btn btn-primary btn-blue a-btn-slide-text'>";
					echo"	<a onclick='history.go(-1);' class='btn btn-primary btn-blue a-btn-slide-text'>";					
					echo"		<span class='glyphicon glyphicon-backward' aria-hidden='true'></span>";
					echo"		<span><strong>Volver</strong></span>";            
					echo"	</a>";
				?>
				</div>
			</div>	
		<aside>
			<br/><br/>
			<h2><span style="text-decoration: underline;">Notas Adicionales</span></h2>
			<br/>
			<div>
				<p style="font-size:10px;">
				   1). Todos los socios deben respetar nuestros terminos, normas y condiciones. </br> </br> 
				   2). El pago no es transferible y no es reembolsable. </br> </br> 
				   3). ... </br> </br> 
				   4). Todos los socios deben vestir apropiadamente o según aconseja. </br> </br> 
				   5). Fumar NO está permitido en el gym. </br> </br> 
				   6). ...
				</p>   
			</div>			
		</aside>
				<center style="font-size:12px"><br/><br/><a href="view_mem.php"><?php include('../../include/footer.php'); ?></center>
		</article>				

	</body>
</html>
<?php
//die();
} else {
	mysqli_close($con);
    $location = 'new_entry.php?DNIValidation=No se pudieron obtener los datos del nuevo socio.';
	header_redirect($location, true, 303);
}
}else{
	mysqli_close($con);
    $location = 'new_entry.php?DNIValidation=No se pudo dar de alta correctamente al nuevo socio.';
	header_redirect($location, true, 303);
}    
?>