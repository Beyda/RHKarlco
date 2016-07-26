<?php
include_once("../../../control/connect.php");
session_start();
?>
        <script src="/rhkarlco/bootstrap/js/fileinput.js" type="text/javascript"></script>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar empresas</h4>
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
                        <input type="text" class="form-control" name="nombre" maxlength="50" placeholder="Nombre" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    
                    <label>Dirección:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-map-marker"></i>
                        </span>
                        <input type="text" class="form-control" name="dir" maxlength="46" placeholder="Dirección" maxlength="100" required>
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
                        <input type="text" class="form-control" name="sweb" maxlength="30" placeholder="Sitio Web">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>RFC:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="rfc" maxlength="20" placeholder="RFC" required>
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
                        <input type="mail" placeholder="Correo electrónico" class="form-control" name="correo" maxlength="30">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Teléfono:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa  fa-phone"></i>
                        </span>
                        <input type="text" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="tel" placeholder="Teléfono" maxlength="10">
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
                        <textarea class="form-control" name="desc" maxlength="100" placeholder="Descripción"></textarea>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Logo:</label>
                      <div class="input-group">
                        <input id="archivo" type="file" class="file" name="archivo" data-show-preview="false" accept="application/pdf, image/*">
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
                 