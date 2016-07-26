<?php
include_once("../../../control/connect.php");
session_start();
$id = $_GET["id"];
$sel_empresas = "SELECT * FROM `empresas` WHERE `id_empresa` = $id";
$resul_selempresa = $mysqli->query($sel_empresas);
$row_emp = $resul_selempresa->fetch_array();
?>
        <script src="/rhkarlco/bootstrap/js/fileinput.js" type="text/javascript"></script>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar la empresa</h4>
                  </div>
                  <form method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    
                <div class="empleos_anteriores">
                <!-- Empleos anteriores 
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_empleosant">Agregar otro</button> 
                </div>
                  </div>
                </div>-->

                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Nombre:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-building-o"></i>
                        </span>
                        <input type="text" class="form-control" name="Mnombre" maxlength="50" value="<?php echo $row_emp[1] ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    
                    <label>Dirección:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-map-marker"></i>
                        </span>
                        <input type="text" class="form-control" name="Mdir" maxlength="46" value="<?php echo $row_emp[2] ?>" maxlength="100" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Jefe inmediato, año y teléfono -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Sitio Web:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-globe"></i>
                        </span>
                        <input type="text" class="form-control" name="Msweb" maxlength="30" value="<?php echo $row_emp[3] ?>">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>RFC:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="Mrfc" maxlength="20" value="<?php echo $row_emp[4] ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group --> 


                  <!-- Fecha inicio y final -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Correo electrónico:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-envelope"></i>
                        </span>
                        <input type="mail" value="<?php echo $row_emp[5] ?>" class="form-control" name="Mcorreo" maxlength="30">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Teléfono:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa  fa-phone"></i>
                        </span>
                        <input type="text" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="Mtel" value="<?php echo $row_emp[6] ?>" maxlength="10">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group --> 

                  <!-- Descripción -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-6">
                    
                    <label>Descripción:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-pencil"></i>
                        </span>
                        <textarea class="form-control" name="Mdesc" maxlength="100"><?php echo $row_emp[7] ?></textarea>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Logo:</label>
                      <div class="input-group">
                        <input id="archivo" type="file" class="file" name="Marchivo" data-show-preview="false" accept="application/pdf, image/*">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group --> 

                  </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="id" value="<?php echo $row_emp[0] ?>" id="guardar">Actualizar</button>
                  </div>
                  </form>
                 