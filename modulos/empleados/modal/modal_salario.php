<?php
include_once("../../../control/connect.php");
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregue sus puestos</h4>
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


                <script type="text/javascript">
                  //Mostrar los estados obteniendo el id del pais
                  $(document).ready(function(){

                      //Mostrar las ciudades con el id del estadocipio
                      $("#empresa").change(function(){
                          var empresa=$(this).val();
                          var dataString2 = 'empresa='+ empresa;
                          $.ajax({
                              type: "POST",
                              url: "../puestos/ajax_puesto.php",
                              data: dataString2,
                              cache: false,
                          success: function(html){
                          $("#puesto").html(html);
                          }
                          });
                      });


                      

                    });
                  </script>
                  <!-- Empresa y fecha inicial -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Empresa:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="empresa" id="empresa" required>
                          <option>Selecciona una empresa</option>
                          <?php
                          $empresa = "SELECT * FROM `empresas` WHERE `status` = 1";
                          $res_empresa = $mysqli->query($empresa);
                          while ( $row_empresa = $res_empresa->fetch_array()) {
                            ?>
                              <option value="<?php echo $row_empresa[0] ?>"><?php echo $row_empresa[1] ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Salario:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="salario" maxlength="18" placeholder="Salario" onKeypress="if (event.keyCode < 8 || event.keyCode > 57) event.returnValue = false;" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <script>
                    function myFunction() {
                        document.getElementById("f_final").disabled = true;
                    }
                    function enable() {
                        document.getElementById("f_final").disabled = false;
                    }
                  </script>

                  <!-- Fecha de inicio y de final -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                    <input type="checkbox" onclick="if(this.checked){myFunction()}else{enable()}" <?php echo $opt ?> name="check" value="Null"><label>Trabajo aquí actualmente:</label>
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Fecha de inicio:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="date" name="f_inicio" value="<?php echo date("Y-m-d"); ?>" class="form-control" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Fecha de final:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="date" name="f_final" id="f_final" class="form-control" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Puestos -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Puesto:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="puesto" id="puesto" required>
                          <option value="">Selecciona un puesto</option>
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
     
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="guardar" value="ho" id="guardar">Guardar</button>
                  </div>
                  </form>
                 