<?php
include_once("../../../control/connect.php");
session_start();
if (isset($_GET["id"])) {
  $id = $_GET["id"];

  $selfest = "SELECT * FROM `dias_festivos` WHERE `id_festivos` = $id";
  $resul_selfest = $mysqli->query($selfest);
  $row_selfest = $resul_selfest->fetch_array();
   
  ?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modificar día festivo</h4>
                  </div>
                  <form method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    
                <div class="empleos_anteriores">

                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-5">
                    <label>Día festivo:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input type="date" class="form-control" value="<?php echo $row_selfest[1] ?>" name="Mfecha" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-7">
                    <label>Descripción:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-pencil"></i>
                        </span>
                        <input type="text" class="form-control" value="<?php echo $row_selfest[2] ?>" maxlength="100" name="Mdesc" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                  </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="Mid" value="<?php echo $row_selfest[0] ?>" id="guardar">Guardar</button>
                  </div>
                  </form>
  <?php
}else
{
?>
       
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar días festivos</h4>
                  </div>
                  <form method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    
                <div class="empleos_anteriores">

                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-5">
                    <label>Día festivo:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input type="date" class="form-control" name="fecha" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-7">
                    <label>Descripción:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-pencil"></i>
                        </span>
                        <input type="text" class="form-control" maxlength="100" name="desc" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->


                  </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="id_jefe" value="ho" id="guardar">Guardar</button>
                  </div>
                  </form>
<?php
}
?>