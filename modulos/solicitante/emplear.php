<?php
require("../../control/connect.php");
	if (isset($_GET["emp"])) 
	  	{
	  		$id = $_GET["emp"];
	  		$updtSol = "UPDATE `datos_personales` SET `solicitante`= 0 WHERE `id_datosper` = $id";
        	$updtSol = $mysqli->query($updtSol);
	        
	        if($mysqli->error)
	            {
	            	echo "<script>if(confirm('No se pudo borrar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
	            } else
	            {
	            	header( "Location: ../usuarios/r_usuarios.php");
	            }
	  	}

?>