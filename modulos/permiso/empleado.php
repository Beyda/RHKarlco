<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION["session"])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION["session"];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 //$avatar_session=$_SESSION["avatar_session"];
 
//$id_tmp = uniqid('', true);
include("../../template/todo2.php");
//inicio de librerias 
$id_emp = $_GET["id_emp"];
?>
     

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="col-xs-12" id="result">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Empleados</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Puesto</th>
                        <th>Autorización</th>
                        <th>Solicitud</th>
                        <th>Observaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ctr_emp = "SELECT DISTINCT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, e.`nombre`, p.`puesto`, pe.`etapa`, p.`id_puesto`, pe.`id_permiso` FROM `datos_personales` d INNER JOIN `permisos` pe ON d.`id_datosper` = pe.`id_solicitante` INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` AND pe.`id_puesto` = p.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` WHERE pe.`id_solicitante` = $id_emp ORDER BY pe.`fecha_rh` ASC ";
                    $res_emp = $mysqli->query($ctr_emp);
                    while ($row_resemp = $res_emp->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_resemp[1] ." ". $row_resemp[2] ." ". $row_resemp[3] ." ". $row_resemp[4] ?></td>
                        <td><?php echo $row_resemp[5] ?></td>
                        <td><?php echo $row_resemp[6] ?></td>
                        <td>
                          <?php

                          $ctr_etapa = "SELECT `id_vaca`, `etapa` FROM `vacaciones` WHERE `id_solicitante` = $row_resemp[0] ORDER BY `fecha` DESC LIMIT 1";
                          $res_etapa = $mysqli->query($ctr_etapa); //Consulta el estatus de la ultima solicitud de vacaciones de este empleado
                          $row_resetapa = $res_etapa->fetch_array();

                          $ctr_jefpu = "SELECT * FROM `jefes` WHERE `id_puesto` = $row_resemp[8]";
                          $res_jefpu = $mysqli->query($ctr_jefpu); //Consulta el estatus de la ultima solicitud de vacaciones de este empleado
                          $row_resjefpu = $res_jefpu->fetch_array();
                          $disable = "disabled";

                          if ($row_resemp[7] == 0) {
                            $etapa = "bg-red";
                            $valor = "Jefe inmediato";
                            if ($row_resjefpu[2] == $_SESSION["id_datosper"]) {
                              $disable = "enable";
                            }
                          }
                          elseif ($row_resemp[7] == 1) {
                            $etapa = "bg-yellow";
                            $valor = "Jefe de área";
                            if ($row_resjefpu[3] == $_SESSION["id_datosper"]) {
                              $disable = "enable";
                            }
                          }
                          elseif ($row_resemp[7] == 2) {
                            $etapa = "bg-blue";
                            $valor = "Recursos Humanos";
                            $rh = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno` FROM `datos_personales` d INNER JOIN `usuarios` u ON u.`id_datosper` = d.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` AND t.`nombre` = 'Recursos Humanos'";
                            $res_rh = $mysqli->query($rh);
                            $row_rh = $res_rh->fetch_array();
                            if ($row_rh[0] == $_SESSION["id_datosper"]) {
                              $disable = "enable";
                            }
                          }
                          elseif ($row_resemp[7] == 3) {
                            $etapa = "bg-green";
                            $valor = "Autorizado";
                          }
                          elseif ($row_resemp[7] == 4) {
                            $etapa = "bg-red";
                            $valor = "Rechazado";
                          }
                          ?>
                          <center>
                          <ul class="timeline">
                          <li class="time-label">
                          <span class="<?php echo $etapa ?>"><?php echo $valor ?></span></li></ul></center>
                        </td>
                        <td><center><a href="../pdf/permisos.php?id=<?php echo $row_resemp[9]?>" target="blanck"><button class="btn bg-blue" style="width: 50%;">Ver</button></a></center></td>
                        <td><center><a href="modal/modal_obs.php?id_permiso=<?php echo $row_resemp[9]?>" data-toggle="modal" data-target=".bs-example-modal-lg" class='modalLoad'><button class="btn bg-navy" style="width: 50%;">Ver</button></a></center></td>
                      </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Puesto</th>
                        <th>Autorización</th>
                        <th>Solicitud</th>
                        <th>Observaciones</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        <script type="text/javascript">

      $(document).ready(function(){
        $('.modalLoad').click(function() { 
          $('.modal').modal('show'); 
          $('.modal-content').val('');
          $('.modal-content').load($(this).attr('href'));
           return false;

        });

      });
      </script>
  <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        /*$('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });*/
      });
    </script>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            
          </div>
        </div>
      </div>

      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->
    </body>
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
