<?php
session_start();
require("../../../control/connect.php");
$id = $_GET["id"];
$sel_datfam2 = "SELECT * FROM `datos_familiares` WHERE `id_datosfam` = $id";
$res_datfam2 = $mysqli->query($sel_datfam2);
$row_datfam2 = $res_datfam2->fetch_array();
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregue sus profesiones</h4>
                  </div>
                  <form method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    
              <div>



                  <!-- Nombres -->
                  <div class="form-group">
                    <label>Nombres:</label>
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="Mdatfami_pnom" maxlength="20" value="<?php echo $row_datfam2[1] ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="Mdatfami_snom" maxlength="20" value="<?php echo $row_datfam2[2] ?>">
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
                        <input type="text" class="form-control" name="Mdatfami_pape" maxlength="20" value="<?php echo $row_datfam2[3] ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="Mdatfami_sape" maxlength="20" value="<?php echo $row_datfam2[4] ?>" required>
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
                        <input type="date" class="form-control" name="Mdatfami_date" value="<?php echo $row_datfam2[5] ?>" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Parentesco:</label>
                      <div class="input-group">
                        <select class="form-control" name="Mdatfami_parent" required>
                        <option><?php echo $row_datfam2[6] ?></option>
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
                      <input id="file" type="file" name="Marchivo" accept="application/pdf, image/*"/>
                    </div>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                  </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="guardarMDF" value="<?php echo $row_datfam2[0] ?>" id="guardar">Guardar</button>
                  </div>
                  </form>
                 