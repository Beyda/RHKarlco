<?php
include_once("../../control/connect.php");
 session_start();

if (isset($_SESSION['login_session'])){
      //$id_usuario_session=$_SESSION["id_usuario_session"];
       //$nombre_session=$_SESSION['nombre_session'];
// $apellidos_session=$_SESSION["apellidos_session"];
 $correo_session=$_SESSION['login_session'];
 $tipo_usuario_session=$_SESSION["t_usuario_session"];
 //$avatar_session=$_SESSION["avatar_session"];
 

include("../../template/todo2.php");
//inicio de librerias 

?>

<body class="skin-blue">
<div class="content-wrapper">
        <section class="content">
          <div class="row">
             <!-- /.Documentos necesarios -->

            <div class="col-md-6">              
              <!-- iCheck -->
              <div id="respuesta" class="alert"></div>
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Documentos necesarios a entregar</h3>
                </div>
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
                      <div class="input-group">
                      <?php
                      $obt_tdoc = "SELECT * FROM `tipo_doc`";       
                      $res_tdoc = $mysqli->query($obt_tdoc);
                      ?>
                        <select class="form-control" name="nombre_archivo" id="nombre_archivo" required>
                        <option value="">Selecciona un tipo</option>
                        <?php
                        
                        while ($row_tdoc = $res_tdoc->fetch_array()) { 
                          ?>
                            <option value="<?php echo $row_tdoc[0] ?>"><?php echo utf8_encode($row_tdoc[1]) ?></option>
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
            </div><!-- /.col (right) -->
</div>


<center><button class="btn btn-block btn-info btn-lg" name="registro" style="width: 700px">Registrarse</button></center>



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
                    url: '../carga_archivos/mostrar_archivos.php',
                    dataType: 'JSON',
                    success: function(respuesta) {
                        if (respuesta) {
                            var html = '';
                            for (var i = 0; i < respuesta.length; i++) {
                                if (respuesta[i] != undefined) {
                                    html += '<hr /><div class="row"> <span class="col-lg-8"> ' + respuesta[i] + ' </span> <div class="col-lg-2"> <a class="eliminar_archivo btn btn-danger" href="javascript:void(0);"> Eliminar </a> </div> </div>';
                                }
                            }
                            $("#archivos_subidos").html(html);
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

</section>
</div>
</body>




<?php 
require('/../../../template/footer.php');
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
<?php
if(isset($_POST["est_escu"])){
    $n=0;
    $capture_field_vals ="";

    

    foreach($_POST["est_escu"] as $key => $text_field){
      $gmax = $_POST{"est_gmax"};
      $certi = $_POST{"est_certi"};
        $capture_field_vals .= $text_field .", ".$gmax[$n] .", ".$certi[$n];
        $n++;
    }
    
    echo $capture_field_vals;
}
?>