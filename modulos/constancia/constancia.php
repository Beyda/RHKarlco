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
$demp = "SELECT `primer_nombre`,`segundo_nombre`, `ap_paterno`, `ap_materno`, `curp`, `rfc`, `imss` FROM `datos_personales` WHERE `id_datosper` = $id_emp";
$res_demp = $mysqli->query($demp);
$row_demp = $res_demp->fetch_array();

$ingreso = "SELECT `fecha` FROM `puesto_per` WHERE `id_datosper` = $id_emp ORDER BY `fecha` ASC LIMIT 1";
$res_ingreso = $mysqli->query($ingreso);
$row_ingreso = $res_ingreso->fetch_array();

$puesto = "SELECT p.`puesto`, pp.`salario`, pp.`fecha_final`, pp.`id_puestoper` FROM `puesto_per` pp INNER JOIN `puestos` p ON pp.`id_puesto` = p.`id_puesto` WHERE pp.`id_datosper` = $id_emp AND pp.`fecha_final` = '0000-00-00' ";
$res_puesto = $mysqli->query($puesto);
$row_puesto = $res_puesto->fetch_array();

$rh = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno` FROM `datos_personales` d INNER JOIN `usuarios` u ON u.`id_datosper` = d.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` AND t.`nombre` = 'Recursos Humanos'";
$res_rh = $mysqli->query($rh);
$row_rh = $res_rh->fetch_array();
?>
<form method="post">
<div class="margen">
	<p class="fecha">Navojoa, Sonora, <?php 
	$dias2 = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	 
	echo $dias2[date('w')].", ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y');
	?></p>
<center><h1>CONSTANCIA DE TRABAJO</h1></center>
<h4>A QUIEN CORRESPONDA:</h4>
<p>El que subscribe <?php echo $row_rh[1] ." ". $row_rh[2] ." ". $row_rh[3] ." ". $row_rh[4] ?>, encargado de R.H. y Asuntos Legales hace constar que:</p>

<center><h1><?php echo $row_demp[0] ." ". $row_demp[1] ." ". $row_demp[2] ." ". $row_demp[3] ?></h1></center>
<p>Desempeña el cargo de: <strong><?php echo $row_puesto[0] ?></strong>, contando con los siguientes datos administrativos de registro por medio de aoutsorcing:</p>
<ul>
	<li><strong>CURP: </strong><?php echo strtoupper($row_demp[4]) ?></li>
	<li><strong>RFC: </strong><?php echo strtoupper($row_demp[5]) ?></li>
	<li><strong>SUELDO MENSUAL: </strong><?php echo number_format($row_puesto[1],2) ?></li>
	<li><strong>FECHA DE INGRESO: </strong><?php 
		$ano = date("Y", strtotime($row_ingreso[0]));
		$mes = date('n', strtotime($row_ingreso[0]));
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
<input type="submit" name="descargar" value="Descargar">
</form>
<?php
	if ($row_puesto[3] == "") {
		echo "<script>if(confirm('Tienes que asignarle a este trabajador un puesto actual primero')){ 
				document.location='/rhkarlco/modulos/empleados/a_perfil.php?id=$id_emp';} 
				else{ alert('Operacion Cancelada'); 
				}</script>";
	}
	if (isset($_POST["descargar"])) {
		$fecha = date('Y-m-d');
		$subscribe = $_POST["subscribe"];
		$encargado = $_POST["encargado"];
		$id_solicitante = $id_emp;
		$id_puestoper = $row_puesto[3];
		$sueldo = $row_puesto[1];
		$fecha_ingreso = $row_ingreso[0];
		$id_rh = $row_rh[0];

		echo $constancia = "INSERT INTO `constancia`(`fecha`, `subscribe`, `encargo`, `id_solicitante`, `id_puestoper`, `sueldo`, `fecha_ingreso`, `id_rh`) VALUES ('$fecha','$subscribe','$encargado',$id_solicitante,$id_puestoper,$sueldo,'$fecha_ingreso',$id_rh)"; //Busca todos los días vacaciones
		$res_constancia = $mysqli->query($constancia);
		if ($mysqli->error) 
			{
				echo "<script>if(confirm('Ocurrió un error, favor de intentarlo nuevamente')){ 
				document.location='constancia.php?id=$id_solicitante';} 
				else{ alert('Operacion Cancelada'); 
				}</script>";
			}else
			{
				$selconst = "SELECT `id_cons` FROM `constancia` WHERE `fecha` = '$fecha' AND `id_solicitante` = $id_solicitante AND `id_puestoper` = $id_puestoper AND `subscribe` = '$subscribe' AND `encargo` = '$encargado' AND `fecha_ingreso` = '$fecha_ingreso' LIMIT 1"; //Busca todos los días selconst
				$res_selconst = $mysqli->query($selconst);
				$row_reselconst = $res_selconst->fetch_array();
				echo "<script> document.location='../pdf/constancia.php?id=$row_reselconst[0]'; </script>";
			}
	}
?>
</body>
</html>
