<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*
*Se realiza una busqueda de en la base de datos sobre cierta palabra para dar
*las opciones que se encuentran en esta.
*/
$mysqli = new mysqli("localhost", "admin_rhkarlco", "bdrhk16", "admin_rhkarlco");
if (mysqli_connect_errno()) {
    echo "<li>Coneccion Fallida!! : %s\n", mysqli_connect_error();
    exit();
}
$mysqli->set_charset("utf8");


// Here, we will get user input data and trim it, if any space in that user input data
$buscar = trim($_REQUEST['term']);


// Define two array, one is to store output data and other is for display
  $display_json = array();
  $json_arr = array();
  $buscar = preg_replace('/\s+/', ' ', $buscar);

  $result_fila = $mysqli->query("SELECT * FROM `l_habilidad` WHERE `nombre` LIKE '%$buscar%'"); 


  $filas = $result_fila->num_rows;

  if($filas>0)
  {
    while($result = mysqli_fetch_array($result_fila)) 
    {
           
      $json_arr["id"] = $result['id_lhab'];
      $json_arr["value"] = $result['nombre'];
      $json_arr["label"] =$result['nombre'];
      
      array_push($display_json, $json_arr);
    }
  } else 
  {
    $json_arr["id"] = "";
    $json_arr["value"] = "";
    $json_arr["label"] = "Resultado No encontrado!";
   
    array_push($display_json, $json_arr);
  }

  $jsonWrite = json_encode($display_json); //encode that search data
   echo $jsonWrite;
?>