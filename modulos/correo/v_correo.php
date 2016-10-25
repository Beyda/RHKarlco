<?php
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION["session"])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION["session"];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 //$avatar_session=$_SESSION["avatar_session"];
 
//$id_tmp = uniqid('', true);
include("../../template/todo2.php");
//inicio de librerias 
$id = $_GET["id"];
$obt_correo = "SELECT c.*, e.`nombre` FROM `correos` c INNER JOIN `empresas` e ON c.`id_empresa` = e.`id_empresa` AND c.`id_correo` = $id";       
$res_correo = $mysqli->query($obt_correo);
$row_correo = $res_correo->fetch_array();
?> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <?php 
    if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Recursos Humanos" || $tipo_usuario_session == "Jefe" || $tipo_usuario_session == "Empleado") {
    ?>
      <section class="content-header">
        <h1>
          Correo
          <small>recibido </small>
          <a href="l_correo.php"><button class="btn btn-info margin" >Regresar al listado de correos</button></a>
        </h1>
      </section>

      <section class="content">
          <div class="row">
          <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Leer correo</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-read-info">
                    <h3><?php echo $row_correo[2] ?></h3>
                    <h5>De: rhkarlco@gmail.com <span class="mailbox-read-time pull-right">
                    <?php 
                      $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                      $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                      $ano = date("Y", strtotime($row_correo[5]));
                      $dia = date('d', strtotime($row_correo[5]));
                      $mes = date('n', strtotime($row_correo[5]));
                      echo
                       $dia." de ".$meses[$mes-1]. " de ".$ano ;
                    ?>
                        </span></h5>
                  </div><!-- /.mailbox-read-info -->
                  <div class="mailbox-read-message">
                    <?php echo $row_correo[3] ?>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                <div class="box-footer">
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
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
    <?php
      }
    ?>
  </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->
</body>
<?php 
require('../../template/footer.php');
    ?>
    </div><!-- ./wrapper -->

    <!-- ./Footer -->
  
</html>
<?php
} else{
header("location: /rhkarlco/login.php");
}
?>
