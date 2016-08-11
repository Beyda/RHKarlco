<?php
include_once("../../../control/connect.php");
session_start();
$id_emp = $_GET["id_emp"];
?>
<script type="text/javascript" src="/rhkarlco/bootstrap/js/scripts.js"></script>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Lista de solicitudes</h4>
                  </div>
                  <form method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th>Autorización</th>
                        <th>Solicitud</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ctr_emp = "SELECT `id_vaca`, `fecha`, `etapa`, `id_puesto` FROM `vacaciones` WHERE `id_solicitante` = $id_emp";
                    $res_emp = $mysqli->query($ctr_emp);
                    while ($row_resemp = $res_emp->fetch_array()) {
                          $disable = "disabled";

                          $ctr_jefpu = "SELECT * FROM `jefes` WHERE `id_puesto` = $row_resemp[3]";
                          $res_jefpu = $mysqli->query($ctr_jefpu); //Consulta el estatus de la ultima solicitud de vacaciones de este empleado
                          $row_resjefpu = $res_jefpu->fetch_array();
                          if ($row_resemp[2] == 0) {
                            $etapa = "btn btn-block btn-danger";
                            $valor = "Jefe inmediato";
                            if ($row_resjefpu[2] == $_SESSION["id_datosper"]) {
                              $disable = "enable";
                            }
                          }
                          elseif ($row_resemp[2] == 1) {
                            $etapa = "btn btn-block btn-warning";
                            $valor = "Jefe de área";
                            if ($row_resjefpu[3] == $_SESSION["id_datosper"]) {
                              $disable = "enable";
                            }
                          }
                          elseif ($row_resemp[2] == 2) {
                            $etapa = "btn btn-block btn-info";
                            $valor = "Recursos Humanos";
                          }
                          elseif ($row_resemp[2] == 3) {
                            $etapa = "btn btn-block btn-success";
                            $valor = "Autorizado";
                          }
                      ?>
                      <tr>
                        <td><?php echo $row_resemp[1] ?></td>
                        <td>
                          <center><a href="../pdf/vacaciones.php?id=$row_resemp[0]" target="blanck"><button class="<?php echo $etapa ?>" style="width: 50%;" <?php echo $disable ?>><?php echo $valor ?></button></a></center>
                        </td>
                        <td><center><a href="../pdf/vacaciones.php?id=$row_resemp[0]" target="blanck"><button class="btn bg-blue margin" style="width: 50%;">Ver</button></a></center></td>
                      </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Fecha</th>
                        <th>Autorización</th>
                        <th>Solicitud</th>
                      </tr>
                    </tfoot>
                  </table>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="guardarEmpant" value="ho" id="guardar">Guardar</button>
                  </div>
                  </form>
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