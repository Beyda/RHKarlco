

<?php


include_once("/../control/connect.php");
$id_usuario=$_POST['id_usuario'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$correo=$_POST['correo'];
$contrasena=md5($_POST['contrasena']);

$t_usuario=$_POST['t_usuario'];




echo $query1=" insert into `siskarco`.`login`  values('', '".$nombre."', '".$apellido."',  '".$_POST["telefono"]."', '".md5($_POST['contrasena'])."')";
$resultado = $mysqli->query($query1) or die ($mysqli->error);



header("Location: ");




?>


