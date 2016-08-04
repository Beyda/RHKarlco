<?php
include_once("../../control/connect.php");
session_start();
$f_in = $_POST["f_in"];
$f_final=$_POST['f_fin'];

//Días transcurridos entre las fechas establecidas
$dias = (strtotime($f_in)-strtotime($f_final))/86400; 
$dias = abs($dias); $dias = floor($dias);
//echo $dias."<br>";
$dias2 = $dias;

$festivos = "SELECT * FROM `dias_festivos` WHERE `estatus`=1"; //Busca todos los días festivos
$res_festivos = $mysqli->query($festivos);
while($row_refestivos = $res_festivos->fetch_array())
{
	$d_festiv[] = date("Y-m-d", strtotime($row_refestivos[1]));//Guarda los días festivos en un array
}

for ($d=0; $d <= $dias; $d++) { 
	$fecha = strtotime ( '+'.$d.' day' , strtotime ( $f_in ) );
	$fecha2 = date('Y-m-d',$fecha);
	$h = date('w',strtotime($fecha2));
	if ($h == 6 || $h == 0) {
		//echo "Quitar fin: ". $h ."<br>";
			$dias2--;
		}
	for ($i=0; $i <= count($d_festiv) -1 ; $i++) 
	{ //echo $d_festiv[$i] ."==". $fecha2 ."<br>";
		if ($d_festiv[$i] == $fecha2) {
			//echo "Quitar festivo<br>";
			$dias2--;
		}
	}
}
$n = 1;
$regreso = "";
$date = $f_final;
$anac = date('Y');
while ($regresa == "") {
	$date = strtotime ( '+'.$n.' day' , strtotime ( $f_final ) );
	$date2 = date('Y-m-d',$date);
	for ($i=0; $i <= count($d_festiv) -1 ; $i++) {
		if ($date2 == $d_festiv[$i]) {
			$n++;
			$date = strtotime ( '+'.$n.' day' , strtotime ( $f_final ) );
			$date2 = date('Y-m-d',$date);
		}
		if ($date2 != $d_festiv[$i]) {
			$regresa = $date2;
			/*
			echo "<br>Date= ".$date2;
			echo  "<br>fest_act= ".$fest_act;*/
			//echo date('Y-m-d',$regresa) . '<br />';
		}
	}
	$h = date('w',strtotime($date2));
	if ($h == 6 || $h == 0) {
		$regresa = "";
	}
	$n++;
}
//echo $regresa . '<br />';
?>
<form method="post">
<table id="fechas">
	<tbody>
		<tr>
			<td>AÑO A DISFRUTAR</td>
			<td>DÍAS A DISFRUTAR </td>
			<td>FECHA DE INICIO DE VACACIONES</td>
			<td>FECHA DE CULMINACIÓN DE VACACIONES</td>
			<td>FECHA DE REINICIO DE VACACIONES</td>
		</tr>
		<?php
          $ano = "SELECT * FROM `ejercicio` WHERE `estatus` = 1";
          $res_anos = $mysqli->query($ano);
          $row_anos = $res_anos->fetch_array();
        ?>
		<tr>
			<td><?php echo $row_anos[1] ?></td>
			<td><?php echo $descanso = $dias2+1 ?></td>
			<td><input type="date" name="f_in" value="<?php echo $f_in ?>" required></td>
			<td><input type="date" name="f_fin" id="f_fin" value="<?php echo $f_final ?>" required></td>
			<td name="regreso"><?php echo $regresa ?></td>
		</tr>
	</tbody>
</table>
</form>
<?php
	$_SESSION["f_in"] = $f_in;
	$_SESSION["f_final"] = $f_final;
	$_SESSION["dias"] = $descanso;
	$_SESSION["regresa"] = $regresa;
?>
