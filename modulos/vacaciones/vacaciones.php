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
      if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Jefe" || $tipo_usuario_session == "Recursos Humanos") {
        $rh = "SELECT d.`id_datosper` FROM `datos_personales` d INNER JOIN `usuarios` u ON u.`id_datosper` = d.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` AND t.`nombre` = 'Recursos Humanos'";
        $res_rh = $mysqli->query($rh);
        $row_rh = $res_rh->fetch_array();
    ?>


<!-- *****************************************/.ajax tipo******************************** -->
  <script type="text/javascript">
  //Mostrar el tipo de resultado que se desea ver
  $(document).ready(function(){
      //Manda el tipo de información que se desea consultar
      $("#tipo").change(function(){
          var tipo=$(this).val();
          var dataString2 = 'tipo='+ tipo;
          $.ajax({
              type: "POST",
              url: "l_solic.php",
              data: dataString2,
              cache: false,
          success: function(html){
          $("#result").html(html);
          }
          });
      });

    });
  </script>
      
        <section class="content-header">
          <h1>
            Lista de solicitudes
            <small>de vacaciones </small>
            <a href="solicitud.php?id=<?php echo $_SESSION["id_datosper"] ?>" class='tooltipster-shadow-preview' title="Abrir una solicitud de vacaciones" target="blanck"><button class="btn bg-navy margin">Solicitar vacaciones</button></a>
            <form method="post" action="ajax_solic.php" id="fo3" name="fo3" >
            <select class="form-control tooltipster-shadow-preview" title="Busca las diferentes solicitudes" style="width: 30%;" name="tipo" id="tipo" required>
              <option value="">Selecciona que mostrar</option>
              <option value="0">Pendientes</option>
              <option value="1">Autorizadas</option>
              <option value="2">Mis solicitudes</option>
              <option value="3">Todas</option>
            </select>
            </form>
          </h1>
        </section>
      

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
                        <th>Vacaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ctr_emp = "SELECT DISTINCT d.`id_datosper`FROM `vacaciones` v INNER JOIN `datos_personales` d ON v.`id_solicitante` = d.`id_datosper` INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `jefes` j ON pp.`id_puesto` = j.`id_puesto`  WHERE j.`id_jefin` = $_SESSION[id_datosper] OR j.`id_jefar` = $_SESSION[id_datosper]"; //Busca a todos los empleados de ese usuario
                    $res_emp = $mysqli->query($ctr_emp);
                    while ($row_resemp = $res_emp->fetch_array()) {
                      $ultimo = "SELECT `id_vaca` FROM `vacaciones` WHERE `id_solicitante` = $row_resemp[0]  ORDER BY `fecha` DESC LIMIT 1"; //Busca la última solicitud de vacaciones enviada
                      $res_ultimo = $mysqli->query($ultimo);
                      $row_resultimo = $res_ultimo->fetch_array();

                     $info = "SELECT DISTINCT e.`nombre`, p.`puesto`, v.`etapa`, p.`id_puesto`, d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, j.`id_jefin`, j.`id_jefar` FROM `datos_personales` d INNER JOIN `vacaciones` v ON d.`id_datosper` = v.`id_solicitante`  AND v.`id_vaca` = $row_resultimo[0] INNER JOIN `puesto_per` pp ON pp.`id_datosper` = d.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON e.`id_empresa` = p.`id_empresa` INNER JOIN `jefes` j ON pp.`id_puesto` = j.`id_puesto`";
                      $res_info = $mysqli->query($info);
                      $row_resinfo = $res_info->fetch_array();

                      $empleado = "ocultar"; // oculta al empleado a menos que este sea jefe de la etapa en que esta solicitando las vacaciones

                      if ($row_resinfo[2] == 0 && $row_resinfo[9] == $_SESSION["id_datosper"]) {
                        $empleado = "ver";
                        //echo "Entre en jefe inmeadiato";
                        $etapa = "btn btn-block btn-danger";
                        $valor = "Empleado inmediato";
                      }
                      elseif ($row_resinfo[2] == 1 && $row_resinfo[10] == $_SESSION["id_datosper"]) {
                        $empleado = "ver";
                        //echo "Entre en jefe de área";
                        $etapa = "btn btn-block btn-warning";
                        $valor = "Empleado de área";
                      }
                      elseif ($row_resinfo[2] == 2 && $row_rh[0] == $_SESSION["id_datosper"]) {
                        $empleado = "ver";
                        //echo "Entre en recursos humanos";
                        $etapa = "btn btn-block btn-info";
                        $valor = "Recursos Humanos";
                      }
                      /*elseif ($row_resinfo[2] == 3) {
                            $etapa = "btn btn-block btn-success";
                            $valor = "Autorizado";
                          }*/

                      if ($empleado == "ver") {
                      ?>
                      <tr>
                        <td><?php echo $row_resinfo[5] ." ". $row_resinfo[6] ." ". $row_resinfo[7] ." ". $row_resinfo[8] ?></td>
                        <td><?php echo $row_resinfo[0] ?></td>
                        <td><?php echo $row_resinfo[1] ?></td>
                        <td>
                          <center><button class="<?php echo $etapa ?>" onclick="autorizar(this, '<?php echo $row_resinfo[2]; ?>')"style="width: 50%;" <?php echo $disable ?> value="<?php echo $row_resultimo[0]?>"><?php echo $valor ?></button></center>
                        </td>
                        <td><center><a href="modal/modal_lvaca.php?id_emp=<?php echo $row_resinfo[4]?>" data-toggle="modal" data-target=".bs-example-modal-lg" class='modalLoad'><button class="btn bg-blue margin" style="width: 50%;">Ver</button></a></center></td>
                      </tr>
                      <?php
                          }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Puesto</th>
                        <th>Autorización</th>
                        <th>Vacaciones</th>
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
<?php 
      if ($tipo_usuario_session == "Empleado") {
    ?>

<!-- *****************************************/.ajax tipo******************************** -->
  <script type="text/javascript">
  //Mostrar el tipo de resultado que se desea ver
  $(document).ready(function(){


      //Manda el tipo de información que se desea consultar
      $("#tipo").change(function(){
          var tipo=$(this).val();
          var dataString2 = 'tipo='+ tipo;
          $.ajax({
              type: "POST",
              url: "l_solic.php",
              data: dataString2,
              cache: false,
          success: function(html){
          $("#result").html(html);
          }
          });
      });


      

    });
  </script>
      
        <section class="content-header">
          <h1>
            Lista de solicitudes
            <small>de vacaciones </small>
            <a href="solicitud.php?id=<?php echo $_SESSION["id_datosper"] ?>" class='tooltipster-shadow-preview' title="Abrir una solicitud de vacaciones" target="blanck"><button class="btn bg-navy margin">Solicitar vacaciones</button></a>
          </h1>
        </section>
      

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
                    $ctr_emp = "SELECT DISTINCT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, e.`nombre`, p.`puesto`, v.`etapa`, p.`id_puesto`, v.`id_vaca` FROM `datos_personales` d INNER JOIN `vacaciones` v ON d.`id_datosper` = v.`id_solicitante` INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` WHERE v.`id_solicitante` = $_SESSION[id_datosper] AND pp.`fecha_final` = '0000-00-00' ORDER BY v.`fecha_rh` ASC";
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

                          if ($row_resetapa[1] == 0) {
                            $etapa = "bg-red";
                            $valor = "Jefe inmediato";
                            $link = "../pdf/vacaciones.php?id=$row_resetapa[0]";
                            if ($row_resjefpu[2] == $_SESSION["id_datosper"]) {
                              $disable = "enable";
                            }
                          }
                          elseif ($row_resetapa[1] == 1) {
                            $etapa = "bg-yellow";
                            $valor = "Jefe de área";
                            $link = "../pdf/vacaciones.php?id=$row_resetapa[0]";
                            if ($row_resjefpu[3] == $_SESSION["id_datosper"]) {
                              $disable = "enable";
                            }
                          }
                          elseif ($row_resetapa[1] == 2) {
                            $etapa = "bg-blue";
                            $valor = "Recursos Humanos";
                            $rh = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno` FROM `datos_personales` d INNER JOIN `usuarios` u ON u.`id_datosper` = d.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` AND t.`nombre` = 'Recursos Humanos'";
                            $res_rh = $mysqli->query($rh);
                            $row_rh = $res_rh->fetch_array();
                            if ($row_rh[0] == $_SESSION["id_datosper"]) {
                              $disable = "enable";
                            }
                            $link = "../pdf/vacaciones.php?id=$row_resetapa[0]";
                          }
                          elseif ($row_resetapa[1] == 3) {
                            $etapa = "bg-green";
                            $valor = "Autorizado";
                            $link = "../pdf/vacaciones.php?id=$row_resetapa[0]";
                          }
                          ?>
                          <center>
                          <ul class="timeline">
                          <li class="time-label">
                          <span class="<?php echo $etapa ?>"><?php echo $valor ?></span></li></ul></center>
                        </td>
                        <td><center><a href="../pdf/vacaciones.php?id=<?php echo $row_resemp[9]?>" target="blanck"><button class="btn bg-blue" style="width: 50%;">Ver</button></a></center></td>
                        <td><center><a href="modal/modal_obs.php?id_vac=<?php echo $row_resemp[9]?>" data-toggle="modal" data-target=".bs-example-modal-lg" class='modalLoad'><button class="btn bg-navy" style="width: 50%;">Ver</button></a></center></td>
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
                  <?php
              }
?>
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->

    <script type="text/javascript">

     function autorizar(id, etapa){
        swal({
        title: "¿Desea autorizar estas vacaciones?",
        text: "Escribir las observaciones",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        inputPlaceholder: "Observaciones"
      }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") 
        swal("Bien!", "solicitud autorizada" , "success");
        window.location.href = "autorizar.php?idvac="+id.value+"&obs="+inputValue+"&tipo="+etapa;
      });
      };

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
