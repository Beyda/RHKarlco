<?php

include_once("../../control/connect.php");

$query = "SELECT * FROM `carreras` ORDER BY `nombre` ASC";       
$result = $mysqli->query($query) or die ($mysqli->error);
$filas = $result->num_rows;

if($filas > 0){

echo '<option value=""></option>';

while($row = mysqli_fetch_array($result)){
$id_carrera=$row['id_carrera'];
$nombre=$row['nombre'];
echo '<option value="'.$id_carrera.'">'. $nombre .'</option>';

}

 }else{

echo '<option selected disabled value="">No existen areas</option>';
}

?>