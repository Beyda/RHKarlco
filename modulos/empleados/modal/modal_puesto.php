
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregue sus profesiones</h4>
                  </div>
                  <form method="post">
                  <div class="modal-body">
                    
                           <div class="puesto">
                <!-- Escuela/Instituto/Universiad, grado máximo-->
                <div class="form-group">
                  <div class="row">                    
                <div class="col-lg-4">
                  <button class="btn btn-block btn-primary btn-sm" id="add_puesto">Agregar otro</button> 
                </div>
                  </div>
                </div>



                  <div class="form-group">                  
                    <div class="row">                    
                    <div class="col-lg-6">
                    <label>Puesto:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="est_puesto[]" maxlength="20" placeholder="Puesto" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                    <label>Disponibilidad:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="est_disp[]" maxlength="20" placeholder="Disponibilidad" required>
                      </div><!-- /input-group -->                    
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->

                  <!-- Certificado/Titulo -->
                  <div class="form-group">                                      
                    <div class="row">
                    <div class="col-lg-12">
                    <label>Unidad Operativa:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" name="est_uoper[]" maxlength="20" placeholder="Unidad Operativa" required>
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </div><!-- /.form group -->
                  </div>
                     
                    
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="guardar" value="ho" id="guardar">Guardar</button>
                  </div>
                  </form>
                 
<!-- ========================== Puesto ================================= -->
          <?php
            $ctr_puesto = "SELECT * FROM `puestos` WHERE `id_datosper` = $id_datosper";
            $res_puesto = $mysqli->query($ctr_puesto);
            $numrowsPuesto = $res_puesto->num_rows;
            if ($numrowsPuesto <= 0) {
              $sigPuesto = "fa fa-warning";
              $botonPuesto = "<a href=modal/modal_puesto.php data-toggle=modal data-target=.modalPuesto class='modalLoad'><button class='btn btn-block btn-primary btn-sm'>Insertar puesto</button></a>";
            } else
            {
              $sigPuesto = "";
            }
          ?>
            <div class="col-md-6">
              <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                <img src="../../imagenes/perfil/puesto.png" style="width: 7%; height: 7%;">
                  <h3 class="box-title">Puesto</h3>
                  <i class="<?php echo $sigPuesto; ?>" style="color: red"></i>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $botonPuesto; ?>
                   <!-- Puesto -->
                    <?php
                    if ($numrowsPuesto > 0) 
                    {
                      ?>
                      <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <a href="modal/modal_puesto.php" data-toggle="modal" data-target=".modalPuesto" class='modalLoad'><button class="btn btn-block btn-primary btn-sm">Insertar nueva profesión</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Puesto</th>
                        <th>Modificar</th>
                        <th>Borrar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $prof1 = 0;
                      while ($row_puesto = $res_puesto->fetch_array()) 
                      {
                      ?>
                     <tr>
                        <td><?php echo $row_puesto["1"] ?></td>
                        <td><center><a href="modal/modal_mpuesto.php?id=<?php echo $row_puesto["0"]; ?>" data-toggle="modal" data-target=".modalmProf" class='modalLoad'><button class="btn btn-block btn-success btn-xs" style="width:100px;">Modificar</button></a></center></td>
                        <td><center><button class="btn btn-block btn-danger btn-xs" style="width:100px;" onclick="borraPuesto(this)" value="<?php echo $row_puesto["0"] ?>">Borrar</button></center></td>
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


      function borraPuesto(id){
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
            window.location.href = "cls_empleado.php?borrarPuesto="+id.value;
          } else
          {
            swal("Cancelado", "No has borrado tu dato", "error");
          }
        });
      };
      </script>
      <?php
                  
        if (isset($_POST["est_puesto"])) {
          include "cls_empleado.php";
          echo $est_puesto = $_POST["est_puesto"];
          $est_disp = $_POST["est_disp"];
          $est_uoper = $_POST["est_uoper"];
          $clasP = new profesion($prof);
          $clasP->insertar();
        }
      ?>