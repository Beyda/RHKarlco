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
                  <form method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <input class="form-control" placeholder="Empresa:" name="empresa" />
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
                      <input type="file" name="attachment" name="archivo" />
                    </div>
                    <p class="help-block">Max. 10MB</p>
                  </div>
                  </form>
                </div><!-- /.box-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-envelope-o"></i> Send</button>
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