<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*/
include_once("../../control/connect.php");
 session_start();
if (isset($_SESSION["session"])){
$_SESSION['id_tmp'] = $_SESSION['id_datosper'];
include("../../template/todo2.php");
//inicio de librerias 
$actual2 = date('Y');

$ano = "SELECT * FROM `ejercicio` WHERE `estatus` = 1";
$res_anos = $mysqli->query($ano);
$row_anos = $res_anos->fetch_array();

$sel_dvaca2 = "SELECT * FROM `dias_vacaciones` WHERE `id_datosper` = $_SESSION[id_tmp] AND `ano` = $actual2";
$res_dvaca2 = $mysqli->query($sel_dvaca2);
$numrowsDvaca2 = $res_dvaca2->num_rows;
if ($numrowsDvaca2 == 0) {
  $selano = "SELECT * FROM `puesto_per` WHERE `id_datosper` = $_SESSION[id_tmp] ORDER BY `fecha` ASC LIMIT 1";
  $res_selano = $mysqli->query($selano);
  $row_reselano = $res_selano->fetch_array();
  $actual = date('Y-m-j');
  $an = date('Y');
  $total_ano = strtotime($actual) - strtotime($row_reselano[1]);
  $tot = $total_ano / (60 * 60 * 24 * 365);
  $fin = floor($tot);
  
  if ($fin == 0 || $fin == 1) {
    $dias = 6;
  }
  if ($fin == 2) {
    $dias = 8;
  }
  if ($fin == 3) {
    $dias = 10;
  }
  if ($fin == 4) {
    $dias = 12;
  }
  if ($fin >= 5 && $fin <= 9) {
    $dias = 14;
  }
  if ($fin >= 10 && $fin <= 14) {
    $dias = 16;
  }
  if ($fin >= 15 && $fin <= 19) {
    $dias = 18;
  }
  if ($fin >= 20 && $fin <= 24) {
    $dias = 20;
  }
  if ($fin >= 25 && $fin <= 29) {
    $dias = 22;
  }
  if ($fin >= 30) {
    $dias = 24;
  }
  $insertvaca = "INSERT INTO `dias_vacaciones`(`descripcion`, `dias`, `id_ejercicio`, `fecha`, `id_datosper`, `id_autoriza`, `signo`) VALUES ('Ingreso de días de vacaciones automático anual',$dias,$row_anos[0],'$actual',$id_tmp,77,'+')";
  $res_ivacaa = $mysqli->query($insertvaca);
}
?>

<div class="content-wrapper">
  <section class="content">
          <div class="row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <i class="ion ion-person"></i>
                  <h3 class="box-title">Perfil</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="form-group">                    
                    <div class="row">
                    <div class="col-lg-1">
                    </div>

                    <div class="col-lg-4">
                      <div class="input-group">
                        <img src="<?php echo $avatar_session; ?>" class="img-circle" alt="User Image" style="width: 60%; height: 60%;" /> 
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->

                    <div class="col-lg-6">
                      <div class="input-group">
                        <?php
                          $sel_dper = "SELECT `primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno` FROM `datos_personales` WHERE `id_datosper` = $id_datosper";
                          $res_dper = $mysqli->query($sel_dper);
                          $row_dper = $res_dper->fetch_array();
                          ?>
                          <h4><strong><?php echo $row_dper[0] ." ". $row_dper[1] ." ".$row_dper[2] ." ".$row_dper[3]?></strong></h4>
                          <center><a href="/rhkarlco/modulos/empleados/m_empleados.php?id=0"><button class="btn bg-olive margin">Editar datos personales</button></a></center>
                          <center><a href="/rhkarlco/modulos/usuarios/m_usuarios.php?id=0"><button class="btn bg-blue margin">Editar mis usuario</button></a></center>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
    <!-- START ALERTS AND CALLOUTS -->
<!-- ========================== BENEFICIARIOS EN CASO DE FALLECIMIENTO ============================== -->
          <?php
            $ctr_benfa = "SELECT * FROM `beneficiarios` WHERE `id_datosper` = $id_datosper";
            $res_benfa = $mysqli->query($ctr_benfa);
            $numrowsBenfa = $res_benfa->num_rows;
            if ($numrowsBenfa <= 0) {
              $sigBenfa = "fa fa-warning";
              $botonBenfa = "<a href=modal/modal_benfa.php data-toggle=modal data-target=.modalBenfa class='modalLoad'><button class='btn btn-block btn-primary btn-sm'>Insertar beneficiarios</button></a>";
            } else
            {
              $sigBenfa = "";
            }
          ?>
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                <img src="../../imagenes/perfil/beneficiario.png" style="width: 7%; height: 7%;">
                  <h3 class="box-title">Beneficiarios en caso de fallecimiento</h3>
                  <i class="<?php echo $sigBenfa; ?>" style="color: red"></i>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $botonBenfa; ?>
                  <div>
                
                  <!-- Beneficiarios en caso de fallecimiento -->
                    <?php
                    if ($numrowsBenfa > 0) 
                    {
                      ?>
                      <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <a href="modal/modal_benfa.php" data-toggle="modal" data-target=".modalBenfa" class='modalLoad'><button class="btn btn-block btn-primary btn-sm">Insertar beneficiario</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Beneficiario</th>
                        <th>Modificar</th>
                        <th>Borrar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $benfa1 = 0;
                      while ($row_benfa = $res_benfa->fetch_array()) 
                      {
                      ?>
                     <tr>
                        <td><?php echo $row_benfa["1"] ." ". $row_benfa["2"] ." ". $row_benfa["3"] ." ". $row_benfa["4"] ?></td>
                        <td><center><a href="modal/modal_mbenfa.php?id=<?php echo $row_benfa["0"]; ?>" data-toggle="modal" data-target=".modalmBenfa" class='modalLoad'><button class="btn btn-block btn-success btn-xs" style="width:100px;">Modificar</button></a></center></td>
                        <td><center><button class="btn btn-block btn-danger btn-xs" style="width:100px;" onclick="borraBenfa(this)" value="<?php echo $row_benfa["0"] ?>">Borrar</button></center></td>
                      </tr>
                    <?php
                    $benfa1++;
                      }
                      ?>
                      </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
                      <?php
                    }
                    ?>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

    <script type="text/javascript">

      function borraBenfa(id){
        swal({
          title: "¿Estas seguro de continuar?",
          text: "El dato será borrado",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Si, borrarlo',
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm){
            window.location.href = "cls_empleado.php?borrarBenfa="+id.value;
          } else
          {
            swal("Cancelado", "No has borrado tu dato", "error");
          }
        });
      };
      </script>
          
            
                 <?php  
              if (isset($_POST["benfa_pnom"])) {
                include "cls_empleado.php";
                $benfa_pnom = $_POST["benfa_pnom"];
                $benfa_snom = $_POST["benfa_snom"];
                $benfa_pape = $_POST["benfa_pape"];
                $benfa_sape = $_POST["benfa_sape"];
                $benfa_domici = $_POST["benfa_domici"];
                $benfa_tel = $_POST["benfa_tel"];
                $benfa_parent = $_POST["benfa_parent"];
                $clasBenfa = new beneficiarios($benfa_pnom, $benfa_snom, $benfa_pape, $benfa_sape, $benfa_domici, $benfa_tel, $benfa_parent);
                $clasBenfa->insertar();
              }

              if (isset($_POST["Mbenfa_pnom"])) {
                include "cls_empleado.php";
                $benfa_pnom = $_POST["Mbenfa_pnom"];
                $benfa_snom = $_POST["Mbenfa_snom"];
                $benfa_pape = $_POST["Mbenfa_pape"];
                $benfa_sape = $_POST["Mbenfa_sape"];
                $benfa_domici = $_POST["Mbenfa_domici"];
                $benfa_tel = $_POST["Mbenfa_tel"];
                $benfa_parent = $_POST["Mbenfa_parent"];
                $id_benfa = $_POST["actBenfa"];
                $clasBenfa = new mbeneficiarios($benfa_pnom, $benfa_snom, $benfa_pape, $benfa_sape, $benfa_domici, $benfa_tel, $benfa_parent, $id_benfa);
                $clasBenfa->actualiza();
              }
          ?>

<!-- ========================== Datos familiares o independientes ================================= -->
          <?php
            $ctr_Datfami = "SELECT * FROM `datos_familiares` WHERE `id_datosper` = $id_datosper";
            $res_Datfami = $mysqli->query($ctr_Datfami);
            $numrowsDatfami = $res_Datfami->num_rows;
            if ($numrowsDatfami <= 0) {
              $sigDatfami = "fa fa-warning";
              $botonDatfami = "<a href=modal/modal_datfami.php data-toggle=modal data-target=.modalProf class='modalLoad'><button class='btn btn-block btn-primary btn-sm'>Insertar datos familiares</button></a>";
            } else
            {
              $sigDatfami = "";
            }
          ?>
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                <img src="../../imagenes/perfil/datos_familiares.png" style="width: 7%; height: 7%;">
                  <h3 class="box-title">Datos familiares o dependientes</h3>
                  <i class="<?php echo $sigDatfami; ?>" style="color: red"></i>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $botonDatfami; ?>
                  <div>
                
                  <!-- Datos familiares o independientes -->
                    <?php
                    if ($numrowsDatfami > 0) 
                    {
                      ?>
                      <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <a href="modal/modal_datfami.php" data-toggle="modal" data-target=".modalDatfami" class='modalLoad'><button class="btn btn-block btn-primary btn-sm">Insertar datos familiares</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="width: 200px;">Nombre</th>
                        <th>Acta</th>
                        <th>Modificar</th>
                        <th>Borrar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $Datfami1 = 0;

                      while ($row_datfami = $res_Datfami->fetch_array()) 
                      {
                      ?>
                     <tr>
                        <td><?php echo $row_datfami["1"] ." ". $row_datfami["2"] ." ". $row_datfami["3"] ." ". $row_datfami["4"]; ?></td>
                        <td><center><a href="../carga_archivos/archivos_subidos/<?php echo $row_datfami["7"]; ?>" target="blanck"><img src="../../imagenes/jpg.png" style="width: 40px; height: 40px;"></a></center></td>
                        <td><center><a href="modal/modal_mdatfami.php?id=<?php echo $row_datfami["0"]; ?>" data-toggle="modal" data-target=".modalmProf" class='modalLoad'><button class="btn btn-block btn-success btn-xs" style="width:100%;">Modificar</button></a></center></td>
                        <td><center><button class="btn btn-block btn-danger btn-xs" style="width:100%;" onclick="borraDatfami(this)" value="<?php echo $row_datfami["0"] ?>">Borrar</button></center></td>
                      </tr>
                    <?php
                    $Datfami1++;
                      }
                      ?>
                      </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
                      <?php
                    }
                    ?>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
    <script type="text/javascript">

      function borraDatfami(id){
        swal({
          title: "¿Estas seguro de continuar?",
          text: "El dato será borrado",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Si, borrarlo',
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm){
            window.location.href = "cls_empleado.php?borrarDatfami="+id.value;
          } else
          {
            swal("Cancelado", "No has borrado tu dato", "error");
          }
        });
      };
      </script>

          <?php
                  
              if (isset($_POST["datfami_pnom"])) {
                include "cls_empleado.php";
                $datfami_pnom = $_POST["datfami_pnom"];
                $datfami_snom = $_POST["datfami_snom"];
                $datfami_pape = $_POST["datfami_pape"];
                $datfami_sape = $_POST["datfami_sape"];
                $datfami_date = $_POST["datfami_date"];
                $datfami_parent = $_POST["datfami_parent"];
                $archivo = $_FILES['archivo']['name'];
                $type = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];
                $tmp_name = $_FILES['archivo']['tmp_name'];
                $error = $_FILES['archivo']['error'];
                $clasDatfami = new datosfami($datfami_pnom, $datfami_snom, $datfami_pape, $datfami_sape, $datfami_date, $datfami_parent, $archivo, $type, $tamano, $tmp_name, $error);
                $clasDatfami->insertar();
              }
              if (isset($_POST["Mdatfami_pnom"])) 
              {
                include "cls_empleado.php";
                $datfami_pnom = $_POST["Mdatfami_pnom"];
                $datfami_snom = $_POST["Mdatfami_snom"];
                $datfami_pape = $_POST["Mdatfami_pape"];
                $datfami_sape = $_POST["Mdatfami_sape"];
                $datfami_date = $_POST["Mdatfami_date"];
                $datfami_parent = $_POST["Mdatfami_parent"];
                $id = $_POST["guardarMDF"];
                $archivo = $_FILES['Marchivo']['name'];
                $type = $_FILES['Marchivo']['type'];
                $tamano = $_FILES['Marchivo']['size'];
                $tmp_name = $_FILES['Marchivo']['tmp_name'];
                $error = $_FILES['Marchivo']['error'];

                if($error == 0)
                {
                  $clasDatfamiM = new Mdatosfami($datfami_pnom, $datfami_snom, $datfami_pape, $datfami_sape, $datfami_date, $datfami_parent, $archivo, $type, $tamano, $tmp_name, $error, $id, 1);
                  $clasDatfamiM->actualiza();
                }if($error != 0)
                {
                  $clasDatfamiM = new Mdatosfami($datfami_pnom, $datfami_snom, $datfami_pape, $datfami_sape, $datfami_date, $datfami_parent, 0, 0, 0, 0, 0, $id,0);
                  $clasDatfamiM->actualiza();
                }
              }
            
          ?>



<!-- ========================== Empleos anteriores ================================= -->
          <?php
            $ctr_empant = "SELECT * FROM `empleos_anteriores` WHERE `id_datosper` = $id_datosper";
            $res_empant = $mysqli->query($ctr_empant);
            $numrowsEmpant = $res_empant->num_rows;
            if ($numrowsEmpant <= 0) {
              $sigEmpant = "fa fa-warning";
              $botonEmpant = "<a href=modal/modal_empant.php data-toggle=modal data-target=.modalEmpant class='modalLoad'><button class='btn btn-block btn-primary btn-sm'>Insertar empleos anteriores</button></a>";
            } else
            {
              $sigEmpant = "";
            }
          ?>
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                <img src="../../imagenes/perfil/emp_ant.png" style="width: 7%; height: 7%;">
                  <h3 class="box-title">Empleos anteriores</h3>
                  <i class="<?php echo $sigEmpant; ?>" style="color: red"></i>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $botonEmpant; ?>
                  

                  <!-- Empleos anteriores -->
                    <?php
                    if ($numrowsEmpant > 0) 
                    {
                      ?>
                      <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <a href="modal/modal_empant.php" data-toggle="modal" data-target=".modalEmpant" class='modalLoad'><button class="btn btn-block btn-primary btn-sm">Insertar empleos anteriores</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Empresa</th>
                        <th>Modificar</th>
                        <th>Borrar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $prof1 = 0;
                      while ($row_empant = $res_empant->fetch_array()) 
                      {
                      ?>
                     <tr>
                        <td><?php echo $row_empant["1"] ?></td>
                        <td><center><a href="modal/modal_mempant.php?id=<?php echo $row_empant["0"]; ?>" data-toggle="modal" data-target=".modalmProf" class='modalLoad'><button class="btn btn-block btn-success btn-xs" style="width:100px;">Modificar</button></a></center></td>
                        <td><center><button class="btn btn-block btn-danger btn-xs" style="width:100px;" onclick="borraEmpant(this)" value="<?php echo $row_empant["0"] ?>">Borrar</button></center></td>
                      </tr>
                    <?php
                    $prof1++;
                      }
                      ?>
                      </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
                      <?php
                    }
                    ?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

  <script type="text/javascript">

      function borraEmpant(id){
        swal({
          title: "¿Estas seguro de continuar?",
          text: "El dato será borrado",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Si, borrarlo',
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm){
            window.location.href = "cls_empleado.php?borrarEmpant="+id.value;
          } else
          {
            swal("Cancelado", "No has borrado tu dato", "error");
          }
        });
      };
      </script>
      <?php
                  
              if (isset($_POST["empant_empr"])) {
                include "cls_empleado.php";
                $empant_empr = $_POST["empant_empr"];
                $area = $_POST["area"];
                $subarea = $_POST["subarea"];
                $empant_jefe = $_POST["empant_jefe"];
                $empant_anoi = $_POST["empant_anoi"];
                $empant_anof = $_POST["empant_anof"];
                $industria = $_POST["industria"];
                $empant_tel = $_POST["empant_tel"];
                $clasEant = new empleosAn($empant_empr, $area, $subarea, $empant_jefe, $empant_anoi, $empant_anof, $industria, $empant_tel);
                $clasEant->insertar();
              }

              if (isset($_POST["mempant_empr"])) {
                include "cls_empleado.php";
                $empant_empr = $_POST["mempant_empr"];
                $area = $_POST["marea"];
                $subarea = $_POST["msubarea"];
                $empant_jefe = $_POST["mempant_jefe"];
                $empant_anoi = $_POST["mempant_anoi"];
                if (isset($_POST["check"])) {
                  $empant_anof = "0000-00-00";
                }else
                {
                  $empant_anof = $_POST["mempant_anof"];
                }
                
                $industria = $_POST["mindustria"];
                $empant_tel = $_POST["mempant_tel"];
                $id_emp = $_POST["mguardarEmpant"];
                $clasEant = new MempleosAn($empant_empr, $area, $subarea, $empant_jefe, $empant_anoi, $empant_anof, $industria, $empant_tel, $id_emp);
                $clasEant->actualiza();
              }
          ?>

<!-- ========================== Estudios anteriores ================================= -->
<?php
            $ctr_estant = "SELECT * FROM `estudios` WHERE `id_datosper` = $id_datosper";
            $res_estant = $mysqli->query($ctr_estant);
            $numrowsEA = $res_estant->num_rows;
            if ($numrowsEA <= 0) {
              $sigEA = "fa fa-warning";
              $botonEA = "<a href=modal/modal_ea.php data-toggle=modal data-target=.modalProf class='modalLoad'><button class='btn btn-block btn-primary btn-sm'>Insertar estudios anteriores</button></a>";
            } else
            {
              $sigEA = "";
            }
          ?>
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                <img src="../../imagenes/perfil/estudios.png" style="width: 7%; height: 7%;">
                  <h3 class="box-title">Estudios</h3>
                  <i class="<?php echo $sigEA; ?>" style="color: red"></i>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $botonEA; ?>
                  <?php
                    if ($numrowsEA > 0) 
                    {
                      ?>
                      <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <a href="modal/modal_ea.php" data-toggle="modal" data-target=".modalProf" class='modalLoad'><button class="btn btn-block btn-primary btn-sm">Insertar estudios</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Escuela</th>
                        <th>Modificar</th>
                        <th>Borrar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $prof1 = 0;
                      while ($row_EA = $res_estant->fetch_array()) 
                      {
                      ?>
                     <tr>
                        <td><?php echo $row_EA["1"] ?></td>
                        <td><center><a href="modal/modal_meant.php?id=<?php echo $row_EA["0"]; ?>" data-toggle="modal" data-target=".modalmProf" class='modalLoad'><button class="btn btn-block btn-success btn-xs" style="width:100px;">Modificar</button></a></center></td>
                        <td><center><button class="btn btn-block btn-danger btn-xs" style="width:100px;" onclick="borraEstant(this)" value="<?php echo $row_EA["0"] ?>">Borrar</button></center></td>
                      </tr>
                    <?php
                    $prof1++;
                      }
                      ?>
                      </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
                      <?php
                    }
                    ?>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <?php
                  
              if (isset($_POST["est_escu"])) {
                include "cls_empleado.php";
                $est_escu = $_POST["est_escu"];
                $est_gmax = $_POST["est_gmax"];
                $est_certi = $_POST["est_certi"];
                $clasEstant = new estant($est_escu, $est_gmax, $est_certi);
                $clasEstant->insertar();
              }

              if (isset($_POST["Mest_escu"])) {
                include "cls_empleado.php";
                $Mest_escu = $_POST["Mest_escu"];
                $Mest_gmax = $_POST["Mest_gmax"];
                $Mest_certi = $_POST["mest_certi"];
                $id_estant = $_POST["btnestant"];
                $clasEstant = new mestant($Mest_escu, $Mest_gmax, $Mest_certi, $id_estant);
                $clasEstant->actualiza();
              }

            ?>

  <script type="text/javascript">

      function borraEstant(id){
        swal({
          title: "¿Estas seguro de continuar?",
          text: "El dato será borrado",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Si, borrarlo',
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm){
            window.location.href = "cls_empleado.php?borrarEstant="+id.value;
          } else
          {
            swal("Cancelado", "No has borrado tu dato", "error");
          }
        });
      };
  </script>

<!-- ========================== Referencias Personales ================================= -->
          <?php
            $ctr_ref = "SELECT * FROM `referencias` WHERE `id_datosper` = $id_datosper";
            $res_red = $mysqli->query($ctr_ref);
            $numrowsRef = $res_red->num_rows;
            if ($numrowsRef <= 0) {
              $sigRef = "fa fa-warning";
              $botonRef = "<a href=modal/modal_refper.php data-toggle=modal data-target=.modalRefper class='modalLoad'><button class='btn btn-block btn-primary btn-sm'>Insertar referencias personales</button></a>";
            } else
            {
              $sigRef = "";
            }
          ?>
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                <img src="../../imagenes/perfil/ref_per.png" style="width: 7%; height: 7%;">
                  <h3 class="box-title">Referencias Personales</h3>
                  <i class="<?php echo $sigRef; ?>" style="color: red"></i>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $botonRef; ?>
                  
                  <!-- REFERENCIAS PERSONALES -->
                    <?php
                    if ($numrowsRef > 0) 
                    {
                      ?>
                      <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <a href="modal/modal_refper.php" data-toggle="modal" data-target=".modalRefper" class='modalLoad'><button class="btn btn-block btn-primary btn-sm">Insertar referencias personales</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        <th>Borrar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while ($row_refper = $res_red->fetch_array()) 
                      {
                      ?>
                     <tr>
                        <td><?php echo $row_refper["1"] ?></td>
                        <td><center><a href="modal/modal_mrefper.php?id=<?php echo $row_refper["0"]; ?>" data-toggle="modal" data-target=".modalmProf" class='modalLoad'><button class="btn btn-block btn-success btn-xs" style="width:100px;">Modificar</button></a></center></td>
                        <td><center><button class="btn btn-block btn-danger btn-xs" style="width:100px;" onclick="borraRefper(this)" value="<?php echo $row_refper["0"] ?>">Borrar</button></center></td>
                      </tr>
                    <?php
                      }
                      ?>
                      </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
                      <?php
                    }
                    ?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
        <script type="text/javascript">


      function borraRefper(id){
        swal({
          title: "¿Estas seguro de continuar?",
          text: "El dato será borrado",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Si, borrarlo',
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm){
            window.location.href = "cls_empleado.php?borrarRefper="+id.value;
          } else
          {
            swal("Cancelado", "No has borrado tu dato", "error");
          }
        });
      };
      </script>

          <?php      
              if (isset($_POST["refper_pnom"])) {
                include "cls_empleado.php";
                $refper_pnom = $_POST["refper_pnom"];
                $refper_snom = $_POST["refper_snom"];
                $refper_pape = $_POST["refper_pape"];
                $refper_sape = $_POST["refper_sape"];
                $refper_dir = $_POST["refper_dir"];
                $refper_tel = $_POST["refper_tel"];
                $refper_parent = $_POST["refper_parent"];
                $clasRP = new refper($refper_pnom, $refper_snom, $refper_pape, $refper_sape, $refper_dir,$refper_tel, $refper_parent);
                $clasRP->insertar();
              }

              if (isset($_POST["mrefper_pnom"])) {
                include "cls_empleado.php";
                $refper_pnom = $_POST["mrefper_pnom"];
                $refper_snom = $_POST["mrefper_snom"];
                $refper_pape = $_POST["mrefper_pape"];
                $refper_sape = $_POST["mrefper_sape"];
                $refper_dir = $_POST["mrefper_dir"];
                $refper_tel = $_POST["mrefper_tel"];
                $refper_parent = $_POST["mrefper_parent"];
                $id = $_POST["guardarRefper"];
                $clasRP = new Mrefper($refper_pnom, $refper_snom, $refper_pape, $refper_sape, $refper_dir,$refper_tel, $refper_parent,$id);
                $clasRP->actualiza();
              }
          ?>


<!-- ========================== HABILIDADES ================================= -->
          <?php
            $ctr_habi = "SELECT DISTINCT lh.*, h.* FROM `habilidades` h INNER JOIN `l_habilidad` lh ON h.`id_lhab` = lh.`id_lhab`  WHERE h.`id_datosper` = $id_datosper";
            $res_habi = $mysqli->query($ctr_habi);
            $numrowsH = $res_habi->num_rows;
            if ($numrowsH <= 0) {
              $sigH = "fa fa-warning";
              $botonH = "<a href=modal/modal_prof.php data-toggle=modal data-target=.modalHab class='modalLoad'><button class='btn btn-block btn-primary btn-sm'>Insertar nueva habilidad</button></a>";
            } else
            {
              $sigH = "";
            }
          ?>
          
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                <img src="../../imagenes/perfil/profesion.png" style="width: 7%; height: 7%;">
                  <h3 class="box-title">Habilidades</h3>
                  <i class="<?php echo $sigH; ?>" style="color: red"></i>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->

                <div class="box-body">
                <?php echo $botonH; ?>
                 <div class="prof">
                
                  <!-- Profesion -->
                    <?php
                    if ($numrowsH > 0) 
                    {
                      ?>
                      <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <a href="modal/modal_prof.php" data-toggle="modal" data-target=".modalHab" class='modalLoad'><button class="btn btn-block btn-primary btn-sm">Insertar nueva habilidad</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Habilidad</th>
                        <th>Borrar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $prof1 = 0;
                      while ($row_Hab = $res_habi->fetch_array()) 
                      {
                      ?>
                     <tr>
                        <td><?php echo $row_Hab["1"] ?></td>
                        <td><center><button class="btn btn-block btn-danger btn-xs" style="width:100px;" onclick="borraHab(this)" value="<?php echo $row_Hab["2"] ?>">Borrar</button></center></td>
                      </tr>
                    <?php
                    $prof1++;
                      }
                      ?>
                      </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
                      <?php
                    }
                    ?>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          

  <script type="text/javascript">

      $(document).ready(function(){
        $('.modalLoad').click(function() { 
          $('.modal').modal('show'); 
          $('.modal-content').val('');
          $('.modal-content').load($(this).attr('href'));
           return false;

        });

      });

      function borraHab(id){
        swal({
          title: "¿Estas seguro de continuar?",
          text: "El dato será borrado",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Si, borrarlo',
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm){
            window.location.href = "cls_empleado.php?borrar="+id.value;
          } else
          {
            swal("Cancelado", "No has borrado tu dato", "error");
          }
        });
      };
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
                  
              if (isset($_POST["habilidades"])) {
                include "cls_empleado.php";
                $habilidades = $_POST["habilidades"];
                $clasP = new habilidad($habilidades);
                $clasP->insertar();
              }

              if (isset($_POST["act"])) {
                include "cls_empleado.php";
                $mhdad = $_POST["mhdad"];
                $id_hdad = $_POST["act"];
                $clasP = new mhabilidad($mhdad, $id_hdad);
                $clasP->actualizar();
              }
          ?>



 
<!-- ========================== Documentos necesarios a entregar ================================= -->
          <?php
            $ctr_doc = "SELECT * FROM `documentos` WHERE `id_datosper` = $id_datosper";
            $res_doc = $mysqli->query($ctr_doc);
            $numrowsDoc = $res_doc->num_rows;
            if ($numrowsDoc <= 0) {
              $sigDoc = "fa fa-warning";
            } else
            {
              $sigDoc = "";
            }
          ?>
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                <img src="../../imagenes/perfil/documentos.png" style="width: 7%; height: 7%;">
                  <h3 class="box-title">Documentos necesarios a entregar</h3>
                  <i class="<?php echo $sigDoc; ?>" style="color: red"></i>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="doc_nec">
                <!-- acta, identificación-->
               
               
                <form action="javascript:void(0);">
                  <div class="form-group">                  
                    <div class="row">                    
                    <div class="col-lg-4">
                    <label>Archivo</label>
                      <div class="input-group">
                        <input id="archivo" type="file" class="file" name="archivo" data-show-preview="false" accept="application/pdf, image/*">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-4">
                    <label>Tipo</label>
                      <div class="input-group" id="recargado">
                      <?php
                     $obt_tdoc = "SELECT distinct * FROM `tipo_doc` WHERE `tipo_doc`.`id_tdoc` NOT IN (SELECT `id_tdoc` FROM `documentos` WHERE `id_datosper` = $id_datosper and `tipo_doc`.`id_tdoc` = `documentos`.`id_tdoc`)";       
                      $res_tdoc = $mysqli->query($obt_tdoc);
                      ?>
                        <select class="form-control" name="nombre_archivo" id="nombre_archivo" required>
                        <option value="">Selecciona un tipo</option>
                        <?php
                        while ($row_tdoc = $res_tdoc->fetch_array()) { 
                          ?>
                            <option value="<?php echo $row_tdoc[1] ?>"><?php echo $row_tdoc[1] ?></option>
                          <?php
                        }
                        ?>                        
                      </select>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->                    
                    <div class="col-lg-4">
                    <label></label>
                      <div class="input-group">
                      <center>
                        <input type="submit" id="boton_subir" value="Subir" class="btn btn-success" style="width:230%" />
                      </center>
                      </div><!-- /input-group -->                      
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-4">
                        <progress id="barra_de_progreso" value="0" max="100"></progress>
                    </div>
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                    <div id="archivos_subidos"></div>

                  </form>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <!-- ========================== Salario ================================= -->
          <?php
           $ctr_puesto = "SELECT * FROM `puesto_per` pp INNER JOIN `puestos` p ON pp.`id_puesto` = p.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` WHERE `id_datosper` = $_SESSION[id_datosper] ORDER BY pp.`fecha` ASC";
            $res_puesto = $mysqli->query($ctr_puesto);
            $res_puesto2 = $mysqli->query($ctr_puesto);
            $numrowsPuesto = $res_puesto->num_rows;
            if ($numrowsPuesto <= 0) {
              $sigPuesto = "fa fa-warning";
              $botonPuesto = "<a href=modal/modal_salario.php data-toggle=modal data-target=.modalRefper class='modalLoad'><button class='btn btn-block btn-primary btn-sm'>Insertar puesto</button></a>";

            } else
            {
              $sigPuesto = "";
            }
          ?>
            <div class="col-md-12">  
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                <img src="../../imagenes/perfil/salario.png" style="width: 3%; height: 3%;">
                  <h3 class="box-title">Hoja de servicio</h3>
                  <i class="<?php echo $sigPuesto; ?>" style="color: red"></i>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 
                if ($tipo_usuario_session == "Administrador") 
                {
                  echo $botonPuesto; 
                }
                ?>
                  
                  <!-- REFERENCIAS PERSONALES -->
                    <?php
                    if ($numrowsPuesto > 0) 
                    {
                      ?>
                      <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
              <?php
                if ($tipo_usuario_session == "Administrador") {
              ?>
                <div class="box-header">
                  <a href="modal/modal_salario.php" data-toggle="modal" data-target=".modalsal" class='modalLoad'><button class="btn btn-block btn-primary btn-sm">Insertar puestos</button></a>
                </div><!-- /.box-header -->
                <?php
                  }
                ?>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Inicio</th>
                        <th>Fin </th>
                        <th>Puesto</th>
                        <th>Empresa</th>
                        <th>Salario</th>
                        <th>Meses</th>
                        <th>Acumulado</th>
                        <?php
                          if ($tipo_usuario_session == "Administrador") {
                        ?>
                        <th>Modificar</th>
                        <?php
                        }
                      ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i=0;
                      while ($row_puesto1 = $res_puesto->fetch_array()) 
                      {
                        $fecha_inicial2[] = $row_puesto1["1"];
                        $fecha_inicial = $row_puesto1["1"];
                        $fecha_final = strtotime ( '-1 day' , strtotime ( $fecha_inicial ) ) ;
                        $fecha_final2[] = date ( 'Y-m-j' , $fecha_final );
                        $i++;
                      }
                      $n = 0;
                      while ($row_puesto = $res_puesto2->fetch_array()) 
                      {
                        $fecha1 = new DateTime($row_puesto["1"]);
                        $n++;
                        $fecha2 = new DateTime($row_puesto["2"]);
                        if ($row_puesto["2"] == "0000-00-00") {
                          $row_puesto["2"] = date('Y-m-j');
                          $fecha2 = date('Y-m-j');
                        }

                        $diferencia = $fecha1->diff($fecha2);
                        $meses = ( $diferencia->y * 12 ) + $diferencia->m;
                        $acumulado = $acumulado + $meses;

                         
                      ?>
                     <tr>
                        <td><?php echo date("d-m-Y", strtotime($row_puesto["1"])); ?></td>
                        <td><?php echo date("d-m-Y", strtotime($row_puesto["2"])); ?></td>
                        <td><?php echo $row_puesto["7"] ?></td>
                        <td><?php echo $row_puesto["11"] ?></td>
                        <td><?php echo $row_puesto["3"] ?></td>
                        <td><?php echo $meses ?></td>
                        <td><?php echo $acumulado ?></td>
                        <?php
                          if ($tipo_usuario_session == "Administrador") {
                        ?>
                        <td><center><a href="modal/modal_msalario.php?id=<?php echo $row_puesto["0"]; ?>" data-toggle="modal" data-target=".modalmsalario" class='modalLoad'><button class="btn btn-block btn-success btn-xs" style="width:100px;">Modificar</button></a></center></td>
                        <?php
                        }
                      ?>
                      </tr>
                    <?php
                      }
                        $u = 0;
                        $r=1;
                        while ($u <= $acumulado) {  
                         $u = 12 * $r;
                         $r++;
                        }
                        $ano =$r - 2;
                        $x = 12 * $ano;
                        $mes = $acumulado - $x;
                        if ($ano != 0) {
                          if ($ano == 1) {
                            $fano = $ano." año";
                          }else
                          {
                            $fano = $ano." años";
                          }
                          
                        }
                        if ($mes != 0) {
                          if ($mes == 1) {
                            $fmes = ", ".$mes. " mes";
                          }else
                          {
                            $fmes = ", ".$mes. " meses";
                          }
                        }
                        
                        
                      ?>
                      <p><strong>TOTAL MESES DEL EMPLEADO PARA PLAN SEGURO SOCIAL: <?php echo $acumulado ?></strong></p>
                      <p><strong>TIEMPO TOTAL DEL EMPLEADO PARA PLAN SEGURO SOCIAL: <?php echo $fano ."". $fmes; ?></strong></p>

                      </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
                      <?php
                    }
                    ?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          <?php      
              if (isset($_POST["puesto"])) {
                include "cls_empleado.php";
                $f_inicio = $_POST["f_inicio"];
                $f_final = $_POST["f_final"];
                $salario = $_POST["salario"];
                $puesto = $_POST["puesto"];
                if ($f_final < $f_inicio) {
                  echo "<script>if(confirm('La fecha final no puede ser menor a la inicial')){ 
                  document.location='perfil.php';} 
                  else{ alert('Operacion Cancelada'); 
                  }</script>";
                }else
                {
                  $clasRP = new salario($f_inicio, $salario, $puesto,0, $f_final);
                  $clasRP->insertar();
                }
                
              }
              if (isset($_POST["Mpuesto"])) {
                include "cls_empleado.php";
                $f_inicio = $_POST["Mf_inicio"];
                $f_final = $_POST["mf_final"];
                if (isset($_POST["check"])) {
                  $f_final = "0000-00-00";
                }else
                {
                  $f_final = $_POST["mf_final"];
                }

                $salario = $_POST["Msalario"];
                $puesto = $_POST["Mpuesto"];
                $id = $_POST["id"];
                if ($f_final < $f_inicio && $f_final != "0000-00-00") {
                  echo "<script>if(confirm('La fecha final no puede ser menor a la inicial')){ 
                  document.location='perfil.php';} 
                  else{ alert('Operacion Cancelada'); 
                  }</script>";
                } else
                {
                  $clasRP = new salario($f_inicio, $salario, $puesto, $id, $f_final);
                  $clasRP->actualizar();
                }
                
              }
          ?>


          </div> <!-- /.row -->

          

          <!-- END ALERTS AND CALLOUTS -->
          </div> <!-- /.row -->



 <script type="text/javascript">
            function subirArchivos() {
             

                $("#archivo").upload('../carga_archivos/subir_archivo.php',
                {
                    nombre_archivo: $("#nombre_archivo").val()
                },
                function(respuesta) {
                    //Subida finalizada.
                    $("#barra_de_progreso").val(0);
                    if (respuesta === 1) {
                        mostrarRespuesta('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>  <i class="icon fa fa-check"></i>Subida Exitosa!</h4>El archivo se ha subido correctamente.', true);
                        $("#nombre_archivo, #archivo").val('');
                    } else {
                        mostrarRespuesta('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Error!</h4>El archivo no se pudo subir.', false);
                    }
                    mostrarArchivos();
                }, function(progreso, valor) {
                    //Barra de progreso.
                    $("#barra_de_progreso").val(valor);
                });
            }
            function eliminarArchivos(archivo) {
                $.ajax({
                    url: '../carga_archivos/eliminar_archivo.php',
                    type: 'POST',
                    timeout: 10000,
                    data: {archivo: archivo},
                    error: function() {
                        mostrarRespuesta('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Error!</h4>La eliminación fue fallida.', false);
                    },
                    success: function(respuesta) {
                        if (respuesta == 1) {
                            mostrarRespuesta('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>  <i class="icon fa fa-check"></i>Eliminación Exitosa!</h4>El archivo ha sido eliminado correctamente.', true);
                        } else {
                            mostrarRespuesta('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Error!</h4>La eliminación fue fallida.', false);                            
                        }
                        mostrarArchivos();
                    }
                });
            }
            function mostrarArchivos() {
                $.ajax({
                    url: '../carga_archivos/mostrar_archivos.php?id_tmp=<?php echo $id_tmp ?>',
                    dataType: 'JSON',
                    success: function(respuesta) {
                        if (respuesta) {
                            var html = '';
                            for (var i = 0; i < respuesta.length; i++) {
                                if (respuesta[i] != undefined) {
                                    html += '<hr /><div class="row"> <span class="col-lg-8"><a href="../carga_archivos/archivos_subidos/' + respuesta[i] + '" target ="blank"> ' + respuesta[i] + '</a> </span> <div class="col-lg-2"> <a class="eliminar_archivo btn btn-danger" href="javascript:void(0);"> Eliminar </a> </div> </div>';
                                }
                            }
                            $("#archivos_subidos").html(html);
                            recargar();
                        }
                    }
                });
            }
            function mostrarRespuesta(mensaje, ok){
                $("#respuesta").removeClass('alert-success alert-dismissable').removeClass('alert-danger alert-dismissable').html(mensaje);
                if(ok){
                    $("#respuesta").addClass('alert-success alert-dismissable');
                }else{
                    $("#respuesta").addClass('alert-danger alert-dismissable');
                }
            }

          $(document).ready(function() {
                mostrarArchivos();
                $("#boton_subir").on('click', function() {
                  subirArchivos();
                      
                });
                $("#archivos_subidos").on('click', '.eliminar_archivo', function() {
                    var archivo = $(this).parents('.row').eq(0).find('span').text();
                    archivo = $.trim(archivo);
                    eliminarArchivos(archivo);
                });
            });
        </script>   



<script language="javascript">
function recargar(){    
       /// Aqui podemos enviarle alguna variable a nuestro script PHP
    var variable_post="<?php echo $id_tmp ?>";
       /// Invocamos a nuestro script PHP
    $.post("ajax_select.php", { variable: variable_post }, function(data){
       /// Ponemos la respuesta de nuestro script en el DIV recargado
    $("#recargado").html(data);
    });         
}
</script>      
</div>

  </section>
  
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
mysqli_close($mysqli);//se cierra la sesion
?>