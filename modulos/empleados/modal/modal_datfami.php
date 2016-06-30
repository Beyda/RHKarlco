
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregue sus profesiones</h4>
                  </div>
                  <form method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    
                           <div class="dat_fami">
                <!-- Nombre y dirección -->
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_datfami">Agregar otro</button> 
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
                        <input type="text" class="form-control" name="datfami_pnom[]" maxlength="20" placeholder="Primer nombre" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datfami_snom[]" maxlength="20" placeholder="Segundo nombre">
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
                        <input type="text" class="form-control" name="datfami_pape[]" maxlength="20" placeholder="Primer Apellido" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="datfami_sape[]" maxlength="20" placeholder="Segundo Apellido" required>
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
                        <input type="date" class="form-control" name="datfami_date[]" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Parentesco:</label>
                      <div class="input-group">
                        <select class="form-control" name="datfami_parent[]" required>
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
                      <input id="file" type="file" name="archivo[]" accept="application/pdf, image/*" required/>
                    </div>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                  </div>
                      <script type="text/javascript">
            $(document).ready(function() {
              var max_fields      = 6; //maximum input boxes allowed
              
              var wrapper_datfami      = $(".dat_fami"); //Fields wrapper
              var button_datfami       = $("#add_datfami"); //Add button ID
              
  var x_datfami = 1; //initlal text box count
    $(button_datfami).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_datfami < max_fields){ //max input box allowed  
            x_datfami++; //text box increment
            $(wrapper_datfami).append('<div><div class="dat_fami"><div class="box-footer"></div><!-- Nombres -->'+
                  '<div class="form-group">'+
                    '<label>Nombres:</label>'+
                    '<div class="row">'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="datfami_pnom[]" maxlength="20" placeholder="Primer nombre">'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="datfami_snom[]" maxlength="20" placeholder="Segundo nombre">'+
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
                        '<input type="text" class="form-control" name="datfami_pape[]" maxlength="20" placeholder="Primer Apellido">'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="datfami_sape[]" maxlength="20" placeholder="Segundo Apellido">'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+
                  

                  '<!-- parentesco y conyugue -->'+
                  '<div class="form-group">'+                                     
                    '<div class="row">'+            
                    '<div class="col-lg-6">'+
                    '<label>Fecha de nacimiento:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-user"></i>'+
                        '</span>'+
                        '<input type="date" class="form-control" name="datfami_date[]">'+
                      '</div><!-- /input-group -->'+                   
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                    '<label>Parentesco:</label>'+
                      '<div class="input-group">'+
                        '<select class="form-control" name="datfami_parent[]">'+
                        '<option>Hijo</option>'+
                        '<option>Conyugue</option>'+
                      '</select>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<div class="form-group">'+                  
                    '<div class="row">'+                    
                    '<div class="col-lg-6">'+
                    '<label>Acta de nacimiento</label>'+
                      '<div class="input-group">'+
                        '<div class="btn btn-default btn-file">'+
                      '<i class="fa fa-paperclip"></i> Agregar archivo <input type="file" name="archivo[]" accept="application/pdf, image/*"/>'+
                    '</div>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button>'+
                  '</div>'); //add input box
        
      }
    });
    
    $(wrapper_datfami).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_datfami--;
    })
          });
          </script>
                    
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="guardar" value="ho" id="guardar">Guardar</button>
                  </div>
                  </form>
                 