<?php
session_start();
require("../../../control/connect.php");
$id = $_GET["id"];
$sel_estant2 = "SELECT * FROM `estudios`, `carreras` WHERE `estudios`.`id_estudios` = $id and `estudios`.`certificado` = `carreras`.`id_carrera`";
$res_estant2 = $mysqli->query($sel_estant2);
$row_estant2 = $res_estant2->fetch_array();
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar sus estudios</h4>
                  </div>
                  <form method="post">
                  <div class="modal-body">
                    <div class="estudios">



                  <div class="form-group">                  
                    <div class="row">                    
                    <div class="col-lg-6">
                    <label>Escuela/Instituto/Universiad:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="Mest_escu" maxlength="50" value="<?php echo $row_estant2["1"]; ?>" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Grado máximo de estudios:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="Mest_gmax" maxlength="50" value="<?php echo $row_estant2["2"]; ?>" required>
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
                        <select data-placeholder="Certificado/Titulo/etc" name="mest_certi" class="chosen-select" style="width:350px;" tabindex="2">
                          <option value="<?php echo $row_estant2["5"]; ?>"><?php echo $row_estant2["6"]; ?></option>
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
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="btnestant" value="<?php echo $id ?>" id="guardar">Guardar</button>
                  </div>
                  </form>
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