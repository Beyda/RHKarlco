<?php
session_start();
require("../../../control/connect.php");
$id = $_GET["id"];
$sel_benfa2 = "SELECT * FROM `beneficiarios` WHERE `id_benificiario` = $id";
$res_benfa2 = $mysqli->query($sel_benfa2);
$row_benfa2 = $res_benfa2->fetch_array();
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar la profesión</h4>
                  </div>
                  <form method="post">
                  <div class="modal-body">
                    
                           <div>
                          
                            <div class="form-group">
                    <label>Nombres:</label>
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="Mbenfa_pnom" maxlength="20" value="<?php echo $row_benfa2[1] ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="Mbenfa_snom" maxlength="20" value="<?php echo $row_benfa2[2] ?>">
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
                        <input type="text" class="form-control" name="Mbenfa_pape" maxlength="20" value="<?php echo $row_benfa2[3] ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="Mbenfa_sape" maxlength="20" value="<?php echo $row_benfa2[4] ?>" required>
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
                        <input type="text" class="form-control" name="Mbenfa_domici" maxlength="20" value="<?php echo $row_benfa2[6] ?>" required>
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
                        <input type="text" class="form-control" name="Mbenfa_tel" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="<?php echo $row_benfa2[7] ?>" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Parentesco:</label>
                      <div class="input-group">
                        <select class="form-control" name="Mbenfa_parent">
                        <option><?php echo $row_benfa2[5] ?></option>
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
                  <button type="submit" class="btn btn-primary" name="actBenfa" value="<?php echo $id ?>" id="act">Actualizar</button>
                  </div>
                  </form>
                 