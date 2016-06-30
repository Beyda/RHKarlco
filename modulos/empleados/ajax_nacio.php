<?php

include_once("../../control/connect.php");
$datper_pais=$_POST['datper_pais'];

$query = "SELECT * FROM  `pais` WHERE `id_pais` =  $datper_pais order by `nombre` ASC";
$result = $mysqli->query($query) or die ($mysqli->error);
$filas = $result->num_rows;

if($filas > 0){

while($row = mysqli_fetch_array($result)){
$id_pais=$row['id_pais'];
$nacionalidad=$row['nacionalidad'];
echo '<option value="'.$id_pais.'">'. $nacionalidad .'</option>';

}

 }else{

echo '<option selected disabled value="">No existe nacionalidad</option>';
}

?>