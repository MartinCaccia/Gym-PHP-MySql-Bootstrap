<?php
if(isset($_POST['page'])){

    //Include pagination class file
    include('Pagination.php');
    
    //Include database configuration file
    include('dbConfig.php');
	    
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 3;
    
    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    if(!empty($keywords)){
        $whereSQL = "WHERE name LIKE '%".$keywords."%'";
    }
    if(!empty($sortBy)){
        $orderSQL = " ORDER BY id ".$sortBy;
    }else{
        $orderSQL = " ORDER BY id DESC ";
    }

    //Get number of rows & resulset
    $resultNum = mysqli_query($db, "SELECT * FROM user_data ".$whereSQL.$orderSQL);
	$result = mysqli_query($db, "select * from user_data ".$whereSQL.$orderSQL." LIMIT ".$start.",".$limit);
	$rowCount = mysqli_num_rows($resultNum);

?>
<!-- Inicio DIVS contenedores -->
<div class="posts_list">
<div class="list_item">
<?php	
/*Inicio render tabla dinamica*/
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
/*Fin render tabla dinamica*/

	//echo "<pre> start: ". $start."</pre>";
	//echo "<pre> rowCount: ". $rowCount."</pre>";
    //echo "<pre> limit: ". $limit."</pre>";
		
	//initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);
?>	
</div>
</div>
<!-- Fin DIVS contenedores -->
<?php
//Render pagination class
echo $pagination->createLinks();
}
?> 