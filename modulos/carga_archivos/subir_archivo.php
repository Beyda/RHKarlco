<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*
*Aquí se suben cada uno de los archivos por empleado en la siguiente variable
*@var string $_SESSION['id_datosper'] aqui se manda el id del empleado
*@var string $archivo aqui se mandan el nombre del archivo
*@var string $nombre aqui se guarda el nombre completo del archivo
*@var string $ruta aqui se manda la ruta donde se guardará el archivo
*/
if (isset($_FILES['archivo'])) {
  session_start();
  if ($_SESSION['id_tmp'] == $_SESSION['id_datosper']) {
  $_SESSION['id_tmp2'] = $_SESSION['id_datosper'];
  }else
  {
    $_SESSION['id_tmp2'] = $_SESSION['id_tmp'];
  }
    $archivo = $_FILES['archivo'];
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
	$time = time();
	$id_doc = $_POST['nombre_archivo'];
  require("../../control/connect.php");
  $abrev = "SELECT `abrev` FROM `tipo_doc` WHERE `id_tdoc` = $id_doc";
  $resul_abrev = $mysqli->query($abrev);
  $row = $resul_abrev->fetch_array();
    $nombre = "$_SESSION[id_tmp2]__$row[0].$extension";
    $ruta = "carga_archivos/archivos_subidos/$nombre";
    if (!file_exists($ruta))
    {
      if (move_uploaded_file($archivo['tmp_name'], "archivos_subidos/$nombre")) {
          echo $v = 1;
      } else {
          echo $v = 0;
      }
    }
   if ($v == 1) {
   	$doc = "INSERT INTO `documentos`(`id_tdoc`, `nombre`, `id_datosper`) VALUES ($id_doc,'$nombre',$_SESSION[id_tmp2])";
    $resul_doc = $mysqli->query($doc);
    if ($mysqli->error) {
      unlink("archivos_subidos/$nombre");
      echo 0;
    }
   }
}


?>
