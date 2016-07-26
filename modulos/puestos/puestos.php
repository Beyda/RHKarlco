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
 
$id = uniqid('', true);
include("../../template/todo2.php");
//inicio de librerias 

?>

<div class="content-wrapper">
        <?php
        if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Recursos Humanos"){
        ?>
        <section class="content-header">
          <h1>
            Lista de empresas
          </h1>
        </section>
        

        <section class="content">
        
          <div class="row">
          <?php 
          $ver_emp = "SELECT * FROM `empresas` WHERE `status` = 1";
          $resul_verempresa = $mysqli->query($ver_emp);
          while ( $row_emp = $resul_verempresa->fetch_array()) 
          {
            $ver_p = "SELECT * FROM `puestos` WHERE `id_empresa` = $row_emp[0]";
            $resul_verp = $mysqli->query($ver_p);
            $numrowsP = $resul_verp->num_rows;
          ?>
            <div class="col-md-4">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-building-o"></i>
                  <h3 class="box-title tooltipster-shadow-preview" title="Nombre de la empresa"><?php echo $row_emp[1] ?></h3><strong style="float: right; font-size: 150%" class="tooltipster-shadow-preview" title="Número de puestos en esta empresa"><?php echo $numrowsP ?></strong>
                </div><!-- /.box-header -->
                <div class="box-body">
                <center>
                <img src="../carga_archivos/archivos_subidos/empresas/<?php echo $row_emp[8] ?>" height="190px" >
                <br>
                <a href="l_puestos.php?id=<?php echo $row_emp[0] ?>"><button class="btn bg-olive btn-flat margin">Ver puestos</button></a>
                </center>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- ./col -->
          <?php
          }
          ?>
          </div><!-- /.row -->


</section>

<?php
}
?>
</div>
</body>
<script type="text/javascript">

      $(document).ready(function(){
        $('.modalLoad').click(function() { 
          $('.modal').modal('show'); 
          $('.modal-content').val('');
          $('.modal-content').load($(this).attr('href'));
           return false;

        });

      });
      </script>

      <div class="example-modal">
            <div class="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->

<?php 
require('../../template/footer.php');
    ?>
    </div><!-- ./wrapper -->

    <!-- ./Footer -->
  </body>
</html>

<?php
} else{
header("location: /rhkarlco/login.php");
}
?>