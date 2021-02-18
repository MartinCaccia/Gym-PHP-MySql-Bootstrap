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
	<style>
	div[contenteditable]{
		/*border: 1px solid black;*/
		border: none;
		max-height: auto;
		overflow: auto;		
	}
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

		<h3>Eidos Gym</h3>
		<br/>
		<div><!-- a href="view_mem.php"><i class="entypo-back"></i><span>Volver</span></a -->
			<a href="view_mem.php" class="btn btn-primary btn-blue a-btn-slide-text">
				<span class="glyphicon glyphicon-back" aria-hidden="true"></span>
				<span><strong>Volver</strong></span>
			</a>
		</div>
		<br/>
			Detalle: 
		<hr/>
			<?php
				if (isset($_REQUEST['id'])) {
					$id = $_REQUEST['id'];
				}
				$query  = "select * from Persons WHERE id=".$id;
				//echo $query;
				//die();
				$result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) {
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);	 					  	
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
					  //$Weight = $row['Weight']; //Sale de tabla mediciones, valores relacionada por dni					  					 
					  $observations = $row['observations'];
					  $SleepHours = $row['SleepHours'];
					  $GymAnterior = $row['GymAnterior'];
					  $yearstraining = $row['yearstraining'];
					  //Falta fecha inscripcion (FechaIns). Aunque podria ser cdate
					  $mem_type_id = $row['mem_type_id'];
					  $cuser = $row['cuser'];
					  $cdate = $row['cdate'];
					  $muser = $row['muser'];
					  $mdate = $row['mdate'];											
				}
				
				//Obtencion del peso:
				$query  = "select * from Mediciones WHERE Dni_id=".$Dni." and Activo=1 and Tipo=4";
				//echo $query;
				//die();
				$result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) {
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					$Weight = $row['Valor'];
				}else{
					$Weight = "XX";
				}
				//Obtencion tipo membresia:
				$query = "select name from mem_types where id =".$mem_type_id;
				//echo $query;
				//die();
				$result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) {
				 $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
				 $mem_type_desc =$row2['name'];
				}
			?>
		<!-- Datos principales -->	
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>ID </th>				
					<th>Imagen</th>					
					<th>Nombre Apellido</th>
					<th>Tipo / Dni</th>
					<th>Nacionalidad</th>
					<th>Dirección</th>
					<th>Telefono</th>
					<th>Fecha Nacimiento</th>
					<th>Edad / Sexo</th>
					<th>Altura / Peso</th>
					<th>Fecha Inscripción</th>
					<th>Tipo Membresia</th>
				</tr>
			</thead>
				<tbody>
					<?php
						$img = imgPic($UserPicProfile, "", "", "");
						$sex_desc = sex_desc($Sex);
						echo "<tr>";
						echo "<td>" . $id . "</td>";							
						echo "<td>" . $img . "</td>";
						echo "<td>" . $name . " ". $LastName . "</td>";
						echo "<td>" . $TipoDoc . " ". $Dni . "</td>";
						echo "<td>" . $nacionalidad . "</td>";
						echo "<td>" . $Address . "</td>";
						echo "<td>" . $CellPhone . "</td>";
						echo "<td>" . $BirthDate . "</td>";
						echo "<td>" . $Age . " años / " . $sex_desc ."</td>";
						echo "<td>" . $Height . " cm / " . $Weight ." kgr.</td>";
						echo "<td>" . $cdate . "</td>";
						echo "<td>" . $mem_type_desc . "</td>";
						echo "</tr>";
					?>								
				</tbody>
		</table>
		<!-- Datos secundarios -->
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>Horas sueño</th>				
					<th>Gym anterior</th>					
					<th>Tiempo entrenamiento</th>	
					<th>Observaciones</th>					
				</tr>
			</thead>
				<tbody>
					<?php
						echo "<tr>";
						echo "<td>" . $SleepHours . "</td>";							
						echo "<td>" . $GymAnterior . "</td>";
						echo "<td>" . $yearstraining . "</td>";
						echo "<td>" . $observations . "</td>";
						echo "</tr>";
					?>								
				</tbody>
		</table>
		<!-- Amigos -->
		<table class="table table-bordered datatable" id="table-1">
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
		<!-- Datos de contacto -->
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>Contacto</th>				
					<th>Parentesco</th>					
					<th>Telefono</th>					
				</tr>
			</thead>
				<tbody>
					<?php
						echo "<tr>";
						echo "<td>" . $EmergencyContactPerson . "</td>";							
						echo "<td>" . $EmergencyKinship . "</td>";
						echo "<td>" . $EmergencyPhone . "</td>";
						echo "</tr>";
					?>								
				</tbody>
		</table>
		Mediciones: 
		<?php				
			$query  = "select * from Mediciones WHERE Dni_id=".$Dni." order by FechaDesde desc";
			//echo $query;
			//die();
			$result = mysqli_query($con, $query);
		?>
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>Id</th>
					<th>Medicion</th>
					<th>Valor</th>
					<th>Fecha</th>
					<th>Activo</th>
					<!-- th>Accion</th -->
				</tr>
			</thead>
				<tbody>
					<?php
						$sno    = 1;
						if (mysqli_affected_rows($con) != 0) {
						    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$tipo_desc = mediciones($row['Tipo']);
						        echo "<tr>";
								echo "<td>" . $sno . "</td>";
						        echo "<td>" . $tipo_desc . "</td>";
						        echo "<td>" . $row['Valor'] . "</td>";
						        echo "<td>" . $row['FechaDesde'] . "</td>";
						        echo "<td>" . $row['Activo'] . "</td>";						        
						        //echo "<td><form action='gen_invoice.php' method='post'>";
								//echo "<input type='hidden' name='name' value='" . $id . "'/><input type='submit' value='Print Invoice ' class='btn btn-info'/>";
								//echo "</form>";
								//echo "<form action='edit_invoice.php' method='post'><input type='hidden' name='name' value='" . $id . "'/>";
								//echo "<input type='submit' value='Edit Invoice ' class='btn btn-warning'/>";
								//echo "</form>";
								//echo "<form action='del_invoice.php' method='post' onSubmit='return ConfirmDelete();'>";
								//echo "<input type='hidden' name='name' value='" . $id . "'/><input type='submit' value='Delete Invoice ' class='btn btn-danger'/>";
								//echo "</form></td>";
								echo "</tr>";
						        $sno++;								
						    }
						    
						}
					?>							
				</tbody>
		</table>

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

    </body>
</html>

