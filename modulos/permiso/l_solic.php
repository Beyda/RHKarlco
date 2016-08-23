<?php
include_once("../../control/connect.php");
session_start();  
$tipo = $_POST["tipo"];
$disable = "disabled";
$personal = "ocultar";
if ($tipo == 0) {
  require('pendiente.php');
}
elseif ($tipo == 1) {
  require('autorizados.php');

}
elseif ($tipo == 2) {
  require('mias.php');
}
elseif ($tipo == 3) {
  require('todos.php');
  //echo "tres";
}
?>

