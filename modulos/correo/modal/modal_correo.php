<?php
include_once("../../../control/connect.php");
session_start();
$id = $_GET["id"];
?>
<script type="text/javascript" src="/rhkarlco/bootstrap/js/scripts.js"></script>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Correo</h4>
                  </div>
                  <form method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                  <div class="form-group">
                    <select class="form-control tooltipster-shadow-preview" title="Seleccionar la empresa a quienes se envía el correo" style="width: 30%;" name="empresa" id="empresa" required>
                      <option value="">Selecciona una empresa</option>
                      <?php
                      $obt_emp = "SELECT * FROM `empresas` WHERE `status` = 1";       
                      $res_emp = $mysqli->query($obt_emp);
                      while ($row_emp = $res_emp->fetch_array()) { 
                        ?>
                          <option value="<?php echo $row_emp[0] ?>"><?php echo $row_emp[1] ?></option>
                        <?php
                      }
                      ?>  
                    </select>
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Asunto:" name="asunto" />
                  </div>
                  <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="mensaje"></textarea>
                  </div>
                  <div class="form-group">
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Archivo
                      <input type="file" name="archivo"/>
                    </div>
                    <p class="help-block">Max. 10MB</p>
                  </div>
                </div><!-- /.box-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-envelope-o"></i> Send</button>
                </div><!-- /.box-footer -->
              </form>
     
    <script type="text/javascript">

      $(document).ready(function(){
        $('.modalOb').click(function() { 
          $('.modal').modal('show'); 
          $('.modal-content').val('');
          $('.modal-content').load($(this).attr('href'));
           return false;
        });

      });
      </script>

      <div class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            
          </div>
        </div>
      </div>