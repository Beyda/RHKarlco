<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION["session"])){
 $correo_session=$_SESSION["session"];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 
include("../../template/todo2.php");
//inicio de librerias 

?>
     

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
                <?php 
                  if ($tipo_usuario_session == "Administrador") {
                ?>

      <form method="post" action="p_empresas.php" id="fo3" name="fo3" >
        <section class="content-header">
          <h1>
            Lista de ejercicios
            <a href="modal/modal_ejercicio.php" data-toggle="modal" data-target=".modal" class='modalLoad tooltipster-shadow-preview' title="Agregar el año activo"><button class="btn bg-navy margin">Agregar un nuevo ejercicio</button></a>
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
                  <h3 class="box-title">Lista de ejercicio</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Año</th>
                        <th>Descripción</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sel_df = "SELECT * FROM `ejercicio`";

                    $res_df = $mysqli->query($sel_df);
                    while ($row_resdf = $res_df->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_resdf[1]?></td>
                        <td><?php echo $row_resdf[2] ?></td>
                        <!--<td><a href="modal/modal_festivos.php?id=<?php echo $row_resdf[0] ?>" data-toggle="modal" data-target=".modal" class='modalLoad tooltipster-shadow-preview'><button class="btn bg-navy margin">Modificar</button></a></td>
                        <td>
                          <div class="btn-group">
                          <?php
                          if ($row_resdf[3] == 1) {
                            $valor = "Activo";
                            $boton = "btn btn-success";
                          }
                          if ($row_resdf[3] == 0) {
                            $valor = "Inactivo";
                            $boton = "btn btn-danger";
                          }

                          ?>
                                <button type="button" class="<?php echo $boton ?>"><?php echo $valor ?></button>
                                <button type="button" class="<?php echo $boton ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="cls_festivos.php?status=1&festivo=<?php echo $row_resdf[0] ?>">Activo</a></li>
                                  <li><a href="cls_festivos.php?status=0&festivo=<?php echo $row_resdf[0] ?>">Inactivo</a></li>
                                </ul>
                          </div>
                        </td>-->
                      </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Año</th>
                        <th>Descripción</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
                  <?php

                  if (isset($_POST["ano"])) {
                    include "cls_ejercicio.php";
                    $ano = $_POST["ano"];
                    $desc = $_POST["desc"];

                    $classFest = new ejercicio ($ano,$desc, 0);
                    $classFest->insertar();
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
