<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION["session"])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION["session"];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 $id_emp = $_GET["id"];
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
      <form method="post" action="p_empresas.php" id="fo3" name="fo3" >
        <section class="content-header">
          <h1>
            Lista de jefes
            <small>por puestos</small>
            <a href="modal/modal_jefes.php" data-toggle="modal" data-target=".modal" class='modalLoad tooltipster-shadow-preview' title="Agregar jefe inmediato y de área a los puestos de trabajo faltantes"><button class="btn bg-navy margin">Asignar jefes</button></a>
            <select class="form-control tooltipster-shadow-preview" title="Filtrar los puestos por empresa al seleccionarla" style="width: 30%;" name="empresa" id="empresa" required>
              <option value="">Selecciona una empresa</option>
              <?php
              $obt_emp = "SELECT * FROM `empresas` WHERE `status` = 1";       
              $res_emp = $mysqli->query($obt_emp);
              while ($row_emp = $res_emp->fetch_array()) { 
                ?>
                  <option value="<?php echo $row_emp[0] ?>"><?php echo $row_emp[1] ?></option>
                <?php
              }
              ?>  
            </select>
          </h1>

        </section>
      </form>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="col-xs-12" id="result">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Puestos con sus jefes</h3>
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
                  $sel_puesto = "SELECT j.*, p.`id_puesto`, p.`puesto`, d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, da.`id_datosper`, da.`primer_nombre`, da.`segundo_nombre`, da.`ap_paterno`, da.`ap_materno` FROM `jefes` j INNER JOIN `puestos` p ON j.`id_puesto` = p.`id_puesto` INNER JOIN `datos_personales` d ON d.`id_datosper` = j.`id_jefin` INNER JOIN `datos_personales` da ON da.`id_datosper` = j.`id_jefar`";

                    $res_puesto = $mysqli->query($sel_puesto);
                    while ($row_respuesto = $res_puesto->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_respuesto[5]?></td>
                        <td><?php echo $row_respuesto[7]." ".$row_respuesto[8]." ".$row_respuesto[9]." ".$row_respuesto[10] ?></td>
                        <td><?php echo $row_respuesto[12]." ".$row_respuesto[13]." ".$row_respuesto[14]." ".$row_respuesto[15] ?></td>
                        <td><center><a href="modal/modal_mjefes.php?id=<?php echo $row_respuesto["0"]; ?>" data-toggle="modal" data-target=".modalmsalario" class='modalLoad'><button class="btn btn-block btn-success btn-xs" style="width:100px;">Modificar</button></a></center></td>
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
