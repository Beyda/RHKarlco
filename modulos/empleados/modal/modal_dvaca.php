<?php
session_start();
require("../../../control/connect.php");
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregue sus días de vacaciones</h4>
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
                        <select class="form-control" name="signo">
                          <option>+</option>
                          <option>-</option>
                        </select>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-4">
                    <label>Días:</label>
                      <div class="input-group">
                        <input type="number" placeholder="Días de vacaciones" class="form-control" name="dias" max="99" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-5">
                    <label>Año:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="number" class="form-control" name="ano" maxlength="20" placeholder="Año">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Apellidos -->
                  <div class="form-group">
                    <label>Descripción:</label>
                    <div class="row">
                    <div class="col-lg-12">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-pencil"></i>
                        </span>
                        <input type="text" class="form-control" name="desc" maxlength="46" placeholder="Descripción">
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
                 