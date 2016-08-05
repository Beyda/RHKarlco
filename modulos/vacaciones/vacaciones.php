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
<script language="javascript">
$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    $('#form, #fat, #fo3').submit(function() {
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                $('#result').html(data);

            }
        })
        
        return false;
    }); 

    $("#empresa").change(function(){
    var empresa=$(this).val();
    var dataString2 = 'empresa='+ empresa;
    $.ajax({
        type: "POST",
        url: "p_empresas.php",
        data: dataString2,
        cache: false,
    success: function(html){
    $("#result").html(html);
    }
    });
});
})  
</script>
      
        <section class="content-header">
          <h1>
            Lista de vacaciones
            <small>por empleados</small>
            <a href="solicitud.php?id=<?php echo $_SESSION["id_datosper"] ?>" class='tooltipster-shadow-preview' title="Abrir una solicitud de vacaciones" target="blanck"><button class="btn bg-navy margin">Solicitar vacaciones</button></a>
            <form method="post" action="p_empresas.php" id="fo3" name="fo3" >
            <select class="form-control tooltipster-shadow-preview" title="Filtrar los puestos por empresa al seleccionarla" style="width: 30%;" name="empresa" id="empresa" required>
              <option value="">Selecciona empresa</option>
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
                        <th>Pendientes</th>
                        <th>Vacaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ctr_emp = "SELECT DISTINCT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, e.`nombre`, p.`puesto`, v.`etapa` FROM `datos_personales` d INNER JOIN `vacaciones` v ON d.`id_datosper` = v.`id_solicitante` INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` ORDER BY v.`fecha_rh` ASC";
                    $res_emp = $mysqli->query($ctr_emp);
                    while ($row_resemp = $res_emp->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_resemp[1] ." ". $row_resemp[2] ." ". $row_resemp[3] ." ". $row_resemp[4] ?></td>
                        <td><?php echo $row_resemp[5] ?></td>
                        <td><?php echo $row_resemp[6] ?></td>
                        <td>
                          <?php
                          if ($row_resemp[7] == 0) {
                            $etapa = "btn btn-block btn-danger";
                            $valor = "Jefe inmediato";
                            $link = "#";
                          }
                          elseif ($row_resemp[7] == 1) {
                            $etapa = "btn btn-block btn-warning";
                            $valor = "Jefe de área";
                            $link = "#";
                          }
                          elseif ($row_resemp[7] == 2) {
                            $etapa = "btn btn-block btn-info";
                            $valor = "Recursos Humanos";
                            $link = "#";
                          }
                          elseif ($row_resemp[7] == 3) {
                            $etapa = "btn btn-block btn-success";
                            $valor = "Eutorizado";
                            $link = "#";
                          }
                          ?>
                          <center><a href="modal/modal.php?id=<?php echo $row_resemp[0]?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn bg-blue margin" style="width: 50%;">Ver</button></a></center>
                        </td>
                        <td><center><a href="modal/modal.php?id=<?php echo $row_resemp[0]?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn bg-blue margin" style="width: 50%;">Ver</button></a></center></td>
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
                        <th>Pendientes</th>
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

                  if (isset($_POST["puesto"])) {
                    include "cls_jefe.php";
                    $puesto = $_POST["puesto"];
                    $jefi = $_POST["jefi"];
                    $jefa = $_POST["jefa"];

                    $classEmp = new jefes ($puesto,$jefi, $jefa, 0);
                    $classEmp->insertar();

                  }
                  if (isset($_POST["Mpuesto"])) {
                    include "cls_jefe.php";
                    $puesto = $_POST["Mpuesto"];
                    $jefi = $_POST["Mjefi"];
                    $jefa = $_POST["Mjefa"];
                    $id = $_POST["id"];

                    $classEmp = new jefes ($puesto,$jefi, $jefa, $id);
                    $classEmp->actualizar();

                  }

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

      <div class="example-modal">
            <div class="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->

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
