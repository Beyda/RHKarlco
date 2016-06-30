<?php

include_once("../../control/connect.php");
$datper_pais=$_POST['datper_pais'];


$query = "SELECT * FROM `estado` WHERE `id_pais` =  $datper_pais order by `nombre` ASC";
$result = $mysqli->query($query) or die ($mysqli->error);
$filas = $result->num_rows;

if($filas > 0){

echo '<option selected disabled value="">Selecciona una estado</option>';

while($row = mysqli_fetch_array($result)){
$id_estado=$row['id_estado'];
$estado=$row['nombre'];
echo '<option value="'.$id_estado.'">'. utf8_encode($estado) .'</option>';

}

 }else{

echo '<option selected disabled value="">No existen ciudades</option>';
}

?>