<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*/
    $id = $_GET["id"];
    $id_ar = $_GET["id_ar"];
?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Selecciona el estatus</h4>
                  </div>
                  <div class="modal-body">
                  <center>
                  
                    <a href="updtsb.php?id_sub=<?php echo $id ?>&val=1&id_ar=<?php echo $id_ar ?>"><img src="/rhkarlco/imagenes/activo.png" width="140px" height="140px"></a>
                    <a href="updtsb.php?id_sub=<?php echo $id ?>&val=0&id_ar=<?php echo $id_ar ?>"><img src="/rhkarlco/imagenes/inactivo.png" width="140px" height="140px"></a>
                  </center>
                  </div>
                  <div class="modal-footer">
                  </div>