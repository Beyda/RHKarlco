<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION["session"])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $usuario=$_SESSION["session"];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 //$avatar_session=$_SESSION["avatar_session"];
 
$id = $_GET["id"];
$v = $id;
if ($v == "0") {
  $id = $usuario;
  $valor = "Disabled";
}
include("../../template/todo2.php");
//inicio de librerias 

?>

<form method="post">
<div class="content-wrapper">
        <section class="content">
          <div class="row">
          <div class="col-md-3">
          </div>
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Modificar un usuario</h3>
                </div>
                <div class="box-body">

                  <!-- Empleado -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Empleado:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <?php 
                          $sel_emp = "SELECT d.`primer_nombre`, d.`ap_paterno`, u.`pass`, t.`nombre`, u.`jefe`, t.`id_tipous` FROM `datos_personales` d INNER JOIN `usuarios` u ON d.`id_datosper` = u.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` WHERE u.`usuario` = '$id'";       
                          $res_emp = $mysqli->query($sel_emp);
                          $row_emp = $res_emp->fetch_array();
                        ?>
                        <select class="form-control" name="empleado" disabled>
                        <option><?php echo $row_emp[0] ." ". $row_emp[1]; ?></option>
                      </select>  
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Usuario -->
                  <div class="form-group">
                    <label>Usuario:</label>
                    <div class="row">
                    <div class="col-lg-12">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="user" value="<?php echo $id;?>" maxlength="20" disabled>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->                   
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->

                  <!-- Contraseña -->
                  <div class="form-group">
                    <label>Contraseña:</label>
                    <div class="row">
                    <div class="col-lg-12">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="password" class="form-control" name="pass" maxlength="20" value="<?php echo $row_emp[2] ?>" required>
                      </div><!-- /input-group -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  </div>
                  


                  <!-- Tipo de usuario -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Tipo de usuario:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="t_usuario" required <?php echo $valor ?>>
                        <option value = "<?php echo $row_emp[5] ?>" selected><?php echo $row_emp[3] ?></option>
                        <?php
                        $tipo = $row_emp[3];
                          $sel_tipo = "SELECT * FROM `tipo_usuario`";       
                          $res_tipo = $mysqli->query($sel_tipo);
                          while ($row_tipo = $res_tipo->fetch_array()) {
                            ?>
                              <option value="<?php echo $row_tipo[0] ?>"><?php echo $row_tipo[1] ?></option>
                            <?php
                          }
                        ?>
                      </select>  
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" value="bot" name="env">Modificar Usuario</button>
                </div>
              </div><!-- /.box -->

            </div>

   
</div>

</form>

<?php
      if(isset($_POST['env'])){
      include "cls_usuario.php";

        //DATOS PERSONALES

        $pass = $_POST["pass"];
        if ($pass == $row_emp[2]) {
          $contra = $pass;
        }else
        {
          $contra = md5($pass);
        }


        if ($v == "0") {
          $t_usuario = $row_emp[5];
        }else
        {
          $t_usuario = $_POST["t_usuario"];
        }
        
        $datos = new usuarioM("$contra", $t_usuario, $id, $v);
        $datos->mod();
        
      } 
      ?>
</section>
</div>
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