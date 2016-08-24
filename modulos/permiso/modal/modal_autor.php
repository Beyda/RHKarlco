<?php
include_once("../../../control/connect.php");
session_start();
$id_per = $_GET["id_per"];
$tipo = $_GET["tipo"];
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Autorización de permiso</h4>
                  </div>
                  <form method="POST" action="autorizar.php?tipo=<?php echo $tipo ?>">
                  <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Introduce tus observaciones" name="obs" />
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-danger pull-left" name="rechazar" value="<?php echo $id_per ?>">Rechazar permiso</button>
                    <button type="submit" class="btn btn-success" name="autorizar" value="<?php echo $id_per ?>">Autorizar permiso</button>
                  </div>
                  </form>