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
                        <th>Autorización</th>
                        <th>Vacaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ctr_emp = "SELECT DISTINCT d.`id_datosper`FROM `vacaciones` v INNER JOIN `datos_personales` d ON v.`id_solicitante` = d.`id_datosper` INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `jefes` j ON pp.`id_puesto` = j.`id_puesto`  WHERE j.`id_jefin` = $_SESSION[id_datosper] OR j.`id_jefar` = $_SESSION[id_datosper] OR $row_rh[0] = $_SESSION[id_datosper]"; //Busca a todos los empleados de ese usuario
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
                          <center><a href="modal/modal_autor.php?id_vac=<?php echo $row_resultimo[0]?>&tipo=<?php echo $row_resinfo[2]?>" data-toggle="modal" data-target=".bs-example-modal-lg" class='modalLoad'><button class="<?php echo $etapa ?>" style="width: 50%;"><?php echo $valor ?></button></a></center>
                        </td>
                        <td><center><a href="empleado.php?id_emp=<?php echo $row_resinfo[4]?>" target="blanck" ><button class="btn bg-blue margin" style="width: 50%;">Ver</button></a></center></td>
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