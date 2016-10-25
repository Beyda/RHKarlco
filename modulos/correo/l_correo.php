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

?>
   <!-- *****************************************/.ajax tipo******************************** -->
  <script type="text/javascript">
  //Mostrar el tipo de resultado que se desea ver
  $(document).ready(function(){
      //Manda el tipo de información que se desea consultar
      $("#empresa").change(function(){
          var empresa=$(this).val();
          var dataString2 = 'empresa='+ empresa;
          $.ajax({
              type: "POST",
              url: "empresa.php",
              data: dataString2,
              cache: false,
          success: function(html){
          $("#result").html(html);
          }
          });
      });

    });
  </script>  

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <?php 
      if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Recursos Humanos") {
    ?>
      
        <section class="content-header">
          <h1>
            Lista de correos
            <small>enviados </small>
            <a href="modal/modal_correo.php?id=<?php echo $row_resemp[0]?>" data-toggle="modal" data-target=".bs-example-modal-lg" class='modalLoad'><button class="btn bg-navy margin" >Redactar</button></a>
          </h1>
          <form method="post" action="ajax_solic.php" id="fo3" name="fo3" >
            <select class="form-control tooltipster-shadow-preview" title="Filtrar los correos por empresa al seleccionarla" style="width: 30%;" name="empresa" id="empresa" required>
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
            </form>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="col-xs-12" id="result">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Correos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Asunto</th>
                        <th>Empresa</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    echo $obt_correo = "SELECT * FROM `correos` ORDER BY `id_correo` DESC";       
                    $res_correo = $mysqli->query($obt_correo);
                    while ($row_correo = $res_correo->fetch_array()) {
                      $obt_empresa = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = $row_correo[1]";       
                      $res_empresa = $mysqli->query($obt_empresa);
                      $row_empresa = $res_empresa->fetch_array();
                      ?>
                      <tr>
                        <td><a href="v_correo.php?id=<?php echo $row_correo[0]?>"><strong><?php echo $row_correo[2] ?></strong></a> - <?php echo substr($row_correo[3], 0, 90);?>...</td>
                        <td><?php echo $row_empresa[0] ?></td>
                        <td><?php 
                          $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                          $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                          $ano = date("Y", strtotime($row_correo[5]));
                          $dia = date('d', strtotime($row_correo[5]));
                          $mes = date('n', strtotime($row_correo[5]));
                          echo
                           $dia." de ".$meses[$mes-1]. " de ".$ano ;
                        ?></td>
                      </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Asunto</th>
                        <th>Empresa</th>
                        <th>Fecha</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

            <?php
            if (isset($_POST["empresa"])) {
              include "cls_correo.php";
              $empresa = $_POST["empresa"];
              $asunto = $_POST["asunto"];
              $mensaje = $_POST["mensaje"];
              $archivo = $_FILES['archivo']['name'];
              $type = $_FILES['archivo']['type'];
              $tamano = $_FILES['archivo']['size'];
              $tmp_name = $_FILES['archivo']['tmp_name'];
              $error = $_FILES['archivo']['error'];
              $clasCorreo = new correo($empresa, $asunto, $mensaje, $archivo, $type, $tamano, $tmp_name, $error);
              $clasCorreo->insertar();
            }
              }
              if ($tipo_usuario_session == "Empleado" || $tipo_usuario_session == "Jefe") {
    ?>
      
        <section class="content-header">
          <h1>
            Lista de correos
            <small>enviados </small>
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="col-xs-12" id="result">
              <?php
          $obt_emp = "SELECT DISTINCT p.`id_empresa` FROM `puesto_per` pp INNER JOIN `puestos` p ON pp.`id_datosper` = $_SESSION[id_datosper] AND pp.`id_puesto` = p.`id_puesto`";       
          $res_emp = $mysqli->query($obt_emp);
          $row_demp = $res_emp->fetch_array();
          $row_emp = $res_emp->num_rows;
          if ($row_emp > 0) {
            ?>

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Correos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-striped">
                    <thead>
                      <tr>
                        <th>Asunto</th>
                        <th>Empresa</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $obt_correo = "SELECT * FROM `correos` WHERE `id_empresa` = $row_demp[0] ORDER BY `id_correo` DESC";       
                    $res_correo = $mysqli->query($obt_correo);
                    while ($row_correo = $res_correo->fetch_array()) {
                      $obt_empresa = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = $row_correo[1]";
                      $res_empresa = $mysqli->query($obt_empresa);
                      $row_empresa = $res_empresa->fetch_array();
                      ?>
                      <tr>
                        <td><a href="v_correo.php?id=<?php echo $row_correo[0]?>"><strong><?php echo $row_correo[2] ?></strong></a> - <?php echo substr($row_correo[3], 0, 90);?>...</td>
                        <td><?php echo $row_empresa[0] ?></td>
                        <td><?php 
                          $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                          $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                          $ano = date("Y", strtotime($row_correo[5]));
                          $dia = date('d', strtotime($row_correo[5]));
                          $mes = date('n', strtotime($row_correo[5]));
                          echo
                           $dia." de ".$meses[$mes-1]. " de ".$ano ;
                        ?></td>
                      </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Asunto</th>
                        <th>Empresa</th>
                        <th>Fecha</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <?php
            }//termina if de obtener el id de la empresa del empleado
            else
            {
              ?>
              <h1>No hay correos ya que no perteneces a ninguna empresa</h1>
              <?php
            }
            ?>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

            <?php
              }
            ?>
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->

    <script type="text/javascript">

      $(function () {
        $("#example1").dataTable();
        /*$('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });*/
      });
    </script>
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

      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            
          </div>
        </div>
      </div>
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
