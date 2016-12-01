<?php
$mysqli = new mysqli("localhost", "", "", "");
//$mysqli = new mysqli("localhost", "root", "", "admin_rhkarlco");
/* check connection */
if (mysqli_connect_errno()) {
    echo "<li>Coneccion Fallida!! : %s\n", mysqli_connect_error();
    exit();
}else{

//echo "Coneccion Exitosa";

}
$mysqli->set_charset("utf8");
?>
