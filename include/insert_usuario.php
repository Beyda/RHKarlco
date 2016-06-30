

<?php


require ('conecc.php');
$id_usuario=$_POST['id_usuario'];
$nombre=$_POST['nombre'];
$correo=$_POST['correo'];
$telefono=$_POST['telefono'];
$contrasena=md5($_POST['contrasena']);



echo $query1=" insert into `inscripcion`.`login`  values('', '".$_POST["nombre"]."', '".$_POST["correo"]."',  '".$_POST["telefono"]."', '".md5($_POST['contrasena'])."')";
$resultado = $mysqli->query($query1) or die ($mysqli->error);



header("Location: /inscripciones/admin/catalogo_usuarios.php");




?>


