<?php
session_start();
require("../../../control/connect.php");
$id = $_GET["id"];
$sel_hdad2 = "SELECT * FROM `habilidades` WHERE `id_habilidad` = $id";
$res_hdad2 = $mysqli->query($sel_hdad2);
$row_hdad2 = $res_hdad2->fetch_array();
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar la habilidad</h4>
                  </div>
                  <form method="post">
                  <div class="modal-body">
                    
                           <div>
                          
                            <!-- habilidad -->
                              <div class="form-group">                                      
                              <div class="row">
                                <div class="col-lg-12">
                                <label>Habilidad:</label>
                                
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="fa fa-graduation-cap"></i>
                                    </span>
                                    <input type="text" class="form-control" id="mhdad" maxlength="20" value="<?php echo $row_hdad2["1"]; ?>"required>
                                  </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div><!-- /.row -->
                            </div><!-- /.form group -->
                            </div>
                    
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="act" value="<?php echo $id ?>" id="act">Actualizar</button>
                  </div>
                  </form>



                 