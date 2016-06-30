<?php 
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*/
	include_once("../../control/connect.php");
 	session_start();
 	$id = $_GET["id_sub"];
 	$val = $_GET["val"];
 	$id_ar = $_GET["id_ar"];

 	$upt_status = "UPDATE `subarea` SET `estatus`= $val WHERE `id_sub` = $id";
	$res_status = $mysqli->query($upt_status);
	
	if ($res_status) {
		header("Location: l_subareas.php?id=$id_ar");
	}else 
	{
		echo "<script>if(confirm('No se pudo actualizar')){ 
			document.location='l_subareas.php?id=$id_ar';} 
			else{ alert('Operacion Cancelada'); 
			}</script>";
	}


?>