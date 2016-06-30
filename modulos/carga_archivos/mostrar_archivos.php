<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*
*Aquí se muestran cada uno de los archivos por empleado en la siguiente variable
*@var string $_SESSION['id_datosper'] aqui se manda el id del empleado
*@var array $archivos aqui se mandan los nombre de los archivos encontrados
*/
session_start();
if ($_SESSION['id_tmp'] == $_SESSION['id_datosper']) {
	$_SESSION['id_tmp2'] = $_SESSION['id_datosper'];
}else
{
	$_SESSION['id_tmp2'] = $_SESSION['id_tmp'];
}
$directorio_escaneado = scandir('archivos_subidos');
$archivos = array();
	require("../../control/connect.php");
	$mysqli->set_charset("utf8");
   	$select = "SELECT d.`nombre`, t.`nombre` FROM `documentos` d INNER JOIN `tipo_doc` t ON d.`id_tdoc` = t.`id_tdoc` WHERE d.`id_datosper` =  $_SESSION[id_tmp2]";
    $resul_select = $mysqli->query($select);
    while ( $row = $resul_select->fetch_array()) {
    	foreach ($directorio_escaneado as $item) {
		    if ($item != '.' and $item != '..' and $item == $row[0]) {
		        $archivos[] = $item;
		    }
		}
    }
    

echo json_encode($archivos);
?>
