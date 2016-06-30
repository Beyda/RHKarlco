<?php 
	include_once("../../control/connect.php");
 	session_start();
 	$id = $_GET["id"];
 	$val = $_GET["val"];

 	$upt_status = "UPDATE `datos_personales` SET `estatus`=$val WHERE `id_datosper` = $id";
	$res_status = $mysqli->query($upt_status);

	$sel_status = "SELECT  `estatus` FROM `datos_personales` WHERE `id_datosper` = $id and `estatus` = $val";
	$res_selstatus = $mysqli->query($sel_status);
	$numrows = $res_selstatus->num_rows;
	if ($numrows > 0) {
		header("Location: l_empleados.php");
	}
	if ($numrows == 0) {
		echo "<script>if(confirm('No se pudo actualizar')){ 
			document.location='l_empleados.php';} 
			else{ alert('Operacion Cancelada'); 
			}</script>";
	}


?>