<?php
session_start();
require("../../../control/connect.php");
$id = $_GET["id"];
$salario2 = "SELECT * FROM `puesto_per` pp INNER JOIN `puestos` p ON pp.`id_puesto` = p.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` WHERE pp.`id_puestoper` = $id";
$res_salario2 = $mysqli->query($salario2);
$row_salario2 = $res_salario2->fetch_array();
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
                        <select class="form-control" name="Mempresa" id="empresa" required>
                          <option value="<?php echo $row_salario2[10] ?>"><?php echo $row_salario2[11] ?></option>
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
                        <input type="text" class="form-control" name="Msalario" maxlength="18" value="<?php echo $row_salario2[3] ?>" onKeypress="if (event.keyCode < 8 || event.keyCode > 57) event.returnValue = false;" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <script>
                    function myFunction() {
                        document.getElementById("Mf_final").disabled = true;
                    }
                    function enable() {
                        document.getElementById("Mf_final").disabled = false;
                    }
                  </script>


                  <!-- Salario y puesto -->
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
                        <input type="date" name="Mf_inicio" value="<?php echo $row_salario2[1] ?>" class="form-control" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Fecha de final:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="date" name="mf_final" id="Mf_final" value="<?php echo $row_salario2[2] ?>" class="form-control" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Salario y puesto -->
                  <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Puesto:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="Mpuesto" id="puesto" required>
                          <option value="<?php echo $row_salario2[6] ?>"><?php echo $row_salario2[7] ?></option>
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
                  <button type="submit" class="btn btn-primary" name="id_pp" value="<?php echo $row_salario2[0] ?>" id="guardar">Guardar</button>
                  </div>
                  </form>
                 