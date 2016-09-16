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
                  <div class="modal-body">
                  <div class="form-group">
                    <input class="form-control" placeholder="Empresa:"/>
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Asunto:"/>
                  </div>
                  <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px">
                    </textarea>
                  </div>
                  <div class="form-group">
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Archivo
                      <input type="file" name="attachment"/>
                    </div>
                    <p class="help-block">Max. 10MB</p>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="navbar-right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                  </div>
                </div><!-- /.box-footer -->
     
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