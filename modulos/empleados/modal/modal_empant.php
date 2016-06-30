<?php
include_once("../../../control/connect.php");
session_start();
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar empleo anterior</h4>
                  </div>
                  <form method="post">
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
                    <label>Empresa:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="empant_empr[]" maxlength="46" placeholder="Empresa">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <?php 
                      $obt_area = "SELECT * FROM `areas` WHERE `estatus` = 1";       
                      $res_area = $mysqli->query($obt_area);
                    ?>
                    <label>Área de trabajo:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="area[]" maxlength="46" id="area">
                          <option>Selecciona área de trabajo</option>
                          <?php
                          while ($row_area = $res_area->fetch_array()) 
                          { 
                            ?>
                              <option value="<?php echo $row_area[0] ?>"><?php echo $row_area[1] ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  <!-- *****************************************/.ajax pais******************************** -->
                  <script type="text/javascript">
                  //las subareas de trabajo
                  $(document).ready(function(){
                      //Mostrar las subareas de trabajo
                      $("#area").change(function(){
                          var area=$(this).val();
                          var dataString = 'area='+ area;
                          $.ajax({
                              type: "POST",
                              url: "modal/ajax_subarea.php",
                              data: dataString,
                              cache: false,
                          success: function(html){
                          $("#subarea").html(html);
                          }
                          });
                      });


                      

                    });
                  </script>

                  <!-- Jefe inmediato, año y teléfono -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Subarea de trabajo:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="subarea[]" maxlength="46" id="subarea">
                          <option disabled>Selecciona subarea</option>
                        </select>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Jefe inmediato:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="empant_jefe[]" maxlength="46" placeholder="Jefe inmediato">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group --> 

    <script>
      function myFunction() {
          document.getElementById("añof").disabled = true;
      }
      function enable() {
          document.getElementById("añof").disabled = false;
      }
    </script>

                  <!-- Fecha inicio y final -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                    <input type="checkbox" onclick="if(this.checked){myFunction()}else{enable()}" <?php echo $opt ?> name="check" value="Null"><label>Trabajo aquí actualmente:</label>
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Fecha inicio:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="date" class="form-control" name="empant_anoi[]" maxlength="10">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Fecha final:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="date" class="form-control" name="empant_anof[]" id="añof" maxlength="10">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group --> 

                  <!-- Teléfono -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-6">
                    <?php 
                      $obt_indu = "SELECT * FROM `industria`";       
                      $res_indus = $mysqli->query($obt_indu);
                    ?>
                    <label>Industria:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </span>
                        <select class="form-control" name="industria[]" maxlength="46">
                          <option>Selecciona una industria</option>
                          <?php
                          while ($row_indus = $res_indus->fetch_array()) 
                          { 
                            ?>
                              <option value="<?php echo $row_indus[0] ?>"><?php echo $row_indus[1] ?></option>
                            <?php
                          }
                          ?> 
                        </select>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Teléfono:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </span>
                        <input type="tel" class="form-control" name="empant_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group --> 

                  </div>
                      <script type="text/javascript">
            $(document).ready(function() {
              var max_fields      = 6; //maximum input boxes allowed
              
              var wrapper_ea      = $(".empleos_anteriores"); //Fields wrapper
              var button_ea       = $("#add_empleosant"); //Add button ID
              
              var x_ea = 1; //initlal text box count
              $(button_ea).click(function(e){ //on add input button click
                  e.preventDefault();
                  if(x_ea < max_fields){ //max input box allowed  
                      x_ea++; //text box increment
                      $(wrapper_ea).append('<div>'+
            '<div class="empleos_anteriores">'+
              '<div class="box-footer"></div>'+
              '<!-- Empresa y puesto -->'+
                '<div class="form-group">'+
                  '<div class="row"></div>'+
                '</div>'+
                '<div class="form-group">'+                                     
                              '<div class="row">'+
                              '<div class="col-lg-6">'+
                              '<label>Empresa:</label>'+
                                '<div class="input-group">'+
                                  '<span class="input-group-addon">'+
                                    '<i class="fa fa-user"></i>'+
                                  '</span>'+
                                  '<input type="text" class="form-control" name="empant_empr[]" maxlength="46" placeholder="Empresa">'+
                                '</div><!-- /input-group -->'+
                              '</div><!-- /col-lg-6 -->'+
                              '<div class="col-lg-6">'+
                              '<label>Puesto:</label>'+
                                '<div class="input-group">'+
                                  '<span class="input-group-addon">'+
                                    '<i class="fa fa-user"></i>'+
                                  '</span>'+
                                  '<input type="text" class="form-control" name="empant_puesto[]" maxlength="46" placeholder="Puesto">'+
                                '</div><!-- /input-group -->'+                   
                              '</div><!-- /col-lg-6 -->'+
                            '</div><!-- /row -->'+
                            '</div><!-- /form group -->'+
                            '<!-- Jefe inmediato, año y teléfono -->'+
                            '<div class="form-group">'+                                      
                              '<div class="row">'+
                              '<div class="col-lg-5">'+
                              '<label>Jefe inmediato:</label>'+
                                '<div class="input-group">'+
                                  '<span class="input-group-addon">'+
                                    '<i class="fa fa-user"></i>'+
                                  '</span>'+
                                  '<input type="text" class="form-control" name="empant_jefe[]" maxlength="46" placeholder="Jefe inmediato">'+
                                '</div><!-- /input-group -->'+
                              '</div><!-- /col-lg-6 -->'+
                              '<div class="col-lg-3">'+
                              '<label>Año:</label>'+
                                '<div class="input-group">'+
                                  '<span class="input-group-addon">'+
                                    '<i class="fa fa-user"></i>'+
                                  '</span>'+
                                  '<input type="text" class="form-control" name="empant_ano[]" maxlength="4" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Año">'+
                                '</div><!-- /input-group -->'+                    
                              '</div><!-- /col-lg-6 -->'+
                              '<div class="col-lg-4">'+
                              '<label>Teléfono:</label>'+
                                '<div class="input-group">'+
                                  '<span class="input-group-addon">'+
                                    '<i class="fa fa-phone"></i>'+
                                  '</span>'+
                                  '<input type="tel" class="form-control" name="empant_tel[]" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Teléfono">'+
                                '</div><!-- /input-group -->'+                    
                              '</div><!-- /col-lg-6 -->'+
                            '</div><!-- /row -->'+
                            '</div><!-- /form group -->'+
            '</div>'+
            '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button>'+
            '</div>'); //add input box
                  
                }
              });
              
              $(wrapper_ea).on("click","#remove_field", function(e){ //user click on remove text
                  e.preventDefault(); $(this).parent('div').remove(); x_ea--;
              })
          });
          </script>
                    
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="guardarEmpant" value="ho" id="guardar">Guardar</button>
                  </div>
                  </form>
                 