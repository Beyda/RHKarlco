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
     

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <?php 
      if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Jefe" || $tipo_usuario_session == "Recursos Humanos") {
        $rh = "SELECT d.`id_datosper` FROM `datos_personales` d INNER JOIN `usuarios` u ON u.`id_datosper` = d.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` AND t.`nombre` = 'Recursos Humanos'";
        $res_rh = $mysqli->query($rh);
        $row_rh = $res_rh->fetch_array();
    ?>


<!-- *****************************************/.ajax tipo******************************** -->
  <script type="text/javascript">
  //Mostrar el tipo de resultado que se desea ver
  $(document).ready(function(){
      //Manda el tipo de información que se desea consultar
      $("#tipo").change(function(){
          var tipo=$(this).val();
          var dataString2 = 'tipo='+ tipo;
          $.ajax({
              type: "POST",
              url: "l_solic.php",
              data: dataString2,
              cache: false,
          success: function(html){
          $("#result").html(html);
          }
          });
      });

    });
  </script>
      
        <section class="content-header">
          <h1>
            Lista de solicitudes
            <small>de permisos </small>
            <a href="solicitud.php?id=<?php echo $_SESSION["id_datosper"] ?>" class='tooltipster-shadow-preview' title="Abrir una solicitud de permisos" target="blanck"><button class="btn bg-navy margin">Solicitar permiso</button></a>
            <form method="post" action="ajax_solic.php" id="fo3" name="fo3" >
            <select class="form-control tooltipster-shadow-preview" title="Busca las diferentes solicitudes" style="width: 30%;" name="tipo" id="tipo" required>
              <option value="">Selecciona que mostrar</option>
              <?php 
                if ($tipo_usuario_session == "Administrador" || $tipo_usuario_session == "Recursos Humanos") {
              ?>
              <option value="3">Todas las solicitudes</option>
              <?php
                }
              ?>
              <option value="0">Solicitudes pendientes</option>
              <option value="1">Solicitudes autorizadas</option>
              <option value="2">Mis solicitudes</option>
            </select>
            </form>
          </h1>
        </section>
      

            <?php
            require('pendiente.php');
              }
            ?>
<?php 
      if ($tipo_usuario_session == "Empleado") {
    ?>

<!-- *****************************************/.ajax tipo******************************** -->
  <script type="text/javascript">
  //Mostrar el tipo de resultado que se desea ver
  $(document).ready(function(){


      //Manda el tipo de información que se desea consultar
      $("#tipo").change(function(){
          var tipo=$(this).val();
          var dataString2 = 'tipo='+ tipo;
          $.ajax({
              type: "POST",
              url: "l_solic.php",
              data: dataString2,
              cache: false,
          success: function(html){
          $("#result").html(html);
          }
          });
      });


      

    });
  </script>
      
        <section class="content-header">
          <h1>
            Lista de solicitudes
            <small>de permisos </small>
            <a href="solicitud.php?id=<?php echo $_SESSION["id_datosper"] ?>" class='tooltipster-shadow-preview' title="Abrir una solicitud de permisos" target="blanck"><button class="btn bg-navy margin">Solicitar permiso</button></a>
          </h1>
        </section>
                  <?php
                  require('mias.php');
              }
?>
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->

    <script type="text/javascript">

     function autorizar(id, etapa){
        swal({
        title: "¿Desea autorizar estas vacaciones?",
        text: "Escribir las observaciones",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        inputPlaceholder: "Observaciones"
      }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") 
        swal("Bien!", "solicitud autorizada" , "success");
        window.location.href = "autorizar.php?idvac="+id.value+"&obs="+inputValue+"&tipo="+etapa;
      });
      };

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

  </body>
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
