<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
        

          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $avatar_session ?>" class="img-circle" alt="User Image" />
            </div>
             <div class="pull-left info">
              <!--<p><?php echo $nombre_session." ".$apellidos_session; ?></p> -->
              <p><?php echo $tipo_usuario_session ?></p>
              <p style="font-size: 12px;"><i class="fa fa-circle text-success"></i> Online</p>
            </div>
          </div>
          <!-- search form 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>-->

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
        <li class="header">MENU PRINCIPAL</li>
             
<?php
if ($tipo_usuario_session == "Administrador"){
?>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>MI MENU</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="/rhkarlco/"><i class="fa fa-circle-o"></i>Home</a></li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i>Empresas <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="/rhkarlco/modulos/empresas/empresas.php"><i class="fa fa-circle-o"></i> Mis empresas</a></li> 
                        <li><a href="/rhkarlco/modulos/puestos/puestos.php"><i class="fa fa-circle-o"></i> Puestos</a></li> 
                        <li><a href="/rhkarlco/modulos/jefes/jefes.php"><i class="fa fa-circle-o"></i> Jefes</a></li>                       
                        </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i>Empleados <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="/rhkarlco/modulos/empleados/r_empleados.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
                        <li><a href="/rhkarlco/modulos/empleados/l_empleados.php"><i class="fa fa-circle-o"></i> Mis empleados</a></li>                        
                        </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i>Usuarios <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="/rhkarlco/modulos/usuarios/r_usuarios.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
                        <li><a href="/rhkarlco/modulos/usuarios/l_usuarios.php"><i class="fa fa-circle-o"></i> Mis usuarios</a></li>                        
                        </ul>
                </li>
                <li><a href="/rhkarlco/modulos/ejercicio/ejercicio.php"><i class="fa fa-circle-o"></i>Ejercicio</a></li>
                <li><a href="/rhkarlco/modulos/festivos/festivos.php"><i class="fa fa-circle-o"></i>Días festivos</a></li>
                <li><a href="/rhkarlco/modulos/vacaciones/vacaciones.php"><i class="fa fa-circle-o"></i>Vacaciones</a></li>
                <li><a href="/rhkarlco/modulos/permiso/permisos.php"><i class="fa fa-circle-o"></i>Permisos</a></li>
                <li><a href="/rhkarlco/modulos/solicitante/l_solic.php"><i class="fa fa-circle-o"></i>Lista de solicitantes</a></li>
                <li><a href="/rhkarlco/modulos/areas/l_areas.php"><i class="fa fa-circle-o"></i>Áreas de trabajo</a></li>
                <li><a href="/rhkarlco/modulos/cumple/cumples.php"><i class="fa fa-circle-o"></i>Cumpleaños</a></li>
                <li><a href="/rhkarlco/modulos/constancia/l_constancia.php"><i class="fa fa-circle-o"></i>Constancia</a></li>
                <li><a href="/rhkarlco/modulos/correo/l_correo.php"><i class="fa fa-circle-o"></i>Correo Masivo</a></li>
                </ul>
            </li>

<?php
}
if ($tipo_usuario_session == "Recursos Humanos"){
?>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>MI MENU</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="/rhkarlco/"><i class="fa fa-circle-o"></i>Home</a></li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i>Empresas <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="/rhkarlco/modulos/puestos/puestos.php"><i class="fa fa-circle-o"></i> Puestos</a></li> 
                        <li><a href="/rhkarlco/modulos/jefes/jefes.php"><i class="fa fa-circle-o"></i> Jefes</a></li>                       
                        </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i>Empleados <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="/rhkarlco/modulos/empleados/r_empleados.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
                        <li><a href="/rhkarlco/modulos/empleados/l_empleados.php"><i class="fa fa-circle-o"></i> Mis empleados</a></li>                        
                        </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i>Usuarios <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="/rhkarlco/modulos/usuarios/r_usuarios.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
                        <li><a href="/rhkarlco/modulos/usuarios/l_usuarios.php"><i class="fa fa-circle-o"></i> Mis usuarios</a></li>                        
                        </ul>
                </li>
                <li><a href="/rhkarlco/modulos/festivos/festivos.php"><i class="fa fa-circle-o"></i>Días festivos</a></li>
                <li><a href="/rhkarlco/modulos/vacaciones/vacaciones.php"><i class="fa fa-circle-o"></i>Vacaciones</a></li>
                <li><a href="/rhkarlco/modulos/permiso/permisos.php"><i class="fa fa-circle-o"></i>Permisos</a></li>
                <li><a href="/rhkarlco/modulos/solicitante/l_solic.php"><i class="fa fa-circle-o"></i>Lista de solicitantes</a></li>
                <li><a href="/rhkarlco/modulos/areas/l_areas.php"><i class="fa fa-circle-o"></i>Áreas de trabajo</a></li>
                <li><a href="/rhkarlco/modulos/cumple/cumples.php"><i class="fa fa-circle-o"></i>Cumpleaños</a></li>
                <li><a href="/rhkarlco/modulos/constancia/l_constancia.php"><i class="fa fa-circle-o"></i>Constancia</a></li>
                <li><a href="/rhkarlco/modulos/correo/l_correo.php"><i class="fa fa-circle-o"></i>Correo Masivo</a></li>
                </ul>
            </li>

<?php
}
if ($tipo_usuario_session == "Empleado"){
?>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>MI MENU</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="/rhkarlco/"><i class="fa fa-circle-o"></i>Home</a></li>
                <li class="active"><a href="/rhkarlco/modulos/empleados/perfil.php"><i class="fa fa-circle-o"></i>Perfil</a></li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i>Usuarios <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="/rhkarlco/modulos/usuarios/r_usuarios.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
                        <li><a href="/rhkarlco/modulos/usuarios/l_usuarios.php"><i class="fa fa-circle-o"></i> Mis usuarios</a></li>                        
                        </ul>
                </li>
                <li><a href="/rhkarlco/modulos/vacaciones/vacaciones.php"><i class="fa fa-circle-o"></i>Vacaciones</a></li>
                <li><a href="/rhkarlco/modulos/permiso/permisos.php"><i class="fa fa-circle-o"></i>Permisos</a></li>
                <li><a href="/rhkarlco/modulos/cumple/cumples.php"><i class="fa fa-circle-o"></i>Cumpleaños</a></li>
                </ul>
                <li><a href="/rhkarlco/modulos/correo/l_correo.php"><i class="fa fa-circle-o"></i>Correos</a></li>
            </li>

<?php
}
if($tipo_usuario_session == "Jefe"){
?>
           
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>MI MENU</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="/rhkarlco/"><i class="fa fa-circle-o"></i>Home</a></li>
                 <li>
                    <a href="#"><i class="fa fa-circle-o"></i>Empleados <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="/rhkarlco/modulos/empleados/l_empleados.php"><i class="fa fa-circle-o"></i> Mis empleados</a></li>                        
                        </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i>Usuarios <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="/rhkarlco/modulos/usuarios/l_usuarios.php"><i class="fa fa-circle-o"></i> Mis usuarios</a></li>                        
                        </ul>
                </li>
                <li><a href="/rhkarlco/modulos/vacaciones/vacaciones.php"><i class="fa fa-circle-o"></i>Vacaciones</a></li>
                <li><a href="/rhkarlco/modulos/permiso/permisos.php"><i class="fa fa-circle-o"></i>Permisos</a></li>
                <li><a href="/rhkarlco/modulos/cumple/cumples.php"><i class="fa fa-circle-o"></i>Cumpleaños</a></li>
                </ul>
                <li><a href="/rhkarlco/modulos/correo/l_correo.php"><i class="fa fa-circle-o"></i>Correos</a></li>
            </li>


<?php 
}

?>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
