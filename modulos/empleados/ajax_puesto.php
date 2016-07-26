<?php

include_once("../../control/connect.php");
$empresa=$_POST['empresa'];


$query = "SELECT * FROM `puestos` WHERE `id_empresa` =  $empresa order by `puesto` ASC";
$result = $mysqli->query($query) or die ($mysqli->error);
$filas = $result->num_rows;

if($filas > 0){

echo '<option selected disabled value="">Selecciona un puesto</option>';

while($row = mysqli_fetch_array($result)){
$id_puesto=$row['id_puesto'];
$puesto=$row['puesto'];
echo '<option value="'.$id_puesto.'">'. utf8_encode($puesto) .'</option>';

}

 }else{

echo '<option selected disabled value="">No existen puestos</option>';
}

?>