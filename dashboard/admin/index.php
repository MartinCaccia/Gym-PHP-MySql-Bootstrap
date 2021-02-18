<?php
include '../../include/db_conn.php';
page_protect();
?>

<?php
//require 'db_conn.php';
//page_protect();
?>
<!DOCTYPE html>
<html lang="en">
<head> 

    
    <title>EIDOS Gym | Dashboard </title>

    <link rel="stylesheet" href="../../neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
    <link rel="stylesheet" href="../../neon/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
    <link rel="stylesheet" href="../../neon/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
    <link rel="stylesheet" href="../../neon/css/neon.css"  id="style-resource-5">
    <link rel="stylesheet" href="../../neon/css/custom.css"  id="style-resource-6">

    <script src="../../neon/js/jquery-1.10.2.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    
</head>
    <body class="page-body  page-fade">

    	<div class="page-container">	
	
		<div class="sidebar-menu">
	
			<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="index.php">
					<!-- img src="../../img/logo.png" alt="" width="192" height="80" / -->
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

			<h2>EIDOS Gym</h2>

			<hr>

			<div class="col-sm-3">			
				<div class="tile-stats tile-red">
					<div class="icon"><i class="entypo-chart-bar"></i></div>
						<div class="num" data-postfix="" data-duration="1500" data-delay="0">
						<h2>Ingresos faltantes del Mes</h2><br>	
						$ 
						<?php
							$date  = date('Y-m');
							//$query = "select * from subsciption WHERE  paid_date LIKE '$date%'";
							$query = "select * from subsciption ";

							//echo $query;
							$result  = mysqli_query($con, $query);
							$revenue = 0;
							if (mysqli_affected_rows($con) != 0) {
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        $revenue = $row['paid'] + $revenue;
							    }
							}
							echo $revenue;
							?>
						</div>
				</div>
			</div>
			

			<div class="col-sm-3">	
			<a href="view_mem.php">		
				<div class="tile-stats tile-green">
					<div class="icon"><i class="entypo-users"></i></div>
						<div class="num" data-postfix="" data-duration="1500" data-delay="0">
						<h2>Total Miembros Activos</h2><br/>	
							<?php
							$date  = date('Y-m');
							//$query = "select COUNT(*) from user_data WHERE wait='no'";
							$query = "select COUNT(id) from persons WHERE activo=1";

							//echo $query;
							$result = mysqli_query($con, $query);
							$i      = 1;
							if (mysqli_affected_rows($con) != 0) {
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        echo $row['COUNT(id)'];
							    }
							}
							$i = 1;
							?>
						</div>
				</div>
			</a>
			</div>	

			<div class="col-sm-3">	
			<a href="view_mem_del.php">			
				<div class="tile-stats tile-red">
					<div class="icon"><i class="entypo-users"></i></div>
						<div class="num" data-postfix="" data-duration="1500" data-delay="0">
						<h2>Total Miembros Inactivos</h2><br>	
							<?php													
							$query = "select COUNT(id) from persons WHERE activo=0";

							//echo $query;
							$result = mysqli_query($con, $query);
							$i      = 1;
							if (mysqli_affected_rows($con) != 0) {
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        echo $row['COUNT(id)'];
							    }
							}
							$i = 1;
							?>
						</div>
				</div>
			</a>
			</div>	
				
			<div class="col-sm-3">			
				<div class="tile-stats tile-aqua">
					<div class="icon">
						<!-- i class="entypo-mail"></i -->
						<i class="entypo-chart-bar"></i>
					</div>
						<div class="num" data-postfix="" data-duration="1500" data-delay="0">
						<h2>Inscriptos este Mes</h2><br>	
							<?php
							$date  = date('Y-m');
							//$query = "select COUNT(*) from user_data WHERE wait='no'";
							$query = "select COUNT(id) from persons where activo=1 and month(cdate) = month(sysdate()) and year(cdate)=year(sysdate())";	

							//echo $query;
							$result = mysqli_query($con, $query);
							$i      = 1;
							if (mysqli_affected_rows($con) != 0) {
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        echo $row['COUNT(id)'];
							    }
							}
							$i = 1;
							?>
						</div>
				</div>			
			</div>

			<div class="col-sm-3">			
				<div class="tile-stats tile-blue">
					<div class="icon"><i class="entypo-rss"></i></div>
						<div class="num" data-postfix="" data-duration="1500" data-delay="0">
						<h2>Ingresos del Mes</h2><br>	
							$ <?php
							$date  = date('Y-m');
							$query = "select * from subsciption WHERE paid_date LIKE '$date%'";
							
							//echo $query;
							$result  = mysqli_query($con, $query);
							$revenue = 0;
							if (mysqli_affected_rows($con) != 0) {
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        $revenue = $row['total'] + $revenue;
							    }
							}
							echo $revenue;
							?>
						</div>
				</div>
			</div>

			<div class="col-sm-3">	
			<a href="payments.php">			
				<div class="tile-stats tile-red">
					<div class="icon"><i class="entypo-users"></i></div>
						<div class="num" data-postfix="" data-duration="1500" data-delay="0">
						<h2>Miembros <br/>Mes actual impago</h2><br>	
							<?php
							//$query = "select COUNT(id) from persons WHERE activo=0";							
							$query = "select COUNT(id) from Persons P where P.activo=1 and P.Dni not in (select Dni_id from cuotas where Mes = month(sysdate()) and Anio = year(sysdate()) )";

							//echo $query;
							$result = mysqli_query($con, $query);
							//$i      = 1;
							if (mysqli_affected_rows($con) != 0) {
								//echo "<pre>";
								//echo "result: ". $result;
								//echo "</pre>";
								//die();
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        echo $row['COUNT(id)'];
							    }
							}
							//$i = 1;
							?>
						</div>
				</div>
			</a>
			</div>	

			<div class="col-sm-3">	
			<a href="pagaron.php">			
				<div class="tile-stats tile-green">
					<div class="icon"><i class="entypo-users"></i></div>
						<div class="num" data-postfix="" data-duration="1500" data-delay="0">
						<h2>Miembros <br/>Mes actual pago</h2><br>	
							<?php													
							$query = "select COUNT(id) from Persons P where p.activo=1 and P.Dni in (select Dni_id from cuotas where Mes = month(sysdate()) and Anio = year(sysdate()) )";

							//echo $query;
							$result = mysqli_query($con, $query);
							//$i      = 1;
							if (mysqli_affected_rows($con) != 0) {
								//echo "<pre>";
								//echo "result: ". $result;
								//echo "</pre>";
								//die();
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        echo $row['COUNT(id)'];
							    }
							}
							//$i = 1;
							?>
						</div>
				</div>
			</a>
			</div>
						
		<br/>
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
