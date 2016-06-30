<?php 
	include_once("../../control/connect.php");
 	session_start();
 	$id = $_GET["id"];
 	$val = $_GET["val"];

 	$upt_status = "UPDATE `areas` SET `estatus`= $val WHERE `id_area` = $id";
	$res_status = $mysqli->query($upt_status);
	
	if ($res_status) {
		header("Location: l_areas.php");
	}else 
	{
		echo "<script>if(confirm('No se pudo actualizar')){ 
			document.location='l_areas.php';} 
			else{ alert('Operacion Cancelada'); 
			}</script>";
	}


?>