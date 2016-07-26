<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION["session"])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION["session"];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 $id = $_GET["id"];
 if ($id != 0) 
 {
 
  /* ***************SELECCIONAR DATOS DE LA PERSONA *************************** */
  $edt_emp = "SELECT * FROM `datos_personales` WHERE `id_datosper` = $id";
  $res_edt = $mysqli->query($edt_emp);
  $row_resedt = $res_edt->fetch_array();

  /* ************SELECCIONAR MUNICIPIO, ESTADO, PAIS, NACIONALIDAD ********************* */
  $sel_mepn = "SELECT `municipio`.`id_municipio`, `municipio`.`nombre`, `estado`.`id_estado`, `estado`.`nombre`, `pais`.`id_pais`, `pais`.`nombre`, `pais`.`nacionalidad` FROM `municipio`, `estado`, `pais`, `datos_personales` WHERE `datos_personales`.`id_municipio` = `municipio`.`id_municipio` and `datos_personales`.`id_datosper` = $id and `estado`.`id_estado` =  `municipio`.`id_estado` and  `estado`.`id_pais` = `pais`.`id_pais`";
  $res_mepn = $mysqli->query($sel_mepn);
  $row_mepn = $res_mepn->fetch_array();

  } else
    {
      /* ***************SELECCIONAR DATOS DE LA PERSONA *************************** */
      $edt_emp = "SELECT * FROM `datos_personales` WHERE `id_datosper` = $_SESSION[id_datosper]";
      $res_edt = $mysqli->query($edt_emp);
      $row_resedt = $res_edt->fetch_array();

      /* ************SELECCIONAR MUNICIPIO, ESTADO, PAIS, NACIONALIDAD ********************* */
     $sel_mepn = "SELECT `municipio`.`id_municipio`, `municipio`.`nombre`, `estado`.`id_estado`, `estado`.`nombre`, `pais`.`id_pais`, `pais`.`nombre`, `pais`.`nacionalidad` FROM `municipio`, `estado`, `pais`, `datos_personales` WHERE `datos_personales`.`id_municipio` = `municipio`.`id_municipio` and `datos_personales`.`id_datosper` = $_SESSION[id_datosper] and `estado`.`id_estado` =  `municipio`.`id_estado` and  `estado`.`id_pais` = `pais`.`id_pais`";
      $res_mepn = $mysqli->query($sel_mepn);
      $row_mepn = $res_mepn->fetch_array();
    }   
 //$avatar_session=$_SESSION["avatar_session"];
 
//$id_tmp = uniqid('', true);
include("../../template/todo2.php");
//inicio de librerias 

?>

<form method="post" enctype="multipart/form-data">
<div class="content-wrapper">
        <section class="content">
          <div class="row">
          <div class="col-md-1">
          </div>
            <div class="col-md-10">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Datos Personales</h3>
                </div>
                <div class="box-body">

                  <!-- Nombres -->
                  <div class="form-group">
                    <label>Nombres:</label>
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_pnom" value="<?php echo $row_resedt[1]; ?>" maxlength="20" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_snom" value="<?php echo $row_resedt[2]; ?>" maxlength="20" >
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Apellidos -->
                  <div class="form-group">
                    <label>Apellidos:</label>
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_pape" value="<?php echo $row_resedt[3]; ?>" maxlength="20" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_sape" value="<?php echo $row_resedt[4]; ?>" maxlength="20" >
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  

                   <!-- Lugar y fecha nacimiento -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Lugar de nacimiento:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_lugar" value="<?php echo $row_resedt[5]; ?>" maxlength="20" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Fecha de nacimiento:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input type="date" name="datper_date" class="form-control" value = "<?php echo $row_resedt[6]; ?>"required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- RFC y CURP -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    <label>RFC:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_rfc" value="<?php echo $row_resedt[8]; ?>" maxlength="13" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>CURP:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_curp" value="<?php echo $row_resedt[9]; ?>" maxlength="18" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- # AFILIACIONES IMSS -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-12">
                    <label>N° de afiliaciones IMSS:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_imss" value="<?php echo $row_resedt[10]; ?>" maxlength="20" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- # Unidad médica y años de experiencia -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Unidad médica familiar:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_unifam" value="<?php echo $row_resedt[12]; ?>" maxlength="100" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Años de experiencia:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_anoexp" maxlength="2" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="<?php echo $row_resedt[11]; ?>" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Domicilio actual -->
                  <div class="form-group">                   
                    <label>Domicilio actual:</label>                   
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_calle" value="<?php echo $row_resedt[13]; ?>" maxlength="20" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_extint" maxlength="2" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="<?php echo $row_resedt[14]; ?>" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_col" value="<?php echo $row_resedt[15]; ?>" maxlength="20" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_cp" maxlength="5" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="<?php echo $row_resedt[16]; ?>" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                  

                  <!-- *****************************************/.ajax pais******************************** -->
                  <script type="text/javascript">
                  //Mostrar los estados obteniendo el id del pais
                  $(document).ready(function(){
                      $("#datper_pais").change(function(){
                          var datper_pais=$(this).val();
                          var dataString = 'datper_pais='+ datper_pais;
                          $.ajax({
                              type: "POST",
                              url: "ajax_estado.php",
                              data: dataString,
                              cache: false,
                          success: function(html){

                              $("#datper_estado").html(html);
                              $.ajax({
                                  type: "POST",
                                  url: "ajax_nacio.php",
                                  data: dataString,
                                  cache: false,
                              success: function(html){
                              $("#datper_nacio").html(html);
                              }
                              });


                          }
                          
                          });
                      });


                      //Mostrar las ciudades con el id del estadocipio
                      $("#datper_estado").change(function(){
                          var datper_estado=$(this).val();
                          var dataString2 = 'datper_estado='+ datper_estado;
                          $.ajax({
                              type: "POST",
                              url: "ajax_municipios.php",
                              data: dataString2,
                              cache: false,
                          success: function(html){
                          $("#datper_municipio").html(html);
                          }
                          });
                      });


                      

                    });
                  </script>



                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                      <select class="form-control" id="datper_pais" name="datper_pais" required>
                        <option value="<?php echo $row_mepn[4]; ?>"><?php echo $row_mepn[5]; ?></option>
                        <?php
                          $obtdatper = "SELECT * FROM  `pais` ORDER BY nombre ASC";
                          $resul_datper = $mysqli->query($obtdatper);
                            while($row_datper = $resul_datper->fetch_array())
                              {
                                ?>
                                <option value="<?php echo $row_datper[0];?>"><?php echo utf8_encode($row_datper[2]);?></option>
                                <?php
                              }
                        ?>
                      </select>                
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <select class="form-control" id="datper_estado" name="datper_estado" required>
                        <option value="<?php echo $row_mepn[2];?>"><?php echo $row_mepn[3];?></option>
                      </select>                      
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->



                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                      <select class="form-control" id="datper_municipio" name="datper_municipio" required>
                        <option value="<?php echo $row_mepn[0];?>"><?php echo $row_mepn[1];?></option>
                      </select>                      
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <select class="form-control" name="datper_nacio">
                        <option><?php echo $row_resedt[28];?></option>
                        <option value="Mexicano">Mexicano</option>
                        <option value="Extranjero">Extranjero</option>
                      </select>                
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- # Teléfonos -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Teléfono particular:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </span>
                        <input type="tel" class="form-control" name="datper_telpart" value="<?php echo $row_resedt[17]; ?>" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Teléfono celular:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-mobile-phone"></i>
                        </span>
                        <input type="tel" class="form-control" name="datper_telcel" value="<?php echo $row_resedt[18]; ?>" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- # Correo -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Correo electrónico:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" name="datper_correo" value="<?php echo $row_resedt[19]; ?>" maxlength="100" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Estado civil:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="datper_ecivil" required>
                        <option><?php echo $row_resedt[24]; ?></option>
                        <option>Soltero</option>
                        <option>Casado</option>
                        <option>Divorsiado</option>
                        <option>Viudo</option>
                      </select>  
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Banco y N° cuenta bancaria -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Banco:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_banco" value="<?php echo $row_resedt[20]; ?>" maxlength="46" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>N° de cuenta bancaria:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_ncuenta" maxlength="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="<?php echo $row_resedt[21]; ?>" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- N° clabe interbancaria -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    <label>N° de clabe interbancaria para transferencias:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_nclabe" maxlength="18" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="<?php echo $row_resedt[22]; ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Sexo:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="datper_sexo" required>
                        <option><?php echo $row_resedt[7]; ?></option>
                        <option>Femenino</option>
                        <option>Masculino</option>
                      </select>  
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                  <!-- N° c´redito infonavit -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-12">
                    <label>N° de crédito:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_ncredito" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="<?php echo $row_resedt[23]; ?>">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->                    
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>

            <center><button class="btn btn-block btn-info btn-lg" name="registro" style="width: 700px">Modificar</button></center>
   
</div>

</form>

<?php
      if(isset($_POST['datper_pnom'])){
      include "cls_empleado.php";

        //DATOS PERSONALES

        $datper_pnom = $_POST["datper_pnom"];
        $datper_snom = $_POST["datper_snom"];
        $datper_pape = $_POST["datper_pape"];
        $datper_sape = $_POST["datper_sape"];
        $datper_lugar = $_POST["datper_lugar"];
        $datper_date = $_POST["datper_date"];
        $datper_rfc = $_POST["datper_rfc"];
        $datper_curp = $_POST["datper_curp"];
        $datper_imss = $_POST["datper_imss"];
        $datper_unifam = $_POST["datper_unifam"];
        $datper_anoexp = $_POST["datper_anoexp"];
        $datper_calle = $_POST["datper_calle"];
        $datper_extint = $_POST["datper_extint"];
        $datper_col = $_POST["datper_col"];
        $datper_cp = $_POST["datper_cp"];
        $datper_municipio = $_POST["datper_municipio"];
        $datper_telpart = $_POST["datper_telpart"];
        $datper_telcel = $_POST["datper_telcel"];
        $datper_correo = $_POST["datper_correo"];
        $datper_ecivil = $_POST["datper_ecivil"];
        $datper_banco = $_POST["datper_banco"];
        $datper_ncuenta = $_POST["datper_ncuenta"];
        $datper_nclabe = $_POST["datper_nclabe"];
        $datper_sexo = $_POST["datper_sexo"];
        $datper_ncredito = $_POST["datper_ncredito"];
        $datper_nacio = $_POST["datper_nacio"];



       $datos = new datos("$datper_pnom", "$datper_snom", "$datper_pape", "$datper_sape", "$datper_lugar", "$datper_date", "$datper_rfc", "$datper_curp", "$datper_imss", "$datper_unifam", $datper_anoexp, "$datper_calle", $datper_extint, "$datper_col", $datper_cp, $datper_municipio, $datper_telpart, $datper_telcel, "$datper_correo", "$datper_ecivil", "$datper_banco", $datper_ncuenta, $datper_nclabe, "$datper_sexo", $datper_ncredito, $id, "$datper_nacio");
      $datos->modificar();
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