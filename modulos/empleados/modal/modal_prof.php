<?php
include_once("../../../control/connect.php");
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregue sus habilidades</h4>
                  </div>
                  <form method="post">
                  <div class="modal-body">
                    <select data-placeholder="Selecciona habilidades" name="habilidades[]" class="chosen-select" multiple style="width:350px;" tabindex="4">
                      <option value=""></option>
                      <?php
                        $ctr_emp = "SELECT * FROM `l_habilidad` ORDER BY `nombre` ASC";
                        $res_emp = $mysqli->query($ctr_emp);
                        while ($row_resemp = $res_emp->fetch_array()) 
                        {
                        ?>
                        <option value="<?php echo $row_resemp[0] ?>"><?php echo $row_resemp[1] ?></option>
                        <?php
                        }
                      ?>
                  </select>
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
