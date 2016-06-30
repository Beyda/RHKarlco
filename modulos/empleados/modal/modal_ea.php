<?php
include_once("../../../control/connect.php");
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregue sus estudios</h4>
                  </div>
                  <form method="post">
                  <div class="modal-body">
                    <div class="estudios">
                <!-- Escuela/Instituto/Universiad, grado máximo
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_estudios">Agregar otro</button> 
                </div>
                  </div>
                </div>-->



                  <div class="form-group">                  
                    <div class="row">                    
                    <div class="col-lg-6">
                    <label>Escuela/Instituto/Universiad:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="est_escu[]" maxlength="50" placeholder="Escuela/Instituto/Universiad" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Grado máximo de estudios:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="est_gmax[]" maxlength="50" placeholder="Grado máximo de estudios" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Certificado/Titulo -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Certificado/Titulo/etc:</label>
                      <div class="input-group">
                        <select data-placeholder="Certificado/Titulo/etc" name="est_certi[]" class="chosen-select" style="width:350px;" tabindex="2">
                          <option value=""></option>
                          <?php
                        $ctr_emp = "SELECT * FROM `carreras` ORDER BY `nombre` ASC";
                        $res_emp = $mysqli->query($ctr_emp);
                        while ($row_resemp = $res_emp->fetch_array()) 
                        {
                        ?>
                        <option value="<?php echo $row_resemp[0] ?>"><?php echo $row_resemp[1] ?></option>
                        <?php
                        }
                      ?>
                        </select>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  </div>
                  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
    <script type="text/javascript">
            $(document).ready(function() {
              var max_fields      = 6; //maximum input boxes allowed
              
              var wrapper_est      = $(".estudios"); //Fields wrapper
              var button_est       = $("#add_estudios"); //Add button ID
              
               var x_est = 1; //initlal text box count
    $(button_est).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_est < max_fields){ //max input box allowed  
            x_est++; //text box increment
            $(wrapper_est).append('<div>'+
              '<div class="estudios">'+
                '<div class="box-footer"></div>'+
                '<!-- Escuela/Instituto/Universiad, grado máximo-->'+
                
                  '<div class="form-group">'+                  
                    '<div class="row">'+                    
                    '<div class="col-lg-6">'+
                    '<label>Escuela/Instituto/Universiad:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-graduation-cap"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="est_escu[]" maxlength="20" placeholder="Escuela/Instituto/Universiad" required>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                    '<div class="col-lg-6">'+
                    '<label>Grado máximo de estudios:</label>'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon">'+
                          '<i class="fa fa-graduation-cap"></i>'+
                        '</span>'+
                        '<input type="text" class="form-control" name="est_gmax[]" maxlength="20" placeholder="Grado máximo de estudios" required>'+
                      '</div><!-- /input-group -->'+                    
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+

                  '<!-- Certificado/Titulo -->'+
                  '<div class="form-group">'+                                      
                    '<div class="row">'+
                    '<div class="col-lg-12">'+
                    '<label>Certificado/Titulo/etc:</label>'+
                      '<div class="input-group">'+
                        '<select data-placeholder="Certificado/Titulo/etc" name="est_certi[]" class="chosen-select" style="width:350px;" tabindex="2" id="cert'+ x_est +'">'+
                          '<option value=""></option>'+
                        '</select>'+
                      '</div><!-- /input-group -->'+
                    '</div><!-- /.col-lg-6 -->'+
                  '</div><!-- /.row -->'+
                  '</div><!-- /.form group -->'+
                  '<button class="btn btn-block btn-danger btn-xs" id="remove_field" style="width:100px;">Borrar</button>'+
                  '<!-- /.form group -->'+
                  '</div>'); //add input box
        
      }
      
      var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    $("#cert"+x_est).load('ajax_cert.php');
    });
    
    $(wrapper_est).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_est--;

    })
          });
          </script>
                    
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="guardar" value="ho" id="guardar">Guardar</button>
                  </div>
                  </form>
                 