<?php
include_once("../../control/connect.php");
session_start();
if (isset($_GET["id"])) 
{
  $id_tmp = $_GET["id"];
}
if ($_SESSION["id_datosper"] == $id_tmp) 
{
	$id_tmp = $_SESSION["id_datosper"];
}
	$rh = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno` FROM `datos_personales` d INNER JOIN `usuarios` u ON u.`id_datosper` = d.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` AND t.`nombre` = 'Recursos Humanos'";
	$res_rh = $mysqli->query($rh);
	$row_rh = $res_rh->fetch_array();

  	$ano = "SELECT * FROM `ejercicio` WHERE `estatus` = 1";
 	$res_anos = $mysqli->query($ano);
  	$row_anos = $res_anos->fetch_array();

  	$datos = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, p.`puesto`, pp.`id_puestoper`, d2.`id_datosper`, d2.`primer_nombre`, d2.`segundo_nombre`, d2.`ap_paterno`, d2.`ap_materno`  FROM `datos_personales` d INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` AND pp.`fecha_final` = '0000-00-00' INNER JOIN `jefes` j ON j.`id_puesto` = pp.`id_puesto` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `datos_personales` d2 ON d2.`id_datosper` = j.`id_jefin` WHERE d.`id_datosper` = $id_tmp";
  	$res_datos = $mysqli->query($datos);
  	$row_datos = $res_datos->fetch_array();

  	$inicio_trab = "SELECT `fecha`, `id_puesto` FROM `puesto_per` WHERE `id_datosper` = $id_tmp ORDER BY `fecha` ASC LIMIT 1";
  	$res_itrab = $mysqli->query($inicio_trab);
  	$row_itrab = $res_itrab->fetch_array();
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
<script language="javascript">
$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    $('#form, #fat, #fo3').submit(function() {
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                $('#result').html(data);

            }
        })
        
        return false;
    }); 
})  
</script>
	<table  id="dp">
		<tbody>
			<tr>
				<td>Fecha:</td>
				<td style="float: right;"><?php 
					$dias2 = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					 
					echo $dias2[date('w')].", ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y');
				?></td>
			</tr>
			<tr>
				<td>  </td>
				<td> <p></p> </td>
			</tr>
			<tr>
				<td>Nombre del Empleado</td>
				<td><?php echo $row_datos[1] ." ". $row_datos[2] ." ". $row_datos[3] ." ". $row_datos[4] ?></td>
			</tr>
			<tr>
				<td>Área de Trabajo</td>
				<td><?php echo $row_datos[5] ?></td>
			</tr>
			<tr>
				<td>Jefe de Trabajo</td>
				<td><?php echo $row_datos[8] ." ". $row_datos[9] ." ". $row_datos[10] ." ". $row_datos[11] ?></td>
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
	<form method="post" id="fo3" action="ajax_regreso.php">
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
				<td></td>
				<td><input type="date" name="f_in" required></td>
				<td><input type="date" name="f_fin" id="f_fin" required></td>
				<td><label id="regreso"></label></td>
			</tr>
		</tbody>
	</table>
	</div>
	<button>Calcular</button>
	</form>

	<!-- DÍAS DISTRIBUIDOS -->
<form method="post">
	<div id="dd">
		<table id="distribuidos">
			<tr>
				<td id="titulo">A CUENTA DE VACACIONES</td>
				<td id="titulo">N° Días</td>
			</tr>
			<tr>
				<td>Enfermedad no comprobada</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="enf_com_vac"></td>
			</tr>
			<tr>
				<td>Enfermedad de un familiar</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="enf_fam_vac"></td>
			</tr>
			<tr>
				<td>Tramite de Visa</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="visa_vac" ></td>
			</tr>
			<tr>
				<td>Asunto personal</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="personal_vac"></td>
			</tr>
			<tr>
				<td>Otros</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="otros_vac"></td>
			</tr>
		</table>

		<table id="distribuidos">
			<tr>
				<td id="titulo">CON GOCE DE SUELDO</td>
				<td id="titulo">N° Días</td>
			</tr>
			<tr>
				<td>Incapacidad IMSS</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  name="imss_cs"></td>
			</tr>
			<tr>
				<td>Nacimiento hijo</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="nacimiento_cs"></td>
			</tr>
			<tr>
				<td>Defunción Familiar Directo</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="defuncion_cs"></td>
			</tr>
			<tr>
				<td>Reposición de día</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="reposicion_cs"></td>
			</tr>
			<tr>
				<td>Otros</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="otros_cs"></td>
			</tr>
		</table>

		<table id="distribuidos">
			<tr>
				<td id="titulo">SIN GOCE DE SUELDO</td>
				<td id="titulo">N° Días</td>
			</tr>
			<tr>
				<td>Consulta Servicio Médico Particular</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="consulta_ss"></td>
			</tr>
			<tr>
				<td>Asunto Personal</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="personal_ss"></td>
			</tr>
			<tr>
				<td>Otros</td>
				<td id="verde"><input type="text" maxlength="3" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="otros_ss"></td>
			</tr>
		</table>
	</div>

	<div id="pie">
		<p><strong>Observaciones: </strong><input type="text" name="obs"></p>
		<p><strong>DURANTE MI AUSENCIA, EN MI REPRESENTACIÓN ATENDERÁ CUALQUIER ASUNTO O PENDIENTE:</strong></p>
		<table>
			<tr>
				<td>NOMBRE: <input type="text" name="nombre"></td>
				<td>TELÉFONO: <input type="text" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="tel"></td>
			</tr>
			<tr>
				<td><br><br><br>FIRMA CONFORMIDAD:________________________________</td>
				<td><br><br><br>CORREO: <input type="email" name="correo"></td>
			</tr>
		</table>
	</div>

	<!-- FIRMAS DE VACACIONES -->
	
	<table id="firmas">
		<tr>
			<td>
				<?php echo $row_datos[1] ." ". $row_datos[2] ." ". $row_datos[3] ." ". $row_datos[4] ?>
				<div style="border-top: 1px solid; width: auto;"></div>
				<p>Solicitante</p>
			</td>
			<td>
				<?php echo $row_datos[8] ." ". $row_datos[9] ." ". $row_datos[10] ." ". $row_datos[11] ?>
				<div style="border-top: 1px solid; width: auto;"></div>
				<p>Jefe inmediato</p>
			</td>
			<td>
				<?php echo $row_rh[1] ." ". $row_rh[2] ." ". $row_rh[3] ." ". $row_rh[4] ?>
				<div style="border-top: 1px solid; width: auto;"></div>
				<p>Legal y R.H.</p>
			</td>
		</tr>
	</table>

	<button style="float: right;" value="descarga" name="descarga">Descargar PDF</button>
</form>
</body>
</html>
<?php
	if (isset($_POST["descarga"])) {

		$vac = array(
			'enf_com' => "NULL",
			'enf_fam' => "NULL",
			'visa' => "NULL",
			'personal' => "NULL",
			'otros' => "NULL"
			);

		$cs = array(
			'imss' => "NULL",
			'nacimiento' => "NULL", 
			'defuncion' => "NULL",
			'reposicion' => "NULL",
			'otros' => "NULL"
			);

		$ss = array(
			'consulta' => "NULL",
			'personal' => "NULL", 
			'otros' => "NULL"
			);

		$_SESSION["f_in"];
		$_SESSION["f_final"];
		$_SESSION["dias"];
		$_SESSION["regresa"];
		$fecha = date("Y-m-d");

		$total_dias = 0;

		if (!empty($_POST["enf_com_vac"])) {
			$vac['enf_com'] = $_POST["enf_com_vac"];
			$total_dias = $total_dias + $_POST["enf_com_vac"];
		}
		if (!empty($_POST["enf_fam_vac"])) {
			$vac['enf_fam'] = $_POST["enf_fam_vac"];
			$total_dias = $total_dias + $_POST["enf_fam_vac"];
		}
		if (!empty($_POST["visa_vac"])) {
			$vac['visa'] = $_POST["visa_vac"];
			$total_dias = $total_dias + $_POST["visa_vac"];
		}
		if (!empty($_POST["personal_vac"])) {
			$vac['personal'] = $_POST["personal_vac"];
			$total_dias = $total_dias + $_POST["personal_vac"];
		}
		if (!empty($_POST["otros_vac"])) {
			$vac['otros'] = $_POST["otros_vac"];
			$total_dias = $total_dias + $_POST["otros_vac"];
		}

		if (!empty($_POST["imss_cs"])) {
			$cs['imss'] = $_POST["imss_cs"];
			$total_dias = $total_dias + $_POST["imss_cs"];
		}
		if (!empty($_POST["nacimiento_cs"])) {
			$cs['nacimiento'] = $_POST["nacimiento_cs"];
			$total_dias = $total_dias + $_POST["nacimiento_cs"];
		}
		if (!empty($_POST["defuncion_cs"])) {
			$cs['defuncion'] = $_POST["defuncion_cs"];
			$total_dias = $total_dias + $_POST["defuncion_cs"];
		}
		if (!empty($_POST["reposicion_cs"])) {
			$cs['reposicion'] = $_POST["reposicion_cs"];
			$total_dias = $total_dias + $_POST["reposicion_cs"];
		}
		if (!empty($_POST["otros_cs"])) {
			$cs['otros'] = $_POST["otros_cs"];
			$total_dias = $total_dias + $_POST["otros_cs"];
		}

		if (!empty($_POST["consulta_ss"])) {
			$ss['consulta'] = $_POST["consulta_ss"];
			$total_dias = $total_dias + $_POST["consulta_ss"];
		}
		if (!empty($_POST["personal_ss"])) {
			$ss['personal'] = $_POST["personal_ss"];
			$total_dias = $total_dias + $_POST["personal_ss"];
		}
		if (!empty($_POST["otros_ss"])) {
			$ss['otros'] = $_POST["otros_ss"];
			$total_dias = $total_dias + $_POST["otros_ss"];
		}


		$obs = $_POST["obs"];
		$representante = $_POST["nombre"];
		$tel_rep = $_POST["tel"];
		$correo = $_POST["correo"];
		echo $total_dias;
		if ($_SESSION["dias"] == $total_dias) 
		{

			$permisos = "INSERT INTO `permisos`(`id_solicitante`, `f_inicio`, `f_final`, `reinicio_labores`, `fecha`, `id_puesto`, `dias_descanso`, `enf_com_vac`, `enf_fam_vac`, `visa_vac`, `personales_vac`, `otro_vac`, `imss_cs`, `nacimiento_cs`, `defuncion_cs`, `reposicion_cs`, `otro_cs`, `consulta_ss`, `personal_ss`, `otro_ss`, `obs`, `representante`, `tel_rep`, `correo_rep`, `id_ejercicio`, `id_rh`, `etapa`) VALUES ($id_tmp,'$_SESSION[f_in]','$_SESSION[f_final]','$_SESSION[regresa]','$fecha',$row_itrab[1],$_SESSION[dias],$vac[enf_com],$vac[enf_fam],$vac[visa],$vac[personal],$vac[otros],$cs[imss],$cs[nacimiento],$cs[defuncion],$cs[reposicion],$cs[otros],$ss[consulta],$ss[personal],$ss[otros],'$obs','$representante',$tel_rep,'$correo',$row_anos[0],$row_rh[0],0)"; //Busca todos los días vacaciones
			$res_permisos = $mysqli->query($permisos);
			if ($mysqli->error) 
				{
					echo "<script>if(confirm('Los días a disfrutar no coinciden con los días puestos')){ 
					document.location='solicitud_per.php?id=$id_tmp';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}else
				{
					$selper = "SELECT `id_permiso` FROM `permisos` WHERE `id_solicitante` = $id_tmp AND `f_inicio` = '$_SESSION[f_in]' AND `f_final` = '$_SESSION[f_final]' AND `reinicio_labores` = '$_SESSION[regresa]' AND `fecha` = '$fecha' AND `id_puesto` = $row_itrab[1] AND `dias_descanso` = $_SESSION[dias] AND `id_ejercicio` = $row_anos[0] AND `id_rh` = $row_rh[0] "; //Busca todos los días selper
					$res_selper = $mysqli->query($selper);
					$row_reselper = $res_selper->fetch_array();
					echo "<script> document.location='../pdf/permisos.php?id=$row_reselper[0]'; </script>";
				}
		} else
		{
			echo "<script>if(confirm('Los días a disfrutar no coinciden con los días puestos')){ 
			document.location='solicitud_per.php?id=$id_tmp';} 
			else{ alert('Operacion Cancelada'); 
			}</script>";
		}

	}
?>