<?php
include_once("../../control/connect.php");
session_start();  
$tipo = $_POST["tipo"];
$disable = "disabled";
$personal = "ocultar";
if ($tipo == 0) {
  $query = "SELECT DISTINCT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno` FROM `vacaciones` v INNER JOIN `datos_personales` d ON v.`id_solicitante` = d.`id_datosper`";
  $ver = "enable";
}
elseif ($tipo == 1) {
  $query = "SELECT DISTINCT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno` FROM `vacaciones` v INNER JOIN `datos_personales` d ON v.`id_solicitante` = d.`id_datosper` INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `jefes` j ON pp.`id_puesto` = j.`id_puesto` WHERE  j.`id_jefin` = $_SESSION[id_datosper] OR j.`id_jefar` = $_SESSION[id_datosper] AND pp.`fecha_final` = '0000-00-00'";
  $ver = "enable";

}
elseif ($tipo == 2) {
  $query = "SELECT DISTINCT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, e.`nombre`, p.`puesto`, v.`etapa`, p.`id_puesto`, v.`id_vaca` FROM `datos_personales` d INNER JOIN `vacaciones` v ON d.`id_datosper` = v.`id_solicitante` INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` WHERE v.`id_solicitante` = $_SESSION[id_datosper] AND pp.`fecha_final` = '0000-00-00' ORDER BY v.`fecha_rh` ASC";
  $personal = "ver";
}
?>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Empleados</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
  <?php
    if ($personal == "ocultar") {
  ?>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Empresa</th>
          <th>Puesto</th>
          <th>Autorización</th>
          <?php
          if($tipo != 2){
          ?>
          <th>Vacaciones</th>
          <?php
        }
          ?>
        </tr>
      </thead>
      <tbody>
      <?php
      $ctr_emp = $query;
      $res_emp = $mysqli->query($ctr_emp);
      while ($row_resemp = $res_emp->fetch_array()) {
            $ctr_etapa = "SELECT `id_vaca`, `etapa` FROM `vacaciones` WHERE `id_solicitante` = $row_resemp[0] ORDER BY `fecha` DESC LIMIT 1";
            $res_etapa = $mysqli->query($ctr_etapa); //Consulta el estatus de la ultima solicitud de vacaciones de este empleado
            $row_resetapa = $res_etapa->fetch_array();
        if ($tipo == 0) {
          $epv = "SELECT DISTINCT e.`nombre`, p.`puesto`, v.`etapa`, p.`id_puesto` FROM `datos_personales` d INNER JOIN `vacaciones` v ON d.`id_datosper` = v.`id_solicitante` AND d.`id_datosper` = $row_resemp[0] INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` AND pp.`fecha_final` = '0000-00-00' INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` ORDER BY v.`fecha` DESC LIMIT 1";
          $res_epv = $mysqli->query($epv);
          $row_resepv = $res_epv->fetch_array();
          $empresa = $row_resepv[0];
          $puesto = $row_resepv[1];
          $id_pu = $row_resepv[3];
          $etapa = $row_resetapa[1];
        }
        elseif ($tipo == 1)
        {
          $epv = "SELECT DISTINCT e.`nombre`, p.`puesto`, v.`etapa`, p.`id_puesto` FROM `datos_personales` d INNER JOIN `vacaciones` v ON d.`id_datosper` = v.`id_solicitante` AND d.`id_datosper` = $row_resemp[0] INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` ORDER BY v.`fecha` DESC LIMIT 1";
          $res_epv = $mysqli->query($epv);
          $row_resepv = $res_epv->fetch_array();
          $empresa = $row_resepv[0];
          $puesto = $row_resepv[1];
          $id_pu = $row_resepv[3];
          $etapa = $row_resetapa[1];
        }
        elseif ($tipo == 2)
        {
          $empresa = $row_resemp[5];
          $puesto = $row_resemp[6];
          $id_pu = $row_resemp[8];
          $ver = "enable";
        }
        
        

            
            if ($tipo == 2) {
              $etapa = $row_resemp[7];
            }

            $ctr_jefpu = "SELECT * FROM `jefes` WHERE `id_puesto` = $id_pu";
            $res_jefpu = $mysqli->query($ctr_jefpu); //Consulta el estatus de la ultima solicitud de vacaciones de este empleado
            $row_resjefpu = $res_jefpu->fetch_array();

            if ($etapa == 0) {
              $etapa2 = "btn btn-block btn-danger";
              $valor = "Jefe inmediato";
              $link = "#";
              if ($row_resjefpu[2] == $_SESSION["id_datosper"]) {
                $disable = "enable";
                $ver = "enable";
              }
            }
            elseif ($etapa == 1) {
              $etapa2 = "btn btn-block btn-warning";
              $valor = "Jefe de área";
              $link = "#";
              if ($row_resjefpu[3] == $_SESSION["id_datosper"]) {
                $disable = "enable";
                $ver = "enable";
              }
            }
            elseif ($etapa == 2) {
              $etapa2 = "btn btn-block btn-info";
              $valor = "Recursos Humanos";
              $link = "#";
              if ($row_resjefpu[4] == $_SESSION["id_datosper"]) {
                $disable = "enable";
                $ver = "enable";
              }
            }
            elseif ($etapa == 3) {
              $etapa2 = "btn btn-block btn-success";
              $valor = "Autorizado";
              $link = "#";
            }

            if ($ver == "enable") {
              
            
        ?>
        <tr>
          <td><?php echo $row_resemp[1] ." ". $row_resemp[2] ." ". $row_resemp[3] ." ". $row_resemp[4] ?></td>
          <td><?php echo $empresa ?></td>
          <td><?php echo $puesto ?></td>
          <td>
            <center><button class="<?php echo $etapa2 ?>" onclick="autorizar(this, '<?php echo $etapa; ?>')"style="width: 50%;" <?php echo $disable ?> value="<?php echo $row_resetapa[0]?>"><?php echo $valor ?></button></center>
          </td>
          <?php
          if($tipo != 2){
          ?>
          <td><center><a href="modal/modal.php?id=<?php echo $row_resemp[0]?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn bg-blue margin" style="width: 50%;">Ver</button></a></center></td>
          <?php
        }
          ?>
        </tr>
        <?php
               }
          }
          ?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nombre</th>
          <th>Empresa</th>
          <th>Puesto</th>
          <th>Autorización</th>
          <?php
          if($tipo != 2){
          ?>
          <th>Vacaciones</th>
          <?php
        }
          ?>
        </tr>
      </tfoot>
    </table>
    <?php
      }
      else
      {
    ?>
      <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Empresa</th>
          <th>Puesto</th>
          <th>Autorización</th>
          <th>Solicitud</th>
          <th>Observaciones</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $ctr_emp = $query;
      $res_emp = $mysqli->query($ctr_emp);
      while ($row_resemp = $res_emp->fetch_array()) {
            $ctr_etapa = "SELECT `id_vaca`, `etapa` FROM `vacaciones` WHERE `id_solicitante` = $row_resemp[0] ORDER BY `fecha` DESC LIMIT 1";
            $res_etapa = $mysqli->query($ctr_etapa); //Consulta el estatus de la ultima solicitud de vacaciones de este empleado
            $row_resetapa = $res_etapa->fetch_array();
        if ($tipo == 0) {
          $epv = "SELECT DISTINCT e.`nombre`, p.`puesto`, v.`etapa`, p.`id_puesto` FROM `datos_personales` d INNER JOIN `vacaciones` v ON d.`id_datosper` = v.`id_solicitante` AND d.`id_datosper` = $row_resemp[0] INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` AND pp.`fecha_final` = '0000-00-00' INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` ORDER BY v.`fecha` DESC LIMIT 1";
          $res_epv = $mysqli->query($epv);
          $row_resepv = $res_epv->fetch_array();
          $empresa = $row_resepv[0];
          $puesto = $row_resepv[1];
          $id_pu = $row_resepv[3];
          $etapa = $row_resetapa[1];
        }
        elseif ($tipo == 1)
        {
          $epv = "SELECT DISTINCT e.`nombre`, p.`puesto`, v.`etapa`, p.`id_puesto` FROM `datos_personales` d INNER JOIN `vacaciones` v ON d.`id_datosper` = v.`id_solicitante` AND d.`id_datosper` = $row_resemp[0] INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` ORDER BY v.`fecha` DESC LIMIT 1";
          $res_epv = $mysqli->query($epv);
          $row_resepv = $res_epv->fetch_array();
          $empresa = $row_resepv[0];
          $puesto = $row_resepv[1];
          $id_pu = $row_resepv[3];
          $etapa = $row_resetapa[1];
        }
        elseif ($tipo == 2)
        {
          $empresa = $row_resemp[5];
          $puesto = $row_resemp[6];
          $id_pu = $row_resemp[8];
          $ver = "enable";
        }
        
        

            
            if ($tipo == 2) {
              $etapa = $row_resemp[7];
            }

            $ctr_jefpu = "SELECT * FROM `jefes` WHERE `id_puesto` = $id_pu";
            $res_jefpu = $mysqli->query($ctr_jefpu); //Consulta el estatus de la ultima solicitud de vacaciones de este empleado
            $row_resjefpu = $res_jefpu->fetch_array();

            if ($etapa == 0) {
              $etapa2 = "btn btn-block btn-danger";
              $valor = "Jefe inmediato";
              $link = "#";
              if ($row_resjefpu[2] == $_SESSION["id_datosper"]) {
                $disable = "enable";
                $ver = "enable";
              }
            }
            elseif ($etapa == 1) {
              $etapa2 = "btn btn-block btn-warning";
              $valor = "Jefe de área";
              $link = "#";
              if ($row_resjefpu[3] == $_SESSION["id_datosper"]) {
                $disable = "enable";
                $ver = "enable";
              }
            }
            elseif ($etapa == 2) {
              $etapa2 = "btn btn-block btn-info";
              $valor = "Recursos Humanos";
              $link = "#";
              if ($row_resjefpu[4] == $_SESSION["id_datosper"]) {
                $disable = "enable";
                $ver = "enable";
              }
            }
            elseif ($etapa == 3) {
              $etapa2 = "btn btn-block btn-success";
              $valor = "Autorizado";
              $link = "#";
            }

            if ($ver == "enable") {
              
            
        ?>
        <tr>
          <td><?php echo $row_resemp[1] ." ". $row_resemp[2] ." ". $row_resemp[3] ." ". $row_resemp[4] ?></td>
          <td><?php echo $empresa ?></td>
          <td><?php echo $puesto ?></td>
          <td>
            <center><button class="<?php echo $etapa2 ?>" onclick="autorizar(this, '<?php echo $etapa; ?>')"style="width: 50%;" <?php echo $disable ?> value="<?php echo $row_resetapa[0]?>"><?php echo $valor ?></button></center>
          </td>
          <td><center><a href="../pdf/vacaciones.php?id=<?php echo $row_resemp[9]?>" target="blanck"><button class="btn bg-blue" style="width: 50%;">Ver</button></a></center></td>
          <td><center><a href="modal/modal_obs.php?id_vac=<?php echo $row_resemp[9]?>" data-toggle="modal" data-target=".bs-example-modal-lg" class='modalLoad'><button class="btn bg-navy" style="width: 50%;">Ver</button></a></center></td>
        </tr>
        <?php
               }
          }
          ?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nombre</th>
          <th>Empresa</th>
          <th>Puesto</th>
          <th>Autorización</th>
          <th>Solicitud</th>
          <th>Observaciones</th>
        </tr>
      </tfoot>
    </table>
    <?php
      }
    ?>
  </div><!-- /.box-body -->
</div><!-- /.box -->
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