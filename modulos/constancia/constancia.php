<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Constancia de trabajo</title>
	<link type="image/x-icon" href="../../imagenes/favicon.ico" rel="icon" />
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once("../../control/connect.php");
$id_emp = $_GET["id"];
?>
<div class="margen">
	<p class="fecha">Navojoa, Sonora, <?php 
	$dias2 = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	 
	echo $dias2[date('w')].", ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y');
	?></p>
<center><h1>CONSTANCIA DE TRABAJO</h1></center>
<h4>A QUIEN CORRESPONDA:</h4>
<p>El que subscribe la <input type="text" name="subscribe">, Encargado <input type="text" name="encargado"> hace constar que:</p>

<center><h1>Nombre del solicitante</h1></center>
<p>Desempeña el cargo de: <strong>Cargo que desempeña</strong>, contando con los siguientes datos administrativos de registro por medio de aoutsorcing:</p>
<ul>
	<li><strong>CURP:</strong><?php echo $i ?></li>
	<li><strong>RFC:</strong><?php echo $i ?></li>
	<li><strong>SUELDO MENSUAL:</strong><?php echo $i ?></li>
	<li><strong>FECHA DE INGRESO:</strong><?php echo $i ?></li>
	<li><strong>IMSS:</strong><?php echo $i ?></li>
</ul>
<p>Extendemos la presente para los fines que convengan.</p>
<p>Atentamente:</p>
<table>
	<tr>
		<td><center>Nombre<br>Departamento Legal y R.H.</center></td>
	</tr>
</table>
</div>
</body>
</html>
