<?php
include '../../include/db_conn.php';
//Include functions file
include('../../include/functions.php');
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
	
    <!-- Estilo de campo requeridos -->
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
	</SCRIPT>

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

		<form action="submit_health_new.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
			
			<?php
				if (isset($_REQUEST['id'])) {
					$id = $_REQUEST['id'];
				}
				$query  = "SELECT name, LastName, UserPicProfile, TipoDoc, Dni FROM Persons WHERE id=".$id;
				//echo $query;
				//die();
				$result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) {
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);	 					  	
					  $name = $row['name'];
					  $LastName = $row['LastName'];
					  $fullName = $name. " " . $LastName;
					  $UserPicProfile = $row['UserPicProfile'];
					  $TipoDoc = $row['TipoDoc'];							  							 
					  $Dni = $row['Dni']; 							  							 										
				}
			?>
		<h3>Mediciones de <b><?php echo $fullName;?></b></h3>
		<hr/>			
			<div class="form-group">			
				<label class="col-sm-3 control-label">ID:</label>					
					<div class="col-sm-5">				
						<input type="text" name="userId" id="userId" class="form-control" value="<?php echo $id; ?>" readonly required/>						
					</div>
			</div>			
			
			<div class="form-group">			
				<label class="col-sm-3 control-label"><?php echo (is_null($TipoDoc)) ? 'DNI' : $TipoDoc; ?>:</label>					
					<div class="col-sm-5">				
						<input type="text" name="dni" id="dni" class="form-control" value="<?php echo $Dni; ?>" readonly required/>	
					</div>
			</div>	

			<div class="form-group">
				<label class="col-sm-3 control-label">Nombre Apellido:</label>
					
					<div class="col-sm-5">						
						<input type="text" name="nomApe" id="nomApe" class="form-control" value="<?php echo $fullName; ?>" readonly required/>						
					</div>
			</div>
			
		<h3>Nuevas Mediciones:</h3>
		<hr/>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Bicep Der:</label>					
					<div class="col-sm-5">
						<input type="text" name="Tipo[]" value="1" hidden />
						<input type="text" name="Valor[]" class="form-control" placeholder="Valor en cm" onKeyPress="return checkIt(event)" />
					</div>
			</div>
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Bicep Izq:</label>					
					<div class="col-sm-5">
						<input type="text" name="Tipo[]" value="2" hidden />
						<input type="text" name="Valor[]" class="form-control" placeholder="Valor en cm" onKeyPress="return checkIt(event)" />
					</div>
			</div>
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Pecho:</label>					
					<div class="col-sm-5">
					<input type="text" name="Tipo[]" value="3" hidden />
						<input type="text" name="Valor[]" class="form-control" placeholder="Valor en cm" onKeyPress="return checkIt(event)" />
					</div>
			</div>
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Espalda:</label>					
					<div class="col-sm-5">
						<input type="text" name="Tipo[]" value="4" hidden />
						<input type="text" name="Valor[]" class="form-control" placeholder="Valor en cm" onKeyPress="return checkIt(event)" />
					</div>
			</div>
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Cuadricep Der:</label>					
					<div class="col-sm-5">
						<input type="text" name="Tipo[]" value="5" hidden />					
						<input type="text" name="Valor[]" class="form-control" placeholder="Valor en cm" onKeyPress="return checkIt(event)" />
					</div>
			</div>
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Cuadricep Izq:</label>					
					<div class="col-sm-5">
						<input type="text" name="Tipo[]" value="6" hidden />					
						<input type="text" name="Valor[]" class="form-control" placeholder="Valor en cm" onKeyPress="return checkIt(event)" />
					</div>
			</div>
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Gemelo Der:</label>					
					<div class="col-sm-5">
						<input type="text" name="Tipo[]" value="7" hidden />					
						<input type="text" name="Valor[]" class="form-control" placeholder="Valor en cm" onKeyPress="return checkIt(event)" />
					</div>
			</div>
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Gemelo Izq:</label>					
					<div class="col-sm-5">
						<input type="text" name="Tipo[]" value="8" hidden />					
						<input type="text" name="Valor[]" class="form-control" placeholder="Valor en cm" onKeyPress="return checkIt(event)" />
					</div>
			</div>
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Cintura:</label>					
					<div class="col-sm-5">
						<input type="text" name="Tipo[]" value="9" hidden />					
						<input type="text" name="Valor[]" class="form-control" placeholder="Medida de cintura en cm" onKeyPress="return checkIt(event)" />
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Peso:</label>					
					<div class="col-sm-5">
						<input type="text" name="Tipo[]" value="10" hidden />					
						<input type="text" name="Valor[]" class="form-control" placeholder="Peso en Kgr" onKeyPress="return checkIt(event)" />
					</div>
			</div>	
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">BMI:</label>					
					<div class="col-sm-5">
						<input type="text" name="Tipo[]" value="11" hidden />					
						<input type="text" name="Valor[]" class="form-control" placeholder="Body Mass Index" onKeyPress="return checkIt(event)" />
					</div>
			</div>	

			<div class="form-group">		
					<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-primary">Guardar Cambios</button>	
					</div>
			</div>				

		<h3>Mediciones anteriores:</h3>
		<hr/>			
			<table class="table table-bordered datatable" id="table-1">
				<thead>
					<tr>
						<th width="120">ID </th>				
						<th width="220">Medición</th>					
						<th width="120">Valor</th>
						<th width="120">Fecha</th>
						<th width="120">Activo</th>
					</tr>
				</thead>
				<tbody>
			<?php
				$query  = "SELECT * FROM Mediciones WHERE Dni_id=".$Dni." Order by Tipo, Activo desc";
				//echo $query;
				//die();
				$result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {					
					  $id    = $row['id'];
					  $Tipo  = $row['Tipo'];
					  $Valor = $row['Valor'];
					  $Activo = $row['Activo'];
					  $Activo_desc = ($Activo == 1) ? 'SI' : 'NO';
					  $FechaDesde = $row['FechaDesde'];							  							 		  							 										
					  $Tipo_desc = mediciones($Tipo);
					  if ($Activo == 1){
						echo "<tr>";
					  }
					  else {
						echo "<tr  style='text-decoration: line-through;'>";
					  }
						echo "<td>" . $id . "</td>";							
						echo "<td>" . $Tipo_desc . "</td>";
						echo "<td>" . $Valor . " </td>";
						echo "<td>" . $FechaDesde . "</td>";
						echo "<td>" . $Activo_desc . "</td>";
						echo "</tr>";
					}
				}
						?>								
					</tbody>
			</table>	
						
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
	<script src="../../neon/js/select2/select2.min.js" id="script-resource-7"></script>
	<link rel="stylesheet" href="../../neon/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="../../neon/js/select2/select2.css"  id="style-resource-2">
	<link rel="stylesheet" href=".../../neon/js/selectboxit/jquery.selectBoxIt.css"  id="style-resource-3">
	<link rel="stylesheet" href="../../neon/js/daterangepicker/daterangepicker-bs3.css"  id="style-resource-4">    

    </body>
</html>