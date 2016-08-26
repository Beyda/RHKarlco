<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION["session"])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION["session"];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 $id_emp = $_GET["id"];
 //$avatar_session=$_SESSION["avatar_session"];
 
//$id_tmp = uniqid('', true);
include("../../template/todo2.php");
//inicio de librerias 
$mes_act = date('Y-m-j');
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$mes_act = date('m');
$ano_act = date('Y');
$dia_act = date('d')-1;
$dia_act2 = date('d');
$mes_letra = date('n');

$cump_emp = "SELECT DISTINCT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, d.`f_nacimiento`, e.`nombre` FROM `datos_personales` d INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` AND pp.`fecha_final`= '0000-00-00' INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON e.`id_empresa` = p.`id_empresa` WHERE date_format (`f_nacimiento`, '%m') = date_format (now(), '%m') AND d.`solicitante` = 0";
$res_cump_emp = $mysqli->query($cump_emp); //Busca las fechas de cumpleaños de los empleados del mes actual con nombre completo y empresa a la que pertenece
$n = 0;
while ($row_cump_emp = $res_cump_emp->fetch_array()) {
  $dias[$n] = date("d", strtotime($row_cump_emp[5])); //Guarda en un arreglo las fechas de cumpleaños del mes
  $nombre[$n] = $row_cump_emp[1] ." ". $row_cump_emp[2] ." ". $row_cump_emp[3] ." ". $row_cump_emp[4]; //Guarda el nombre del empleado
  $empresa[$n] = $row_cump_emp[6]; //Guarda el nombre de la empresa
  $id_emp[$n] = $row_cump_emp[0]; //Guarda el id del empleado
  $n++;
}


$cump_familiar = "SELECT f.`id_datosfam`, f.`primer_nombre`, f.`segundo_nombre`, f.`ap_paterno`, f.`ap_materno`, f.`nacimiento`, f.`tipo`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno` FROM `datos_familiares` f INNER JOIN `datos_personales` d ON f.`id_datosper` = d.`id_datosper` WHERE date_format (f.`nacimiento`, '%m') = date_format (now(), '%m') AND d.`solicitante` = 0";
$res_cump_familiar = $mysqli->query($cump_familiar); //Busca las fechas de cumpleaños de los empleados del mes actual con nombre completo y empresa a la que pertenece
$f = 0;
while ($row_cump_familiar = $res_cump_familiar->fetch_array()) {
  $dias_fam[$f] = date("d", strtotime($row_cump_familiar[5])); //Guarda en un arreglo las fechas de cumpleaños del mes
  $nombre_fam[$f] = $row_cump_familiar[1] ." ". $row_cump_familiar[2] ." ". $row_cump_familiar[3] ." ". $row_cump_familiar[4]; //Guarda el nombre del familiar
  $nombre_emp[$f] = $row_cump_familiar[7] ." ". $row_cump_familiar[8] ." ". $row_cump_familiar[9] ." ". $row_cump_familiar[10]; //Nombre del empleado que es familiar
  $id_fam[$f] = $row_cump_familiar[0]; //Guarda el id del empleado
  $tipo[$f] = $row_cump_familiar[6];
  $f++;
}


function getMonthDays($Month, $Year)
{
   if( is_callable("cal_days_in_month"))
   {
      return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
   }
   else
   {
      return date("d",mktime(0,0,0,$Month+1,0,$Year));
   }
}
//Obtenemos la cantidad de días que tiene el mes actual
$num_dias_mes = getMonthDays($mes_act, $ano_act);
?>
     

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
                
        <!-- Main content -->
          <section class="content-header">
          <h1>
            Cumpleaños
            <small>del mes

            </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">UI</a></li>
            <li class="active">Timeline</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- row -->
          <div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <ul class="timeline">
                <?php
                  while ($dia_act <= $num_dias_mes) { //mientras sea el mes
                    ?>
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-green">
                    <?php 
                      echo $dia_act ." de ". $meses[$mes_letra-1];
                    ?>
                  </span>
                </li>
                <!-- /.timeline-label -->
                    <?php
                    $j = 0;
                      //echo $cump_emp_mes = date("d", strtotime($row_cump_emp[5]));
                    while ($j < $n) {
                      
                      if ($dia_act == $dias[$j]) {
                        ?>
                          <!-- timeline item -->
                          <li>
                            <i class="fa fa-user bg-aqua"></i>
                            <div class="timeline-item">
                              <h3 class="timeline-header no-border"><?php 
                  if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Recursos Humanos") { ?><a href="<?php echo  $id_emp[$j] ?>"><?php } ?><?php echo  $nombre[$j] ?><?php if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Recursos Humanos") {
                ?></a><?php } ?> de la empresa <?php echo $empresa[$j] ?></h3>
                            </div>
                          </li>
                          <!-- END timeline item -->
                        <?php
                      }
                      $j++;
                    }


                    $g = 0;
                      //echo $cump_emp_mes = date("d", strtotime($row_cump_emp[5]));
                    while ($g < $f) {
                      
                      if ($dia_act2 == $dias_fam[$g]) {
                        ?>
                          <!-- timeline item -->
                          <li>
                            <i class="fa fa-user bg-aqua"></i>
                            <div class="timeline-item">
                              <h3 class="timeline-header no-border"><?php 
                  if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Recursos Humanos") {
                ?><a href="<?php echo  $id_emp[$g] ?>"><?php } ?><?php echo  $nombre_fam[$g] ?><?php 
                  if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Recursos Humanos") {
                ?></a><?php } ?> es <?php echo $tipo[$g] ?> de <?php echo $nombre_emp[$g] ?></h3>
                            </div>
                          </li>
                          <!-- END timeline item -->
                        <?php
                      }
                      $g++;
                    }
                    $dia_act2++;
                    $dia_act++;
                  }
                ?>
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div><!-- /.col -->
          </div><!-- /.row -->


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->
<?php 
require('../../template/footer.php');
    ?>
    </div><!-- ./wrapper -->

    <!-- ./Footer -->
  </body>
</html>
<?php
} else{
header("location: /rhkarlco/login.php");
}
?>
