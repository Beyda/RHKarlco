<?php 
  include_once("../../control/connect.php");
  session_start();
  $empresa = $_POST["empresa"];
?>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Empleados</h3>
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
      $obt_correo = "SELECT * FROM `correos` WHERE `id_empresa` = $empresa ORDER BY `id_correo` ASC";       
      $res_correo = $mysqli->query($obt_correo);
      while ($row_correo = $res_correo->fetch_array()) {
        $obt_empresa = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = $row_correo[1]";       
        $res_empresa = $mysqli->query($obt_empresa);
        $row_empresa = $res_empresa->fetch_array();
        ?>
        <tr>
          <td><a href=""><strong><?php echo $row_correo[2] ?></strong></a> - <?php echo substr($row_correo[3], 0, 90);?>...</td>
          <td><?php echo $row_empresa[0] ?></td>
          <td><?php 
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
            $ano = date("Y", strtotime($row_correo[5]));
            $dia = date('d', strtotime($row_correo[5]));
            $mes = date('n', strtotime($row_correo[5]));
            echo $dia." de ".$meses[$mes-1]. " de ".$ano ;
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