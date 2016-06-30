<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*/
include_once("../../control/connect.php"); 

session_start();
if (isset($_SESSION['login_session'])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION['login_session'];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];session_start();
if (isset($_SESSION['login_session'])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION['login_session'];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 session_start();
if (isset($_SESSION['login_session'])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION['login_session'];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 //$avatar_session=$_SESSION["avatar_session"];
 
//$id_tmp = uniqid('', true);


?> 
<?php 
//inicio de librerias 

include('../../template/libs.html');
include('../../template/script.html');
//Final de Librerrias
?>

   <body class="skin-green sidebar-collapse">
    <div class="wrapper">
      
<?php 
//Inicio de cabecera y navegacion
include('../../template/header.php');
include('../../template/nav.php');
//Final de Cabecera y Navegacion


?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
                <?php 
                  if ($tipo_usuario_session == "Administrador") {
                ?>
        <section class="content-header">
        <div class="col-xs-3">
          <h3>
            Filtros
          </h3>
        </div>
        <div class="col-xs-9">
          <h3>
            Lista de solicitantes
          </h3>
        </div>

        </section>

        <!-- Main content -->

<script language="javascript">
$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    $('#form, #fat, #fo3').submit(function() {
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                $('#result').html(data);

            }
        })
        
        return false;
    }); 
})  
</script>
        <section class="content">
          <div class="row">

            <div class="col-xs-3">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Habilidades</h3>
                </div><!-- /.box-header style="overflow-y: auto;"-->
                <div class="box-body" >
                <form method="post" action="filtrado.php" id="fo3" name="fo3" >
                <select data-placeholder="Selecciona habilidades" name="habilidades[]" class="chosen-select" multiple style="width:350px;" tabindex="4">
                  <option value=""></option>
                  <?php
                    $ctr_emp = "SELECT * FROM `l_habilidad` ORDER BY `nombre` ASC";
                    $res_emp = $mysqli->query($ctr_emp);
                    while ($row_resemp = $res_emp->fetch_array()) 
                    {
                    ?>
                    <option value="<?php echo $row_resemp[0] ?>"><?php echo $row_resemp[1] ?></option>
                    <?php
                    }
                  ?>
                  </select>
                </div><!-- /.box-body -->
                <div class="box-header">
                  <h3 class="box-title">Carreras</h3>
                </div><!-- /.box-header style="overflow-y: auto;"-->
                <div class="box-body">
                <form method="post">
                <select data-placeholder="Selecciona carreras" name="carreras[]" class="chosen-select" multiple style="width:100%;" tabindex="4">
                  <option value=""></option>
                  <?php
                    $ctr_emp = "SELECT * FROM `carreras` ORDER BY `nombre` ASC";
                    $res_emp = $mysqli->query($ctr_emp);
                    while ($row_resemp = $res_emp->fetch_array()) 
                    {
                    ?>
                    <option value="<?php echo $row_resemp[0] ?>"><?php echo $row_resemp[1] ?></option>
                    <?php
                    }
                  ?>
                  </select>
                </div><!-- /.box-body -->
                  <button class="btn bg-navy margin" style="width: 50%;">Buscar</button>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->


            <div class="col-xs-9" id="result">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Solicitantes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Perfil</th>
                        <th>Emplear</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ctr_emp = "SELECT `primer_nombre`, `ap_paterno`, `id_datosper`, `estatus` FROM `datos_personales` where `solicitante` = 1 ORDER BY `primer_nombre` ASC";
                    $res_emp = $mysqli->query($ctr_emp);
                    while ($row_resemp = $res_emp->fetch_array()) {
                      ?>
                      <tr>
                        <td><?php echo $row_resemp[0]?> <?php echo $row_resemp[1]?></td>
                        <td><center><a href="../empleados/a_perfil.php?id=<?php echo $row_resemp[2]?>"><button class="btn bg-olive margin" style="width: 50%;">Ver</button></a></center></td>
                        <td><center><button class="btn bg-blue margin sweet-4" style="width: 50%;" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-4']);">
                        Confirmar</button></center></td>
                      </tr>
                      <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Perfil</th>
                        <th>Emplear</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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

      document.querySelector('.sweet-4').onclick = function(){
        swal({
          title: "¿Desea convertirlo como empleado?",
          text: "Clic en si para continuar",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-primary',
          confirmButtonText: 'Si, continuar',
          closeOnConfirm: false,
          //closeOnCancel: false
        },
        function(){
          swal("Felicidades!", "Crearle un usuario al empleado!", "success");
        });
      };
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

      <div class="example-modal">
            <div class="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->


  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>


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


