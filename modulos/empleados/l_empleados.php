<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION["session"])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION["session"];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 $id_datosper = $_SESSION["id_datosper"];
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
        <section class="content-header">
          <h1>
            Lista de empleados
            <small>Listado</small>
            <a href="r_empleados.php"><button class="btn bg-navy margin">Agregar un empleado</button></a>
          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Empleados</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        <th>Estatus</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ctr_emp = "SELECT `primer_nombre`, `ap_paterno`, `id_datosper`, `estatus` FROM `datos_personales` where `solicitante` = 0 ORDER BY `primer_nombre` ASC";
                    $res_emp = $mysqli->query($ctr_emp);
                    while ($row_resemp = $res_emp->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_resemp[0]?> <?php echo $row_resemp[1]?></td>
                        <td><center><a href="a_perfil.php?id=<?php echo $row_resemp[2]?>"><button class="btn bg-olive margin" style="width: 50%;">Modificar</button></a></center></td>
                        <?php 
                        if($row_resemp[3] == 1)
                        {
                          $color = "btn bg-blue margin";
                          $estatus = "Activo";                
                        }
                        if($row_resemp[3] == 2)
                        {
                          $color = "btn bg-orange margin";
                          $estatus = "Con permiso"; 
                        }
                        if($row_resemp[3] == 3)
                        {
                          $color = "btn bg-red margin";
                          $estatus = "Dado de baja"; 
                        }
                        ?>
                        <td><center><a href="modal/modal.php?id=<?php echo $row_resemp[2]?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="<?php echo $color; ?>" style="width: 50%;"><?php echo $estatus ?></button></a></center></td>
                      </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        <th>Estatus</th>
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


                     
                  if ($tipo_usuario_session == "Jefe") {
                ?>
        <section class="content-header">
          <h1>
            Lista de empleados
            <small>Listado</small>
          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Empleados</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        <th>Estatus</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ctr_emp = "SELECT DISTINCT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, d.`estatus` FROM `datos_personales` d INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `jefes` j ON pp.`id_puesto` = j.`id_puesto` WHERE j.`id_jefin` = $id_datosper OR j.`id_jefar` = $id_datosper ORDER BY `primer_nombre` ASC"; 
                    $res_emp = $mysqli->query($ctr_emp);
                    while ($row_resemp = $res_emp->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_resemp[1] ." ". $row_resemp[2] ." ". $row_resemp[3] ." ". $row_resemp[4] ?></td>
                        <td><center><a href="a_perfil.php?id=<?php echo $row_resemp[2]?>"><button class="btn bg-olive margin" style="width: 50%;">Modificar</button></a></center></td>
                        <?php 
                        if($row_resemp[5] == 1)
                        {
                          $color = "btn bg-blue margin";
                          $estatus = "Activo";                
                        }
                        if($row_resemp[5] == 2)
                        {
                          $color = "btn bg-orange margin";
                          $estatus = "Con permiso"; 
                        }
                        if($row_resemp[5] == 3)
                        {
                          $color = "btn bg-red margin";
                          $estatus = "Dado de baja"; 
                        }
                        ?>
                        <td><center><a href="modal/modal.php?id=<?php echo $row_resemp[0]?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="<?php echo $color; ?>" style="width: 50%;"><?php echo $estatus ?></button></a></center></td>
                      </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        <th>Estatus</th>
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


