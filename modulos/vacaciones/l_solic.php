<?php
include_once("../../control/connect.php");
session_start();  
$tipo = $_POST["tipo"];
if ($tipo == 0) {
  $query = "SELECT DISTINCT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, e.`nombre`, p.`puesto`, v.`etapa`, p.`id_puesto` FROM `datos_personales` d INNER JOIN `vacaciones` v ON d.`id_datosper` = v.`id_solicitante` INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` ORDER BY v.`fecha_rh` ASC";
}
elseif ($tipo == 1) {
  $query = "SELECT DISTINCT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, e.`nombre`, p.`puesto`, v.`etapa`, p.`id_puesto` FROM `datos_personales` d INNER JOIN `vacaciones` v ON d.`id_datosper` = v.`id_solicitante` INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` ORDER BY v.`fecha_rh` ASC";
}
elseif ($tipo == 2) {
  $query = "SELECT DISTINCT d.`id_datosper`, d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, e.`nombre`, p.`puesto`, v.`etapa`, p.`id_puesto` FROM `datos_personales` d INNER JOIN `vacaciones` v ON d.`id_datosper` = v.`id_solicitante` INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON p.`id_puesto` = pp.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` ORDER BY v.`fecha_rh` ASC";
}
?>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Empleados</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Empresa</th>
          <th>Puesto</th>
          <th>Etapa</th>
          <th>Vacaciones</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $ctr_emp = $query;
      $res_emp = $mysqli->query($ctr_emp);
      while ($row_resemp = $res_emp->fetch_array()) {
        ?>
        <tr>
          <td><?php echo $row_resemp[1] ." ". $row_resemp[2] ." ". $row_resemp[3] ." ". $row_resemp[4] ?></td>
          <td><?php echo $row_resemp[5] ?></td>
          <td><?php echo $row_resemp[6] ?></td>
          <td>
            <?php
            $ctr_etapa = "SELECT `id_vaca`, `etapa` FROM `vacaciones` WHERE `id_solicitante` = $row_resemp[0] ORDER BY `fecha` ASC LIMIT 1";
            $res_etapa = $mysqli->query($ctr_etapa); //Consulta el estatus de la ultima solicitud de vacaciones de este empleado
            $row_resetapa = $res_etapa->fetch_array();

            $ctr_jefpu = "SELECT * FROM `jefes` WHERE `id_puesto` = $row_resemp[8]";
            $res_jefpu = $mysqli->query($ctr_jefpu); //Consulta el estatus de la ultima solicitud de vacaciones de este empleado
            $row_resjefpu = $res_jefpu->fetch_array();
            $disable = "disabled";

            if ($row_resetapa[1] == 0) {
              $etapa = "btn btn-block btn-danger";
              $valor = "Jefe inmediato";
              $link = "#";
              if ($row_resjefpu[2] == $_SESSION["id_datosper"]) {
                $disable = "enable";
              }
            }
            elseif ($row_resetapa[1] == 1) {
              $etapa = "btn btn-block btn-warning";
              $valor = "Jefe de área";
              $link = "#";
              if ($row_resjefpu[3] == $_SESSION["id_datosper"]) {
                $disable = "enable";
              }
            }
            elseif ($row_resetapa[1] == 2) {
              $etapa = "btn btn-block btn-info";
              $valor = "Recursos Humanos";
              $link = "#";
            }
            elseif ($row_resetapa[1] == 3) {
              $etapa = "btn btn-block btn-success";
              $valor = "Autorizado";
              $link = "#";
            }
            ?>
            <center><a href="<?php echo $link ?>"><button class="<?php echo $etapa ?>" style="width: 50%;" <?php echo $disable ?>><?php echo $valor ?></button></a></center>
          </td>
          <td><center><a href="modal/modal.php?id=<?php echo $row_resemp[0]?>" data-toggle="modal" data-target=".modal" class='modalLoad'><button class="btn bg-blue margin" style="width: 50%;">Ver</button></a></center></td>
        </tr>
        <?php
          }
          ?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nombre</th>
          <th>Empresa</th>
          <th>Puesto</th>
          <th>Etapa</th>
          <th>Vacaciones</th>
        </tr>
      </tfoot>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->