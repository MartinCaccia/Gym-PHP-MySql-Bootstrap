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

    //get number of rows
    $resultNum = mysqli_query($db, "SELECT * FROM user_data ".$whereSQL.$orderSQL);
	$result = mysqli_query($db, "select * from user_data ".$whereSQL.$orderSQL." LIMIT ".$start.",".$limit);
	$rowCount = mysqli_num_rows($resultNum);
    //$resultNum = $queryNum->fetch_assoc();
    //$rowCount = $resultNum['postNum'];
	
	echo "<pre> start: ". $start."</pre>";
    echo "<pre> rowCount: ". $rowCount."</pre>";
	echo "<pre> limit: ". $limit."</pre>";
	

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);


    if($rowCount > 0){ ?>
        <div class="posts_list">
        <?php
            while($row = $result->fetch_assoc()){ 
                $postID = $row['id'];
        ?>
            <div class="list_item">
			<a href="javascript:void(0);"><h2>
			<?php 
			echo $row["name"]; 
			
			?>
			</h2></a>
			</div>
        <?php } ?>
        </div>		
<?php 
echo $pagination->createLinks();
    } 
} 
?>