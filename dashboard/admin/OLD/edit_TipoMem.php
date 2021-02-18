<?php
include '../../include/db_conn.php';
//Include functions file
include('../../include/functions.php');
page_protect();

if (isset($_REQUEST['id'])) {
    $memid = $_REQUEST['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Eidos Gym</title>
    <link rel="stylesheet" href="../../neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
    <link rel="stylesheet" href="../../neon/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
    <link rel="stylesheet" href="../../neon/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
    <link rel="stylesheet" href="../../neon/css/neon.css"  id="style-resource-5">
    <link rel="stylesheet" href="../../neon/css/custom.css"  id="style-resource-6">
	
	<!-- Estilo de campo requeridos * -->
	<style>
		.error {color: #FF0000;}
	</style>

    <!-- Theme framework -->
	<script src="../../js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="../../js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="../../js/demonstration.min.js"></script>

    <script src="../../neon/js/jquery-1.10.2.min.js"></script>

	<script src="../../js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="../../js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="../../js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="../../js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="../../js/plugins/jquery-ui/jquery.ui.spinner.js"></script>
	<script src="../../js/plugins/jquery-ui/jquery.ui.slider.js"></script>

    <SCRIPT LANGUAGE="JavaScript">
		function checkIt(evt) {
		    evt = (evt) ? evt : window.event
		    var charCode = (evt.which) ? evt.which : evt.keyCode
		    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		        status = "This field accepts numbers only."
		        return false
		    }
		    status = ""
		    return true
		}
	</SCRIPT>

	<script type="text/javascript" src="webcam.js"></script>
	
	<!-- Dual List Box -->
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap-duallistbox.css">
	<script src="../../js/jquery.bootstrap-duallistbox.js"></script>

</head>
    <body class="page-body  page-fade">

    	<div class="page-container">	
	
		<div class="sidebar-menu">
	
			<header class="logo-env">
			
				<!-- logo -->
				<div class="logo">
					<a href="main.php">
						<img src="../../img/EIDOS.jpg" width="150" height="150" alt="Eidos Gym" />
					</a>
				</div>
				
				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
					<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
						<i class="entypo-menu"></i>
					</a>
				</div>
								
				
				<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
						<i class="entypo-menu"></i>
					</a>
				</div>
			</header>

    		<?php include('../../include/nav.php'); ?>
    	</div>

    		<div class="main-content">
		
				<div class="row">
					
					<!-- Profile Info and Notifications -->
					<div class="col-md-6 col-sm-8 clearfix">	

					</div>
				
					<!-- Raw Links -->
					<div class="col-md-6 col-sm-4 clearfix hidden-xs">
						
						<ul class="list-inline links-list pull-right">


							<li>Bienvenido <?php echo $_SESSION['full_name']; ?> 
							</li>							
						
							<li>
								<a href="logout.php">
									Cerrar Sesión<i class="entypo-logout right"></i>
								</a>
							</li>
						</ul>
					</div>
			</div>

		<h3>Editar Socio</h3>

		<hr />

			<form action="edit_member_submit.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">

				<?php
	    
				    $query  = "select * from Persons WHERE id='$memid'";
				    //echo $query;
				    $result = mysqli_query($con, $query);
				    $sno    = 1;
				    
				    if (mysqli_affected_rows($con) == 1) {
				        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {							  
							  $login_id = $row['login_id'];
							  $pass_key = $row['pass_key'];
							  $security = $row['security'];
							  $level = $row['level'];
							  $Sex = $row['Sex'];
							  $name = $row['name'];
							  $LastName = $row['LastName'];							  
							  $UserPicProfile = $row['UserPicProfile'];
							  $Address = $row['Address'];
							  $CellPhone = $row['CellPhone'];
							  $LinePhone = $row['LinePhone'];
							  $EmergencyPhone = $row['EmergencyPhone'];
							  $EmergencyContactPerson = $row['EmergencyContactPerson'];
							  $EmergencyKinship = $row['EmergencyKinship'];
							  $Email = $row['Email'];							  
							  $BirthDate = $row['BirthDate'];
							  $TipoDoc = $row['TipoDoc'];							  							 
							  $Dni = $row['Dni'];							  							 
							  $nacionalidad = $row['nacionalidad'];							  							 
							  $Age = $row['Age'];
							  $Height = $row['Height'];
							  //$Weight = $row['Weight']; //Sale de otra tabla de valores relacionada por dni
							  //$BMI = $row['BMI']; //Sale de otra tabla de valores relacionada por dni
							  $observations = $row['observations'];
							  $SleepHours = $row['SleepHours'];
							  $GymAnterior = $row['GymAnterior'];
							  $yearstraining = $row['yearstraining'];
							  //Falta fecha inscripcion (FechaIns). Aunque podria ser cdate
							  $mem_type = $row['mem_type'];
							  $cuser = $row['cuser'];
							  $cdate = $row['cdate'];
							  $muser = $row['muser'];
							  $mdate = $row['mdate'];
				        }
				    }

				?>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">ID :</label>					
						<div class="col-sm-5">
							<input type="text" name="p_id" value="<?php echo $memid;?>" class="form-control" readonly/>
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Foto :</label>					
						<div class="col-sm-5">
							<script language="JavaScript">
									//document.write( webcam.get_html(300, 220) );
							</script>
							<script language="JavaScript">
								/*
								webcam.set_api_url( 'test.php' );
									webcam.set_quality( 100 ); // JPEG quality (1 - 100)
									webcam.set_shutter_sound( true ); // play shutter click sound
									webcam.set_hook( 'onComplete', 'my_completion_handler' );

									function take_snapshot(){
										// take snapshot and upload to server
										webcam.snap();
									}
								*/						
							</script>		
							<!-- input type=button  class="btn btn-primary" value="Take Snapshot" onClick="take_snapshot()" -->
							<input type="file" accept="image/*" capture="camera" />
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Nombre :</label>					
						<div class="col-sm-5">
							<input type="text" name="p_name" id="p_name" class="form-control"  data-rule-minlength="4" placeholder="Ingrese nombre" maxlength="30" value="<?php echo $name; ?>" autofocus required/>							
						</div>
				</div>
				
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Apellido :</label>					
						<div class="col-sm-5">
							<input type="text" name="Apellido" id="Apellido" class="form-control"  data-rule-minlength="4" placeholder="Ingrese apellido" maxlength="60" value="<?php echo $LastName; ?>" required/>
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Identificacion:</label>					
						<div class="col-sm-5">
							<select name="Ident" id="Ident"  class="form-control" value="<?php echo $TipoDoc; ?>" required>
									<option value="">-- Por favor seleccione --</option>
									<option value="DNI">DNI</option>							    								
									<option value="Pasaporte">Pasaporte</option>								
									<option value="Otros">Otros</option>
							</select>
							
						</div>
				</div>
				
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Numero Identificacion:</label>					
						<div class="col-sm-5">
							<input type="text" name="NroDNI"  id="NroDNI" class="form-control" data-rule-minlength="8" placeholder="Numero Identificacion" maxlength="60" value="<?php echo $Dni; ?>"  required/>						
						</div>
				</div>					
				
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Direccion :</label>					
						<div class="col-sm-5">
							<input type="text" name="add" id="textfield5" class="form-control"  data-rule-minlength="6" placeholder="Address" value="<?php echo $Address; ?>" required/>
						</div>
				</div>					

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Fecha de Nacimiento :</label>			
						<div class="col-sm-5">						
							<!-- La posta esta aca calendar de HTML5: -->
							<input type="date" name="birthdate" id="birthdate" step="1" min="1950-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date('Y-m-d',strtotime($BirthDate));?>" onchange="submitBday()" required/>
							<!-- Fin de La posta esta aca calendar de HTML5 -->
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Edad :</label>					
						<div class="col-sm-5">
							<input type="text" name="age" id="age" class="form-control"  data-rule-minlength="1" placeholder="Age"  maxlength="3" value="<?php echo $Age;?>" required/>
						</div>
				</div>						

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Sexo :</label>					
						<div class="col-sm-5">
							<select name="sex" id="sex"  class="form-control" value="<?php echo $Sex;?>" required>
								<option value="">-- Por favor seleccione --</option>
								<option value="1">Masculino</option>
								<option value="2">Femenino</option>
							</select>
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Altura :</label>					
						<div class="col-sm-5">
							<input type="text" name="height" id="height" class="form-control"  data-rule-minlength="1" placeholder="Height"  maxlength="3" onKeyPress="return checkIt(event)" value="<?php echo $Height;?>"  required/>
							<span class="selectRequiredMsg">(En  Cm)</span>
						</div>
				</div>		

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> ABM Peso:</label>					
						<div class="col-sm-5">
							<!-- Consultar tabla de peso y traer todos los valores -->
							<input type="text" name="weight" id="weight" class="form-control"  data-rule-minlength="1" placeholder="Weight"  maxlength="3" onKeyPress="return checkIt(event)" required/> 
							<span class="selectRequiredMsg">(En Kgrs)</span>
						</div>
				</div>	
				
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">ABM BMI:</label>					
						<div class="col-sm-5">
							<!-- Consultar tabla de BMI y traer todos los valores -->
							<input type="text" name="BMI" id="BMI" class="form-control"  data-rule-minlength="1" placeholder="Body Mass Index" onKeyPress="return checkIt(event)"  maxlength="10" />
						</div>
				</div>				

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Horas de sueño:</label>					
						<div class="col-sm-5">
							<input type="text" name="SleepHours"  id="SleepHours" class="form-control" data-rule-minlength="1" placeholder="Horas de sueño" maxlength="2" onKeyPress="return checkIt(event)" value="<?php echo $SleepHours;?>"  required/>
						</div>
				</div>		

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">ABM Amigos:</label>									
							<div class="col-md-5">
							<!-- 
							bootstrap-duallistbox-nonselected-list_duallistbox_demo2
							bootstrap-duallistbox-selected-list_duallistbox_demo2
							btn clear1 pull-right btn-default btn-xs
							-->
							</div>
							<div class="col-md-7">
								<?php
								//Ejecuto query para traer la lista de socios y los amigos si tuviere por nro de dni.
								$query = "select dni, CONCAT(name,' ', lastName) as nombre, EXISTS(SELECT Amigo_id FROM amigos WHERE dni_id ='".$Dni."' and amigo_id = Persons.dni) as selected from Persons";
								$result = mysqli_query($con, $query);
								if (mysqli_affected_rows($con) != 0) {
									//Llamo funcion para renderizar el select option:
									Html_OptionList_render($result, 1, "duallistbox_demo2[]", "");							
									}
								?>
							  <script>
								//var element = "<option value='1' selected>Prueba</option>";
								//var options = $("#duallistbox_demo2");
								//options.append(element);
													  
								var demo2 = $('.demo2').bootstrapDualListbox({
								  nonSelectedListLabel: 'Non-selected',
								  selectedListLabel: 'Selected',
								  preserveSelectionOnMove: 'moved',
								  moveOnSelect: false,
								  nonSelectedFilter: '' //Aca va el filtro por default
								});														
							  </script>
							</div>					
				</div>	
				
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">ABM Estudios:</label>					
						<div class="col-sm-5">
						<!-- Consultar tabla de Estudios y traer todos los valores -->	
							<input type="text" name="Estudios"  id="Estudios" class="form-control" data-rule-minlength="5" placeholder="Estudios" maxlength="250">
						</div>
				</div>				

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Nacionalidad :</label>					
						<div class="col-sm-5">
							<input type="text" name="nationality" id="nationality" class="form-control"  data-rule-minlength="6" placeholder="Nationality" value="<?php echo $nacionalidad;?>" required/>
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Email:</label>					
						<div class="col-sm-5">
							<input type="text" name="email"  id="email" class="form-control" data-rule-minlength="5" placeholder="E-Mail" maxlength="60" value="<?php echo $Email;?>" required/>
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Telefono Linea:</label>					
						<div class="col-sm-5">
							<input type="text" name="TeLinea"  id="TeLinea" class="form-control" data-rule-minlength="5" placeholder="Telefono de Linea" maxlength="60" onKeyPress="return checkIt(event)" value="<?php echo $LinePhone;?>"  />
						</div>
				</div>
				
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Celular:</label>					
						<div class="col-sm-5">
							<input type="text" name="Cel"  id="Cel" class="form-control" data-rule-minlength="5" placeholder="Celular" maxlength="60" onKeyPress="return checkIt(event)" value="<?php echo $CellPhone;?>" required/>
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Nombre Contacto:</label>					
						<div class="col-sm-5">
							<input type="text" name="contactName" id="contactName" class="form-control" data-rule-minlength="3" placeholder="Nombre contacto" maxlength="60" value="<?php echo $EmergencyContactPerson;?>" required/>
						</div>
				</div>	

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Parentesco Contacto:</label>					
						<div class="col-sm-5">
							<input type="text" name="Parentesco" id="Parentesco" class="form-control"  data-rule-minlength="12" placeholder="Parentesco del contacto" value="<?php echo $EmergencyKinship;?>" maxlength="12">
						</div>
				</div>			

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Telefono Contacto:</label>					
						<div class="col-sm-5">
							<input type="text" name="contacTel"  id="contacTel" class="form-control" data-rule-minlength="5" placeholder="Telefono del contacto" maxlength="60" onKeyPress="return checkIt(event)" value="<?php echo $EmergencyPhone;?>" required/>
						</div>
				</div>			

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Gym Anterior:</label>					
						<div class="col-sm-5">
							<input type="text" name="previousgym"  id="previousgym" class="form-control" data-rule-minlength="5" placeholder="Previous Gym" value="<?php echo $GymAnterior;?>" maxlength="60" />
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Años Entrenando:</label>					
						<div class="col-sm-5">
							<input type="text" name="yearstraining"  id="yearstraining" class="form-control" data-rule-minlength="1" placeholder="Years Training" maxlength="2" onKeyPress="return checkIt(event)" value="<?php echo $yearstraining;?>" />
						</div>
				</div>																						

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Observaciones:</label>					
						<div class="col-sm-5">
							<input type="text" name="Obs"  id="Obs" class="form-control" data-rule-minlength="5" placeholder="Observaciones" maxlength="250" value="<?php echo $observations;?>" />
						</div>
				</div>		
				
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Fecha Inscripcion :</label>					
						<div class="col-sm-5">
							<input type="text" name="FechaIns" id="textfield22" value="<?php echo $cdate; ?>">
						</div>
				</div>			

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Tipo Membresia :</label>					
						<div class="col-sm-5">
							 <select name="mem_type" id="id"  class="country" value="<?php echo $mem_type;?>">
								<option value="">-- Por favor seleccione --</option>
								<?php
									$query = "select * from mem_types";
									//echo $query;
									$result = mysqli_query($con, $query);

									if (mysqli_affected_rows($con) != 0) {
										while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
											echo "<option value=" . $row['mem_type_id'] . ">" . $row['name'] . "</option>";
											
										}
									}
								?>
							</select>

							<!-- span class="selectRequiredMsg">Por favor seleccione un articulo</span -->
						</div>					
				</div>
       
				<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-primary">Guardar Cambios</button>	
						</div>
				</div>					

			</form>

			<?php include('footer.php'); ?>
    	</div>


    <script src="../../neon/js/gsap/main-gsap.js" id="script-resource-1"></script>
    <script src="../../neon/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
    <script src="../../neon/js/bootstrap.min.js" id="script-resource-3"></script>
    <script src="../../neon/js/joinable.js" id="script-resource-4"></script>
    <script src="../../neon/js/resizeable.js" id="script-resource-5"></script>
    <script src="../../neon/js/neon-api.js" id="script-resource-6"></script>
    <script src="../../neon/js/jquery.validate.min.js" id="script-resource-7"></script>
    <script src="../../neon/js/neon-login.js" id="script-resource-8"></script>
    <script src="../../neon/js/neon-custom.js" id="script-resource-9"></script>
    <script src="../../neon/js/neon-demo.js" id="script-resource-10"></script>
    <script src="../../neon/js/bootstrap-datepicker.js" id="script-resource-11"></script>

  
</body>
</html>	

<?php
} else //No se envio correctamente el id, vuelve a la pagina de origen.
{
    //Falta el header a la pagina anterior aca.
}
?>