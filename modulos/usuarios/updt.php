<?php 
	include_once("../../control/connect.php");
 	session_start();
 	$id = $_GET["id"];
 	$val = $_GET["val"];

 	echo $upt_status = "UPDATE `usuarios` SET `estatus`= '$val' WHERE `usuario` = '$id'";
	$res_status = $mysqli->query($upt_status);

	$sel_status = "SELECT  `estatus` FROM `usuarios` WHERE `usuario` = '$id' and `estatus` = $val";
	$res_selstatus = $mysqli->query($sel_status);
	$numrows = $res_selstatus->num_rows;
	if ($numrows > 0) {
		header("Location: l_usuarios.php");
	}
	if ($numrows == 0) {
		echo "<script>if(confirm('No se pudo actualizar')){ 
			document.location='l_usuarios.php';} 
			else{ alert('Operacion Cancelada'); 
			}</script>";
	}


?>