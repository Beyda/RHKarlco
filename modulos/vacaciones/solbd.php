<?php
include_once("../../control/connect.php");
 session_start();

 ?>
<!DOCTYPE html>
<html name="html">
<head>
	<meta charset="UTF-8">
	<title>Solicitud de Vacaciones KarlCo</title>
	<link type="image/x-icon" href="../../imagenes/favicon.ico" rel="icon" />
	<link href="../../bootstrap/css/estilo_solv.css" rel="stylesheet" type="text/css" />
	<script src="/rhkarlco/plugins/jQuery/jQuery-2.1.3.min.js"></script>
</head>
<body>
<?php
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
	}
	$datosper = "SELECT v.`fecha_inicial`, v.`fecha_final`, v.`reinicio_labores`, v.`fecha`, v.`dias_descanso`, .d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, pp.`fecha`, pp.`salario`, p.`id_puesto`, p.`puesto`, v.`dias`, v.`id_ejercicio`, v.`id_rh` FROM `vacaciones` v INNER JOIN `datos_personales` d ON v.`id_solicitante` = d.`id_datosper` INNER JOIN `puesto_per` pp ON v.`id_puesto` = pp.`id_puestoper` INNER JOIN `puestos` p ON pp.`id_puesto` = p.`id_puesto` WHERE v.`id_vaca` = $id";
	$res_datosper = $mysqli->query($datosper);
	$row_datosper = $res_datosper->fetch_array();

	$ctr_fing = "SELECT * FROM `puesto_per` WHERE `id_datosper` = $row_datosper[5] ORDER BY `fecha` ASC LIMIT 1";
    $res_fing = $mysqli->query($ctr_fing);
    $row_resfing = $res_fing->fetch_array();

    $ctr_jefe = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno` FROM `jefes` j INNER JOIN `datos_personales` d ON j.`id_jefin` = d.`id_datosper` WHERE j.`id_puesto` = $row_datosper[12]";
    $res_jefe = $mysqli->query($ctr_jefe);
    $row_resjefes = $res_jefe->fetch_array();

	$ano = "SELECT * FROM `ejercicio` WHERE `id_ejercicio` = $row_datosper[15]";
    $res_anos = $mysqli->query($ano);
    $row_anos = $res_anos->fetch_array();

   	$rh = "SELECT `id_datosper`, `primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno` FROM `datos_personales` WHERE `id_datosper` = $row_datosper[16]";
	$res_rh = $mysqli->query($rh);
	$row_rh = $res_rh->fetch_array();
?>
<!-- ENCABEZADO DE LA SOLICITUD DE VACACIONES -->
<table>
	<tr>
		<td><img src="../../imagenes/logo2.png" id="logo"></td>
		<td>
			<div id="empresa">
			KARL Co, S.A. de C.V.
		</div>
		<div id="solicitud">
			SOLICITUD DE VACACIONES
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
					$ano1 = date("Y", strtotime($row_datosper[3]));
					$dia1 = date('d', strtotime($row_datosper[3]));
					$mes1 = date('n', strtotime($row_datosper[3]));
					$nom1 = date('w', strtotime($row_datosper[3]));

					$dias2 = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					echo $dias2[$nom1].", ".$dia1." de ".$meses[$mes1-1]. " de ".$ano1;
					?></td>
			</tr>
			<tr>
				<td>  </td>
				<td> <p></p> </td>
			</tr>
			<tr>
				<td>Nombre del Empleado</td>
				<td><?php echo $row_datosper[6] ." ". $row_datosper[7] ." ". $row_datosper[8] ." ". $row_datosper[9] ?></td>
			</tr>
			<tr>
				<td>Área de Trabajo</td>
				<td><?php echo $row_datosper[13] ?></td>
			</tr>
			<tr>
				<td>Jefe de Trabajo</td>
				<td><?php echo $row_resjefes[1] ." ". $row_resjefes[2] ." ". $row_resjefes[3] ." ". $row_resjefes[4] ?></td>
			</tr>
			<tr>
				<td>Fecha de Ingreso</td>
				<td><?php
					$ano = date("Y", strtotime($row_resfing[1]));
					$dia = date('d', strtotime($row_resfing[1]));
					$mes = date('n', strtotime($row_resfing[1]));
					echo $dia." de ".$meses[$mes-1]. " de ".$ano ;
				?></td>
			</tr>
		</tbody>
	</table>
				<!-- DATOS DEL TRABAJO Y DÍAS DE VACACIONES -->
<br>
<?php
$total_ano = strtotime($row_datosper[10]) - strtotime($row_resfing[1]);
$tot = $total_ano / (60 * 60 * 24 * 365);
?>
	<table id="dtv">
		<tbody>
			<tr>
				<td>Años de Trabajo</td>
				<td><?php echo floor($tot); ?></td>
			</tr>
			<tr>
				<td>Días de Descanso</td>
				<td><?php echo $row_datosper[14] ?></td>
			</tr>
			<tr>
				<td>Sueldo Mensual</td>
				<td><?php echo "$".$row_resfing[3] ?></td>
			</tr>
			<tr>
				<td>Sueldo Diario</td>
				<td><?php 
				$diario = $row_resfing[3] / 30;
				echo "$".round($diario, 2) ?></td>
			</tr>
		</tbody>
	</table>



	<table id="dtv">
		<tbody>
			<tr>
				<td>Vacaciones</td>

				<td><?php 
				$vaca = $diario * $row_datosper[14];
				echo "$".round($vaca, 2) ?></td>
			</tr>
			<tr>
				<td>Prima Vacacional</td>
				<td><?php 
				$pvaca = $vaca * .25;
				echo "$".round($pvaca, 2) ?></td>
			</tr>
			<tr>
				<td><strong>TOTAL NETO</strong></td>
				<td><?php 
				$totalito = $vaca + $pvaca;
				echo "$".round($totalito, 2) ?></td>
			</tr>
		</tbody>
	</table>

<!-- *****************************************/.ajax date******************************** 
                  <script type="text/javascript">
                  //Mostrar los estados obteniendo el id del pais
                  $(document).ready(function(){


                      //Mostrar las ciudades con el id del estadocipio
                      $("#f_fin").change(function(){
                          var f_fin=$(this).val();
                          var dataString2 = 'f_fin='+ f_fin;
                          $.ajax({
                              type: "POST",
                              url: "ajax_regreso.php",
                              data: dataString2,
                              cache: false,
                          success: function(html){
                          $("#regreso").html(html);
                          }
                          });
                      });

                    });
                  
                  </script>-->

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

			<!-- FECHAS DE VACACIONES -->
	<form method="post" id="fo3" action="ajax_regreso.php">
	<div id="result">
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
				<td><?php echo $row_anos[1] ?></td>
				<td><?php echo $row_datosper[4] ?></td>
				<td><?php echo date("d-m-Y", strtotime($row_datosper[0])); ?></td>
				<td><?php echo date("d-m-Y", strtotime($row_datosper[1])); ?></td>
				<td><?php echo date("d-m-Y", strtotime($row_datosper[2])); ?></td>
			</tr>
		</tbody>
	</table>
	</div>
	</form>
	
				<!-- FECHAS DE VACACIONES -->

	
	
	<table id="firmas">
		<tr>
			<td>
				<?php echo $row_datosper[6] ." ". $row_datosper[7] ." ". $row_datosper[8] ." ". $row_datosper[9] ?>
				<div style="border-top: 1px solid; width: auto;"></div>
				<p>Solicitante</p>
			</td>
			<td>
				<?php echo $row_resjefes[1] ." ". $row_resjefes[2] ." ". $row_resjefes[3] ." ". $row_resjefes[4] ?>
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

<div id="pie">
	<p><strong>LFT. VACACIONES</strong><br>
	<strong>ARTÍCULO 76.</strong> Los trabajadores que tengan más de un año de servicio de un periodo anual de vacaciones pagadas, que en ningún caso podrá ser inferior a seis días laborales, y que aumentarán en dos días laborales, hasta llegar a doce, por cada año subsecuente de servicio.<br>
	Despues del cuarto año de servicio, el periodo de vacaciones aumentará en dos días por cada cinco años de servicio.<br>
	El sábado es día laborable y remunerado.</p>
</div>
<?php
	if (isset($_POST["descarga"])) {
		$id_solicitante = $id_tmp;
		$_SESSION["f_in"];
		$_SESSION["f_final"];
		$_SESSION["dias"];
		$_SESSION["regresa"];
		$fecha = date("Y-m-d");
		$id_puesto = $row_resjefes[12];
		$vacaciones = "INSERT INTO `vacaciones`(`id_solicitante`, `fecha_inicial`, `fecha_final`, `reinicio_labores`, `fecha`, `id_puesto`, `dias_descanso`, `id_ejercicio`) VALUES ($id_solicitante,'$_SESSION[f_in]','$_SESSION[f_final]','$_SESSION[regresa]','$fecha',$id_puesto,$_SESSION[dias],$row_anos[0])"; //Busca todos los días vacaciones
		$res_vacaciones = $mysqli->query($vacaciones);
		if ($mysqli->error) 
				{
					echo "<script>if(confirm('Ocurrió un error, favor de intentarlo nuevamente')){ 
					document.location='solicitud.php?id=$id_solicitante';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}else
				{
					$selvac = "SELECT `id_vaca` FROM `vacaciones` WHERE `id_solicitante` = $id_solicitante AND `fecha_inicial` = '$_SESSION[f_in]' AND `fecha_final` = '$_SESSION[f_final]' AND `fecha` = $fecha AND `dias_descanso` = $_SESSION[dias]"; //Busca todos los días selvac
					$res_selvac = $mysqli->query($selvac);
					$row_reselvar = $res_festivos->fetch_array();
					header("Location: http://admonkco.com/rhkarlco/modulos/pdf/vacaciones.php?id=$row_reselvar[0]");
					//echo "<script> document.location='../pdf/vacaciones.php?id=$row_reselvar[0]'; </script>";
				}
	}
?>
</body>
</html>

