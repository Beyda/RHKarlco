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
        ?>
      </div><!-- /.content-wrapper -->
      <?php

require('/template/footer.php');
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