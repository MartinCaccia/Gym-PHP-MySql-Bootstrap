<?php
$a = $_SERVER['HTTP_REFERER'];

//echo "<pre>";
//echo $a;
//echo "</pre>";

if (strpos($a, '/PHPGym/') !== false) {
    
} else {
    header("Location: ../login/");
}


include '../include/db_conn.php';


$user_id_auth = ltrim($_POST['user_id_auth']);
$user_id_auth = rtrim($user_id_auth);

$pass_key = ltrim($_POST['pass_key']);
$pass_key = rtrim($_POST['pass_key']);

$user_id_auth = stripslashes($user_id_auth);
$pass_key     = stripslashes($pass_key);

$user_id_auth = mysqli_real_escape_string($con, $user_id_auth);
$pass_key     = mysqli_real_escape_string($con, $pass_key);
$sql          = "SELECT login_id, pass_key, security, level, sex, name, LastName FROM Persons WHERE login_id='$user_id_auth' and pass_key='$pass_key'";

$result       = mysqli_query($con, $sql);

$count        = mysqli_num_rows($result);


//echo "<pre>";
//echo "SQL: ".$sql."</br>";
//echo $result;
//echo "count: ".$count;
//echo "</pre>";


if ($count == 1) {
    $row = mysqli_fetch_assoc($result);
    
	session_start();
    // store session data	
	$_SESSION['ErrorLogin'] = "ENTRO BIEN";
    $_SESSION['user_data']  = $user_id_auth;
    $_SESSION['logged']     = "start";
    $_SESSION['auth_level'] = $row["level"];
    $_SESSION['sex']        = $row["sex"];
    $_SESSION['full_name']  = $row["name"]." ".$row["LastName"];
    $auth_l_x               = $_SESSION['auth_level'];

	//echo "auth_l_x: " .$auth_l_x."</br>";
	//echo "full_name: " .$_SESSION['full_name']."</br>";

    /* obtener array asociativo 
    while ($row = mysqli_fetch_assoc($result)) {
        
			echo "login_id: " .$row["login_id"]."</br>";
			echo "pass_key: " .$row['pass_key']."</br>";
			echo "security: " .$row['security']."</br>";
			echo "level: " .$row['level']."</br>";
			echo "sex: " .$row['sex']."</br>";
			echo "name: " .$row['name']."</br>";		
    }


			echo "login_id: " .$row["login_id"]."</br>";
			echo "pass_key: " .$row["pass_key"]."</br>";
			echo "security: " .$row["security"]."</br>";
			echo "level: " .$row["level"]."</br>";
			echo "sex: " .$row["sex"]."</br>";
			echo "name: " .$row["name"]."</br>";	
	*/

    if ($auth_l_x == 5) {
        header("location: ../dashboard/admin/");
    } else if ($auth_l_x == 4) {
        header("location: ../dashboard/cashier/");
    } else if ($auth_l_x == 3) {
        header("location: ../dashboard/member/");        
    } else {
        header("location: ../login/");
    }

} else {
	session_start();
	$_SESSION['ErrorLogin'] = "Usuario o Contraseña Invalidos";
	header("location: ../login/");
	//header("location: ../login/more-login.php");
	//session_destroy();
	//echo "<html><head><script>alert('Usuario O Contraseña Invalidos');</script></head></html>";
    //include 'index.php';	
	//echo "</pre>Usuario O Contraseña Invalidos</pre>";
	//$location = 'more-login.php?Error=Usuario O Contraseña Invalidos.';
	//mysqli_close($con);
	//header_redirect($location, true, 303);
}

?>