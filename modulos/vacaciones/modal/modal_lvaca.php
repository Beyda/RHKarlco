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
                    $ctr_emp = "SELECT v.`id_vaca`, v.`fecha`, v.`etapa`, pp.`id_puesto` FROM `vacaciones` v INNER JOIN `puesto_per` pp ON v.`id_puesto` = pp.`id_puestoper` WHERE `id_solicitante` = $id_emp";
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
                          <center><button class="<?php echo $etapa ?>" onclick="autorizar(this, '<?php echo $row_resetapa[1]; ?>')"style="width: 50%;" <?php echo $disable ?> value="<?php echo $row_resetapa[0]?>"><?php echo $valor ?></button></center>
                        </td>
                        <td><center><a href="../pdf/vacaciones.php?id=<?php echo $row_resemp[0] ?>" target="blanck"><button class="btn bg-blue margin" style="width: 50%;">Ver</button></a></center>
                        <center><a href="modal/modal_obs.php" data-toggle="modal" data-target=".modal fade bd-example-modal-lg" class='modalOb'><button class="btn bg-blue margin" style="width: 50%;">Observaciones</button></a></center></td>
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
                  </div>
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
        $('.modalOb').click(function() { 
          $('.modal').modal('show'); 
          $('.modal-content').val('');
          $('.modal-content').load($(this).attr('href'));
           return false;

        });

      });
      </script>

      <div class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            
          </div>
        </div>
      </div>