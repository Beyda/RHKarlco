<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Solicitud de Vacaciones KarlCo</title>
	<link type="image/x-icon" href="../../imagenes/favicon.ico" rel="icon" />
	<link href="/rhkarlco/bootstrap/css/estilo_solv.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="head">
                   <!-- ENCABEZADO DE LA SOLICITUD DE VACACIONES -->
	<div id="head">
		<img src="../../imagenes/logo2.png" id="logo">
	</div>
	
	<div id="head">
		<div id="empresa">
			KARL Co, S.A. de C.V.
		</div>
		<div id="solicitud">
			SOLICITUD DE VACACIONES
		</div>
	</div>

	<div id="head">
		<img src="../../imagenes/logo2.png" id="logo">
	</div>
	<br>
					<!-- DATOS PERSONALES DE LA SOLICITUD DE VACACIONES -->
<center>
	<table  id="dp">
		<tbody>
			<tr>
				<td>Fecha:</td>
				<td style="float: right;"><?php 
					$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					 
					echo $dias[date('w')].", ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;
				?></td>
			</tr>
			<tr>
				<td>  </td>
				<td> <p></p> </td>
			</tr>
			<tr>
				<td>Nombre del Empleado</td>
				<td></td>
			</tr>
			<tr>
				<td>Área de Trabajo</td>
				<td></td>
			</tr>
			<tr>
				<td>Jefe de Trabajo</td>
				<td></td>
			</tr>
			<tr>
				<td>Fecha de Ingreso</td>
				<td></td>
			</tr>
		</tbody>
	</table>
</center>
				<!-- DATOS DEL TRABAJO Y DÍAS DE VACACIONES -->
<br>
	<table id="dtv">
		<tbody>
			<tr>
				<td>Años de Trabajo</td>
				<td></td>
			</tr>
			<tr>
				<td>Días de Descanso</td>
				<td></td>
			</tr>
			<tr>
				<td>Sueldo Mensual</td>
				<td></td>
			</tr>
			<tr>
				<td>Sueldo Diario</td>
				<td></td>
			</tr>
			<tr>
				<td>Vacaciones</td>
				<td></td>
			</tr>
			<tr>
				<td>Prima Vacacional</td>
				<td></td>
			</tr>
			<tr>
				<td><strong>TOTAL NETO</strong></td>
				<td></td>
			</tr>
		</tbody>
	</table>

			<!-- FECHAS DE VACACIONES -->

	<table id="fechas">
		<tbody>
			<tr>
				<td>AÑO A DISFRUTAR</td>
				<td>DÍAS A DISFRUTAR </td>
				<td>FECHA DE INICIO DE VACACIONES</td>
				<td>FECHA DE CULMINACIÓN DE VACACIONES</td>
				<td>FECHA DE REINICIO DE VACACIONES</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</div>
</body>
</html>