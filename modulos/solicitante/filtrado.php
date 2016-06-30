<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*/
include_once("../../control/connect.php");
 session_start();
 if (isset($_POST["habilidades"])) 
  {
    $hab = $_POST["habilidades"];
    foreach ($hab as $key => $value) {
      //echo "El número: ".$value;
      $where[] = $value;
    }
    echo $query = "SELECT DISTINCT d.* FROM `datos_personales` d INNER JOIN `habilidades` h ON h.`id_datosper` = h.`id_datosper` WHERE h.`id_lhab` IN (".implode(", ",$where).") and d.`solicitante` = 1 GROUP BY h.`id_datosper`";
  }

/*  if (isset($_POST["carreras"]) && isset($_POST["habilidades"])) 
  {
    $hab = $_POST["carreras"];
    foreach ($hab as $key => $value) {
      //echo "El número: ".$value;
      $carrera[] = "AND `empleos_anteriores`.`id_sub` = ".$value;
    }
    
    
  }
  if (isset($_POST["carreras"]) && $_POST["habilidades"] == "") 
  {
    $hab = $_POST["carreras"];
    foreach ($hab as $key => $value) {
      //echo "El número: ".$value;
      $carrera[] = "`empleos_anteriores`.`id_sub` = ".$value;
    }
    
  }

  echo $query = "SELECT DISTINCT `datos_personales`.* FROM `datos_personales`,`habilidades`,`empleos_anteriores` WHERE ".implode(" AND ",$where)." ".implode(" AND ",$carrera);*/


?> 

        <!-- Main content -->


        
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Solicitantes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Perfil</th>
                        <th>Emplear</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ctr_emp = $query;
                    $res_emp = $mysqli->query($ctr_emp);
                    while ($row_resemp = $res_emp->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_resemp[1]?> <?php echo $row_resemp[2]?></td>
                        <td><center><a href="../empleados/a_perfil.php?id=<?php echo $row_resemp[2]?>"><button class="btn bg-olive margin" style="width: 50%;">Ver</button></a></center></td>
                        <td><center><button class="btn bg-blue margin sweet-4" style="width: 50%;" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-4']);">
                        Confirmar</button></center></td>
                      </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Perfil</th>
                        <th>Emplear</th>
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

      $(document).ready(function(){
        $('.modalLoad').click(function() { 
          $('.modal').modal('show'); 
          $('.modal-content').val('');
          $('.modal-content').load($(this).attr('href'));
           return false;

        });

      });
      </script>    <div class="example-modal">
            <div class="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->


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



