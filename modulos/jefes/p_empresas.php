<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*/
include_once("../../control/connect.php");
 session_start();
 if (isset($_POST["empresa"])) 
  {
    $empresa = $_POST["empresa"];
  }



?> 

        <!-- Main content -->


        
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Empleados</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Puesto</th>
                        <th>Jefe inmediato</th>
                        <th>Jefe de área</th>
                        <th>Modificar</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                   $sel_puesto = "SELECT p.`id_puesto`, p.`puesto`, d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, da.`id_datosper`, da.`primer_nombre`, da.`segundo_nombre`, da.`ap_paterno`, da.`ap_materno`, j.`id_jefes` FROM `datos_personales` d INNER JOIN `jefes` j ON d.`id_datosper` = j.`id_jefin` INNER JOIN `datos_personales` da ON da.`id_datosper` = j.`id_jefar` INNER JOIN `puestos` p ON p.`id_puesto` = j.`id_puesto` AND p.`id_empresa` = $empresa";

                    $res_puesto = $mysqli->query($sel_puesto);
                    while ($row_respuesto = $res_puesto->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_respuesto[1]?></td>
                        <td><?php echo $row_respuesto[3]." ".$row_respuesto[4]." ".$row_respuesto[5]." ".$row_respuesto[6] ?></td>
                        <td><?php echo $row_respuesto[8]." ".$row_respuesto[9]." ".$row_respuesto[10]." ".$row_respuesto[11] ?></td>
                        <td><center><a href="modal/modal_mjefes.php?id=<?php echo $row_respuesto["12"]; ?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn btn-block btn-success btn-xs" style="width:100px;">Modificar</button></a></center></td>
                      </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Puesto</th>
                        <th>Jefe inmediato</th>
                        <th>Jefe de área</th>
                        <th>Modificar</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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

      document.querySelector('.sweet-4').onclick = function(){
        swal({
          title: "¿Desea convertirlo como empleado?",
          text: "Clic en si para continuar",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-primary',
          confirmButtonText: 'Si, continuar',
          closeOnConfirm: false,
          //closeOnCancel: false
        },
        function(){
          swal("Felicidades!", "Crearle un usuario al empleado!", "success");
        });
      };
    </script>
    


  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>



