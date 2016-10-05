<?php
include_once("../../control/connect.php");
?>
<!DOCTYPE html>
<html name="html">
<head>
	<meta charset="UTF-8">
	<title>Solicitud de Permiso KarlCo</title>
	<link type="image/x-icon" href="../../imagenes/favicon.ico" rel="icon" />
	<link href="../../bootstrap/css/estilo_solp.css" rel="stylesheet" type="text/css" />
	<script src="/rhkarlco/plugins/jQuery/jQuery-2.1.3.min.js"></script>
</head>
<body>
<?php
 	$id_tmp = $_GET["id"];
	$rh = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno` FROM `datos_personales` d INNER JOIN `usuarios` u ON u.`id_datosper` = d.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` AND t.`nombre` = 'Recursos Humanos'";
	$res_rh = $mysqli->query($rh);
	$row_rh = $res_rh->fetch_array();
  	$ano = "SELECT * FROM `ejercicio` WHERE `estatus` = 1";
 	$res_anos = $mysqli->query($ano);
  	$row_anos = $res_anos->fetch_array();
  	$datos = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, p.`puesto`, pe.`id_puesto`, dp.`id_datosper`, dp.`primer_nombre`, dp.`segundo_nombre`, dp.`ap_paterno`, dp.`ap_materno`, pe.`f_inicio`, pe.`f_final`, pe.`reinicio_labores`, pe.`fecha`, pe.`id_puesto`, pe.`dias_descanso`, pe.`enf_com_vac`, pe.`enf_fam_vac`, pe.`visa_vac`, pe.`personales_vac`, pe.`otro_vac`, pe.`imss_cs`, pe.`nacimiento_cs`, pe.`

  	`, pe.`reposicion_cs`, pe.`otro_cs`, pe.`consulta_ss`, pe.`personal_ss`, pe.`otro_ss`, pe.`obs`, pe.`representante`, pe.`tel_rep`, pe.`correo_rep` FROM `permisos` pe INNER JOIN `datos_personales` d ON pe.`id_solicitante` = d.`id_datosper` INNER JOIN `jefes` j ON pe.`id_puesto` = j.`id_puesto` INNER JOIN `datos_personales` dp ON dp.`id_datosper` = j.`id_jefin` INNER JOIN `puestos` p ON pe.`id_puesto` = p.`id_puesto` WHERE pe.`id_permiso` = $id_tmp";
  	$res_datos = $mysqli->query($datos);
  	$row_datos = $res_datos->fetch_array();
  	$inicio_trab = "SELECT `fecha`, `id_puesto` FROM `puesto_per` WHERE `id_datosper` = $row_datos[0] ORDER BY `fecha` ASC LIMIT 1";
  	$res_itrab = $mysqli->query($inicio_trab);
  	$row_itrab = $res_itrab->fetch_array();
  	?>
	<!-- ENCABEZADO DE LA SOLICITUD DE VACACIONES -->
	<table>
		<tr>
			<td><img src="../../imagenes/logo2.png" id="logo"></td>
			<td>
				<div id="empresa">
				KARL Co, S.A. de C.V.
				<div>Administración corporativa</div>
			</div>
			<div id="solicitud">
				SOLICITUD DE PERMISO DE AUSENCIA
			</div>
			</td>
			<td><img src="../../imagenes/logo2.png" id="logo"></td>
		</tr>
	</table>
	<!-- DATOS PERSONALES DE LA SOLICITUD DE VACACIONES -->
	<table  id="dp">
		<tbody>
			<tr>
				<td>Fecha:</td>
				<td style="float: right;"><?php 
					$dias2 = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					$ano2 = date("Y", strtotime($row_datos[15]));
					$dia2 = date('d', strtotime($row_datos[15]));
					$mes2 = date('n', strtotime($row_datos[15]));
					$dias3 = date("w", strtotime($row_datos[15]));
					echo $dias2[$dias3].", ".$dia2." de ".$meses[$mes2-1]. " de ".$ano2;
				?></td>
			</tr>
			<tr>
				<td></td>
				<td><p></p></td>
			</tr>
			<tr>
				<td>Nombre del Empleado</td>
				<td><?php echo $row_datos[1] ." ". $row_datos[2] ." ". $row_datos[3] ." ". $row_datos[4]; ?></td>
			</tr>
			<tr>
				<td>Área de Trabajo</td>
				<td><?php echo $row_datos[5]; ?></td>
			</tr>
			<tr>
				<td>Jefe de Trabajo</td>
				<td><?php echo $row_datos[8] ." ". $row_datos[9] ." ". $row_datos[10] ." ". $row_datos[11]; ?></td>
			</tr>
			<tr>
				<td>Fecha de Ingreso</td>
				<td><?php
					$ano = date("Y", strtotime($row_itrab[0]));
					$dia = date('d', strtotime($row_itrab[0]));
					$mes = date('n', strtotime($row_itrab[0]));
					echo $dia." de ".$meses[$mes-1]. " de ".$ano ;
				?></td>
			</tr>
		</tbody>
	</table>
	<!-- FECHAS DE VACACIONES -->
	<div id="result">
	<table id="fechas">
		<tbody>
			<tr>
				<td>DÍAS A DISFRUTAR </td>
				<td>FECHA DE INICIO DE VACACIONES</td>
				<td>FECHA DE CULMINACIÓN DE VACACIONES</td>
				<td>FECHA DE REINICIO DE VACACIONES</td>
			</tr>
			
			<tr>
				<td><?php echo $row_datos[17] ?></td>
				<td><?php echo date("d-m-Y", strtotime($row_datos[12]));  ?></td>
				<td><?php echo date("d-m-Y", strtotime($row_datos[13])); ?></td>
				<td><?php echo date("d-m-Y", strtotime($row_datos[14])); ?></td>
			</tr>
		</tbody>
	</table>
	</div>
	<!-- DÍAS DISTRIBUIDOS -->
	<div id="dd">
		<table id="distribuidos">
		<tbody>
			<tr>
				<td id="titulo">A CUENTA DE VACACIONES</td>
				<td id="titulo">N° Días</td>
			</tr>
			<tr>
				<td>Enfermedad no comprobada</td>
				<td id="verde"><?php 
				if ($row_datos[18] != NULL) {
					echo $row_datos[18];
				}
				 ?></td>
			</tr>
			<tr>
				<td>Enfermedad de un familiar</td>
				<td id="verde"><?php 
				if ($row_datos[19] != NULL) {
					echo $row_datos[19];
				} ?></td>
			</tr>
			<tr>
				<td>Tramite de Visa</td>
				<td id="verde"><?php 
				if ($row_datos[20] != NULL) {
					echo $row_datos[20];
				} ?></td>
			</tr>
			<tr>
				<td>Asunto personal</td>
				<td id="verde"><?php 
				if ($row_datos[21] != NULL) {
					echo $row_datos[21];
				}?></td>
			</tr>
			<tr>
				<td>Otros</td>
				<td id="verde"><?php 
				if ($row_datos[22] != NULL) {
					echo $row_datos[22];
				} ?></td>
			</tr>
			</tbody>
		</table>
		<table id="distribuidos">
		<tbody>
			<tr>
				<td id="titulo">CON GOCE DE SUELDO</td>
				<td id="titulo">N° Días</td>
			</tr>
			<tr>
				<td>Incapacidad IMSS</td>
				<td id="verde"><?php 
				if ($row_datos[23] != NULL) {
					echo $row_datos[23];
				} ?></td>
			</tr>
			<tr>
				<td>Nacimiento hijo</td>
				<td id="verde"><?php 
				if ($row_datos[24] != NULL) {
					echo $row_datos[24];
				} ?></td>
			</tr>
			<tr>
				<td>Defunción Familiar Directo</td>
				<td id="verde"><?php 
				if ($row_datos[25] != NULL) {
					echo $row_datos[25];
				} ?></td>
			</tr>
			<tr>
				<td>Reposición de día</td>
				<td id="verde"><?php 
				if ($row_datos[26] != NULL) {
					echo $row_datos[26];
				} ?></td>
			</tr>
			<tr>
				<td>Otros</td>
				<td id="verde"><?php 
				if ($row_datos[27] != NULL) {
					echo $row_datos[27];
				} ?></td>
			</tr>
			</tbody>
		</table>
		<table id="distribuidos">
		<tbody>
			<tr>
				<td id="titulo">SIN GOCE DE SUELDO</td>
				<td id="titulo">N° Días</td>
			</tr>
			<tr>
				<td>Consulta Servicio Médico Particular</td>
				<td id="verde"><?php 
				if ($row_datos[28] != NULL) {
					echo $row_datos[28];
				} ?></td>
			</tr>
			<tr>
				<td>Asunto Personal</td>
				<td id="verde"><?php 
				if ($row_datos[29] != NULL) {
					echo $row_datos[29];
				} ?></td>
			</tr>
			<tr>
				<td>Otros</td>
				<td id="verde"><?php 
				if ($row_datos[30] != NULL) {
					echo $row_datos[30];
				} ?></td>
			</tr>
			</tbody>
		</table>
	</div>
	<div id="pie">
		<p><strong>Observaciones: </strong><?php echo $row_datos[31]; ?></p>
		<p><strong>DURANTE MI AUSENCIA, EN MI REPRESENTACIÓN ATENDERÁ CUALQUIER ASUNTO O PENDIENTE:</strong></p>
		<table>
			<tr>
				<td>NOMBRE: <?php echo $row_datos[32]; ?></td>
				<td>TELÉFONO: <?php echo $row_datos[33]; ?></td>
			</tr>
			<tr>
				<td><br><br><br>FIRMA CONFORMIDAD:________________________________</td>
				<td><br><br><br>CORREO: <?php echo $row_datos[34]; ?></td>
			</tr>
		</table>
	</div>
	<!-- FIRMAS DE VACACIONES -->
	<table id="firmas">
		<tr>
			<td>
				<?php echo $row_datos[1] ." ". $row_datos[2] ." ". $row_datos[3] ." ". $row_datos[4]; ?>
				<div style="border-top: 1px solid; width: auto;"></div>
				<p>Solicitante</p>
			</td>
			<td>
				<?php echo $row_datos[8] ." ". $row_datos[9] ." ". $row_datos[10] ." ". $row_datos[11]; ?>
				<div style="border-top: 1px solid; width: auto;"></div>
				<p>Jefe inmediato</p>
			</td>
			<td>
				<?php echo $row_rh[1] ." ". $row_rh[2] ." ". $row_rh[3] ." ". $row_rh[4]; ?>
				<div style="border-top: 1px solid; width: auto;"></div>
				<p>Legal y R.H.</p>
			</td>
		</tr>
	</table>
</body>
</html>