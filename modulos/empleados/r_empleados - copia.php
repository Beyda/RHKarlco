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
 
$id_tmp = uniqid('', true);
include("../../template/todo2.php");
//inicio de librerias 

?>

<body class="skin-blue">
<form method="post" enctype="multipart/form-data">
<div class="content-wrapper">
        <section class="content">
          <div class="row">
            <div class="col-md-6">
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
                        <input type="date" name="datper_date" class="form-control" required>
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
                    <div class="col-lg-6">
                    <label>N° de afiliaciones IMSS:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_imss" placeholder="N° de afiliación IMSS" maxlength="20" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Profesión:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_profe" placeholder="Profesión" maxlength="46" required>
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
                      <select class="form-control" id="datper_nacio" name="datper_nacio">
                        <option value="">Selecciona Nacionalidad</option>
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
                    <label>N° de crédito:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datper_ncredito" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="N° de crédito">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->                    
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>

<!-- /.referencias personales -->
            <div class="col-md-6">              
              <!-- iCheck -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Referencias Personales</h3>
                </div>
                <div class="box-body">

                <div class="ref_per">
                <!-- Nombre y dirección -->
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_refper">Agregar otro</button> 
                </div>
                  </div>
                </div>


                <!-- Nombres -->
                  <div class="form-group">
                    <label>Nombres:</label>
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="refper_pnom[]" maxlength="20" placeholder="Primer nombre" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="refper_snom[]" maxlength="20" placeholder="Segundo nombre">
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
                        <input type="text" class="form-control" name="refper_pape[]" maxlength="20" placeholder="Primer Apellido" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="refper_sape[]" maxlength="20" placeholder="Segundo Apellido" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Dirección:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-home"></i>
                        </span>
                        <input type="text" class="form-control" name="refper_dir[]" maxlength="20" placeholder="Dirección" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Teléfono y parentesco -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Teléfono:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </span>
                        <input type="tel" class="form-control" name="refper_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Parentesco:</label>
                      <div class="input-group">
                        <select class="form-control" name="refper_parent[]">
                        <option>Hijo(a)</option>
                        <option>Nieto(a)</option>
                        <option>Padre</option>
                        <option>Hermano(a)</option>
                        <option>Sobrino(a)</option>
                        <option>Abuelo(a)</option>
                        <option>Tio(a)</option>
                        <option>Primo(a)</option>
                      </select>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->                    
                  </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->





<!-- /.beneficiario en caso de fallecimiento -->
            <div class="col-md-6">              
              <!-- iCheck -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Beneficiarios en caso de fallecimiento</h3>
                </div>
                <div class="box-body">

                <div class="ben_fa">
                <!-- Nombre y dirección -->
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_benfa">Agregar otro</button> 
                </div>
                  </div>
                </div>



                  <!-- Nombres -->
                  <div class="form-group">
                    <label>Nombres:</label>
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="benfa_pnom[]" maxlength="20" placeholder="Primer nombre" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="benfa_snom[]" maxlength="20" placeholder="Segundo nombre">
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
                        <input type="text" class="form-control" name="benfa_pape[]" maxlength="20" placeholder="Primer Apellido" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="benfa_sape[]" maxlength="20" placeholder="Segundo Apellido" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  

                  <!-- domicilio -->
                  <div class="form-group">                                      
                    <div class="row">            
                    <div class="col-lg-12">
                    <label>Domicilio:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-home"></i>
                        </span>
                        <input type="text" class="form-control" name="benfa_domici[]" maxlength="20" placeholder="Domicilio" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- teléfono, parentesco -->
                  <div class="form-group">                                      
                    <div class="row">            
                    <div class="col-lg-6">
                    <label>Teléfono:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </span>
                        <input type="number" class="form-control" name="benfa_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Parentesco:</label>
                      <div class="input-group">
                        <select class="form-control" name="benfa_parent[]">
                        <option>Hijo(a)</option>
                        <option>Nieto(a)</option>
                        <option>Padre</option>
                        <option>Hermano(a)</option>
                        <option>Sobrino(a)</option>
                        <option>Abuelo(a)</option>
                        <option>Tio(a)</option>
                        <option>Primo(a)</option>
                      </select>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->                    
                  </div>


                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->




<!-- /.datros familiares -->
            <div class="col-md-6">              
              <!-- iCheck -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Datos familiares o independientes</h3>
                </div>
                <div class="box-body">

                <div class="dat_fami">
                <!-- Nombre y dirección -->
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_datfami">Agregar otro</button> 
                </div>
                  </div>
                </div>



                  <!-- Nombres -->
                  <div class="form-group">
                    <label>Nombres:</label>
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datfami_pnom[]" maxlength="20" placeholder="Primer nombre" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datfami_snom[]" maxlength="20" placeholder="Segundo nombre">
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
                        <input type="text" class="form-control" name="datfami_pape[]" maxlength="20" placeholder="Primer Apellido" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datfami_sape[]" maxlength="20" placeholder="Segundo Apellido" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  

                  <!-- parentesco y conyugue -->
                  <div class="form-group">                                      
                    <div class="row">            
                    <div class="col-lg-6">
                    <label>Fecha de nacimiento:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="date" class="form-control" name="datfami_date[]" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Parentesco:</label>
                      <div class="input-group">
                        <select class="form-control" name="datfami_parent[]" required>
                        <option>Hijo</option>
                        <option>Conyugue</option>
                      </select>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->  


                  <div class="form-group">                  
                    <div class="row">                    
                    <div class="col-lg-6">
                    <label>Acta de nacimiento</label>
                      <div class="input-group">
                        <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Agregar archivo
                      <input id="file" type="file" name="archivo[]" accept="application/pdf, image/*" required/>
                    </div>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                  </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->


            <!-- EMPLEOS ANTERIORES -->
            <div class="col-md-6">             
              <!-- iCheck -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Empleos anteriores</h3>
                </div>
                <div class="box-body">                
                <div class="empleos_anteriores">
                <!-- Empresa y puesto -->
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_empleosant">Agregar otro</button> 
                </div>
                  </div>
                </div>

                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Empresa:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="empant_empr[]" maxlength="46" placeholder="Empresa">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Puesto:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="empant_puesto[]" maxlength="46" placeholder="Puesto">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Jefe inmediato, año y teléfono -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-5">
                    <label>Jefe inmediato:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="empant_jefe[]" maxlength="46" placeholder="Jefe inmediato">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-3">
                    <label>Año:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="empant_ano[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Año">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-4">
                    <label>Teléfono:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </span>
                        <input type="tel" class="form-control" name="empant_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->                    
                  </div>


                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->


            <!-- /.estudios -->

            <div class="col-md-6">              
              <!-- iCheck -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Estudios</h3>
                </div>
                <div class="box-body">
                <div class="estudios">
                <!-- Escuela/Instituto/Universiad, grado máximo-->
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_estudios">Agregar otro</button> 
                </div>
                  </div>
                </div>



                  <div class="form-group">                  
                    <div class="row">                    
                    <div class="col-lg-6">
                    <label>Escuela/Instituto/Universiad:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="est_escu[]" maxlength="20" placeholder="Escuela/Instituto/Universiad" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Grado máximo de estudios:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="est_gmax[]" maxlength="20" placeholder="Grado máximo de estudios" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Certificado/Titulo -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Certificado/Titulo/etc:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="est_certi[]" maxlength="20" placeholder="Certificado/Titulo/etc" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  </div>


                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->


            <div class="col-md-6">              
              <!-- iCheck -->
              <div id="respuesta" class="alert"></div>
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Documentos necesarios a entregar</h3>
                </div>
                <div class="box-body">
                <div class="doc_nec">
                <!-- acta, identificación-->
               
               
                <form action="javascript:void(0);">
                  <div class="form-group">                  
                    <div class="row">                    
                    <div class="col-lg-4">
                    <label>Archivo</label>
                      <div class="input-group">
                        <input id="archivo" type="file" class="file" name="archivo" data-show-preview="false" accept="application/pdf, image/*">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-4">
                    <label>Tipo</label>
                      <div class="input-group" id="recargado">
                      <?php
                      $obt_tdoc = "SELECT distinct * FROM `tipo_doc` WHERE `tipo_doc`.`id_tdoc` NOT IN (SELECT `id_tdoc` FROM `documentos` WHERE `id_tmp` = '$id_tmp' and `tipo_doc`.`id_tdoc` = `documentos`.`id_tdoc`)";       
                      $res_tdoc = $mysqli->query($obt_tdoc);
                      ?>
                        <select class="form-control" name="nombre_archivo" id="nombre_archivo" required>
                        <option value="">Selecciona un tipo</option>
                        <?php
                        
                        while ($row_tdoc = $res_tdoc->fetch_array()) { 
                          ?>
                            <option value="<?php echo $row_tdoc[0] ?>"><?php echo utf8_encode($row_tdoc[1]) ?></option>
                          <?php
                        }
                        ?>                        
                      </select>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->                    
                    <div class="col-lg-4">
                    <label></label>
                      <div class="input-group">
                      <center>
                        <input type="submit" id="boton_subir" value="Subir" class="btn btn-success" style="width:230%" />
                      </center>
                      </div><!-- /input-group -->                      
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-4">
                        <progress id="barra_de_progreso" value="0" max="100"></progress>
                    </div>
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                    <div id="archivos_subidos"></div>

                  </form>
                  </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            <center><button class="btn btn-block btn-info btn-lg" name="registro" style="width: 700px">Registrar</button></center>


    <script type="text/javascript">
            function subirArchivos() {
             

                $("#archivo").upload('../carga_archivos/subir_archivo.php?id_tmp=<?php echo $id_tmp ?>',
                {
                    nombre_archivo: $("#nombre_archivo").val()
                },
                function(respuesta) {
                    //Subida finalizada.
                    $("#barra_de_progreso").val(0);
                    if (respuesta === 1) {
                        mostrarRespuesta('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>  <i class="icon fa fa-check"></i>Subida Exitosa!</h4>El archivo se ha subido correctamente.', true);
                        $("#nombre_archivo, #archivo").val('');
                    } else {
                        mostrarRespuesta('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Error!</h4>El archivo no se pudo subir.', false);
                    }
                    mostrarArchivos();
                }, function(progreso, valor) {
                    //Barra de progreso.
                    $("#barra_de_progreso").val(valor);
                });
            }
            function eliminarArchivos(archivo) {
                $.ajax({
                    url: '../carga_archivos/eliminar_archivo.php',
                    type: 'POST',
                    timeout: 10000,
                    data: {archivo: archivo},
                    error: function() {
                        mostrarRespuesta('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Error!</h4>La eliminación fue fallida.', false);
                    },
                    success: function(respuesta) {
                        if (respuesta == 1) {
                            mostrarRespuesta('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>  <i class="icon fa fa-check"></i>Eliminación Exitosa!</h4>El archivo ha sido eliminado correctamente.', true);
                        } else {
                            mostrarRespuesta('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Error!</h4>La eliminación fue fallida.', false);                            
                        }
                        mostrarArchivos();
                    }
                });
            }
            function mostrarArchivos() {
                $.ajax({
                    url: '../carga_archivos/mostrar_archivos.php?id_tmp=<?php echo $id_tmp ?>',
                    dataType: 'JSON',
                    success: function(respuesta) {
                        if (respuesta) {
                            var html = '';
                            for (var i = 0; i < respuesta.length; i++) {
                                if (respuesta[i] != undefined) {
                                    html += '<hr /><div class="row"> <span class="col-lg-8"> ' + respuesta[i] + ' </span> <div class="col-lg-2"> <a class="eliminar_archivo btn btn-danger" href="javascript:void(0);"> Eliminar </a> </div> </div>';
                                }
                            }
                            $("#archivos_subidos").html(html);
                            recargar();
                        }
                    }
                });
            }
            function mostrarRespuesta(mensaje, ok){
                $("#respuesta").removeClass('alert-success alert-dismissable').removeClass('alert-danger alert-dismissable').html(mensaje);
                if(ok){
                    $("#respuesta").addClass('alert-success alert-dismissable');
                }else{
                    $("#respuesta").addClass('alert-danger alert-dismissable');
                }
            }

          $(document).ready(function() {
                mostrarArchivos();
                $("#boton_subir").on('click', function() {
                  subirArchivos();
                      
                });
                $("#archivos_subidos").on('click', '.eliminar_archivo', function() {
                    var archivo = $(this).parents('.row').eq(0).find('span').text();
                    archivo = $.trim(archivo);
                    eliminarArchivos(archivo);
                });
            });
        </script>   

<script language="javascript">
function recargar(){    
       /// Aqui podemos enviarle alguna variable a nuestro script PHP
    var variable_post="<?php echo $id_tmp ?>";
       /// Invocamos a nuestro script PHP
    $.post("ajax_select.php", { variable: variable_post }, function(data){
       /// Ponemos la respuesta de nuestro script en el DIV recargado
    $("#recargado").html(data);
    });         
}
</script>      
</div>



<script type="text/javascript">
  $(document).ready(function() {
    var max_fields      = 6; //maximum input boxes allowed
    var wrapper_ea      = $(".empleos_anteriores"); //Fields wrapper
    var button_ea       = $("#add_empleosant"); //Add button ID

    var wrapper_est      = $(".estudios"); //Fields wrapper
    var button_est       = $("#add_estudios"); //Add button ID

    var wrapper_refper      = $(".ref_per"); //Fields wrapper
    var button_refper       = $("#add_refper"); //Add button ID

    var wrapper_datfami      = $(".dat_fami"); //Fields wrapper
    var button_datfami       = $("#add_datfami"); //Add button ID

    var wrapper_benfa      = $(".ben_fa"); //Fields wrapper
    var button_benfa       = $("#add_benfa"); //Add button ID
    
    var x_ea = 1; //initlal text box count
    $(button_ea).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_ea < max_fields){ //max input box allowed  
            x_ea++; //text box increment
            $(wrapper_ea).append('<div>'+
  '<div class="empleos_anteriores">'+
    '<div class="box-footer"></div>'+
    '<!-- Empresa y puesto -->'+
      '<div class="form-group">'+
        '<div class="row"></div>'+
      '</div>'+
      '<div class="form-group">'+                                     
                    '<div class="row">'+
                    '<div class="col-lg-6">'+
                    '<label>Empresa:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="empant_empr[]" maxlength="46" placeholder="Empresa">'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                    '<label>Puesto:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="empant_puesto[]" maxlength="46" placeholder="Puesto">'+
                      '</div><!-- /input-group -->'+                   
                    '</div><!-- /col-lg-6 -->'+
                  '</div><!-- /row -->'+
                  '</div><!-- /form group -->'+
                  '<!-- Jefe inmediato, año y teléfono -->'+
                  '<div class="form-group">'+                                      
                    '<div class="row">'+
                    '<div class="col-lg-5">'+
                    '<label>Jefe inmediato:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="empant_jefe[]" maxlength="46" placeholder="Jefe inmediato">'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /col-lg-6 -->'+
                    '<div class="col-lg-3">'+
                    '<label>Año:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="empant_ano[]" maxlength="4" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Año">'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /col-lg-6 -->'+
                    '<div class="col-lg-4">'+
                    '<label>Teléfono:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-phone"></i>'+
                        '</span>'+
                        '<input type="tel" class="form-control" name="empant_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono">'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /col-lg-6 -->'+
                  '</div><!-- /row -->'+
                  '</div><!-- /form group -->'+
  '</div>'+
  '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button>'+
  '</div>'); //add input box
        
      }
    });
    
    $(wrapper_ea).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_ea--;
    })


    var x_est = 1; //initlal text box count
    $(button_est).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_est < max_fields){ //max input box allowed  
            x_est++; //text box increment
            $(wrapper_est).append('<div>'+
              '<div class="estudios">'+
                '<div class="box-footer"></div>'+
                '<!-- Escuela/Instituto/Universiad, grado máximo-->'+
                
                  '<div class="form-group">'+                  
                    '<div class="row">'+                    
                    '<div class="col-lg-6">'+
                    '<label>Escuela/Instituto/Universiad:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-graduation-cap"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="est_escu[]" maxlength="20" placeholder="Escuela/Instituto/Universiad" required>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                    '<label>Grado máximo de estudios:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-graduation-cap"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="est_gmax[]" maxlength="20" placeholder="Grado máximo de estudios" required>'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<!-- Certificado/Titulo -->'+
                  '<div class="form-group">'+                                      
                    '<div class="row">'+
                    '<div class="col-lg-12">'+
                    '<label>Certificado/Titulo/etc:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-graduation-cap"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="est_certi[]" maxlength="20" placeholder="Certificado/Titulo/etc" required>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+
                  '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button>'+
                  '<!-- /.form group -->'+
                  '</div>'); //add input box
        
      }
    });
    
    $(wrapper_est).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_est--;
    })


    var x_refper = 1; //initlal text box count
    $(button_refper).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_refper < max_fields){ //max input box allowed  
            x_refper++; //text box increment
            $(wrapper_refper).append('<div>'+
              '<div class="ref_per">'+
                '<div class="box-footer"></div><!-- Nombres -->'+
                  '<div class="form-group">'+
                    '<label>Nombres:</label>'+
                    '<div class="row">'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="refper_pnom[]" maxlength="20" placeholder="Primer nombre" required>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="refper_snom[]" maxlength="20" placeholder="Segundo nombre">'+
                      '</div><!-- /input-group -->'+                   
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<!-- Apellidos -->'+
                  '<div class="form-group">'+
                    '<label>Apellidos:</label>'+
                    '<div class="row">'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="refper_pape[]" maxlength="20" placeholder="Primer Apellido" required>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="refper_sape[]" maxlength="20" placeholder="Segundo Apellido" required>'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+


                  '<div class="form-group">'+                                     
                    '<div class="row">'+
                    '<div class="col-lg-12">'+
                    '<label>Dirección:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-home"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="refper_dir[]" maxlength="46" placeholder="Dirección" required>'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<!-- Teléfono y parentesco -->'+
                  '<div class="form-group">'+                                     
                    '<div class="row">'+
                    '<div class="col-lg-6">'+
                    '<label>Teléfono:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-phone"></i>'+
                        '</span>'+
                        '<input type="tel" class="form-control" name="refper_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono" required>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                    '<label>Parentesco:</label>'+
                      '<div class="input-group">'+
                        '<select class="form-control" name="refper_parent[]">'+
                        '<option>Hijo(a)</option>'+
                        '<option>Nieto(a)</option>'+
                        '<option>Padre</option>'+
                        '<option>Hermano(a)</option>'+
                        '<option>Sobrino(a)</option>'+
                        '<option>Abuelo(a)</option>'+
                        '<option>Tio(a)</option>'+
                        '<option>Primo(a)</option>'+
                      '</select>'+
                      '</div><!-- /input-group -->'+                  
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+
              '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button><!-- /.form group --></div>'); //add input box
        
      }
    });
    
    $(wrapper_refper).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_refper--;
    })


    var x_datfami = 1; //initlal text box count
    $(button_datfami).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_datfami < max_fields){ //max input box allowed  
            x_datfami++; //text box increment
            $(wrapper_datfami).append('<div><div class="dat_fami"><div class="box-footer"></div><!-- Nombres -->'+
                  '<div class="form-group">'+
                    '<label>Nombres:</label>'+
                    '<div class="row">'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="datfami_pnom[]" maxlength="20" placeholder="Primer nombre">'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="datfami_snom[]" maxlength="20" placeholder="Segundo nombre">'+
                      '</div><!-- /input-group -->'+                   
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<!-- Apellidos -->'+
                  '<div class="form-group">'+
                    '<label>Apellidos:</label>'+
                    '<div class="row">'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="datfami_pape[]" maxlength="20" placeholder="Primer Apellido">'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="datfami_sape[]" maxlength="20" placeholder="Segundo Apellido">'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+
                  

                  '<!-- parentesco y conyugue -->'+
                  '<div class="form-group">'+                                     
                    '<div class="row">'+            
                    '<div class="col-lg-6">'+
                    '<label>Fecha de nacimiento:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="date" class="form-control" name="datfami_date[]">'+
                      '</div><!-- /input-group -->'+                   
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                    '<label>Parentesco:</label>'+
                      '<div class="input-group">'+
                        '<select class="form-control" name="datfami_parent[]">'+
                        '<option>Hijo</option>'+
                        '<option>Conyugue</option>'+
                      '</select>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<div class="form-group">'+                  
                    '<div class="row">'+                    
                    '<div class="col-lg-6">'+
                    '<label>Acta de nacimiento</label>'+
                      '<div class="input-group">'+
                        '<div class="btn btn-default btn-file">'+
                      '<i class="fa fa-paperclip"></i> Agregar archivo <input type="file" name="archivo[]" accept="application/pdf, image/*"/>'+
                    '</div>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button>'+
                  '</div>'); //add input box
        
      }
    });
    
    $(wrapper_datfami).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_datfami--;
    })


    var x_benfa = 1; //initlal text box count
    $(button_benfa).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_benfa < max_fields){ //max input box allowed  
            x_benfa++; //text box increment
            $(wrapper_benfa).append('<div><div class="ben_fa"><div class="box-footer"></div>'+
              '<!-- Nombres -->'+
                  '<div class="form-group">'+
                    '<label>Nombres:</label>'+
                    '<div class="row">'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="benfa_pnom[]" maxlength="20" placeholder="Primer nombre" required>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="benfa_snom[]" maxlength="20" placeholder="Segundo nombre">'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<!-- Apellidos -->'+
                  '<div class="form-group">'+
                    '<label>Apellidos:</label>'+
                    '<div class="row">'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="benfa_pape[]" maxlength="20" placeholder="Primer Apellido" required>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="benfa_sape[]" maxlength="20" placeholder="Segundo Apellido" required>'+
                      '</div><!-- /input-group --> '+                   
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+
                  

                  '<!-- domicilio -->'+
                  '<div class="form-group">'+                                     
                    '<div class="row">'+            
                    '<div class="col-lg-12">'+
                    '<label>Domicilio:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-home"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="benfa_domici[]" maxlength="46" placeholder="Domicilio" required>'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<!-- teléfono, parentesco -->'+
                  '<div class="form-group">'+                                     
                    '<div class="row">'+           
                    '<div class="col-lg-6">'+
                    '<label>Teléfono:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-phone"></i>'+
                        '</span>'+
                        '<input type="number" class="form-control" name="benfa_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono" required>'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                    '<label>Parentesco:</label>'+
                      '<div class="input-group">'+
                        '<select class="form-control" name="benfa_parent[]">'+
                        '<option>Hijo(a)</option>'+
                        '<option>Nieto(a)</option>'+
                        '<option>Padre</option>'+
                        '<option>Hermano(a)</option>'+
                        '<option>Sobrino(a)</option>'+
                        '<option>Abuelo(a)</option>'+
                        '<option>Tio(a)</option>'+
                        '<option>Primo(a)</option>'+
                      '</select>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+
                  '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button></div>'); //add input box
        
      }
    });
    
    $(wrapper_benfa).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_benfa--;
    })
});
</script>


</form>

<?php
      if(isset($_POST['datper_pnom'])){
      include "cls_pruebas.php";

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
        $datper_profe = $_POST["datper_profe"];
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


        //REFERENCIAS PERSONALES []

        $refper_pnom = $_POST["refper_pnom"];
        $refper_snom = $_POST["refper_snom"];
        $refper_pape = $_POST["refper_pape"];
        $refper_sape = $_POST["refper_sape"];
        $refper_dir = $_POST["refper_dir"];
        $refper_tel = $_POST["refper_tel"];
        $refper_parent = $_POST["refper_parent"];



        //BENEFICIARIOS EN CASO DE FALLECIMIENTO []

        $benfa_pnom = $_POST["benfa_pnom"];
        $benfa_snom = $_POST["benfa_snom"];
        $benfa_pape = $_POST["benfa_pape"];
        $benfa_sape = $_POST["benfa_sape"];
        $benfa_domici = $_POST["benfa_domici"];
        $benfa_tel = $_POST["benfa_tel"];
        $benfa_parent = $_POST["benfa_parent"];


        //DATOS FAMILIARES O INDEPENDIENTES[]

        $datfami_pnom = $_POST["datfami_pnom"];
        $datfami_snom = $_POST["datfami_snom"];
        $datfami_pape = $_POST["datfami_pape"];
        $datfami_sape = $_POST["datfami_sape"];
        $datfami_date = $_POST["datfami_date"];
        $datfami_parent = $_POST["datfami_parent"];
        $archivo = $_FILES['archivo']['name']; //ARCHIVO
        $type = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $tmp_name = $_FILES['archivo']['tmp_name'];
        $error = $_FILES['archivo']['error'];



        //EMPLEOS ANTERIORES[]
        $empant_empr =$_POST["empant_empr"];
        $empant_puesto = $_POST["empant_puesto"];
        $empant_jefe = $_POST["empant_jefe"];
        $empant_ano = $_POST["empant_ano"];
        $empant_tel = $_POST["empant_tel"];


       //ESTUDIOS[]

        $est_escu = $_POST["est_escu"];
        $est_gmax = $_POST["est_gmax"];
        $est_certi = $_POST["est_certi"];

/* 
        //BOTÓN DE CONTINUAR
        $registro = $_POST["registro"];
"
        */

       $datos = new datos("$datper_pnom", "$datper_snom", "$datper_pape", "$datper_sape", "$datper_lugar", "$datper_date", "$datper_rfc", "$datper_curp", "$datper_imss", "$datper_profe", "$datper_unifam", $datper_anoexp, "$datper_calle", $datper_extint, "$datper_col", $datper_cp, $datper_municipio, $datper_telpart, $datper_telcel, "$datper_correo", "$datper_ecivil", "$datper_banco", $datper_ncuenta, $datper_nclabe, "$datper_sexo", $datper_ncredito, $refper_pnom, $refper_snom, $refper_pape, $refper_sape, $refper_dir, $refper_tel, $refper_parent, $benfa_pnom, $benfa_snom, $benfa_pape, $benfa_sape, $benfa_domici, $benfa_tel, $benfa_parent, $datfami_pnom, $datfami_snom, $datfami_pape, $datfami_sape, $datfami_date, $datfami_parent, $archivo, $type, $tamano, $tmp_name, $error, $empant_empr, $empant_puesto, $empant_jefe, $empant_ano, $empant_tel, $est_escu, $est_gmax, $est_certi, $id_tmp);
      $datos->registrar();
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