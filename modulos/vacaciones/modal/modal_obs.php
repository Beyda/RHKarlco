<?php
include_once("../../../control/connect.php");
session_start();
$id_vac = $_GET["id_vac"];
$ctr_obs = "SELECT `jefe_in`, `fecha_in`, `obs_in`, `jefe_ar`, `fecha_ar`, `obs_ar`, `rh`, `fecha_rh`, `obs_rh` FROM `vacaciones` WHERE `id_vaca` = $id_vac";
$res_obs = $mysqli->query($ctr_obs);
$row_resobs = $res_obs->fetch_array();
?>
<script type="text/javascript" src="/rhkarlco/bootstrap/js/scripts.js"></script>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Lista de solicitudes</h4>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-12">
              <!-- The time line -->
              <ul class="timeline">
                <!-- timeline time label -->
                <?php
                if ($row_resobs[0] != NULL) {
                ?>
                <li class="time-label">
                  <span class="bg-red">
                    <?php echo $row_resobs[1] ?>
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-user bg-blue"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header"><a href="#">Jefe inmediato</a> da la siguiente observación</h3>
                    <div class="timeline-body">
                      <?php echo $row_resobs[2] ?>
                    </div>
                  </div>
                </li>
                <?php
                  }
                ?>
                <!-- END timeline item -->
                <!-- timeline time label -->
                <?php
                if ($row_resobs[3] != NULL) {
                ?>
                <li class="time-label">
                  <span class="bg-yellow">
                    <?php echo $row_resobs[4] ?>
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-user bg-purple"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header"><a href="#">Jefe de área</a> da la siguiente observación</h3>
                    <div class="timeline-body">
                      <?php echo $row_resobs[5] ?>
                    </div>
                  </div>
                </li>
                <?php
                  }
                ?>
                <!-- END timeline item -->
                <!-- timeline time label -->
                <?php
                if ($row_resobs[6] != NULL) {
                ?>
                <li class="time-label">
                  <span class="bg-green">
                    <?php echo $row_resobs[7] ?>
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-user bg-yellow"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header"><a href="#">Recursos Humanos</a> da la siguiente observación</h3>
                    <div class="timeline-body">
                      <?php echo $row_resobs[8] ?>
                    </div>
                  </div>
                </li>
                <?php
                  }else
                  {
                ?>
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header">No hay comentarios hasta el momento</h3>
                    <div class="timeline-body">
                      <?php echo $row_resobs[8] ?>
                    </div>
                  </div>
                </li>
                <?php
                  }
                ?>
                <!-- END timeline item -->
                
              </ul>
            </div><!-- /.col -->
                
                  </div>
                  <div class="modal-footer">
                  </div>
     