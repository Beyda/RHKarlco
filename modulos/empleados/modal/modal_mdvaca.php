<?php
session_start();
require("../../../control/connect.php");
$id = $_GET["id"];
$sel_dv = "SELECT * FROM `dias_vacaciones` WHERE `id_dvaca` = $id";       
$res_dv = $mysqli->query($sel_dv);
$row_dv = $res_dv->fetch_array();

$sel_da = "SELECT `id_datosper`, `primer_nombre`,`segundo_nombre`,`ap_paterno`,`ap_materno` FROM `datos_personales` WHERE `id_datosper` = $row_dv[6]";       
$res_da = $mysqli->query($sel_da);
$row_da = $res_da->fetch_array();
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detalles de sus días de vacaciones</h4>
                  </div>
                  <form method="post">
                  <div class="modal-body">
                           <div>


                <!-- Nombres -->
                  <div class="form-group">
                    
                    <div class="row">
                    <div class="col-lg-3">
                    <label>Signo:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-plus-circle"></i>
                        </span>
                        <select class="form-control" name="signo" disabled>
                          <option><?php echo $row_dv[7] ?></option>
                          <option>+</option>
                          <option>-</option>
                        </select>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-4">
                    <label>Días:</label>
                      <div class="input-group">
                        <input type="number" value="<?php echo $row_dv[2] ?>" class="form-control" name="dias" max="99" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required disabled>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-5">
                    <label>Año:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="number" class="form-control" name="ano" maxlength="20" value="<?php echo $row_dv[3] ?>" disabled>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Descripción -->
                  <div class="form-group">
                    <label>Descripción:</label>
                    <div class="row">
                    <div class="col-lg-12">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-pencil"></i>
                        </span>
                        <input type="text" class="form-control" name="desc" maxlength="46" value="<?php echo $row_dv[1] ?>" disabled>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Autoriza -->
                  <div class="form-group">
                    <label>Autoriza:</label>
                    <div class="row">
                    <div class="col-lg-12">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="autoriza" maxlength="46" value="<?php echo $row_da[1] ." ". $row_da[2] ." ". $row_da[3] ." ". $row_da[4] ?>" disabled>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                                   
                  </div>
                  </div>
                  <div class="modal-footer">
                  <!--<button type="submit" class="btn btn-primary" name="guardarRefper" value="<?php echo $row_refper2[0] ?>" id="guardar">Guardar</button>-->
                  </div>
                  </form>
                 