<?php
session_start();
require("../../../control/connect.php");
$id = $_GET["id"];
$sel_empant2 = "SELECT DISTINCT `empleos_anteriores`.`id_empleos`, `empleos_anteriores`.`empresa`, `empleos_anteriores`.`jefe_inmediato`, `empleos_anteriores`.`ano_inicio`, `empleos_anteriores`.`ano_fin`, `empleos_anteriores`.`tel`, `areas`.*, `subarea`.`nombre`, `subarea`.`id_sub`, `industria`.* FROM `empleos_anteriores`, `areas`, `subarea`, `industria` WHERE `empleos_anteriores`.`id_area` = `areas`.`id_area` and `subarea`.`id_sub`  = `empleos_anteriores`.`id_sub` and `industria`.`id_industria` = `empleos_anteriores`.`id_industria` and `empleos_anteriores`.`id_empleos` =  $id";
$res_empant2 = $mysqli->query($sel_empant2);
$row_empant2 = $res_empant2->fetch_array();
if ($row_empant2[4] == "0000-00-00") {
  $opt = "checked";
  $val = "disabled";
}else
{
  $opt = "";
  $val = "";
}
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregue sus profesiones</h4>
                  </div>
                  <form method="post">
                  <div class="modal-body">
                    
                <div>
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-6">
                    <label>Empresa:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="mempant_empr" maxlength="46" value="<?php echo $row_empant2[1] ?>">
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
                        <select class="form-control" name="marea" maxlength="46" id="area">
                          <option value="<?php echo $row_empant2[6] ?>"><?php echo $row_empant2[7] ?></option>
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
                        <select class="form-control" name="msubarea" maxlength="46" id="subarea">
                          <option value="<?php echo $row_empant2[10] ?>"><?php echo $row_empant2[9] ?></option>
                        </select>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Jefe inmediato:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="mempant_jefe" maxlength="46" value="<?php echo $row_empant2[2] ?>">
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
                        <input type="date" class="form-control" name="mempant_anoi" maxlength="10" value="<?php echo $row_empant2[3] ?>">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Fecha final:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="date" class="form-control" name="mempant_anof" id="añof" maxlength="10" value="<?php echo $row_empant2[4] ?>" <?php echo $val ?>>
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
                        <select class="form-control" name="mindustria" maxlength="46">
                          <option value="<?php echo $row_empant2[11] ?>"><?php echo $row_empant2[12] ?></option>
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
                        <input type="tel" class="form-control" name="mempant_tel" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="<?php echo $row_empant2[5] ?>">
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->                    
                  </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="mguardarEmpant" value="<?php echo $row_empant2[0] ?>" id="guardarEmpant">Guardar</button>
                  </div>
                  </form>
                 