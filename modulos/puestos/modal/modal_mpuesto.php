<?php
include_once("../../../control/connect.php");
session_start();
$id = $_GET["id"];
$sel_puesto = "SELECT * FROM `puestos` WHERE `id_puesto` = $id";
$resul_selpuesto = $mysqli->query($sel_puesto);
$row_puesto = $resul_selpuesto->fetch_array();
?>
        
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar puesto</h4>
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
                    <div class="col-lg-12">
                    <label>Puesto:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-briefcase"></i>
                        </span>
                        <input type="text" class="form-control" name="Mpuesto" maxlength="50" value="<?php echo $row_puesto[1] ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="id" value="<?php echo $row_puesto[0] ?>" id="guardar">Actualizar</button>
                  </div>
                  </form>
                 