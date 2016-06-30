<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*
*Aquí se elimina el archivo que se manda en la siguiente variable
*@var string $archivo aqui se manda el nombre del archivo a borrar
*/
if (isset($_POST['archivo'])) {
    $archivo = $_POST['archivo'];
    if (file_exists("archivos_subidos/$archivo")) {
        unlink("archivos_subidos/$archivo");
        echo $v2 = 1;
    } else {
        echo $v2 = 0;
    }

    if ($v2 == 1) {
   	require("../../control/connect.php");
			$mysqli->set_charset("utf8");
   	$delete = "DELETE FROM `documentos` WHERE `nombre` = '$archivo'";
    $resul_delete = $mysqli->query($delete);
   }
}
?>
