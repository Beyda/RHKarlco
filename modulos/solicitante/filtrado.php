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
    $n=0;
    $c=0;
    foreach ($hab as $key => $value) {
      //echo "El número: ".$value;
      $n++;
      $where[] = "INNER JOIN  `habilidades` h".$n." ON h".$n.".`id_datosper` = d.`id_datosper` AND h".$n.".`id_lhab` = ".$value;
    }
  }

  if (isset($_POST["carreras"])) 
  {
    $carr = $_POST["carreras"];
    foreach ($carr as $key => $value) {
      $c++;
      //echo "El número: ".$value;
      $carrera[] = "INNER JOIN  `estudios` e".$c." ON e".$c.".`id_datosper` = d.`id_datosper` AND e".$c.".`certificado` = ".$value;
    }
  }

  if ($_POST["experiencia"] != "") {
    $experiencia = $_POST["experiencia"];
    $tipo = $_POST["tipo"];
    $exp = "and d.`ano_experiencia` $tipo $experiencia";
  }


  if ($_POST["edad"] != "") {
    $edad = $_POST["edad"];

    $fecha = date('Y-m-j');
    $nuevafecha = strtotime ( '-'.$edad.' year' , strtotime ( $fecha ) ) ;
    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
    
    $tipo_edad = $_POST["tipo_edad"];
    $ed = "and d.`f_nacimiento` $tipo_edad '$nuevafecha'";
  }

  if (isset($_POST["sexo"]) && $_POST["sexo"] != " ") {
    $sexo = $_POST["sexo"];
    $sx = "and d.`sexo` = '$sexo'";
  }

 $query = "SELECT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, d.`correo`, d.`tel_part` FROM `datos_personales` d ".implode(" ",$where)." ".implode(" ",$carrera)." WHERE d.`solicitante` = 1 ".$exp." ".$sx." ".$ed;
    
/*  }
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
                        <th>Correo</th>
                        <th>Teléfono</th>
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
                        <td><?php echo $row_resemp[1] ." ". $row_resemp[2] ." ". $row_resemp[3] ." ". $row_resemp[4] ?></td>
                        <td><?php echo $row_resemp[5] ?></td>
                        <td><?php echo $row_resemp[6] ?></td>
                        <td><center><a href="../empleados/a_perfil.php?id=<?php echo $row_resemp[0]?>"><button class="btn bg-olive margin" style="width: 50%;">Ver</button></a></center></td>
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
                        <th>Correo</th>
                        <th>Teléfono</th>
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



