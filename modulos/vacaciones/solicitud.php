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
	  	$id_tmp = $_GET["id"];
	  }
	if ($_SESSION["id_datosper"] == $id_tmp) {
		
	  $ano = "SELECT * FROM `ejercicio` WHERE `estatus` = 1";
	  $res_anos = $mysqli->query($ano);
	  $row_anos = $res_anos->fetch_array();


	  
	
	$rh = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno` FROM `datos_personales` d INNER JOIN `usuarios` u ON u.`id_datosper` = d.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` AND t.`nombre` = 'Recursos Humanos'";
	  $res_rh = $mysqli->query($rh);
	  $row_rh = $res_rh->fetch_array();

	$ctr_emp = "SELECT `id_datosper`, `primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno`  FROM `datos_personales` WHERE `id_datosper` = $id_tmp";
    $res_emp = $mysqli->query($ctr_emp);
    $row_resemp = $res_emp->fetch_array();
    $ctr_jefes = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, d2.`id_datosper`, d2.`primer_nombre`, d2.`segundo_nombre`, d2.`ap_paterno`, d2.`ap_materno`, p.`puesto`, pp.`salario`, pp.`id_puestoper` FROM `puesto_per` pp INNER JOIN `jefes` j ON pp.`id_datosper` = $_SESSION[id_datosper] AND pp.`id_puesto` = j.`id_puesto` INNER JOIN `datos_personales` d ON j.`id_jefin` = d.`id_datosper` INNER JOIN `datos_personales` d2 ON j.`id_jefar` = d2.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` WHERE pp.`fecha_final` = '0000-00-00'";
    $res_jefes = $mysqli->query($ctr_jefes);
    $row_resjefes = $res_jefes->fetch_array();

    $ctr_fing = "SELECT * FROM `puesto_per` WHERE `id_datosper` = $id_tmp ORDER BY `fecha` ASC LIMIT 1";
    $res_fing = $mysqli->query($ctr_fing);
    $row_resfing = $res_fing->fetch_array();

$actual2 = date('Y');
$sel_dvaca2 = "SELECT dv.*, e.`ano` FROM `dias_vacaciones` dv INNER JOIN `ejercicio` e ON dv.`id_ejercicio` = e.`id_ejercicio` WHERE dv.`id_datosper` = $id_tmp AND e.`id_ejercicio` = $row_anos[0]";
$res_dvaca2 = $mysqli->query($sel_dvaca2);
$numrowsDvaca2 = $res_dvaca2->num_rows;
if ($numrowsDvaca2 == 0) {
  $selano = "SELECT * FROM `puesto_per` WHERE `id_datosper` = $id_tmp ORDER BY `fecha` ASC LIMIT 1";
  $res_selano = $mysqli->query($selano);
  $row_reselano = $res_selano->fetch_array();
  $actual = date('Y-m-j');
  $an = date('Y');
  $total_ano = strtotime($actual) - strtotime($row_reselano[1]);
  $tot = $total_ano / (60 * 60 * 24 * 365);
  $fin = floor($tot);
  
  if ($fin == 0 || $fin == 1) {
    $dias = 6;
  }
  if ($fin == 2) {
    $dias = 8;
  }
  if ($fin == 3) {
    $dias = 10;
  }
  if ($fin == 4) {
    $dias = 12;
  }
  if ($fin >= 5 && $fin <= 9) {
    $dias = 14;
  }
  if ($fin >= 10 && $fin <= 14) {
    $dias = 16;
  }
  if ($fin >= 15 && $fin <= 19) {
    $dias = 18;
  }
  if ($fin >= 20 && $fin <= 24) {
    $dias = 20;
  }
  if ($fin >= 25 && $fin <= 29) {
    $dias = 22;
  }
  if ($fin >= 30) {
    $dias = 24;
  }
 $insertvaca = "INSERT INTO `dias_vacaciones`(`descripcion`, `dias`, `id_ejercicio`, `fecha`, `id_datosper`, `id_autoriza`, `signo`) VALUES ('Ingreso de días de vacaciones automático anual',$dias,$row_anos[0],'$actual',$id_tmp,77,'+')";
  $res_ivacaa = $mysqli->query($insertvaca);
}

$divacas = "SELECT dv.*, e.`ano` FROM `dias_vacaciones` dv INNER JOIN `datos_personales` dp ON dv.`id_datosper` = dp.`id_datosper` INNER JOIN `ejercicio` e ON dv.`id_ejercicio` = e.`id_ejercicio` WHERE dp.`id_datosper` = $id_tmp";
$res_divacas = $mysqli->query($divacas);

$ano_actual = date(Y);
$ano_ingreso = $ano = date("Y", strtotime($row_resfing[1]));
$anos_diferencia = $ano_actual - $ano_ingreso;

$f1 = strtotime('+'. $anos_diferencia .' year' , strtotime($row_resfing[1]));
$f1 = date ( 'Y-m-j' , $f1 );

$f2 = strtotime('+1 year' , strtotime($f1));
$f2 = date ( 'Y-m-j' , $f2 );

$an = date('Y');
while($row_redivacas = $res_divacas->fetch_array())
{
	if ($row_redivacas[4] >= $f1 && $row_redivacas[4] <= $f2) 
	{ 
      if ($row_redivacas["7"] == "+") {
        $totaldis = $totaldis + $row_redivacas["2"];
      }
      if ($row_redivacas["7"] == "-") {
        $totaldis = $totaldis - $row_redivacas["2"];
      }
      
    }
}
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
				<td><?php echo $row_resemp[1] ." ". $row_resemp[2] ." ". $row_resemp[3] ." ". $row_resemp[4] ?></td>
			</tr>
			<tr>
				<td>Área de Trabajo</td>
				<td><?php echo $row_resjefes[10] ?></td>
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
$actual = date('Y-m-j');
$total_ano = strtotime($actual) - strtotime($row_resfing[1]);
$tot = $total_ano / (60 * 60 * 24 * 365);
if ($totaldis <= 0 || floor($tot) == 0) {
		echo "<script>if(confirm('No puedes tomar vacaciones ya que aún no tienes las tienes disponibles')){ 
		document.location='vacaciones.php';} 
		else{ document.location='vacaciones.php'; 
		}</script>";
		
}
?>
	<table id="dtv">
		<tbody>
			<tr>
				<td>Años de Trabajo</td>
				<td><center><?php echo floor($tot); ?></center></td>
			</tr>
			<tr>
				<td>Días de Descanso</td>
				<td><center><?php echo $totaldis ?></center></td>
			</tr>
			<tr>
				<td>Sueldo Mensual</td>
				<td style="text-align: right;"><?php echo "$".number_format($row_resjefes[11],2) ?></td>
			</tr>
			<tr>
				<td>Sueldo Diario</td>
				<td style="text-align: right;"><?php 
				$diario = $row_resjefes[11] / 30;
				echo "$".number_format(round($diario, 2),2) ?></td>
			</tr>
		</tbody>
	</table>



	<table id="dtv">
		<tbody>
			<tr>
				<td>Vacaciones</td>

				<td style="text-align: right;"><?php 
				$vaca = $diario * $totaldis;
				echo "$".number_format(round($vaca, 2),2) ?></td>
			</tr>
			<tr>
				<td>Prima Vacacional</td>
				<td style="text-align: right;"><?php 
				$pvaca = $vaca * .25;
				echo "$".number_format(round($pvaca, 2), 2) ?></td>
			</tr>
			<tr>
				<td><strong>TOTAL NETO</strong></td>
				<td style="text-align: right; font-weight: bold;"><?php 
				$totalito = $vaca + $pvaca;
				echo "$".number_format(round($totalito, 2),2) ?></td>
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
	
	
	
				<!-- FIRMAS DE VACACIONES -->

	
	
	<table id="firmas">
		<tr>
			<td>
				<?php echo $row_resemp[1] ." ". $row_resemp[2] ." ". $row_resemp[3] ." ". $row_resemp[4] ?>
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
<form method="post">
	<button style="float: right;" value="descarga" name="descarga">Descargar PDF</button>
</form>
<?php
	if (isset($_POST["descarga"])) {
		$id_solicitante = $id_tmp;
		$_SESSION["f_in"];
		$_SESSION["f_final"];
		$_SESSION["dias"];
		$_SESSION["regresa"];
		$fecha = date("Y-m-d");
		$id_puesto = $row_resjefes[12];
		if ($_SESSION["dias"] <= $totaldis) {
		
		$vacaciones = "INSERT INTO `vacaciones`(`id_solicitante`, `fecha_inicial`, `fecha_final`, `reinicio_labores`, `fecha`, `id_puesto`, `dias_descanso`, `dias`, `id_rh`, `id_ejercicio`, `etapa`) VALUES ($id_solicitante,'$_SESSION[f_in]','$_SESSION[f_final]','$_SESSION[regresa]','$fecha',$id_puesto,$_SESSION[dias], $totaldis, $row_rh[0], $row_anos[0], 0)"; //Busca todos los días vacaciones
		$res_vacaciones = $mysqli->query($vacaciones);
		if ($mysqli->error) 
				{
					echo "<script>if(confirm('Ocurrió un error, favor de intentarlo nuevamente')){ 
					document.location='solicitud.php?id=$id_solicitante';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}else
				{
					$selvac = "SELECT `id_vaca` FROM `vacaciones` WHERE `id_solicitante` = $id_solicitante AND `fecha_inicial` = '$_SESSION[f_in]' AND `fecha_final` = '$_SESSION[f_final]' AND `fecha` = '$fecha' AND `dias_descanso` = $_SESSION[dias]"; //Busca todos los días selvac
					$res_selvac = $mysqli->query($selvac);
					$row_reselvar = $res_selvac->fetch_array();
					$descuento = "INSERT INTO `dias_vacaciones`(`descripcion`, `dias`, `id_ejercicio`, `fecha`, `id_datosper`, `id_autoriza`, `signo`) VALUES ('Descuento por solicitud de vacaciones',$_SESSION[dias],$row_anos[0],'$fecha',$id_solicitante,77,'-')"; //Busca todos los días vacaciones
					$res_descuento = $mysqli->query($descuento);
					echo "<script> document.location='../pdf/vacaciones.php?id=$row_reselvar[0]'; </script>";
				}
		}else
		{
			echo "<script>if(confirm('Estás tomando más días de los que tienes disponibles')){ 
					document.location='solicitud.php?id=$id_solicitante';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
		}
	}
}
?>
</body>
</html>

