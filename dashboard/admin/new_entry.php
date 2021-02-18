<?php
//require 'db_conn.php';
include '../../include/db_conn.php';
page_protect();
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

	<!-- jQuery UI -->
	<link rel="stylesheet" href="../../css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="../../css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="../../css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="../../css/plugins/fullcalendar/fullcalendar.print.css" media="print">

	<!-- Tagsinput -->
	<link rel="stylesheet" href="../../css/plugins/tagsinput/jquery.tagsinput.css">
	<!-- chosen -->
	<link rel="stylesheet" href="../../css/plugins/chosen/chosen.css">
	<!-- multi select -->
	<link rel="stylesheet" href="../../css/plugins/multiselect/multi-select.css">
	<!-- timepicker -->
	<link rel="stylesheet" href="../../css/plugins/timepicker/bootstrap-timepicker.min.css">
	<!-- colorpicker -->
	<link rel="stylesheet" href="../../css/plugins/colorpicker/colorpicker.css">
	<!-- Datepicker -->
	<link rel="stylesheet" href="../../css/plugins/datepicker/datepicker.css">
	<!-- Plupload -->
	<link rel="stylesheet" href="../../css/plugins/plupload/jquery.plupload.queue.css">

	<!-- Estilo de campo requeridos -->
	<style>
		.error {color: #FF0000;}
	</style>

	<style>
		.camcontent{
		display: block;
		position: relative;
		overflow: hidden;
		height: 240px;
		margin: auto;
		}
		/*
		.cambuttons button {
		border-radius: 15px;
		font-size: 18px;
		}
		.cambuttons button:hover {
		cursor: pointer;
		border-radius: 15px;
		background: #00dd00 ;    
		}
		*/
	</style>

	<!-- jQuery -->
	<script src="../../js/jquery.min.js"></script>
	<!-- jQuery UI -->
	<script src="../../js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="../../js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="../../js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="../../js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="../../js/plugins/jquery-ui/jquery.ui.spinner.js"></script>
	<script src="../../js/plugins/jquery-ui/jquery.ui.slider.js"></script>
	<!-- Bootstrap -->
	<script src="../../js/bootstrap.min.js"></script>
	<!-- Datepicker -->
	<script src="../../js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Timepicker -->
	<script src="../../js/plugins/timepicker/bootstrap-timepicker.min.js"></script>	
	<!-- Theme framework -->
	<script src="../../js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="../../js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="../../js/demonstration.min.js"></script>

	<!-- Scripts para toma de foto de perfil -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>
        // Put event listeners into place
        window.addEventListener("DOMContentLoaded", function() {
            // Grab elements, create settings, etc.
            var canvas = document.getElementById("canvas"),
                context = canvas.getContext("2d"),
                video = document.getElementById("video"),
                videoObj = { "video": true },
                image_format= "jpeg",
                jpeg_quality= 85,
                errBack = function(error) {
                console.log("Video capture error: ", error.code); 
                };

            // Put video listeners into place
            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) { // Standard
                	//navigator.getUserMedia(videoObj, function(stream) {
                    //video.src = stream;
                    //video.play();
					navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        			video.src = window.URL.createObjectURL(stream);
        			video.play();
                    $("#snap").show();					
                }, errBack);
            } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
                navigator.webkitGetUserMedia(videoObj, function(stream){
                    video.src = window.webkitURL.createObjectURL(stream);
                    video.play();
                    $("#snap").show();					
                }, errBack);
            } else if(navigator.mozGetUserMedia) { // moz-prefixed
                navigator.mozGetUserMedia(videoObj, function(stream){
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                    $("#snap").show();					
                }, errBack);
            }
                   //video.play();       these 2 lines must be repeated above 3 times
                   //$("#snap").show();  rather than here once, to keep "capture" hidden
                  //                     until after the webcam has been activated.  

            // Get-Save Snapshot - image 
            document.getElementById("snap").addEventListener("click", function() {
                context.drawImage(video, 0, 0, 320, 240);
                // the fade only works on firefox?
                $("#video").fadeOut("slow");
                $("#canvas").fadeIn("slow");
                $("#snap").hide();
                $("#reset").show();
                $("#upload").show();
            });
            // reset - clear - to Capture New Photo
            document.getElementById("reset").addEventListener("click", function() {
                $("#video").fadeIn("slow");
                $("#canvas").fadeOut("slow");
                $("#snap").show();
                $("#reset").hide();
                $("#upload").hide();
            });
            // Upload image to sever 
            document.getElementById("upload").addEventListener("click", function(){
                var dataUrl = canvas.toDataURL("image/jpeg", 0.85);
				var p_id = document.getElementById("p_id").value;
                $("#uploading").show();
                $.ajax({
                  type: "POST",
                  url: "save_profile_image.php",
                  data: { 
                     imgBase64: dataUrl,
                     user: "Joe",       
                     userid: p_id        
                  }
                }).done(function(msg) {
                  console.log("saved");
                  $("#uploading").hide();
                  $("#uploaded").show();
                });
            });
        }, false);

   </script>

    <SCRIPT LANGUAGE="JavaScript">
	//Funcion para validar el ingreso solo de numeros con event=Onkeypress en input
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
	
	//Funcion para calcular la edad a partir del ingreso de la fecha de cumpleaños	
		function submitBday() {
			//var Q4A = "Your birthday is: ";
			var Bdate = document.getElementById('birthdate').value;
			var Bday = +new Date(Bdate);
			//Q4A += Bdate + ". You are " + ~~ ((Date.now() - Bday) / (31557600000));
			var Q4A = Math.trunc(((Date.now() - Bday) / (31557600000)));
			//alert(Q4A);
			//var theBday = document.getElementById('age');
			//theBday.innerHTML = Q4A;
			document.getElementById('age').value=Q4A;
		}
	</SCRIPT>

	<!-- script type="text/javascript" src="webcam.js"></script -->
	
	<!-- Dual List Box -->
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap-duallistbox.css">
	<script src="../../js/jquery.bootstrap-duallistbox.js"></script>

</head>
<?php
    //Include functions file
    include('../../include/functions.php');
	$NroDNI = '';
	$DNIValidation = '';
	if (isset($_REQUEST['DNIValidation']))
	{
		$DNIValidation = $_REQUEST['DNIValidation'];
	}		
?>
    <body class="page-body  page-fade">

    	<div class="page-container">	
	
		<div class="sidebar-menu">
	
			<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="index.php">
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

		<h3>Nuevo Socio <span class="error"><?php echo $DNIValidation; ?></span></h3>
		<hr/>
		
<!-- ACA EMPIEZA EL FORM -->		
		<form action="new_submit.php" method="POST" class="form-horizontal form-groups-bordered">
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">ID :</label>					
					<div class="col-sm-5">
						<?php
							$query = "select max(id)+1 as ID from Persons";
							//echo $query;
							$result = mysqli_query($con, $query);

							if (mysqli_affected_rows($con) != 0) {
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									$Person_ID = $row['ID'];								        
								}
							}
						?>					
						<input type="text" id="p_id" name="p_id" value="<?php echo  $Person_ID; //echo time(); ?>" class="form-control" readonly/>
					</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Picture :</label>					
					<div class="col-sm-5">
					<!-- Camara -->
						<div class="camcontent">
							<video id="video" width="320" height="240" autoplay></video>
							<canvas id="canvas" width="320" height="240"></canvas>
						</div>
						<br/>
						<div class="cambuttons">
							<button id="snap" style="display:none;" class="btn btn-primary">  Capture </button> 
							<button id="reset" style="display:none;" class="btn btn-primary">  Reset  </button>     
							<button id="upload" style="display:none;" class="btn btn-primary"> Upload </button> 
							<br> 
							<span id=uploading style="display:none;"> Uploading has begun . . .  </span> 
							<span id=uploaded  style="display:none;"> Success, your photo has been uploaded!</a> </span> 
						</div>
					<!-- Fin Camara -->	
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Nombre :</label>					
					<div class="col-sm-5">
						<input type="text" name="p_name" id="p_name" class="form-control"  data-rule-minlength="4" placeholder="Ingrese nombre" maxlength="30" autofocus required/>
						<!-- span class="selectRequiredMsg"><span class="error">* <?php //echo $nameErr; ?></span></span -->
					</div>
			</div>
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Apellido :</label>					
					<div class="col-sm-5">
						<input type="text" name="Apellido" id="Apellido" class="form-control"  data-rule-minlength="4" placeholder="Ingrese apellido" maxlength="60" required/>
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Identificacion:</label>					
					<div class="col-sm-5">
						<select name="Ident" id="Ident"  class="form-control" required>
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
						<input type="text" name="NroDNI"  id="NroDNI" class="form-control" data-rule-minlength="8" placeholder="Numero Identificacion" maxlength="60" onKeyPress="return checkIt(event)" required/>						
					</div>
			</div>					
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Direccion :</label>					
					<div class="col-sm-5">
						<input type="text" name="add" id="textfield5" class="form-control"  data-rule-minlength="6" placeholder="Address" required/>
					</div>
			</div>

			<!--div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Codigo Postal :</label>					
					<div class="col-sm-5">
						<input type="text" name="zipcode" id="zipcode" class="form-control"  data-rule-minlength="20" placeholder="Zipcode">
					</div>
			</div -->							

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Fecha de Nacimiento :</label>			
					<div class="col-sm-5">						
						<!-- La posta esta aca calendar de HTML5: -->
						<input type="date" name="birthdate" id="birthdate" step="1" min="1950-01-01" max="<?php echo date("Y-m-d");?>" onchange="submitBday()" required/>
						<!-- Fin de La posta esta aca calendar de HTML5 -->
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Edad :</label>					
					<div class="col-sm-5">
						<input type="text" name="age" id="age" class="form-control" data-rule-minlength="1" placeholder="Age"  maxlength="3" />
					</div>
			</div>						

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Sexo :</label>					
					<div class="col-sm-5">
						<select name="sex" id="sex"  class="form-control" required>
						    <option value="">-- Por favor seleccione --</option>
						    <option value="1">Masculino</option>
						    <option value="2">Femenino</option>
						</select>
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Altura :</label>					
					<div class="col-sm-5">
						<input type="text" name="height" id="height" class="form-control"  data-rule-minlength="1" placeholder="Height"  maxlength="3" onKeyPress="return checkIt(event)" required/>
						<span class="selectRequiredMsg">(En  Cm)</span>
					</div>
			</div>		

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> ABM Peso:</label>					
					<div class="col-sm-5">
						<input type="text" name="Mediciones[10]" id="Mediciones[10]" class="form-control" data-rule-minlength="1" placeholder="Weight"  maxlength="3" onKeyPress="return checkIt(event)" required/> 
						<span class="selectRequiredMsg">(En Kgrs)</span>
					</div>
			</div>	
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">ABM BMI:</label>					
					<div class="col-sm-5">
						<input type="text" name="Mediciones[11]" id="Mediciones[11]" class="form-control" data-rule-minlength="1" placeholder="Body Mass Index" onKeyPress="return checkIt(event)"  maxlength="10">
					</div>
			</div>				

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Horas de sueño:</label>					
					<div class="col-sm-5">
						<input type="text" name="SleepHours"  id="SleepHours" class="form-control" data-rule-minlength="1" placeholder="Horas de sueño" maxlength="2" onKeyPress="return checkIt(event)" required/>
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
							$query = "select dni, CONCAT(name,' ', lastName) as nombre, EXISTS(SELECT Amigo_id FROM amigos WHERE dni_id ='".$NroDNI."' and amigo_id = Persons.dni) as selected from Persons";
							$result = mysqli_query($con, $query);
							if (mysqli_affected_rows($con) != 0) {
								//Llamo funcion para renderizar el select option:
								Html_OptionList_render($result, 1, "duallistbox_demo2[]","");							
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
						<input type="text" name="Estudios"  id="Estudios" class="form-control" data-rule-minlength="5" placeholder="Estudios" maxlength="250">
					</div>
			</div>				

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Nacionalidad :</label>					
					<div class="col-sm-5">
						<input type="text" name="nationality" id="nationality" class="form-control"  data-rule-minlength="6" placeholder="Nationality" required/>
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Email:</label>					
					<div class="col-sm-5">
						<input type="email" name="email"  id="email" class="form-control" data-rule-minlength="5" placeholder="E-Mail" maxlength="60" required/>
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Telefono Linea:</label>					
					<div class="col-sm-5">
						<input type="text" name="TeLinea"  id="TeLinea" class="form-control" data-rule-minlength="5" placeholder="Telefono de Linea" maxlength="60" onKeyPress="return checkIt(event)" />
					</div>
			</div>
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Celular:</label>					
					<div class="col-sm-5">
						<input type="text" name="Cel"  id="Cel" class="form-control" data-rule-minlength="5" placeholder="Celular" maxlength="60" onKeyPress="return checkIt(event)" required/>
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Nombre Contacto:</label>					
					<div class="col-sm-5">
						<input type="text" name="contactName" id="contactName" class="form-control" data-rule-minlength="3" placeholder="Nombre contacto" maxlength="60" required/>
					</div>
			</div>	

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Parentesco Contacto:</label>					
					<div class="col-sm-5">
						<input type="text" name="Parentesco" id="Parentesco" class="form-control"  data-rule-minlength="12" placeholder="Parentesco del contacto" maxlength="12">
					</div>
			</div>			

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Telefono Contacto:</label>					
					<div class="col-sm-5">
						<input type="text" name="contacTel"  id="contacTel" class="form-control" data-rule-minlength="5" placeholder="Telefono del contacto" maxlength="60" onKeyPress="return checkIt(event)" required/>
					</div>
			</div>			

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Gym Anterior:</label>					
					<div class="col-sm-5">
						<input type="text" name="previousgym"  id="previousgym" class="form-control" data-rule-minlength="5" placeholder="Previous Gym" maxlength="60" />
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Años Entrenando:</label>					
					<div class="col-sm-5">
						<input type="text" name="yearstraining"  id="yearstraining" class="form-control" data-rule-minlength="1" placeholder="Years Training" maxlength="2" onKeyPress="return checkIt(event)" />
					</div>
			</div>																						

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Observaciones:</label>					
					<div class="col-sm-5">
						<!-- input type="text" name="Obs"  id="Obs" class="form-control" data-rule-minlength="5" placeholder="Observaciones" maxlength="250" / -->
						<textarea rows="8" cols="150" name="Obs" id="Obs" class="form-control" data-rule-minlength="5" placeholder="Observaciones" maxlength="250" wrap="hard" required>
						</textarea>
					</div>
			</div>		
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Fecha Inscripcion :</label>					
					<div class="col-sm-5">
						<input type="text" name="FechaIns" id="textfield22" value="<?php echo date('Y-m-d'); ?>">
					</div>
			</div>			

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Tipo Membresia :</label>					
					<div class="col-sm-5">
						 <select name="mem_type" id="id"  class="country">
							<option value="">-- Por favor seleccione --</option>
							<?php
								$query = "select * from mem_types where activo = 1";
								//echo $query;
								$result = mysqli_query($con, $query);

								if (mysqli_affected_rows($con) != 0) {
								    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								        echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";								        
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
			<?php include('../../include/footer.php'); ?>
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
	<!-- Tomar Foto -->
	<!-- script src="../../js/PicProfile.js"></script -->	
    <SCRIPT LANGUAGE="JavaScript">	
	/*Llamada a las funciones
	  document.querySelector('#getUserMediaButton').addEventListener('click', onGetUserMediaButtonClick);
	  document.querySelector('#grabFrameButton').addEventListener('click', onGrabFrameButtonClick);
	  document.querySelector('#takePhotoButton').addEventListener('click', onTakePhotoButtonClick);
	  */
	</script>
	
    </body>
</html>

