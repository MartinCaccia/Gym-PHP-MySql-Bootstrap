<script src="jquery.min.js"></script>
<script>
//document.getElementById('loading-overlay').style.display = 'none';
function searchFilter(page_num) {	
    //alert('page_num: '+page_num);
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'getData.php',
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
			//alert('html: '+html);
            $('#posts_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>
<link rel="stylesheet" href="style.css">
<div class="post-search-panel">
    Buscar: <input type="text" id="keywords" placeholder="Type keywords to filter" onkeyup="searchFilter()"/>
    Ordenar por: <select id="sortBy" onchange="searchFilter()">
					<option value=""></option>
					<option value="asc">Ascending</option>
					<option value="desc">Descending</option>
				</select>
</div>
<div class="post-wrapper">
    <div class="loading-overlay" style="display:none"><div class="overlay-content">Loading.....</div></div>
    <div id="posts_content">
    <?php
    //Include pagination class file
    include('Pagination.php');
    
    //Include database configuration file
    include('dbConfig.php');
    
    $limit = 3;
        
    //get rows
    //$query = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT $limit");
	//$result = mysqli_query($db, "select * from post Limit $start, $perpage");
	$result = mysqli_query($db, "select * from user_data ORDER BY id DESC LIMIT $limit");
	
	//$info_campo = mysqli_fetch_field_direct($result, 1);
	//echo "<pre> info_campo: ". $info_campo->name."</pre>";
	
	$resultNum = mysqli_query($db, "select * from user_data");
	
	//$info_field = mysqli_fetch_fields($result);
	//foreach ($info_field as $valor) {
		//printf("Nombre:           %s\n",   $valor->name);            
		//printf("</br>");
	//}
	
	
	/*while ($fila = mysqli_fetch_row($result)) {
		printf("%s\n", $fila[0]);
		printf("%s\n", $fila[1]);
		printf("%s\n", $fila[2]);
		printf("%s\n", $fila[3]);
		printf("</br>");
	}*/	
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
		//$postID = $fieldValue[0];
		//echo "postID: ".$postID;
	}
	echo '</tr>';
}
echo '</table><br />';
/*Fin render tabla dinamica*/

	
	//get number of rows
    //$queryNum = $db->query("SELECT COUNT(*) as postNum FROM posts");
    //$resultNum = $queryNum->fetch_assoc();
    //$rowCount = $resultNum['postNum'];
	$rowCount = mysqli_num_rows($resultNum);
	
	//echo "<pre> rowCount: ". $rowCount."</pre>";
    //echo "<pre> limit: ". $limit."</pre>";
	
    
    //initialize pagination class
    $pagConfig = array(
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

/* 
    if($rowCount > 0){ ?>
        <div class="posts_list">
        <?php
            while($row = $result->fetch_assoc()){ 
                $postID = $row['id'];
        ?>
            <div class="list_item"><a href="javascript:void(0);"><h2><?php echo $row["name"]; ?></h2></a></div>
        <?php } ?>
        </div>
        <?php echo $pagination->createLinks(); ?>
    <?php } ?>
*/	
?> 
    </div>
</div>
<!-- Fin de post-wrapper y post-content -->