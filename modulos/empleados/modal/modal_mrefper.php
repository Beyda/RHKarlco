<?php
session_start();
require("../../../control/connect.php");
$id = $_GET["id"];
$sel_refper2 = "SELECT * FROM `referencias` WHERE `id_ref` = $id";
$res_refper2 = $mysqli->query($sel_refper2);
$row_refper2 = $res_refper2->fetch_array();
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregue sus referencias personales</h4>
                  </div>
                  <form method="post">
                  <div class="modal-body">
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
                        <input type="text" class="form-control" name="mrefper_pnom" maxlength="20" value="<?php echo $row_refper2[1] ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="mrefper_snom" maxlength="20" value="<?php echo $row_refper2[2] ?>">
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
                        <input type="text" class="form-control" name="mrefper_pape" maxlength="20" value="<?php echo $row_refper2[3] ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="mrefper_sape" maxlength="20" value="<?php echo $row_refper2[4] ?>" required>
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
                        <input type="text" class="form-control" name="mrefper_dir" maxlength="20" value="<?php echo $row_refper2[5] ?>" required>
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
                        <input type="tel" class="form-control" name="mrefper_tel" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="<?php echo $row_refper2[6] ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Parentesco:</label>
                      <div class="input-group">
                        <select class="form-control" name="mrefper_parent">
                        <option><?php echo $row_refper2[7] ?></option>
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
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="guardarRefper" value="<?php echo $row_refper2[0] ?>" id="guardar">Guardar</button>
                  </div>
                  </form>
                 