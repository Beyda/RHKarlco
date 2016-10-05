
<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*
*Es la clase que guarda la información de una empresa
*/
	class empresa
	{
		public $nombre;
        public $dir;
        public $sweb;
        public $rfc;
        public $correo;
        public $tel;
        public $desc;
        public $archivo;
        public $type;
        public $tamano;
        public $tmp_name;
        public $error;
        public $id;

		function __construct($nombre, $dir, $sweb, $rfc, $correo, $tel, $desc, $archivo, $type, $tamano, $tmp_name, $error, $id)
		{
			$this->nombre = $nombre;
	        $this->dir = $dir;
	        $this->sweb = $sweb;
	        $this->rfc =  $rfc;
	        $this->correo = $correo;
	        $this->tel = $tel;
	        $this->desc = $desc;
	        $this->archivo = $archivo;
	        $this->type = $type;
	        $this->tamano = $tamano;
	        $this->tmp_name = $tmp_name;
	        $this->error = $error;
	        $this->id = $id;

		}
		public function insertar()
		{
			require("../../control/connect.php");

			// AGREGAR EMPRESAS 
			$empresas = "INSERT INTO `empresas`(`nombre`, `direccion`, `sitio_web`, `rfc`, `correo`, `tel`, `desc`, `logo`, `status`) VALUES ('$this->nombre','$this->dir','$this->sweb','$this->rfc','$this->correo',$this->tel,'$this->desc','NULL', 1)";
			$resul_empresa = $mysqli->query($empresas);

			$sel_empresas = "SELECT `id_empresa` FROM `empresas` WHERE `rfc` = '$this->rfc' and `nombre` = '$this->nombre'";
			$resul_selempresa = $mysqli->query($sel_empresas);
			$row_emp = $resul_selempresa->fetch_array();

		    	if ($this->error > 0){
						echo "<script>if(confirm('Error al subir archivo')){ 
						document.location='empresas.php';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
					} else {
						//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
						//y que el tamano del archivo no exceda los 1000kb
						$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "application/pdf");
						$limite_kb = 1000;

						if (in_array($this->type, $permitidos) && $this->tamano <= $limite_kb * 1024){
							//esta es la ruta donde copiaremos la imagen
							//recuerden que deben crear un directorio con este mismo nombre
							//en el mismo lugar donde se encuentra el archivo subir.php
							$ruta = "../carga_archivos/archivos_subidos/empresas/" . $row_emp[0] ."___".$this->archivo;
							//comprovamos si este archivo existe para no volverlo a copiar.
							//pero si quieren pueden obviar esto si no es necesario.
							//o pueden darle otro nombre para que no sobreescriba el actual.
							if (!file_exists($ruta)){
								//aqui movemos el archivo desde la ruta temporal a nuestra ruta
								//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
								//almacenara true o false
								$resultado = @move_uploaded_file($this->tmp_name, $ruta);
								if ($resultado){
									//echo "el archivo ha sido movido exitosamente";
									$v = 0;
								} else {
									//echo "ocurrio un error al mover el archivo.";
									$v = 1;
								}
							} else {
								//echo $this->archivo . ", este archivo existe";
								$v = 1;
							}
						} else {
							#echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
							$v = 1;
						}
					}

					if ($v == 0) {
						$upt_emp = "UPDATE `empresas` SET `logo`= '$row_emp[0]___$this->archivo' WHERE `id_empresa` = $row_emp[0]";
						$resul_upt = $mysqli->query($upt_emp);
						echo "<script> document.location='empresas.php'; </script>";
					}else
					{
						$delete = "DELETE FROM `empresas` WHERE `id_empresa` = $row_emp[0]";
						$resul_del = $mysqli->query($delete);
						echo "<script>if(confirm('Ocurrio un error')){ 
						document.location='empresas.php';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
					}

		}

		public function actualizar()
		{
			require("../../control/connect.php");

			if ($this->error == 0) {
				$sel_emp = "SELECT `logo` FROM `empresas` WHERE `id_empresa` = $this->id";
				$resul_selempresa = $mysqli->query($sel_emp);
				$row_emp2 = $resul_selempresa->fetch_array();
				unlink("../carga_archivos/archivos_subidos/empresas/$row_emp2[0]");
				$empresas = "UPDATE `empresas` SET `nombre`= '$this->nombre',`direccion`= '$this->dir',`sitio_web`= '$this->sweb',`rfc`= '$this->rfc',`correo`= '$this->correo',`tel`=$this->tel,`desc`='$this->desc',`logo`= '".$this->id."___$this->archivo' WHERE `id_empresa` = $this->id";
				$resul_empresa = $mysqli->query($empresas);
			} 
			if ($this->error != 0) {
				$empresas = "UPDATE `empresas` SET `nombre`= '$this->nombre',`direccion`= '$this->dir',`sitio_web`= '$this->sweb',`rfc`= '$this->rfc',`correo`= '$this->correo',`tel`=$this->tel,`desc`='$this->desc' WHERE `id_empresa` = $this->id";
				$resul_empresa = $mysqli->query($empresas); 
				$v = 0;
			} 
		    	if ($this->error == 0){
						
						//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
						//y que el tamano del archivo no exceda los 1000kb
						$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "application/pdf");
						$limite_kb = 1000;

						if (in_array($this->type, $permitidos) && $this->tamano <= $limite_kb * 1024){
							//esta es la ruta donde copiaremos la imagen
							//recuerden que deben crear un directorio con este mismo nombre
							//en el mismo lugar donde se encuentra el archivo subir.php
							echo $ruta = "../carga_archivos/archivos_subidos/empresas/" . $this->id ."___".$this->archivo;
							//comprovamos si este archivo existe para no volverlo a copiar.
							//pero si quieren pueden obviar esto si no es necesario.
							//o pueden darle otro nombre para que no sobreescriba el actual.
							if (!file_exists($ruta)){
								//aqui movemos el archivo desde la ruta temporal a nuestra ruta
								//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
								//almacenara true o false
								$resultado = @move_uploaded_file($this->tmp_name, $ruta);
								if ($resultado){
									//echo "el archivo ha sido movido exitosamente";
									$v = 0;
								} else {
									//echo "ocurrio un error al mover el archivo.";
									$v = 1;
								}
							} else {
								//echo $this->archivo . ", este archivo existe";
								$v = 1;
							}
						} else {
							#echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
							$v = 1;
						}
					}

					if ($v == 0) {
						echo "<script> document.location='empresas.php'; </script>";
					}else
					{
						echo "<script>if(confirm('Ocurrio un error')){ 
						document.location='empresas.php';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
					}

		}
	} 

	if (isset($_GET['status'])) {
		require("../../control/connect.php");
		$status = $_GET["status"];
		$empresa = $_GET ["empresa"];
	  		$status = "UPDATE `empresas` SET `status`= $status WHERE `id_empresa` = $empresa";
			$resul_status = $mysqli->query($status);
			if($mysqli->error)
            {
              echo "<script>if(confirm('No se pudo actualizar')){ 
				document.location='empresas.php';} 
				else{ alert('Operacion Cancelada'); 
				}</script>";
            } else
            {
            	header( "Location:empresas.php");
            }
	  	}  	
?>