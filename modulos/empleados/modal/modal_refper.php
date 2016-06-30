
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
                        <input type="text" class="form-control" name="refper_pnom[]" maxlength="20" placeholder="Primer nombre" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="refper_snom[]" maxlength="20" placeholder="Segundo nombre">
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
                        <input type="text" class="form-control" name="refper_pape[]" maxlength="20" placeholder="Primer Apellido" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="refper_sape[]" maxlength="20" placeholder="Segundo Apellido" required>
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
                        <input type="text" class="form-control" name="refper_dir[]" maxlength="20" placeholder="Dirección" required>
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
                        <input type="tel" class="form-control" name="refper_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Parentesco:</label>
                      <div class="input-group">
                        <select class="form-control" name="refper_parent[]">
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
                      <script type="text/javascript">
            $(document).ready(function() {
              var max_fields      = 6; //maximum input boxes allowed
              
              var wrapper_refper      = $(".ref_per"); //Fields wrapper
              var button_refper       = $("#add_refper"); //Add button ID
              
              var x_refper = 1; //initlal text box count
              $(button_refper).click(function(e){ //on add input button click
                  e.preventDefault();
                  if(x_refper < max_fields){ //max input box allowed  
                      x_refper++; //text box increment
                      $(wrapper_refper).append('<div>'+
                        '<div class="ref_per">'+
                          '<div class="box-footer"></div><!-- Nombres -->'+
                            '<div class="form-group">'+
                              '<label>Nombres:</label>'+
                              '<div class="row">'+
                              '<div class="col-lg-6">'+
                                '<div class="input-group">'+
                                  '<span class="input-group-addon">'+
                                    '<i class="fa fa-user"></i>'+
                                  '</span>'+
                                  '<input type="text" class="form-control" name="refper_pnom[]" maxlength="20" placeholder="Primer nombre" required>'+
                                '</div><!-- /input-group -->'+
                              '</div><!-- /.col-lg-6 -->'+
                              '<div class="col-lg-6">'+
                                '<div class="input-group">'+
                                  '<span class="input-group-addon">'+
                                    '<i class="fa fa-user"></i>'+
                                  '</span>'+
                                  '<input type="text" class="form-control" name="refper_snom[]" maxlength="20" placeholder="Segundo nombre">'+
                                '</div><!-- /input-group -->'+                   
                              '</div><!-- /.col-lg-6 -->'+
                            '</div><!-- /.row -->'+
                            '</div><!-- /.form group -->'+

                            '<!-- Apellidos -->'+
                            '<div class="form-group">'+
                              '<label>Apellidos:</label>'+
                              '<div class="row">'+
                              '<div class="col-lg-6">'+
                                '<div class="input-group">'+
                                  '<span class="input-group-addon">'+
                                    '<i class="fa fa-user"></i>'+
                                  '</span>'+
                                  '<input type="text" class="form-control" name="refper_pape[]" maxlength="20" placeholder="Primer Apellido" required>'+
                                '</div><!-- /input-group -->'+
                              '</div><!-- /.col-lg-6 -->'+
                              '<div class="col-lg-6">'+
                                '<div class="input-group">'+
                                  '<span class="input-group-addon">'+
                                    '<i class="fa fa-user"></i>'+
                                  '</span>'+
                                  '<input type="text" class="form-control" name="refper_sape[]" maxlength="20" placeholder="Segundo Apellido" required>'+
                                '</div><!-- /input-group -->'+                    
                              '</div><!-- /.col-lg-6 -->'+
                            '</div><!-- /.row -->'+
                            '</div><!-- /.form group -->'+


                            '<div class="form-group">'+                                     
                              '<div class="row">'+
                              '<div class="col-lg-12">'+
                              '<label>Dirección:</label>'+
                                '<div class="input-group">'+
                                  '<span class="input-group-addon">'+
                                    '<i class="fa fa-home"></i>'+
                                  '</span>'+
                                  '<input type="text" class="form-control" name="refper_dir[]" maxlength="46" placeholder="Dirección" required>'+
                                '</div><!-- /input-group -->'+                    
                              '</div><!-- /.col-lg-6 -->'+
                            '</div><!-- /.row -->'+
                            '</div><!-- /.form group -->'+

                            '<!-- Teléfono y parentesco -->'+
                            '<div class="form-group">'+                                     
                              '<div class="row">'+
                              '<div class="col-lg-6">'+
                              '<label>Teléfono:</label>'+
                                '<div class="input-group">'+
                                  '<span class="input-group-addon">'+
                                    '<i class="fa fa-phone"></i>'+
                                  '</span>'+
                                  '<input type="tel" class="form-control" name="refper_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono" required>'+
                                '</div><!-- /input-group -->'+
                              '</div><!-- /.col-lg-6 -->'+
                              '<div class="col-lg-6">'+
                              '<label>Parentesco:</label>'+
                                '<div class="input-group">'+
                                  '<select class="form-control" name="refper_parent[]">'+
                                  '<option>Hijo(a)</option>'+
                                  '<option>Nieto(a)</option>'+
                                  '<option>Padre</option>'+
                                  '<option>Hermano(a)</option>'+
                                  '<option>Sobrino(a)</option>'+
                                  '<option>Abuelo(a)</option>'+
                                  '<option>Tio(a)</option>'+
                                  '<option>Primo(a)</option>'+
                                '</select>'+
                                '</div><!-- /input-group -->'+                  
                              '</div><!-- /.col-lg-6 -->'+
                            '</div><!-- /.row -->'+
                            '</div><!-- /.form group -->'+
                        '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button><!-- /.form group --></div>'); //add input box
                  
                }
              });
              
              $(wrapper_refper).on("click","#remove_field", function(e){ //user click on remove text
                  e.preventDefault(); $(this).parent('div').remove(); x_refper--;
              })
          });
          </script>
                    
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="guardar" value="ho" id="guardar">Guardar</button>
                  </div>
                  </form>
                 