
<?php 
//inicio de librerias 

require_once('/../template/libs.html');
require_once('/../template/script.html');
//Final de Librerrias
?>

   <body class="skin-blue">
    <div class="wrapper">
      
      
      
<?php 
//Inicio de cabecera y navegacion
require_once('/../template/header.php');
require_once('/../template/nav.php');
//Final de Cabecera y Navegacion


?>
  <style>
      .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
      }
      .example-modal .modal {
        background: transparent!important;
      }
    </style>
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Borrar usuario
            <small>Karlco Group</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
        </section>

        <!-- Main content -->
         <section class="content">
          <div class="example-modal">
            <div class="modal modal-danger">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal Danger</h4>
                  </div>
                  <div class="modal-body">
                    <p>Estas seguro de borrar este usuario?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline">Borrar</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->

              

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    <?php

require_once('/../template/footer.php');
    ?>
    </div><!-- ./wrapper -->


  
  </body>
</html>