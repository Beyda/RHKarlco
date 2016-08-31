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

?>
     

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <?php 
      if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Recursos Humanos") {
    ?>
      
        <section class="content-header">
          <h1>
            Lista de solicitudes
            <small>de constancias </small>
            <a href="constancia.php?id=<?php echo $_SESSION["id_datosper"] ?>" class='tooltipster-shadow-preview' title="Abrir una solicitud de constancia" target="blanck"><button class="btn bg-navy margin">Solicitar constancia</button></a>
          </h1>
        </section>
      <?php 
        $rh = "SELECT d.`id_datosper` FROM `datos_personales` d INNER JOIN `usuarios` u ON u.`id_datosper` = d.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` AND t.`nombre` = 'Recursos Humanos'";
        $res_rh = $mysqli->query($rh);
        $row_rh = $res_rh->fetch_array();
    ?>

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
                        <th>Ver constancias</th>
                        <th>Solicitar constancia</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ctr_emp = "SELECT DISTINCT `id_solicitante` FROM `constancia` c INNER JOIN `datos_personales` d ON c.`id_solicitante` = d.`id_datosper`"; //Busca a todos los empleados de ese usuario
                    $res_emp = $mysqli->query($ctr_emp);
                    while ($row_resemp = $res_emp->fetch_array()) {
                      $ultimo = "SELECT `id_cons` FROM `constancia` WHERE `id_solicitante` = $row_resemp[0]  ORDER BY `fecha` DESC LIMIT 1"; //Busca la última solicitud de vacaciones enviada
                      $res_ultimo = $mysqli->query($ultimo);
                      $row_resultimo = $res_ultimo->fetch_array();

                     $info = "SELECT DISTINCT e.`nombre`, p.`puesto`, p.`id_puesto`, d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, j.`id_jefin`, j.`id_jefar` FROM `datos_personales` d INNER JOIN `constancia` c ON d.`id_datosper` = c.`id_solicitante`  AND c.`id_cons` = $row_resultimo[0] INNER JOIN `puesto_per` pp ON pp.`id_datosper` = d.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON e.`id_empresa` = p.`id_empresa` INNER JOIN `jefes` j ON pp.`id_puesto` = j.`id_puesto`";
                      $res_info = $mysqli->query($info);
                      $row_resinfo = $res_info->fetch_array();

                      ?>
                      <tr>
                        <td><?php echo $row_resinfo[4] ." ". $row_resinfo[5] ." ". $row_resinfo[6] ." ". $row_resinfo[7] ?></td>
                        <td><?php echo $row_resinfo[0] ?></td>
                        <td><?php echo $row_resinfo[1] ?></td>
                        <td>
                          <center><button class="<?php echo $etapa ?>" onclick="autorizar(this, '<?php echo $row_resinfo[2]; ?>')"style="width: 50%;" <?php echo $disable ?> value="<?php echo $row_resultimo[0]?>"><?php echo $valor ?></button></center>
                        </td>
                        <td><center><a href="empleado.php?id_emp=<?php echo $row_resinfo[4]?>" target="blanck" ><button class="btn bg-blue margin" style="width: 50%;">Ver</button></a></center></td>
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
                        <th>Ver constancias</th>
                        <th>Solicitar constancia</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

            <?php
              }
            ?>
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->

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

      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            
          </div>
        </div>
      </div>

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
