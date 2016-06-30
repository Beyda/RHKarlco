<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION['login_session'])){

include("../../template/todo2.php");
//inicio de librerias 

?>

<div class="content-wrapper">
  <section class="content">
          <div class="row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <i class="ion ion-person"></i>
                  <h3 class="box-title">Perfil</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-1">
                    </div>

                    <div class="col-lg-4">
                      <div class="input-group">
                        <img src="<?php echo $avatar_session; ?>" class="img-circle" alt="User Image" style="width: 60%; height: 60%;" /> 
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->

                    <div class="col-lg-6">
                      <div class="input-group">
                        <?php
                          $sel_dper = "SELECT `primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno` FROM `datos_personales` WHERE `id_datosper` = $id_datosper";
                          $res_dper = $mysqli->query($sel_dper);
                          $row_dper = $res_dper->fetch_array();
                          ?>
                          <h4><strong><?php echo $row_dper[0] ." ". $row_dper[1] ." ".$row_dper[2] ." ".$row_dper[3]?></strong></h4>
                          <center><a href="/rhkarlco/modulos/empleados/m_empleados.php?id=0"><button class="btn bg-olive margin">Editar mis datos personales</button></a></center>
                          <center><a href="/rhkarlco/modulos/usuarios/m_usuarios.php?id=0"><button class="btn bg-blue margin">Editar mis usuario</button></a></center>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
<form method="post" enctype="multipart/form-data">
    <!-- START ALERTS AND CALLOUTS -->
<!-- ========================== BENEFICIARIOS EN CASO DE FALLECIMIENTO ============================== -->
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Beneficiarios en caso de fallecimiento</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
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
            </div><!-- /.col -->
</form>

<form method="post" enctype="multipart/form-data">
<!-- ========================== Datos familiares o independientes ================================= -->
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos familiares o independientes</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
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
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
</form>

<form method="post" enctype="multipart/form-data">
<!-- ========================== Empleos anteriores ================================= -->
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Empleos anteriores</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="empleos_anteriores">
                <!-- Empleos anteriores -->
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
            </div><!-- /.col -->
</form>

<form method="post" enctype="multipart/form-data">
<!-- ========================== Estudios anteriores ================================= -->
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Estudios anteriores</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
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
            </div><!-- /.col -->

<!-- ========================== Referencias Personales ================================= -->
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Referencias Personales</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
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
            </div><!-- /.col -->


<!-- ========================== Profesión ================================= -->
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Profesión</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                 <div class="profesion">
                <!-- Profesiones-->
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_prof">Agregar otra</button> 
                </div>
                  </div>
                </div>

                  <!-- Profesion -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Profesión:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="prof[]" maxlength="20" placeholder="Profesión" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

<!-- ========================== Puesto ================================= -->
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Puesto</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="puesto">
                <!-- Escuela/Instituto/Universiad, grado máximo-->
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_puesto">Agregar otro</button> 
                </div>
                  </div>
                </div>



                  <div class="form-group">                  
                    <div class="row">                    
                    <div class="col-lg-6">
                    <label>Puesto:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="est_puesto[]" maxlength="20" placeholder="Puesto" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Disponibilidad:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="est_disp[]" maxlength="20" placeholder="Disponibilidad" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Certificado/Titulo -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Unidad Operativa:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="est_uoper[]" maxlength="20" placeholder="Unidad Operativa" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->


<!-- ========================== Documentos necesarios a entregar ================================= -->
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Documentos necesarios a entregar</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
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
            </div><!-- /.col -->
          </div> <!-- /.row -->
          <!-- END ALERTS AND CALLOUTS -->
          </div> <!-- /.row -->



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

    var wrapper_prof      = $(".profesion"); //Fields wrapper
    var button_prof       = $("#add_prof"); //Add button ID

    var wrapper_puesto      = $(".puesto"); //Fields wrapper
    var button_puesto       = $("#add_puesto"); //Add button ID
    
     var x_prof = 1; //initlal text box count
    $(button_prof).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_prof < max_fields){ //max input box allowed  
            x_prof++; //text box increment
            $(wrapper_prof).append('<div>'+
  '<div class="profesion">'+
    '<div class="box-footer"></div>'+
    '<!-- Profesion -->'+
                  '<div class="form-group">'+                                      
                    '<div class="row">'+
                    '<div class="col-lg-12">'+
                    '<label>Profesión:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-graduation-cap"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="prof[]" maxlength="20" placeholder="Profesión" required>'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /col-lg-6 -->'+
                  '</div><!-- /row -->'+
                  '</div><!-- /form group -->'+
  '</div>'+
  '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button>'+
  '</div>'); //add input box
        
      }
    });
    
    $(wrapper_prof).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_prof--;
    })



    var x_puesto = 1; //initlal text box count
    $(button_puesto).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_puesto < max_fields){ //max input box allowed  
            x_puesto++; //text box increment
            $(wrapper_puesto).append('<div>'+
  '<div class="puesto">'+
    '<div class="box-footer"></div>'+
    '<!-- Escuela/Instituto/Universiad, grado máximo-->'+

                  '<div class="form-group">'+                  
                    '<div class="row">'+                    
                    '<div class="col-lg-6">'+
                    '<label>Puesto:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-graduation-cap"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="est_puesto[]" maxlength="20" placeholder="Puesto" required>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                    '<label>Disponibilidad:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-graduation-cap"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="est_disp[]" maxlength="20" placeholder="Disponibilidad" required>'+
                      '</div><!-- /input-group -->'+                   
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<!-- Certificado/Titulo -->'+
                  '<div class="form-group">'+                                     
                    '<div class="row">'+
                    '<div class="col-lg-12">'+
                    '<label>Unidad Operativa:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-graduation-cap"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="est_uoper[]" maxlength="20" placeholder="Unidad Operativa" required>'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /col-lg-6 -->'+
                  '</div><!-- /row -->'+
                  '</div><!-- /form group -->'+
  '</div>'+
  '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button>'+
  '</div>'); //add input box
        
      }
    });
    
    $(wrapper_puesto).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_puesto--;
    })


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