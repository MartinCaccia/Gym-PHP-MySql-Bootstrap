<?php

$count = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    foreach ($_FILES['files']['name'] as $i => $name) {
        if (strlen($_FILES['files']['name'][$i]) > 1) {
			//$name = basename($_FILES['files']['tmp_name'][$i]);
			//echo "name: ".$name;
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], 'uploadHTML5/'.$name)) {
                $count++;
            }
        }
    }
}

?>