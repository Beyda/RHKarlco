<?php
include_once("../../../control/connect.php");
session_start();
?>
       
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar puesto</h4>
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
                        <select class="form-control" name="puesto" id="puesto" required>
                          <option value="">Selecciona un puesto</option>
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
                        <select class="form-control" name="jefi" id="jefi" required>
                          <option value="">Selecciona un jefe inmeadiato</option>
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
                        <select class="form-control" name="jefa" id="jefa" required>
                          <option value="">Selecciona un jefe de área</option>
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
                  <button type="submit" class="btn btn-primary" name="id_jefe" value="ho" id="guardar">Guardar</button>
                  </div>
                  </form>
                 