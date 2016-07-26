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
        <section class="content-header">
          <h1>
            Lista de empresas
            <a href="modal/modal_empresa.php" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn bg-navy margin">Agregar una empresa</button></a>
          </h1>
        </section>

        <section class="content">
        
          <div class="row">
          <?php 
          $ver_emp = "SELECT * FROM `empresas`";
          $resul_verempresa = $mysqli->query($ver_emp);
          while ( $row_emp = $resul_verempresa->fetch_array()) 
          {
          ?>
            <div class="col-md-4">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-building-o"></i>
                  <h3 class="box-title tooltipster-shadow-preview" title="Nombre de la empresa"><?php echo $row_emp[1] ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <center>
                <img src="../carga_archivos/archivos_subidos/empresas/<?php echo $row_emp[8] ?>" height="190px" >
                <br>
                <a href="modal/modal_mempresa.php?id=<?php echo $row_emp[0] ?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn bg-olive btn-flat margin">Editar</button></a>
                <div class="btn-group">
                <?php
                if ($row_emp[9] == 1) {
                  $valor = "Activo";
                  $boton = "btn btn-success";
                }
                if ($row_emp[9] == 0) {
                  $valor = "Inactivo";
                  $boton = "btn btn-danger";
                }

                ?>
                      <button type="button" class="<?php echo $boton ?>"><?php echo $valor ?></button>
                      <button type="button" class="<?php echo $boton ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="cls_empresa.php?status=1&empresa=<?php echo $row_emp[0] ?>">Activo</a></li>
                        <li><a href="cls_empresa.php?status=0&empresa=<?php echo $row_emp[0] ?>">Inactivo</a></li>
                      </ul>
                    </div>
                </center>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- ./col -->
          <?php
          }
          ?>
          </div><!-- /.row -->

<?php  
  if (isset($_POST["nombre"])) {
    include "cls_empresa.php";
    $nombre = $_POST["nombre"];
    $dir = $_POST["dir"];
    $sweb = $_POST["sweb"];
    $rfc = $_POST["rfc"];
    $correo = $_POST["correo"];
    $tel = $_POST["tel"];
    $desc = $_POST["desc"];
    $archivo = $_FILES['archivo']['name'];
    $type = $_FILES['archivo']['type'];
    $tamano = $_FILES['archivo']['size'];
    $tmp_name = $_FILES['archivo']['tmp_name'];
    $error = $_FILES['archivo']['error'];

    $classEmp = new empresa ("$nombre", "$dir", "$sweb", "$rfc", "$correo", $tel, "$desc", $archivo, $type, $tamano, $tmp_name, $error, 0);
    $classEmp->insertar();

  }
  if (isset($_POST["Mnombre"])) {
    include "cls_empresa.php";
    $nombre = $_POST["Mnombre"];
    $dir = $_POST["Mdir"];
    $sweb = $_POST["Msweb"];
    $rfc = $_POST["Mrfc"];
    $correo = $_POST["Mcorreo"];
    $tel = $_POST["Mtel"];
    $desc = $_POST["Mdesc"];
    $archivo = $_FILES['Marchivo']['name'];
    $type = $_FILES['Marchivo']['type'];
    $tamano = $_FILES['Marchivo']['size'];
    $tmp_name = $_FILES['Marchivo']['tmp_name'];
    $error = $_FILES['Marchivo']['error'];
    $id = $_POST["id"];
    if($error == 0)
    {
      $classEmp = new empresa ("$nombre", "$dir", "$sweb", "$rfc", "$correo", $tel, "$desc", $archivo, $type, $tamano, $tmp_name, $error, $id);
      $classEmp->actualizar();
    }if($error != 0)
    {
      $classEmp = new empresa ("$nombre", "$dir", "$sweb", "$rfc", "$correo", $tel, "$desc", 0, 0, 0, 0, $error, $id);
      $classEmp->actualizar();
    }

  }

?>

</section>
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