<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION["session"])){
	$id_tmp = $_SESSION["id_datosper"];
	$ctr_emp = "SELECT `id_datosper`, `primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno`  FROM `datos_personales` WHERE `id_datosper` = $id_tmp";
    $res_emp = $mysqli->query($ctr_emp);
    $row_resemp = $res_emp->fetch_array();
    $ctr_jefes = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, d2.`id_datosper`, d2.`primer_nombre`, d2.`segundo_nombre`, d2.`ap_paterno`, d2.`ap_materno`, p.`puesto`, pp.`salario` FROM `puesto_per` pp INNER JOIN `jefes` j ON pp.`id_datosper` = $id_tmp AND pp.`id_puesto` = j.`id_puesto` INNER JOIN `usuarios` u ON j.`id_jefin` = u.`id_usuario` INNER JOIN `datos_personales` d ON u.`id_datosper` = d.`id_datosper` INNER JOIN `usuarios` u2 ON j.`id_jefar` = u2.`id_usuario` INNER JOIN `datos_personales` d2 ON u2.`id_datosper` = d2.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` WHERE pp.`fecha_final` = '0000-00-00'";
    $res_jefes = $mysqli->query($ctr_jefes);
    $row_resjefes = $res_jefes->fetch_array();

    $ctr_fing = "SELECT * FROM `puesto_per` WHERE `id_datosper` = $id_tmp ORDER BY `fecha` ASC LIMIT 1";
    $res_fing = $mysqli->query($ctr_fing);
    $row_resfing = $res_fing->fetch_array();

$actual2 = date('Y');
$sel_dvaca2 = "SELECT * FROM `dias_vacaciones` WHERE `id_datosper` = $id_tmp AND `ano` = $actual2";
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
  echo $insertvaca = "INSERT INTO `dias_vacaciones`(`descripcion`, `dias`, `ano`, `fecha`, `id_datosper`, `id_autoriza`, `signo`) VALUES ('Ingreso de días de vacaciones automático anual',$dias,$an,'$actual',$id_tmp,77,'+')";
  $res_ivacaa = $mysqli->query($insertvaca);
}

$divacas = "SELECT dv.* FROM `dias_vacaciones` dv INNER JOIN `datos_personales` dp ON dv.`id_datosper` = dp.`id_datosper` WHERE dp.`id_datosper` = $id_tmp";
$res_divacas = $mysqli->query($divacas);
$an = date('Y');
while($row_redivacas = $res_divacas->fetch_array())
{
	if ($row_redivacas["3"] == $an) 
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
</center>
				<!-- DATOS DEL TRABAJO Y DÍAS DE VACACIONES -->
<br>
<?php
$actual = date('Y-m-j');
$total_ano = strtotime($actual) - strtotime($row_resfing[1]);
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
				<td><?php echo $totaldis ?></td>
			</tr>
			<tr>
				<td>Sueldo Mensual</td>
				<td><?php echo "$".$row_resjefes[11] ?></td>
			</tr>
			<tr>
				<td>Sueldo Diario</td>
				<td><?php 
				$diario = $row_resjefes[11] / 30;
				echo "$".round($diario, 2) ?></td>
			</tr>
		</tbody>
	</table>



	<table id="dtv">
		<tbody>
			<tr>
				<td>Vacaciones</td>

				<td><?php 
				$vaca = $diario * $totaldis;
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

<!-- *****************************************/.ajax date******************************** -->
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
                  </script>

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
				<td style=" width: 25px;"><input type="text" name="anos" placeholder="Año" style="width: 70px;"></td>
				<td style=" width: 25px;"><input type="text" name="dias" placeholder="Días" style="width: 70px;"></td>
				<td style=" width: 40px;"><input type="date" name="f_in"></td>
				<td style=" width: 40px;"><input type="date" name="f_fin" id="f_fin"></td>
				<td style=" width: 40px;"><label id="regreso"></label></td>
			</tr>
		</tbody>
	</table>
				<!-- FECHAS DE VACACIONES -->
	<center>
	<div id="firmas">
		<div>
			<div style="width: 130px;"></div>
			<div style="border-top: 1px solid; width: 130px; text-align: center; margin-top: 100px;">Solicitante</div>
		</div>
		<div>
			<div style="width: 130px;"></div>
			<div style="border-top: 1px solid; width: 130px; text-align: center; margin-top: 100px;">Jefe inmediato</div>
		</div>
		<div>
			<div style="width: 130px;"></div>
			<div style="border-top: 1px solid; width: 130px; text-align: center; margin-top: 100px;">Legal y R.H.</div>
		</div>
	</div>
	</center>
</div>

</body>
</html>
<?php
} // Cierra el if de que existe alguna sesión
?>

