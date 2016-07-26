<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION["session"])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION["session"];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 //$avatar_session=$_SESSION["avatar_session"];
 
$id = uniqid('', true);
include("../../template/todo2.php");
//inicio de librerias 

?>

<form method="post" enctype="multipart/form-data">
<div class="content-wrapper">
        <?php
          if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Recursos Humanos" || $tipo_usuario_session == "Jefe"){
        ?>
        <section class="content">
          <div class="row">
          <div class="col-md-1">
          </div>
            <div class="col-md-10">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Crear un empleado</h3>
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
                        <input type="text" class="form-control" name="datper_pnom" placeholder="Primer nombre" maxlength="20" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_snom" placeholder="Segundo nombre" maxlength="20" >
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
                        <input type="text" class="form-control" name="datper_pape" placeholder="Primer Apellido" maxlength="20" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_sape" placeholder="Segundo Apellido" maxlength="20" >
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  
                  <?php
                  $fecha = date('Y-m-j');
                  $nuevafecha = strtotime ( '-18 year' , strtotime ( $fecha ) ) ;
                  $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                  ?>
                   <!-- Lugar y fecha nacimiento -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Lugar de nacimiento:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_lugar" placeholder="Lugar" maxlength="20" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Fecha de nacimiento:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input type="date" name="datper_date" class="form-control" max="<?php echo $nuevafecha ?>" required>
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
                        <input type="text" class="form-control" name="datper_rfc" placeholder="RFC" maxlength="13" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>CURP:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_curp" placeholder="CURP" maxlength="18" required>
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
                        <input type="text" class="form-control" name="datper_imss" placeholder="N° de afiliación IMSS" maxlength="20" required>
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
                        <input type="text" class="form-control" name="datper_unifam" placeholder="Unidad médica familiar" maxlength="100" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Años de experiencia:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_anoexp" maxlength="2" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Años de experiencia" required>
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
                        <input type="text" class="form-control" name="datper_calle" placeholder="Calle" maxlength="20" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_extint" maxlength="2" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="N° Ext / Int" required>
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
                        <input type="text" class="form-control" name="datper_col" placeholder="Colonia" maxlength="20" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_cp" maxlength="5" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="C.P." required>
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
                        <option value="">Selecciona un pais</option>
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
                        <option value="">Selecciona un estado</option>
                      </select>                      
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->



                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                      <select class="form-control" id="datper_municipio" name="datper_municipio" required>
                        <option>Selecciona una municipio</option>
                      </select>                      
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <select class="form-control" name="datper_nacio">
                        <option value="">Selecciona Nacionalidad</option>
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
                        <input type="tel" class="form-control" name="datper_telpart" placeholder="Teléfono particular" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Teléfono celular:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-mobile-phone"></i>
                        </span>
                        <input type="tel" class="form-control" name="datper_telcel" placeholder="Teléfono celular" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
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
                        <input type="email" class="form-control" name="datper_correo" placeholder="ejemplo@ejemplo.com.mx" maxlength="100" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Estado civil:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="datper_ecivil" required>
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
                        <input type="text" class="form-control" name="datper_banco" placeholder="Banco" maxlength="46" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>N° de cuenta bancaria:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_ncuenta" maxlength="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="N° de cuenta bancaria" required>
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
                        <input type="text" class="form-control" name="datper_nclabe" maxlength="18" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="N° de clabe interbancaria para transferencias" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Sexo:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="datper_sexo" required>
                        <option>Sexo</option>
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
                    <input type="checkbox" onclick="if(this.checked){ECredito()}else{DCredito()}"name="check" value="Null"><label>¿Tiene crédito infonavit?</label>
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-12">
                    <label>N° de crédito:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_ncredito" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="N° de crédito" id="ncredito">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->                    
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  <!-- *****************************************/.ajax pais******************************** -->
                  <script type="text/javascript">
                  //Mostrar los estados obteniendo el id del pais
                  $(document).ready(function(){

                      //Mostrar las ciudades con el id del estadocipio
                      $("#empresa").change(function(){
                          var empresa=$(this).val();
                          var dataString2 = 'empresa='+ empresa;
                          $.ajax({
                              type: "POST",
                              url: "../puestos/ajax_puesto.php",
                              data: dataString2,
                              cache: false,
                          success: function(html){
                          $("#puesto").html(html);
                          }
                          });
                      });


                      

                    });
                  </script>

                  <!-- Empresa y fecha inicial -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Empresa:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="empresa" id="empresa" required>
                          <option>Selecciona una empresa</option>
                          <?php
                          $empresa = "SELECT * FROM `empresas` WHERE `status` = 1";
                          $res_empresa = $mysqli->query($empresa);
                          while ( $row_empresa = $res_empresa->fetch_array()) {
                            ?>
                              <option value="<?php echo $row_empresa[0] ?>"><?php echo $row_empresa[1] ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Fecha de inicio:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="date" name="f_inicio" value="<?php echo date("Y-m-d"); ?>" class="form-control" required></input>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                  <!-- Salario y puesto -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Salario:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="salario" maxlength="18" placeholder="Salario" onKeypress="if (event.keyCode < 8 || event.keyCode > 57) event.returnValue = false;" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Puesto:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="puesto" id="puesto" required>
                          <option>Selecciona un puesto</option>
                        </select>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Crear Empleado</button>
                </div>
              </div><!-- /.box -->
            </div>
   
</div>
                  <script type="text/javascript">
                    
                    function ECredito() {
                        document.getElementById("ncredito").disabled = false;
                    }
                    function DCredito() {
                        document.getElementById("ncredito").disabled = true;
                    }
                    document.getElementById("ncredito").disabled = true;

                  </script>
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
        $empresa = $_POST["empresa"];
        $f_inicio = $_POST["f_inicio"];
        $salario = $_POST["salario"];
        $puesto = $_POST["puesto"];
        if (empty($datper_ncredito)) {
          $datper_ncredito = "NULL";
        }
        $datper_nacio = $_POST["datper_nacio"];



       $datos = new datos("$datper_pnom", "$datper_snom", "$datper_pape", "$datper_sape", "$datper_lugar", "$datper_date", "$datper_rfc", "$datper_curp", "$datper_imss", "$datper_unifam", $datper_anoexp, "$datper_calle", $datper_extint, "$datper_col", $datper_cp, $datper_municipio, $datper_telpart, $datper_telcel, "$datper_correo", "$datper_ecivil", "$datper_banco", $datper_ncuenta, $datper_nclabe, "$datper_sexo", $datper_ncredito, $id, "$datper_nacio",$empresa, "$f_inicio", $salario, $puesto);
      $datos->registrar();
      } 
      ?>
</section>
<?php
}
?>
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