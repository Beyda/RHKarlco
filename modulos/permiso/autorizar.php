<?php
require("../../control/connect.php");
session_start(); 
	if (isset($_GET["idvac"])) 
	  	{
	  		$id = $_GET["idvac"];
	  		$obs = $_GET["obs"];
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
	  			echo $updAutor = "UPDATE `vacaciones` SET `rh`=$_SESSION[id_datosper],`fecha_rh`='$date',`obs_rh`='$obs',`etapa`=3 WHERE `id_vaca` = $id";
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
	            	//echo "<script> document.location='vacaciones.php'; </script>";
	            }
	  	}

?>