<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION['login_session'])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $usuario=$_SESSION['login_session'];
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
                          $sel_emp = "SELECT d.`primer_nombre`, d.`ap_paterno`, u.`pass`, t.`nombre`, u.`jefe` FROM `datos_personales` d INNER JOIN `usuarios` u ON d.`id_datosper` = u.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` WHERE u.`usuario` = '$id'";       
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
                        <select class="form-control" name="t_usuario" onChange="mostrar(this)" required <?php echo $valor ?>>
                        <option value = "<?php echo $row_emp[3] ?>" selected><?php echo $row_emp[3] ?></option>
                        <?php
                        $tipo = $row_emp[3];
                          $sel_tipo = "SELECT * FROM `tipo_usuario`";       
                          $res_tipo = $mysqli->query($sel_tipo);
                          while ($row_tipo = $res_tipo->fetch_array()) {
                            ?>
                              <option value="<?php echo $row_tipo[1] ?>"><?php echo $row_tipo[1] ?></option>
                            <?php
                          }
                        ?>
                      </select>  
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


<script type="text/javascript">
$(document).ready(function(){
  $tipo = "<?php echo $row_emp[3] ?>";
  if ($tipo == "Administrador") {
    $("#jefe").hide();
  }
  
});
function mostrar(id) {
   $val = id.value;
    if ($val == "Administrador") {
        $("#jefe").hide();
    }else{
      $("#jefe").show();
    }

}
</script>
              <?php 
                if ($tipo != "Administrador") {
                  ?>

                  <!-- Jefe -->
                  <div class="form-group" id="jefe">                    
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Jefe:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="jefe" onChange="t_usuario(this)" <?php echo $valor ?>>
                        <?php
                          $sel_jefe1 = "SELECT u.`id_usuario`, d.`primer_nombre`, d.`segundo_nombre`, t.`nombre`  FROM `datos_personales` d INNER JOIN `usuarios` u ON d.`id_datosper` = u.`id_datosper`  INNER JOIN `tipo_usuario` t ON u.`id_tipous` = t.`id_tipous`  WHERE u.`id_usuario` = $row_emp[4]";       
                          $res_jefe1 = $mysqli->query($sel_jefe1);
                          $row_jefe1 = $res_jefe1->fetch_array();
                        ?>
                        <option value = "<?php echo $row_jefe1[0] ?>"><?php echo $row_jefe1[1] ." ". $row_jefe1[2] ." - ". $row_jefe1[3] ?></option>
                        <?php 
                          $sel_jefe = "SELECT u.`id_usuario`, d.`primer_nombre`, d.`segundo_nombre`, t.`nombre`  FROM `datos_personales` d INNER JOIN `usuarios` u ON d.`id_datosper` = u.`id_datosper`  INNER JOIN `tipo_usuario` t ON u.`id_tipous` = t.`id_tipous` WHERE t.`nombre` = 'Administrador' OR t.`nombre` = 'Jefe'";       
                          $res_jefe = $mysqli->query($sel_jefe);
                          while ($row_jefe = $res_jefe->fetch_array()) {
                            ?>
                              <option value="<?php echo $row_jefe[0] ?>"><?php echo $row_jefe[1]. " ". $row_jefe[2] . " - " . $row_jefe[3] ?></option>
                            <?php
                          }
                        ?>
                      </select>  
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
              <?php
                }else
                {
                  ?>


              <!-- Jefe -->
                  <div class="form-group" id="jefe">                    
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Jefe:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="jefe" onChange="t_usuario(this)" <?php echo $valor ?>>
                        <option value = "">Seleccionar un jefe de trabajo</option>
                        <?php 
                          $sel_jefe = "SELECT u.`id_usuario`, d.`primer_nombre`, d.`segundo_nombre`, t.`nombre`  FROM `datos_personales` d INNER JOIN `usuarios` u ON d.`id_datosper` = u.`id_datosper`  INNER JOIN `tipo_usuario` t ON u.`id_tipous` = t.`id_tipous` WHERE t.`nombre` = 'Administrador' OR t.`nombre` = 'Jefe'";       
                          $res_jefe = $mysqli->query($sel_jefe);
                          while ($row_jefe = $res_jefe->fetch_array()) {
                            ?>
                              <option value="<?php echo $row_jefe[0] ?>"><?php echo $row_jefe[1]. " ". $row_jefe[2] . " - " . $row_jefe[3] ?></option>
                            <?php
                          }
                        ?>
                      </select>  
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
              <?php
                }
              ?>

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


        
        $t_usuario = $_POST["t_usuario"];
        if ($_POST["t_usuario"] != "Administrador") 
        {
          $jefe = $_POST["jefe"];
          $datos = new usuarioM("$contra", $t_usuario, $jefe, $id, $v);
          $datos->modJ();
        }else
        {
          $datos = new usuarioM("$contra", $t_usuario, 0, $id, $v);
          $datos->mod();
        }
        
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