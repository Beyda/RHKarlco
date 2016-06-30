<?php

include_once("../../../control/connect.php");
$area=$_POST['area'];


$query = "SELECT * FROM `subarea` WHERE `id_area` = $area and `estatus` = 1 order by `nombre` ASC";
$result = $mysqli->query($query) or die ($mysqli->error);
$filas = $result->num_rows;

if($filas > 0){

echo '<option selected disabled value="">Selecciona una subarea</option>';

while($row = mysqli_fetch_array($result)){
$id_sub=$row['id_sub'];
$nombre=$row['nombre'];
echo '<option value="'.$id_sub.'">'. $nombre .'</option>';

}

 }else{

echo '<option selected disabled value="">No existen subareas</option>';
}

?>