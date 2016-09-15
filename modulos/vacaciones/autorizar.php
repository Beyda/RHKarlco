<?php
require("../../control/connect.php");
session_start(); 
	if (isset($_POST["autorizar"])) 
	  	{
	  		$id = $_POST["autorizar"];
	  		$obs = $_POST["obs"];
	  		$tipo = $_GET["tipo"];
	  		$date = date('Y-m-j');
	  		if ($tipo == "0") { //JEFE INMEDIATO
	  			$updAutor = "UPDATE `vacaciones` SET `jefe_in`=$_SESSION[id_datosper],`fecha_in`='$date',`obs_in`='$obs', `etapa`= 1 WHERE `id_vaca` = $id";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		elseif ($tipo == "1") { //JEFE DE ÁREA
	  			$updAutor = "UPDATE `vacaciones` SET `jefe_ar`=$_SESSION[id_datosper],`fecha_ar`='$date',`obs_ar`='$obs',`etapa`=2 WHERE `id_vaca` = $id";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		elseif ($tipo == "2") { //RECURSOS HUMANOS
	  			$updAutor = "UPDATE `vacaciones` SET `rh`=$_SESSION[id_datosper],`fecha_rh`='$date',`obs_rh`='$obs',`etapa`=3 WHERE `id_vaca` = $id";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		
        	
	        
	        if($mysqli->error)
	            {
	            	echo "<script>if(confirm('No se pudo autorizar')){ 
					document.location='vacaciones.php';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
	            } else
	            {
	            	echo "<script> document.location='vacaciones.php'; </script>";
	            }
	  	}


	  	if (isset($_POST["rechazar"])) 
	  	{
	  		$id = $_POST["rechazar"];
	  		$obs = $_POST["obs"];
	  		$tipo = $_GET["tipo"];
	  		$date = date('Y-m-j');
	  		if ($tipo == "0") { //JEFE INMEDIATO
	  			$updAutor = "UPDATE `vacaciones` SET `jefe_in`=$_SESSION[id_datosper],`fecha_in`='$date',`obs_in`='$obs', `etapa`= 4 WHERE `id_vaca` = $id";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		elseif ($tipo == "1") { //JEFE DE ÁREA
	  			$updAutor = "UPDATE `vacaciones` SET `jefe_ar`=$_SESSION[id_datosper],`fecha_ar`='$date',`obs_ar`='$obs',`etapa`=4 WHERE `id_vaca` = $id";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		elseif ($tipo == "2") { //RECURSOS HUMANOS
	  			$updAutor = "UPDATE `vacaciones` SET `rh`=$_SESSION[id_datosper],`fecha_rh`='$date',`obs_rh`='$obs',`etapa`=4 WHERE `id_vaca` = $id";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		
        	
	        
	        if($mysqli->error)
	            {
	            	echo "<script>if(confirm('No se pudo autorizar')){ 
					document.location='vacaciones.php';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
	            } else
	            {
	            	$dias = "SELECT `dias`, `id_solicitante` FROM `vacaciones` WHERE `id_solicitante` = $id"; //Busca todos los días vacaciones
					$res_dias = $mysqli->query($dias);
	            	$rembolso = "INSERT INTO `dias_vacaciones`(`descripcion`, `dias`, `id_ejercicio`, `fecha`, `id_datosper`, `id_autoriza`, `signo`) VALUES ('Días devueltos por rechazo de solicitud',$res_dias[0],$row_anos[0],'$fecha',$res_dias[1],77,'+')"; //regresa los días quitados
					//$res_rembolso = $mysqli->query($rembolso);
	            	//echo "<script> document.location='vacaciones.php'; </script>";
	            }
	  	}

?>