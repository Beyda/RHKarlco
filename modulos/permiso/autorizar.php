<?php
require("../../control/connect.php");
session_start(); 
	if (isset($_POST["autorizar"])) 
	  	{
	  		$id_per = $_POST["autorizar"];
	  		$obs = $_POST["obs"];
	  		$tipo = $_GET["tipo"];
	  		$date = date('Y-m-j');
	  		if ($tipo == "0") { //JEFE INMEDIATO
	  			$updAutor = "UPDATE `permisos` SET `jefe_in`=$_SESSION[id_datosper],`fecha_in`='$date',`obs_in`='$obs', `etapa`= 1 WHERE `id_permiso` = $id_per";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		elseif ($tipo == "1") { //JEFE DE ÁREA
	  			$updAutor = "UPDATE `permisos` SET `jefe_ar`=$_SESSION[id_datosper],`fecha_ar`='$date',`obs_ar`='$obs',`etapa`=2 WHERE `id_permiso` = $id_per";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		elseif ($tipo == "2") { //RECURSOS HUMANOS
	  			$updAutor = "UPDATE `permisos` SET `rh`=$_SESSION[id_datosper],`fecha_rh`='$date',`obs_rh`='$obs',`etapa`=3 WHERE `id_permiso` = $id_per";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		
        	
	        
	        if($mysqli->error)
	            {
	            	echo "<script>if(confirm('No se pudo autorizar')){ 
					document.location='permisos.php';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
	            } else
	            {
	            	echo "<script> document.location='permisos.php'; </script>";
	            }
	  	}

	  	if (isset($_POST["rechazar"])) 
	  	{
	  		$id_per = $_POST["rechazar"];
	  		$obs = $_POST["obs"];
	  		$tipo = $_GET["tipo"];
	  		$date = date('Y-m-j');
	  		if ($tipo == "0") { //JEFE INMEDIATO
	  			$updAutor = "UPDATE `permisos` SET `jefe_in`=$_SESSION[id_datosper],`fecha_in`='$date',`obs_in`='$obs', `etapa`= 4 WHERE `id_permiso` = $id_per";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		elseif ($tipo == "1") { //JEFE DE ÁREA
	  			$updAutor = "UPDATE `permisos` SET `jefe_ar`=$_SESSION[id_datosper],`fecha_ar`='$date',`obs_ar`='$obs',`etapa`=4 WHERE `id_permiso` = $id_per";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		elseif ($tipo == "2") { //RECURSOS HUMANOS
	  			$updAutor = "UPDATE `permisos` SET `rh`=$_SESSION[id_datosper],`fecha_rh`='$date',`obs_rh`='$obs',`etapa`=4 WHERE `id_permiso` = $id_per";
        		$updAutor = $mysqli->query($updAutor);
	  		}
	  		
        	
	        if($mysqli->error)
	            {
	            	echo "<script>if(confirm('No se pudo rechazar')){ 
					document.location='permisos.php';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
	            } else
	            {
	            	echo "<script> document.location='permisos.php'; </script>";
	            }
	        
	  	}

?>