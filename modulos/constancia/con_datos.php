<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Constancia de trabajo</title>
	<link type="image/x-icon" href="../../imagenes/favicon.ico" rel="icon" />
	<link href="../constancia/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once("../../control/connect.php");
$id_const = $_GET["id"];
$const_dat = "SELECT * FROM `constancia` WHERE `id_cons` = $id_const";
$res_const_dat = $mysqli->query($const_dat);
$row_const_dat = $res_const_dat->fetch_array();

$id_emp = $row_const_dat[4];
$demp = "SELECT `primer_nombre`,`segundo_nombre`, `ap_paterno`, `ap_materno`, `curp`, `rfc`, `imss` FROM `datos_personales` WHERE `id_datosper` = $id_emp";
$res_demp = $mysqli->query($demp);
$row_demp = $res_demp->fetch_array();

$puesto = "SELECT p.`puesto` FROM `puesto_per` pp INNER JOIN `puestos` p ON pp.`id_puesto` = p.`id_puesto` WHERE pp.`id_puestoper` = $row_const_dat[5]";
$res_puesto = $mysqli->query($puesto);
$row_puesto = $res_puesto->fetch_array();

$rh = "SELECT `id_datosper`, `primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno` FROM `datos_personales` WHERE `id_datosper` = $row_const_dat[8]";
$res_rh = $mysqli->query($rh);
$row_rh = $res_rh->fetch_array();
?>
<div class="margen">
	<p class="fecha">Navojoa, Sonora, <?php 
	$dias2 = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$ano = date("Y", strtotime($row_const_dat[1]));
	$dia = date('d', strtotime($row_const_dat[1]));
	$mes = date('n', strtotime($row_const_dat[1]));
	$dia_w = date('w', strtotime($row_const_dat[1]));
	 
	echo $dias2[$dia_w].", ".$dia." de ".$meses[$mes-1]. " de ".$ano;
	?></p>
<center><h1>CONSTANCIA DE TRABAJO</h1></center>
<h4>A QUIEN CORRESPONDA:</h4>
<p>El que subscribe la <?php echo $row_const_dat[2] ?>, Encargado <?php echo $row_const_dat[3] ?> hace constar que:</p>

<center><h1><?php echo $row_demp[0] ." ". $row_demp[1] ." ". $row_demp[2] ." ". $row_demp[3] ?></h1></center>
<p>Desempeña el cargo de: <strong><?php echo $row_puesto[0] ?></strong>, contando con los siguientes datos administrativos de registro por medio de aoutsorcing:</p>
<ul>
	<li><strong>CURP: </strong><?php echo strtoupper($row_demp[4]) ?></li>
	<li><strong>RFC: </strong><?php echo strtoupper($row_demp[5]) ?></li>
	<li><strong>SUELDO MENSUAL: </strong><?php echo $row_const_dat[6] ?></li>
	<li><strong>FECHA DE INGRESO: </strong><?php 
		$ano = date("Y", strtotime($row_const_dat[7]));
		$mes = date('n', strtotime($row_const_dat[7]));
		echo strtoupper($meses[$mes-1]) ." de ". $ano ?></li>
	<li><strong>IMSS: </strong><?php echo strtoupper($row_demp[6]) ?></li>
</ul>
<p>Extendemos la presente para los fines que convengan.</p>
<p>Atentamente:</p>
<table>
	<tr>
		<td><center><?php echo $row_rh[1] ." ". $row_rh[2] ." ". $row_rh[3] ." ". $row_rh[4] ?><br>Departamento Legal y R.H.</center></td>
	</tr>
</table>
</div>
</body>
</html>
