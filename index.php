<?php
include_once("control/connect.php");
 session_start();


if (isset($_SESSION["session"])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];

 
 

include("template/todo2.php");
//inicio de librerias 

?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <?php
          if ($tipo_usuario_session == "Administrador"){
        ?>

        <section class="content-header">
          <h1>
            Principal
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                <?php 
                  // SELECT EMPLEADO
                  $sel_emp = "SELECT `id_datosper` FROM `datos_personales` WHERE `solicitante` = 0";
                  $res_emp = $mysqli->query($sel_emp);
                  $numrowsEmp = $res_emp->num_rows;
                ?>
                  <h3><?php echo $numrowsEmp; ?></h3>
                  <p>Nuevo Empleado</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="modulos/empleados/r_empleados.php" class="small-box-footer">Agregar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                <?php 
                  // SELECT USUARIO
                  $sel_user = "SELECT `id_usuario` FROM `usuarios`";
                  $res_user = $mysqli->query($sel_user);
                  $numrowsUser = $res_user->num_rows;
                ?>
                  <h3><?php echo $numrowsUser ?></h3>
                  <p>Nuevo Usuario</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-person-add"></i>
                </div>
                <a href="modulos/usuarios/r_usuarios.php" class="small-box-footer">Agregar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>44</h3>
                  <p>Vacaciones pendientes</p>
                </div>
                <div class="icon">
                  <i class="fa fa-plane"></i>
                </div>
                <a href="#" class="small-box-footer">Revisar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Permisos pendientes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
                <a href="#" class="small-box-footer">Revisar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->

        </section><!-- /.content -->

        <?php
          }
        ?>

        <?php
          if ($tipo_usuario_session == "Recursos Humanos"){
        ?>

        <section class="content-header">
          <h1>
            Principal
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                <?php 
                  // SELECT EMPLEADO
                  $sel_emp = "SELECT `id_datosper` FROM `datos_personales` WHERE `solicitante` = 0";
                  $res_emp = $mysqli->query($sel_emp);
                  $numrowsEmp = $res_emp->num_rows;
                ?>
                  <h3><?php echo $numrowsEmp; ?></h3>
                  <p>Nuevo Empleado</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="modulos/empleados/r_empleados.php" class="small-box-footer">Agregar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                <?php 
                  // SELECT USUARIO
                  $sel_user = "SELECT `id_usuario` FROM `usuarios`";
                  $res_user = $mysqli->query($sel_user);
                  $numrowsUser = $res_user->num_rows;
                ?>
                  <h3><?php echo $numrowsUser ?></h3>
                  <p>Nuevo Usuario</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-person-add"></i>
                </div>
                <a href="modulos/usuarios/r_usuarios.php" class="small-box-footer">Agregar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>44</h3>
                  <p>Vacaciones pendientes</p>
                </div>
                <div class="icon">
                  <i class="fa fa-plane"></i>
                </div>
                <a href="#" class="small-box-footer">Revisar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Permisos pendientes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
                <a href="#" class="small-box-footer">Revisar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->

        </section><!-- /.content -->

        <?php
          }
        ?>


        <?php
          if ($tipo_usuario_session == "Jefe"){
        ?>

        <section class="content-header">
          <h1>
            Principal
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                <?php 
                  // SELECT EMPLEADO
                  $sel_emp = "SELECT d.`id_datosper` FROM `datos_personales` d INNER JOIN `usuarios` u ON d.`id_datosper` = u.`id_datosper` WHERE u.`jefe` = $id_usuario";
                  $res_emp = $mysqli->query($sel_emp);
                  $numrowsEmp = $res_emp->num_rows;
                ?>
                  <h3><?php echo $numrowsEmp; ?></h3>
                  <p>Mis Empleados</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="modulos/empleados/l_empleados.php" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                <?php 
                  // SELECT USUARIO
                  $sel_user = "SELECT `id_usuario` FROM `usuarios` WHERE `jefe` = $id_usuario";
                  $res_user = $mysqli->query($sel_user);
                  $numrowsUser = $res_user->num_rows;
                ?>
                  <h3><?php echo $numrowsUser ?></h3>
                  <p>Mis Usuarios</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-person"></i>
                </div>
                <a href="modulos/usuarios/l_usuarios.php" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>44</h3>
                  <p>Vacaciones pendientes</p>
                </div>
                <div class="icon">
                  <i class="fa fa-plane"></i>
                </div>
                <a href="#" class="small-box-footer">Revisar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Permisos pendientes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
                <a href="#" class="small-box-footer">Revisar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->

        </section><!-- /.content -->

        <?php
          }
        ?>

        <?php
          if ($tipo_usuario_session == "Empleado"){
        ?>

        <section class="content-header">
          <h1>
            Principal
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>Perfil</h3>
                  <p>Mis datos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="modulos/empleados/l_empleados.php" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Vacaciones</h3>
                  <p>Solicitar</p>
                </div>
                <div class="icon">
                  <i class="fa fa-plane"></i>
                </div>
                <a href="#" class="small-box-footer">Solicitar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>Permiso</h3>
                  <p>Solicitar</p>
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
                <a href="#" class="small-box-footer">Solicitar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->

        </section><!-- /.content -->

        <?php
          }
          
        $obt_emp = "SELECT DISTINCT p.`id_empresa` FROM `puesto_per` pp INNER JOIN `puestos` p ON pp.`id_datosper` = $_SESSION[id_datosper] AND pp.`id_puesto` = p.`id_puesto`";       
          $res_emp = $mysqli->query($obt_emp);
          $row_demp = $res_emp->fetch_array();
          $row_emp = $res_emp->num_rows;
          if ($row_emp > 0) {
        ?>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-xs-6">

              <div class="col-xs-12" id="result">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Correos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Asunto</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    echo $obt_correo = "SELECT * FROM `correos` WHERE `id_empresa` = $row_demp[0] ORDER BY `id_correo` DESC LIMIT 5";       
                    $res_correo = $mysqli->query($obt_correo);
                    while ($row_correo = $res_correo->fetch_array()) {
                      ?>
                      <tr>
                        <td><a href="modulos/correo/v_correo.php?id=<?php echo $row_correo[0]?>"><strong><?php echo $row_correo[2] ?></strong></a> - <?php echo substr($row_correo[3], 0, 60);?>...</td>
                        <td><?php 
                          $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                          $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                          $ano = date("Y", strtotime($row_correo[5]));
                          $dia = date('d', strtotime($row_correo[5]));
                          $mes = date('n', strtotime($row_correo[5]));
                          echo
                           $dia." de ".$meses[$mes-1]. " de ".$ano ;
                        ?></td>
                      </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th><a href="modulos/correo/l_correo.php"><button class="btn btn-block btn-info btn-sm">Ver todos</button></a></th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <!-- Main row -->
          </div>
          <?php
}
          ?>

      </div><!-- /.content-wrapper -->
      <?php

require('template/footer.php');
    ?>
    </div><!-- ./wrapper -->

    <!-- ./Footer -->
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

      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            
          </div>
        </div>
      </div>
  </body>
  
</html>

<?php
} else{
header("location: /rhkarlco/login.php");
}
?>