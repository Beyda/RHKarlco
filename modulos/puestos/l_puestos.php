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
                  if ($tipo_usuario_session == "Administrador") {
                ?>
        <section class="content-header">
          <h1>
            Lista de puestos
            <small>por empresas</small>
            <a href="modal/modal_puesto.php" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn bg-navy margin">Agregar un puesto</button></a>
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
                    $sel_puesto = "SELECT * FROM `puestos` WHERE `id_empresa` = $id_emp ORDER BY `puesto` ASC";
                    $res_puesto = $mysqli->query($sel_puesto);
                    while ($row_respuesto = $res_puesto->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_respuesto[1]?></td>
                        <td><a href="modal/modal_mpuesto.php?id=<?php echo $row_respuesto[0] ?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn bg-olive margin">Modificar</button></a></td>
                        <?php 
                        if($row_respuesto[3] == 1)
                        {
                          $valor = "Activo";
                          $boton = "btn btn-success";                
                        }
                        if($row_respuesto[3] == 0)
                        {
                          $valor = "Inactivo";
                          $boton = "btn btn-danger"; 
                        }
                        ?>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="<?php echo $boton ?>"><?php echo $valor ?></button>
                            <button type="button" class="<?php echo $boton ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="cls_puesto.php?status=1&puesto=<?php echo $row_respuesto[0] ?>&emp=<?php echo $id_emp ?>">Activo</a></li>
                              <li><a href="cls_puesto.php?status=0&puesto=<?php echo $row_respuesto[0] ?>&emp=<?php echo $id_emp ?>">Inactivo</a></li>
                            </ul>
                          </div>
                        </td>
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

                  if (isset($_POST["puesto"])) {
                    include "cls_puesto.php";
                    $puesto = $_POST["puesto"];

                    $classEmp = new puesto ("$puesto", 0, $id_emp);
                    $classEmp->insertar();

                  }
                  if (isset($_POST["Mpuesto"])) {
                    include "cls_puesto.php";
                    $puesto = $_POST["Mpuesto"];
                    $id = $_POST["id"];

                    $classEmp = new puesto ("$puesto", $id, $id_emp);
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


