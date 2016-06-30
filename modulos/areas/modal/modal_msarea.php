<?php
session_start();
require("../../../control/connect.php");
$id = $_GET["id"];
$sel_area2 = "SELECT * FROM `subarea` WHERE `id_sub` = $id";
$res_area2 = $mysqli->query($sel_area2);
$row_area2 = $res_area2->fetch_array();
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modificar subarea</h4>
                  </div>
                  <form method="post">
                  <div class="modal-body">
                    
                           <div class="habilidad">
                          
                            <!-- habilidad -->
                              <div class="form-group">                                      
                              <div class="row">
                                <div class="col-lg-12">
                                <label>Subarea:</label>
                                
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="fa fa-graduation-cap"></i>
                                    </span>
                                    <input type="text" class="form-control" name="msarea" maxlength="20" value="<?php echo $row_area2[1] ?>" required>
                                  </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div><!-- /.row -->
                            </div><!-- /.form group -->
                            </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="btnsarea" value="<?php echo $row_area2[0] ?>" id="guardar">Guardar</button>
                  </div>
                  </form>
                 