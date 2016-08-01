<?php
include_once("../../control/connect.php");
$f_final=$_POST['f_fin'];

$festivos = "SELECT * FROM `dias_festivos` WHERE `estatus`=1";
$res_festivos = $mysqli->query($festivos);
while($row_refestivos = $res_festivos->fetch_array())
{
	$d_festiv[] = date("m-d", strtotime($row_refestivos[1]));
}
$n = 1;
$regreso = "";
$date = $f_final;
$anac = date('Y');
while ($regresa == "") {
	$date = strtotime ( '+'.$n.' day' , strtotime ( $f_final ) );
	$date2 = date('Y-m-d',$date);
	for ($i=0; $i <= count($d_festiv) -1 ; $i++) {
		$fest_act = $anac."-".$d_festiv[$i]; 
		if ($date2 == $fest_act) {
			$n++;
			$date = strtotime ( '+'.$n.' day' , strtotime ( $f_final ) );
			$date2 = date('Y-m-d',$date);
		}
		if ($date2 != $fest_act) {
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
echo $regresa . '<br />';
?>