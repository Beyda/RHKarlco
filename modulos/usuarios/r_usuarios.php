<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION['login_session'])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION['login_session'];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 //$avatar_session=$_SESSION["avatar_session"];
 
$id = uniqid('', true);
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
                  <h3 class="box-title">Crear un usuario</h3>
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
                        <select class="form-control" name="empleado" required>
                        <option value = "">Seleccionar un empleado</option>
                        <?php 
                          $sel_emp = "SELECT DISTINCT `datos_personales`.`id_datosper`, `datos_personales`.`primer_nombre`, `datos_personales`.`ap_paterno` FROM `datos_personales` WHERE `datos_personales`.`id_datosper` NOT IN (SELECT DISTINCT `usuarios`. `id_datosper` FROM `usuarios`, `datos_personales` WHERE `datos_personales`.`id_datosper` != `usuarios`.`id_datosper`) and `datos_personales`.`solicitante` != 1";       
                          $res_emp = $mysqli->query($sel_emp);
                          while ($row_emp = $res_emp->fetch_array()) {
                            ?>
                              <option value="<?php echo $row_emp[0] ?>"><?php echo $row_emp[1] ?> <?php echo $row_emp[2] ?></option>
                            <?php
                          }
                        ?>
                      </select>  
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

<!-- ********************************** CREACIÓN DE LA MATRICULA ************************************* -->
  <?php
        $query = "SELECT `nomenclatura`, `num_contador` FROM `usuarios` order by `id_usuario` desc limit 1";
        $result = $mysqli->query($query) or die ($mysqli->error);
        $row = mysqli_fetch_assoc($result);
        $nomeclatura=$row['nomenclatura']; 
        $num_contador=$row['num_contador']; 

        if(isset($nomeclatura))
          {
           if ($num_contador==99) 
            {
              $nomeclatura++; 
              $num_contador=1;
              $num_contador2=str_pad($num_contador, 2, "0", STR_PAD_LEFT);
              $matricula=$nomeclatura.$num_contador2;
            }else
              {
                if ($num_contador>=09) 
                {    
                  $num_contador++; 
                  $num_contador2=str_pad($num_contador, 2, "0", STR_PAD_LEFT);
                  $matricula=$nomeclatura.$num_contador2;
                }else
                  {
                    $num_contador++; 
                    //$num_contador2=str_pad($num_contador, 1, "0", STR_PAD_LEFT);
                    //$matricula=$nomeclatura.$num_contador2;
                  }  
              } 
          }else
            {  
              $nomeclatura='AA';
              $num_contador=1;
              $num_contador2=str_pad($num_contador, 2, "0", STR_PAD_LEFT);
             // $nomeclatura++;
              $matricula=$nomeclatura.$num_contador2;
            }
    ?>
                  <!-- Usuario -->
                  <div class="form-group">
                    <label>Usuario:</label>
                    <div class="row">
                    <div class="col-lg-12">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="user" value="<?php echo $matricula ?>" maxlength="20" required>
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
                        <input type="password" class="form-control" name="pass" value="<?php echo $matricula ?>" maxlength="20" required>
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
                        <select class="form-control" name="t_usuario" onChange="mostrar(this)" required>
                        <option value = "" selected>Seleccionar tipo de usuario</option>
                        <?php 
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
$("#jefe").hide();
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


                  <!-- Jefe -->
                  <div class="form-group" id="jefe">                    
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Jefe:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="jefe" onChange="t_usuario(this)">
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



                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </div>
              </div><!-- /.box -->

            </div>

   
</div>

</form>

<?php
      if(isset($_POST['user'])){
      include "cls_usuario.php";

        //DATOS PERSONALES

        $empleado = $_POST["empleado"];
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $contra = md5($pass);
        $t_usuario = $_POST["t_usuario"];
        if ($_POST["jefe"] != "") 
        {
          echo $jefe = $_POST["jefe"];
          $datos = new usuario($empleado, "$user", "$contra", $t_usuario, $jefe, "$nomeclatura", $num_contador);
          $datos->registrarJ();
        }else
        {

          $datos = new usuario($empleado, "$user", "$contra", $t_usuario, 0, "$nomeclatura", $num_contador);
          $datos->registrar();
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