<?php
session_start();
if ($_SESSION['id_tmp'] == $_SESSION['id_datosper']) {
	$_SESSION['id_tmp2'] = $_SESSION['id_datosper'];
}else
{
	$_SESSION['id_tmp2'] = $_SESSION['id_tmp'];
}
include_once("../../control/connect.php");
$id_tmp=$_POST['variable'];


$selectt = "SELECT distinct * FROM `tipo_doc` WHERE `tipo_doc`.`id_tdoc` NOT IN (SELECT `id_tdoc` FROM `documentos` WHERE `id_datosper` = $_SESSION[id_tmp2] and `tipo_doc`.`id_tdoc` = `documentos`.`id_tdoc`)";
$result = $mysqli->query($selectt) or die ($mysqli->error);
$filas = $result->num_rows;

if($filas > 0){

echo '<div class="input-group" id="recargado">';
echo '<select class="form-control" name="nombre_archivo" id="nombre_archivo">';
echo '<option selected disabled value="">Selecciona un tipo</option>';

while($row = mysqli_fetch_array($result)){
$id_tdoc=$row['id_tdoc'];
$nombre=$row['nombre'];
echo '<option value="'.$id_tdoc.'">'. $nombre .'</option>';

}

 }else{

echo '<option selected disabled value="">No hay más tipos</option>';
}
echo '</select>';
echo '</div>';

?>