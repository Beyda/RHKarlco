<?php
include_once("../../../control/connect.php");
session_start();
$id = $_GET["id"];
$sel_jefes = "SELECT j.*, p.`id_puesto`, p.`puesto`, u.`id_usuario`, u.`id_datosper`, d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, us.`id_usuario`, us.`id_datosper`, da.`id_datosper`, da.`primer_nombre`, da.`segundo_nombre`, da.`ap_paterno`, da.`ap_materno` FROM `jefes` j INNER JOIN `puestos` p ON j.`id_puesto` = p.`id_puesto` INNER JOIN `usuarios` u ON j.`id_jefin` = u.`id_usuario` INNER JOIN `datos_personales` d ON d.`id_datosper` = u.`id_datosper` INNER JOIN `usuarios` us ON j.`id_jefar` = us.`id_usuario` INNER JOIN `datos_personales` da ON da.`id_datosper` = us.`id_datosper` WHERE j.`id_jefes` = $id";       
$res_jefes = $mysqli->query($sel_jefes);
$row_jefes = $res_jefes->fetch_array();
?>
       
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modificar puesto</h4>
                  </div>
                  <form method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    
                <div class="empleos_anteriores">

                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Puesto:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-briefcase"></i>
                        </span>
                        <select class="form-control" name="Mpuesto" id="puesto" required>
                          <option value="<?php echo $row_jefes[4] ?>"><?php echo $row_jefes[5] ?></option>
                          <?php
                          $obt_puesto = "SELECT p.* FROM `puestos` p WHERE NOT EXISTS (SELECT * FROM `jefes` j WHERE p.`id_puesto` = j.`id_puesto`)";       
                          $res_puesto = $mysqli->query($obt_puesto);
                          while ($row_puesto = $res_puesto->fetch_array()) { 
                            ?>
                              <option value="<?php echo $row_puesto[0] ?>"><?php echo $row_puesto[1] ?></option>
                            <?php
                          }
                          ?>  
                        </select>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-12">
                    <label>Jefe inmediato:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="Mjefi" id="jefi" required>
                          <option value="<?php echo $row_jefes[6] ?>"><?php echo $row_jefes[9]." ".$row_jefes[10]." ".$row_jefes[11]." ".$row_jefes[12] ?></option>
                          <?php
                          $obt_ji = "SELECT u.`id_usuario`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, t.`nombre`  FROM `datos_personales` d INNER JOIN `usuarios` u ON d.`id_datosper` = u.`id_datosper`  INNER JOIN `tipo_usuario` t ON u.`id_tipous` = t.`id_tipous` WHERE t.`nombre` = 'Administrador' OR t.`nombre` = 'Jefe'";       
                          $res_ji = $mysqli->query($obt_ji);
                          while ($row_ji = $res_ji->fetch_array()) { 
                            ?>
                              <option value="<?php echo $row_ji[0] ?>"><?php echo $row_ji[1]. " ". $row_ji[2] . " ". $row_ji[3]. " ". $row_ji[4]. " - " . $row_ji[5] ?></option>
                            <?php
                          }
                          ?>  
                        </select>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-12">
                    <label>Jefe de área:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <select class="form-control" name="Mjefa" id="jefa" required>
                          <option value="<?php echo $row_jefes[13] ?>"><?php echo $row_jefes[16]." ".$row_jefes[17]." ".$row_jefes[18]." ".$row_jefes[19] ?></option>
                          <?php
                          $obt_ja = "SELECT u.`id_usuario`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, t.`nombre`  FROM `datos_personales` d INNER JOIN `usuarios` u ON d.`id_datosper` = u.`id_datosper`  INNER JOIN `tipo_usuario` t ON u.`id_tipous` = t.`id_tipous` WHERE t.`nombre` = 'Administrador' OR t.`nombre` = 'Jefe'";       
                          $res_ja = $mysqli->query($obt_ja);
                          while ($row_ja = $res_ja->fetch_array()) { 
                            ?>
                              <option value="<?php echo $row_ja[0] ?>"><?php echo $row_ja[1]. " ". $row_ja[2] . " ". $row_ja[3]. " ". $row_ja[4]. " - " . $row_ja[5] ?></option>
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
                  <button type="submit" class="btn btn-primary" name="id" value="<?php echo $row_jefes[0] ?>" id="guardar">Guardar</button>
                  </div>
                  </form>
                 