<?php
include_once("../../../control/connect.php");
session_start();
   
  ?>
                
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar año de ejercicio</h4>
                  </div>
                  <form method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    
                <div class="empleos_anteriores">

                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-5">
                    <label>Año:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" class="form-control" name="ano" maxlength="4" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-7">
                    <label>Descripción:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-pencil"></i>
                        </span>
                        <input type="text" class="form-control" maxlength="50" name="desc" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                  </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="id_jefe" value="ho" id="guardar">Guardar</button>
                  </div>
                  </form>
