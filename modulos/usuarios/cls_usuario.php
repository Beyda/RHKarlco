
<?php

	class usuario
	{
		public $empleado;
        public $user;
        public $pass;
        public $t_usuario;
        public $jefe;
        public $nomenclatura;
        public $num_contador;
        

		function __construct($empleado, $user, $pass, $t_usuario, $jefe, $nomenclatura, $num_contador)
		{
			$this->empleado = $empleado;
	        $this->user = $user;
	        $this->pass = $pass;
	        $this->t_usuario =  $t_usuario;
	        $this->jefe = $jefe;
	        $this->nomenclatura = $nomenclatura;
	        $this->num_contador = $num_contador;

		}
		public function registrarJ()
		{
			require("../../control/connect.php");
			$mysqli->set_charset("utf8");	
				// SELECT TIPO DE USUARIO
				$sel_tusu = "SELECT `id_tipous` FROM `tipo_usuario` WHERE `nombre` = '$this->t_usuario'";
				$res_tusu = $mysqli->query($sel_tusu);
				$row_tusu = $res_tusu->fetch_array();

				// AGREGAR USUARIO 
				$obtUser = "INSERT INTO `usuarios`(`nomenclatura`, `num_contador`,`usuario`, `pass`, `jefe`, `id_tipous`, `id_datosper`, `estatus`) VALUES ('$this->nomenclatura', $this->num_contador , '$this->user','$this->pass',$this->jefe,$row_tusu[0],$this->empleado, 1)";
				$resul_user = $mysqli->query($obtUser);


				// SELECT USUARIO
				$sel_user = "SELECT `id_usuario` FROM `usuarios` WHERE `usuario` = '$this->user' and `id_datosper` = $this->empleado";
				$res_user = $mysqli->query($sel_user);
				$numrows = $res_user->num_rows;

					if($numrows > 0)
					{
						echo "<script> document.location='l_usuarios.php'; </script>";
					
					} //FINALIZA EL IF DE DATOS PERSONALES
					if($numrows = 0){
						echo "<script>if(confirm('No se pudo agregar')){ 
						document.location='r_usuarios.php';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
					}


		}

		public function registrar()
		{
			require("../../control/connect.php");
			$mysqli->set_charset("utf8");	
				// SELECT TIPO DE USUARIO
				$sel_tusu = "SELECT `id_tipous` FROM `tipo_usuario` WHERE `nombre` = '$this->t_usuario'";
				$res_tusu = $mysqli->query($sel_tusu);
				$row_tusu = $res_tusu->fetch_array();

				// AGREGAR USUARIO 
				$obtUser = "INSERT INTO `usuarios`(`nomenclatura`, `num_contador`,`usuario`, `pass`, `id_tipous`, `id_datosper`, `estatus`) VALUES ('$this->nomenclatura', $this->num_contador , '$this->user','$this->pass',$row_tusu[0],$this->empleado, 1)";
				$resul_user = $mysqli->query($obtUser);


				// SELECT USUARIO
				$sel_user = "SELECT `id_usuario` FROM `usuarios` WHERE `usuario` = '$this->user' and `id_datosper` = $this->empleado";
				$res_user = $mysqli->query($sel_user);
				$numrows = $res_user->num_rows;

					if($numrows > 0)
					{
						echo "<script> document.location='l_usuarios.php'; </script>";
					
					} //FINALIZA EL IF DE DATOS PERSONALES
					if($numrows = 0){
						echo "<script>if(confirm('No se pudo agregar')){ 
						document.location='r_usuarios.php';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
					}


		}
	}  


	class usuarioM
	{
        public $pass;
        public $t_usuario;
        public $jefe;
        public $id;
        public $v;

		function __construct($pass, $t_usuario, $jefe, $id, $v)
		{
	        $this->pass = $pass;
	        $this->t_usuario =  $t_usuario;
	        $this->jefe = $jefe;
	        $this->id = $id;
	        $this->v = $v;
		}
		public function modJ()
		{
			require("../../control/connect.php");
			$mysqli->set_charset("utf8");	
				// SELECT TIPO DE USUARIO
				$sel_tusu = "SELECT `id_tipous` FROM `tipo_usuario` WHERE `nombre` = '$this->t_usuario'";
				$res_tusu = $mysqli->query($sel_tusu);
				$row_tusu = $res_tusu->fetch_array();

				// AGREGAR USUARIO 
				$obtUser = "UPDATE `usuarios` SET `pass`='$this->pass',`jefe`=$this->jefe,`id_tipous`=$row_tusu[0] WHERE `usuario` = '$this->id'";
				$resul_user = $mysqli->query($obtUser);


				// SELECT USUARIO
				$sel_user = "SELECT `id_usuario` FROM `usuarios` WHERE `usuario` = '$this->id' and `pass`='$this->pass' and `jefe`=$this->jefe and `id_tipous`=$row_tusu[0]";
				$res_user = $mysqli->query($sel_user);
				$numrows = $res_user->num_rows;

					if($numrows > 0)
					{	
						if ($this->v != "0") {
							echo "<script> document.location='l_usuarios.php'; </script>";
						}else
						{
							echo "<script> document.location='../empleados/perfil.php'; </script>";
						}
						
					
					} //FINALIZA EL IF DE DATOS PERSONALES
					if($numrows = 0){
						echo "<script>if(confirm('No se pudo agregar')){ 
						document.location='r_usuarios.php';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
					}
		}

		public function mod()
		{
			require("../../control/connect.php");
			$mysqli->set_charset("utf8");
				// SELECT TIPO DE USUARIO
				$sel_tusu = "SELECT `id_tipous` FROM `tipo_usuario` WHERE `nombre` = '$this->t_usuario'";
				$res_tusu = $mysqli->query($sel_tusu);
				$row_tusu = $res_tusu->fetch_array();

				// AGREGAR USUARIO 
				$obtUser = "UPDATE `usuarios` SET `pass`='$this->pass',`id_tipous`=$row_tusu[0], `jefe`= NULL WHERE `usuario` = '$this->id'";
				$resul_user = $mysqli->query($obtUser);


				// SELECT USUARIO
				$sel_user = "SELECT `id_usuario` FROM `usuarios` WHERE `usuario` = '$this->id' and `pass`='$this->pass' and `id_tipous`=$row_tusu[0]";
				$res_user = $mysqli->query($sel_user);
				$numrows = $res_user->num_rows;

					if($numrows > 0)
					{
						if ($this->v != 0) {
							echo "<script> document.location='l_usuarios.php'; </script>";
						}else
						{
							echo "<script> document.location='../empleados/perfil.php'; </script>";
						}
					
					} //FINALIZA EL IF DE DATOS PERSONALES
					if($numrows = 0){
						echo "<script>if(confirm('No se pudo agregar')){ 
						document.location='r_usuarios.php';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
					}


		}
	}   	
?>