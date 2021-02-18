<?php
include '../../include/db_conn.php';
page_protect();
//Include functions file
include('../../include/functions.php');

//Respuesta validacion del CRUD/ABM:
$Validation = '';
if (isset($_REQUEST['Validation']))
{
	$Validation = $_REQUEST['Validation'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Eidos Gym</title>
    <link rel="stylesheet" href="../../neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
    <link rel="stylesheet" href="../../neon/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
    <link rel="stylesheet" href="../../neon/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
    <link rel="stylesheet" href="../../neon/css/neon.css"  id="style-resource-5">
    <!-- link rel="stylesheet" href="../../neon/css/custom.css"  id="style-resource-6" -->
	<!-- Estilo de campo requeridos -->
	<style>
		.error {color: #FF0000;}
	</style>	

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

</head>
<?php
//Inicializacion valores campos input para insert y update
$Mes = "";
$Anio = "";
$Anio_Mes = "";
$Detalle_input = "";

//Insert
if ($_SERVER["REQUEST_METHOD"] == "POST") {	

	//Obtener valores del formulario.
	 $edit_hidden = $_POST['edit_hidden'];	
	 $id_hidden = $_POST['id_hidden'];	
	 $rowid = $_POST['rowid'];
	 //$Mes = $_POST['Mes'];
	 //$Anio = $_POST['Anio'];
	 $Anio_Mes = $_POST['Anio_Mes'];
	 list($Anio, $Mes) = explode('-', $Anio_Mes);
	 if (strlen($Mes) == 1) {$Mes= "0".$Mes;}
	 $Detalle = $_POST['Detalle'];
	//Fin obtener valores del formulario.  
	
	if ($edit_hidden == 'edit'){
		$accion_desc = "actualizó";	
		$Query_ins= "UPDATE `cuotas` SET Mes=".$Mes.", Anio=".$Anio.", Detalle = '".$Detalle."' WHERE id =".$rowid;		
	}else{
		$accion_desc = "insertó";	
		$Query_ins = "INSERT INTO `cuotas` (Dni_id, Mes, Anio, Detalle) VALUES (".$id_hidden.",".$Mes.",".$Anio.",'".$Detalle."')";		
	}

	//echo "Query_ins: ". $Query_ins;
	//die();

	if (mysqli_query($con, $Query_ins)) {
		//echo "ACA";
		//die();
		$location = 'ABM_payments.php?id='.$id_hidden.'&Validation=Se '.$accion_desc.' la cuota con exito.';
		mysqli_close($con);
		header_redirect($location, true, 303);

	} else {
		//echo "ACA2";
		$InsError = "Ocurrió un error. <br/> Error: " . $Query_ins . "<br/>" . mysqli_error($con);
		$location = 'ABM_payments.php?id='.$id_hidden.'&Validation='.$InsError;
		//echo "InsError: ". $InsError;
		//echo "location: ". $location;
		//die();
		mysqli_close($con);		
		header_redirect($location, true, 303);	
	}
}	

//Edit y Delete
//echo "id: ". isset($_REQUEST['id']);
//echo "action: ".isset($_REQUEST['action']);
//die();
//if (isset($_REQUEST['id']) && isset($_REQUEST['action'])) {
if (isset($_REQUEST['id'])) {	
	$id = $_REQUEST['id'];
	if (isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
		$rowid = $_REQUEST['rowid'];
		switch($_REQUEST['action'])
			{
				case 'edit':
					$query  = "select * from cuotas where id=".$rowid;
					//echo $query;
					//die();
					$result = mysqli_query($con, $query);				
					if (mysqli_affected_rows($con) != 0) {
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						$Mes = $row['Mes'];
						if (strlen($Mes) == 1) {$Mes= "0".$Mes;}
						$Anio = $row['Anio'];
						$Anio_Mes = $Anio."-".$Mes;
						$Detalle_input = $row['Detalle'];				
					}				
					break;

				case 'delete':			
					$Query_del= "DELETE FROM cuotas WHERE id=".$rowid;
					//echo $Query_del;
					//die();
					if (mysqli_query($con, $Query_del)) {						
						$location = 'ABM_payments.php?id='.$id.'&Validation=Se eliminó la cuota con exito.';
						mysqli_close($con);
						header_redirect($location, true, 303);

					} else {
						$InsError = "No se pudo eliminar la cuota. <br/> Error: " . $Query_del . "<br/>" . mysqli_error($con);
					    //echo $InsError;
					    //die();						
						$location = 'ABM_payments.php?id='.$id.'&Validation='.$InsError;
						mysqli_close($con);		
						header_redirect($location, true, 303);	
					}
					break;
			}		
	}else{
			$action="";	
			$rowid="";
	}
	//echo "Query_ins: ". $Query_ins;
	//die();
		
}else{
$id="";
$action="";	
$rowid="";
}	
//echo "id: ". $id;
//echo "action: ".$action;
//echo "rowid: ".$rowid;
//die();
?>
    <body class="page-body  page-fade">

    	<div class="page-container">	
	
		<div class="sidebar-menu">
	
			<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="index.php">
					<img src="../../img/Eidos.jpg" width="120" height="120" alt="Eidos Gym" />
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

		<h4>Eidos Gym</h4>
		<?php
			$query  = "select name, LastName from Persons where Dni=".$id;
			$result = mysqli_query($con, $query);			
			if (mysqli_affected_rows($con) != 0) {
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$Name       = $row['name'];	
				$LastName   = $row['LastName'];	
			}
		?>
		<h3>Cuotas de <?php echo $Name." ".$LastName; ?></h3>
		<hr />
		<h4>Nueva Cuota  <span class="error"><?php echo $Validation; ?></span></h4>
		<hr />		
		<form action="ABM_payments.php" method="POST" class="form-horizontal form-groups-bordered">
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Mes y Año: </label>					
					<div class="col-sm-5">
						<!-- input type="text" name="Mes" id="Mes" class="form-control"  data-rule-minlength="2" placeholder="Ingrese el Mes" maxlength="2" onKeyPress="return checkIt(event)" value="<?php //echo $Mes; ?>" required/ -->
						<input type="month" name="Anio_Mes" id="Anio_Mes" step="1" min="2018-01" value="<?php echo $Anio."-".$Mes; ?>" required/>
					</div>
			</div>
			
			<!-- div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Año:</label>					
					<div class="col-sm-5"><span class="error">
						<?php 
						//echo $Anio."-".$Mes; 						
						?></span>
						<input type="text" name="Anio" id="Anio" class="form-control" data-rule-minlength="4" placeholder="Ingrese el Año" maxlength="4" onKeyPress="return checkIt(event)" value="<?php //echo $Anio; ?>" required/>
					</div>
			</div -->

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Detalle:</label>					
					<div class="col-sm-5">
						<textarea rows="20" cols="150" name="Detalle" id="Detalle" maxlength="2500" wrap="hard" required>
						<?php echo $Detalle_input; ?>
						</textarea>
					</div>
			</div>	

			<div class="form-group">		
					<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-primary">Guardar Cambios</button>	
						<input type="hidden" name="edit_hidden" id="edit_hidden" value="<?php echo $action; ?>" />
						<input type="hidden" name="id_hidden" id="id_hidden" value="<?php echo $id; ?>" />
						<input type="hidden" name="rowid" id="rowid" value="<?php echo $rowid; ?>" />
					</div>
			</div>				
		
		</form>
		<br/><br/><br/>
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>Mes</th>
					<th>Año</th>
					<th>Detalle</th>
					<th width="180">Acción</th>
				</tr>
			</thead>
				<tbody>

						<?php
							$query  = "select * from cuotas where Dni_id =".$id." order by Anio, Mes desc";
							//echo $query;
							//die();
							$result = mysqli_query($con, $query);
							//echo mysqli_affected_rows($con);
							//die();			
							
							if (mysqli_affected_rows($con) != 0) {
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        $msgid   = $row['id'];
							                							                							                
									//$expiry        = (!isset($row1['expiry']) || is_null($row1['expiry'])) ? ' ' : $row1['expiry'];
									//$sub_type_name = (!isset($row1['sub_type_name']) || is_null($row1['sub_type_name'])) ? ' ' : $row1['sub_type_name'];									
									//La fecha de expiracion habria que calcularla en realidad con la fecha de ultimo pago del socio.
									//$expiry = date('Y-m-d', strtotime("+1 months", strtotime($row['cdate'])));
									//$activo = ($row['activo'] == 1) ? 'SI' : 'NO';
									//$img = imgPic($row['UserPicProfile'], "", "", "");
									
									echo "<tr>";																														
									echo "<td>" . $row['Mes'] . "</td>";
									echo "<td>" . $row['Anio'] . "</td>";
									echo "<td>" . substr($row['Detalle'],0,420) . " ...</td>";
																		
									echo "<td>";
									echo"	<a href='ABM_payments.php?action=edit&id=".$id."&rowid=".$msgid."' class='btn btn-primary btn-blue a-btn-slide-text'>";
									echo"		<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>";
									echo"		<span><strong>Edit</strong></span>";            
									echo"	</a>";
																				
									echo"	<a href='ABM_payments.php?action=delete&id=".$id."&rowid=".$msgid."' class='btn btn-primary btn-red a-btn-slide-text'>";
									echo"		<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
									echo"		<span><strong>Delete</strong></span>";            
									echo"	</a>";									
									echo"</td>";
									echo"</tr>";
											
							    }
							}else{
									echo "<tr>";																														
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";																		
									echo "<td></td>";
									echo"</tr>";								
							}
						?>									
					</tbody>
				</table>

		<script type="text/javascript">
			jQuery(document).ready(function($)
			{
				$("#table-1").dataTable({
					"sPaginationType": "bootstrap",
					"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"bStateSave": true
				});
				
				$(".dataTables_wrapper select").select2({
					minimumResultsForSearch: -1
				});
			});
		</script>

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

	<link rel="stylesheet" href="../../neon/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="../../neon/js/select2/select2.css"  id="style-resource-2">

	<script src="../../neon/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="../../neon/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="../../neon/js/select2/select2.min.js" id="script-resource-9"></script>

    </body>
</html>