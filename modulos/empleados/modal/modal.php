<?php
    $id = $_GET["id"];
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Selecciona el estatus</h4>
                  </div>
                  <div class="modal-body">
                  <center>
                  
                    <a href="updt.php?id=<?php echo $id ?>&val=1"><img src="/rhkarlco/imagenes/activo.png" width="150px" height="150px"></a>
                    <a href="updt.php?id=<?php echo $id ?>&val=2"><img src="/rhkarlco/imagenes/permiso.png" width="150px" height="150px"></a>
                    <a href="updt.php?id=<?php echo $id ?>&val=3"><img src="/rhkarlco/imagenes/baja.png" width="150px" height="150px"></a>
                  </center>
                  </div>
                  <div class="modal-footer">
                  </div>