
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregue sus profesiones</h4>
                  </div>
                  <form method="post">
                  <div class="modal-body">
                    <div class="ben_fa">
                <!-- Nombre y dirección -->
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_benfa">Agregar otro</button> 
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
                        <input type="text" class="form-control" name="benfa_pnom[]" maxlength="20" placeholder="Primer nombre" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="benfa_snom[]" maxlength="20" placeholder="Segundo nombre">
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
                        <input type="text" class="form-control" name="benfa_pape[]" maxlength="20" placeholder="Primer Apellido" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="benfa_sape[]" maxlength="20" placeholder="Segundo Apellido" required>
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
                        <input type="text" class="form-control" name="benfa_domici[]" maxlength="20" placeholder="Domicilio" required>
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
                        <input type="text" class="form-control" name="benfa_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Parentesco:</label>
                      <div class="input-group">
                        <select class="form-control" name="benfa_parent[]">
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
              var max_fields      = 4; //maximum input boxes allowed
              
              var wrapper_benfa      = $(".ben_fa"); //Fields wrapper
              var button_benfa       = $("#add_benfa"); //Add button ID
              
               var x_benfa = 1; //initlal text box count
    $(button_benfa).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_benfa < max_fields){ //max input box allowed  
            x_benfa++; //text box increment
            $(wrapper_benfa).append('<div><div class="ben_fa"><div class="box-footer"></div>'+
              '<!-- Nombres -->'+
                  '<div class="form-group">'+
                    '<label>Nombres:</label>'+
                    '<div class="row">'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="benfa_pnom[]" maxlength="20" placeholder="Primer nombre" required>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="benfa_snom[]" maxlength="20" placeholder="Segundo nombre">'+
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
                        '<input type="text" class="form-control" name="benfa_pape[]" maxlength="20" placeholder="Primer Apellido" required>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="benfa_sape[]" maxlength="20" placeholder="Segundo Apellido" required>'+
                      '</div><!-- /input-group --> '+                   
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+
                  

                  '<!-- domicilio -->'+
                  '<div class="form-group">'+                                     
                    '<div class="row">'+            
                    '<div class="col-lg-12">'+
                    '<label>Domicilio:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-home"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="benfa_domici[]" maxlength="46" placeholder="Domicilio" required>'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<!-- teléfono, parentesco -->'+
                  '<div class="form-group">'+                                     
                    '<div class="row">'+           
                    '<div class="col-lg-6">'+
                    '<label>Teléfono:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-phone"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="benfa_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono" required>'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                    '<label>Parentesco:</label>'+
                      '<div class="input-group">'+
                        '<select class="form-control" name="benfa_parent[]">'+
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
                  '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button></div>'); //add input box
        
      }
    });
    
    $(wrapper_benfa).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_benfa--;
    })
          });
          </script>
                    
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="benfa" value="ho" id="benfa">Guardar</button>
                  </div>
                  </form>
