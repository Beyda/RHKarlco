<?php
include_once("../../../control/connect.php");
session_start();
$id = $_GET["id"];
$obt_correo = "SELECT c.*, e.`nombre` FROM `correos` c INNER JOIN `empresas` e ON c.`id_empresa` = e.`id_empresa` AND c.`id_correo` = $id";       
$res_correo = $mysqli->query($obt_correo);
$row_correo = $res_correo->fetch_array();
?>

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Correo</h4>
                  </div>
                  <form method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                  <div class="form-group">
                    <label><?php echo $row_correo[7] ?></label>
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="asunto" value="<?php echo $row_correo[2] ?>" disabled="" />
                  </div>
                  <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="mensaje" disabled=""><?php echo $row_correo[3] ?></textarea>
                  </div>
                </div><!-- /.box-body -->
                <div class="modal-footer">
                    <!--<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-envelope-o"></i> Send</button>-->
                    <ul class="mailbox-attachments clearfix">
                    <?php
                    if ($row_correo[4] != "") {
                    $archivo = "../carga_archivos/correos/$row_correo[4]";
                    $extension = end( explode('.', $archivo) );
                    if ($extension == "jpg" || $extension == "png" || $extension == "PNG") {
                      ?>
                    <li>
                      <span class="mailbox-attachment-icon has-img"><img src="<?php echo $archivo ?>" alt="Attachment"/></span>
                      <div class="mailbox-attachment-info">
                        <span class="mailbox-attachment-size">
                        <a href="<?php echo $archivo ?>" target="blanck" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo $row_correo[4] ?></a>
                          <a href="<?php echo $archivo ?>" target="blanck" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                    <?php
                    }else
                    {
                      ?>
                    <li>
                      <span class="mailbox-attachment-icon"><i class="fa fa-file-text-o"></i></span>
                      <div class="mailbox-attachment-info">
                        
                        <span class="mailbox-attachment-size">
                        <a href="<?php echo $archivo ?>" target="blanck" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo $row_correo[4] ?></a>
                          <a href="<?php echo $archivo ?>" target="blanck" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                      <?php
                    }
                   }
                    ?>
                  </ul>
                </div><!-- /.box-footer -->
              </form>
     