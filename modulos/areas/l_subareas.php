<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*/
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
$id = $_GET["id"];
?>
     

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
                <?php 
                  if ($tipo_usuario_session == "Administrador") {
                ?>
        <section class="content-header">
          <h1>
            Subareas de trabajo
            <small>Listado</small>
            <a href="modal/modal_sarea.php" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn bg-navy margin">Agregar una subarea</button></a>
          </h1>
          <?php
          if (isset($_POST["sarea"])) {//echo "1";
              include "cls_area.php";
              $sarea = $_POST["sarea"];
              $clasArea = new subareas($sarea, $id);
              $clasArea->insertar();
          }
          if (isset($_POST["msarea"])) {//echo "2";
              include "cls_area.php";
              $msarea = $_POST["msarea"];
              $id_sub = $_POST["btnsarea"];
              $clasArea = new Msareas($msarea, $id_sub, $id);
              $clasArea->actualiza();
          }
          ?>

        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Subareas</h3>
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
                    $ctr_sa = "SELECT * FROM `subarea` WHERE `id_area` = $id";
                    $res_sa = $mysqli->query($ctr_sa);
                    while ($row_ressa = $res_sa->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_ressa[1]?></td>
                        <td><center><a href="modal/modal_msarea.php?id=<?php echo $row_ressa[0]?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn bg-olive">Modificar</button></a></center></td>
                        <?php 
                        if($row_ressa[4] == 1)
                        {
                          $color = "btn bg-blue margin";
                          $estatus = "Activo";                
                        }
                        if($row_ressa[4] == 0)
                        {
                          $color = "btn bg-red margin";
                          $estatus = "Inactivo"; 
                        }
                        ?>
                        <td><center><a href="modal/modalsb.php?id=<?php echo $row_ressa[0]?>&id_ar=<?php echo $id ?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="<?php echo $color; ?>"><?php echo $estatus ?></button></a></center></td>
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


