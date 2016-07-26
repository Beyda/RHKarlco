<?php
include_once("../../../control/connect.php");
session_start();
?>
       
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar puesto</h4>
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
                        <input type="text" class="form-control" name="puesto" maxlength="50" placeholder="Nombre" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                  </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="guardarEmpant" value="ho" id="guardar">Guardar</button>
                  </div>
                  </form>
                 