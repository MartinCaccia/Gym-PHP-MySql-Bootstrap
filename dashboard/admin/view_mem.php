<?php
include '../../include/db_conn.php';
//require 'db_conn.php';
page_protect();

//Include functions file
include('../../include/functions.php');
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

    <!-- Theme framework -->
	<!-- script src="../../js/eakroko.min.js"></script -->
	<!-- Theme scripts -->
	<!-- script src="../../js/application.min.js"></script -->
	<!-- Just for demonstration -->
	<!-- script src="../../js/demonstration.min.js"></script -->

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

		<h3>Eidos Gym</h3>

		<hr />
		
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>Profile image</th>
					<th>Expiracion Membresia</th>
					<th>ID / DNI</th>
					<th>Nombre Apellido</th>
					<th>Direccion / Contacto</th>
					<th>Email / Edad / Sexo</th>
					<th>Altura / Peso</th>
					<th width="328">Accion</th>
				</tr>
			</thead>
				<tbody>

						<?php
							$query  = "select * from Persons where activo <> 0 ORDER BY LastName DESC";
							//echo $query;
							$result = mysqli_query($con, $query);
							$sno    = 1;

							if (mysqli_affected_rows($con) != 0) {
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									$msgid   = $row['id'];
									$Dni = $row['Dni'];
							        //$query1  = "select * from subsciption WHERE mem_id='$msgid' AND renewal='yes'";
							        //$result1 = mysqli_query($con, $query1);
							        //if (mysqli_affected_rows($con) == 1) {
							            //while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {							                							                							                
							                //$expiry        = (!isset($row1['expiry']) || is_null($row1['expiry'])) ? ' ' : $row1['expiry'];
							                //$sub_type_name = (!isset($row1['sub_type_name']) || is_null($row1['sub_type_name'])) ? ' ' : $row1['sub_type_name'];
											
											//La fecha de expiracion habria que calcularla en realidad con la fecha de ultimo pago del socio.
											$expiry = date('Y-m-d', strtotime("+1 months", strtotime($row['cdate'])));
											$sexo = ($row['Sex'] == 1) ? 'Hombre' : 'Mujer';
											$img = imgPic($row['UserPicProfile'], "40", "40", "");
											echo "<tr>";																														
											echo "<td><!-- user Profile Pic -->";
											echo "<div>"; 
											echo $img;						
											echo "</div></td>";
							                echo "<td>" . $expiry . "</td>";
											echo "<td>" . $row['id'] . " / " . $row['Dni'] . "</td>";
							                echo "<td>" . $row['name'] . " " . $row['LastName'] . "</td>";
							                echo "<td>" . $row['Address'] . " / " . $row['CellPhone'] . "</td>";
							                echo "<td>" . $row['Email'] . " / " . $row['Age'] . " / " . $sexo . "</td>";
							                echo "<td>" . $row['Height'] . " / 80kgr. </td>";
							                
							                $sno++;
							                
							                echo "<td>";
											//echo "<form action='read_member.php' method='post'>";
											//echo"	<input type='hidden' name='name' value='" . $msgid . "'/>";
											//echo"	<input type='submit' value='View History' class='btn btn-info'/>";											
											//echo"	<a href='read_member.php?id=" . $msgid . "' class='btn btn-primary btn-blue a-btn-slide-text'>";
											echo"	<a href='new_socio.php?DNI=" . $Dni . "' class='btn btn-primary btn-blue a-btn-slide-text'>";
											echo"		<span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>";
											echo"		<span><strong>View</strong></span>";            
											echo"	</a>";
											//echo"</form>";
											//echo"<form action='edit_member.php' method='post'>";
											//echo"	<input type='hidden' name='name' value='" . $msgid . "'/>";
											//echo"	<input type='submit' value='Edit' class='btn btn-warning'/>";
											echo"	<a href='edit_member.php?id=" . $msgid . "' class='btn btn-primary btn-blue a-btn-slide-text'>";
											echo"		<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>";
											echo"		<span><strong>Edit</strong></span>";            
											echo"	</a>";
																						
											//echo"</form>";
											echo"	<a href='new_health_status.php?id=" . $msgid . "' class='btn btn-primary btn-blue a-btn-slide-text'>";
											echo"		<span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span>";
											echo"		<span><strong>Mediciones</strong></span>";            
											echo"	</a>";
											//echo"<form action='del_member.php' method='post' onSubmit='return ConfirmDelete();'>";
											//echo"	<input type='hidden' name='name' value='" . $msgid . "'/>";
											//echo"	<input type='submit' value='Delete' class='btn btn-danger'/>";
											echo"	<a href='del_member.php?id=" . $msgid . "' class='btn btn-primary btn-red a-btn-slide-text'>";
											echo"		<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
											echo"		<span><strong>Delete</strong></span>";            
											echo"	</a>";
											//echo"</form>";
											echo"</td>";
											echo"</tr>";
											
							                $msgid = 0;
							            //}
							        //}
							    }
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





