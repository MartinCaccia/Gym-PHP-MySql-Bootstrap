<?php
include '../../include/db_conn.php';
//require 'db_conn.php';
page_protect();

$msgid = $_REQUEST['id'];
if (strlen($msgid) > 0) {
    mysqli_query($con, "UPDATE Persons set Activo = 1 WHERE id='$msgid'");
    //mysqli_query($con, "DELETE FROM subsciption WHERE mem_id='$msgid'");
    echo "<html><head><script>alert('Socio Activo nuevamente');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=view_mem.php'>";
} else {
    echo "<html><head><script>alert('ERROR! No se pudo dar de alta al socio nuevamente.');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=view_mem.php'>";
}
mysqli_close($con);

?>