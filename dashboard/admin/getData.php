<?php
//include '../../include/db_conn.php';
//page_protect();

//Include functions file
//include('../../include/functions.php');

echo "<pre>".$_POST['keywords']."</pre>";
die();
    
if(isset($_POST['keywords'])){
	echo "entre";
	die();
    //set conditions for search
    $whereSQL = $orderSQL = $keywords = $field = '';
	
    $keywords = $_POST['keywords'];
	$field = $_POST['field'];
    //$sortBy = $_POST['sortBy'];
    if(!empty($keywords)){
		if (field == 'dni'){
			$whereSQL = "WHERE dni LIKE '%".$keywords."%'";
		}else {
			$whereSQL = "WHERE concat(name,' ',LastName) LIKE '%".$keywords."%'";	
		}		
    }
    if(!empty($sortBy)){
        //$orderSQL = " ORDER BY id ".$sortBy;
    }else{
        $orderSQL = " ORDER BY id DESC ";
    }

    echo "<pre>query: SELECT dni, concat(name,' ',LastName) as fullname FROM Persons ".$whereSQL.$orderSQL."</pre>";
	die();
	
    //Get number of rows & resulset
    $result = mysqli_query($con, "SELECT dni, concat(name,' ',LastName) as fullname FROM Persons ".$whereSQL.$orderSQL);
	$rowCount = mysqli_num_rows($resultNum);
	
	if (mysqli_affected_rows($con) != 0) {
	//Llamo funcion para renderizar el select option:
	Html_OptionList_render($result, 0, "socios");							
	}
}else{
	echo "<pre>no entre</pre>";
	die();
}
?>
<!-- Inicio DIVS contenedores 
<div class="posts_list">
<div class="list_item">
-->
<?php	



/*Inicio render tabla dinamica
printf("</br>");
printf("</br>");
$fieldName = mysqli_fetch_fields($result);
echo '<table cellpadding="0" cellspacing="0" class="db-table">';
echo '<tr>';
foreach($fieldName as $valorf) {
	echo '<th>'.$valorf->name.'</th>';
}
echo '</tr>';
while($fieldValue = mysqli_fetch_row($result)) {
	echo '<tr>';
	foreach($fieldValue as $key=>$value) {
		echo '<td>'.$value.'</td>';
	}
	echo '</tr>';
}
echo '</table><br />';
Fin render tabla dinamica*/

	//echo "<pre> start: ". $start."</pre>";
	//echo "<pre> rowCount: ". $rowCount."</pre>";
    //echo "<pre> limit: ". $limit."</pre>";
		
?>	
<!--
</div>
</div>
 Fin DIVS contenedores -->
