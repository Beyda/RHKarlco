<?php

include_once("../../control/connect.php");
$datper_estado=$_POST['datper_estado'];


$query = "SELECT * FROM `municipio` WHERE `id_estado` =  $datper_estado order by `nombre` ASC";
$result = $mysqli->query($query) or die ($mysqli->error);
$filas = $result->num_rows;

if($filas > 0){

echo '<option selected disabled value="">Selecciona un municipio</option>';

while($row = mysqli_fetch_array($result)){
$id_municipio=$row['id_municipio'];
$muni=$row['nombre'];
echo '<option value="'.$id_municipio.'">'. utf8_encode($muni) .'</option>';

}

 }else{

echo '<option selected disabled value="">No existen municipios</option>';
}

?>