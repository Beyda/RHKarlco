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
                   $sel_puesto = "SELECT j.*, p.`id_puesto`, p.`puesto`, u.`id_usuario`, u.`id_datosper`, d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, us.`id_usuario`, us.`id_datosper`, da.`id_datosper`, da.`primer_nombre`, da.`segundo_nombre`, da.`ap_paterno`, da.`ap_materno` FROM `jefes` j INNER JOIN `puestos` p ON j.`id_puesto` = p.`id_puesto` INNER JOIN `usuarios` u ON j.`id_jefin` = u.`id_usuario` INNER JOIN `datos_personales` d ON d.`id_datosper` = u.`id_datosper` INNER JOIN `usuarios` us ON j.`id_jefar` = us.`id_usuario` INNER JOIN `datos_personales` da ON da.`id_datosper` = us.`id_datosper` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` WHERE e.`id_empresa` = $empresa";

                    $res_puesto = $mysqli->query($sel_puesto);
                    while ($row_respuesto = $res_puesto->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_respuesto[5]?></td>
                        <td><?php echo $row_respuesto[9]." ".$row_respuesto[10]." ".$row_respuesto[11]." ".$row_respuesto[12] ?></td>
                        <td><?php echo $row_respuesto[16]." ".$row_respuesto[17]." ".$row_respuesto[18]." ".$row_respuesto[19] ?></td>
                        <td><center><a href="modal/modal_msalario.php?id=<?php echo $row_puesto["0"]; ?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn btn-block btn-success btn-xs" style="width:100px;">Modificar</button></a></center></td>
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



