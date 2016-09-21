<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*
*Es la clase que guarda la información de los correos que se envian masivos a todos los de la empresa
*/
	class correo
	{
		public $empresa;
		public $asunto;
		public $mensaje;
		public $archivo;
		public $type;
		public $tamano;
		public $tmp_name;
		public $error;
        
		function __construct($empresa, $asunto, $mensaje, $archivo, $type, $tamano, $tmp_name, $error)
		{
			$this->empresa = $empresa;
	        $this->asunto = $asunto;
	        $this->mensaje = $mensaje;
	        $this->archivo = $archivo;
	        $this->type = $type;
	        $this->tamano = $tamano;
	        $this->tmp_name = $tmp_name;
	        $this->error = $error;

		}
		public function insertar()
		{
			require("../../control/connect.php");
			$v=0;
			//echo "<script>alert('$this->type');</script>";
			if ($this->error > 0){
				echo "ha ocurrido un error";
			} else {
				//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
				//y que el tamano del archivo no exceda los 1000kb
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "application/pdf", "application/vnd.*", "application/vnd.ms-excel");
				$limite_kb = 1024;

				if (in_array($this->type, $permitidos) && $this->tamano <= $limite_kb * 1024){
					//esta es la ruta donde copiaremos la imagen
					//recuerden que deben crear un directorio con este mismo nombre 
					//en el mismo lugar donde se encuentra el archivo subir.php
					$ruta = "../carga_archivos/correos/" . $this->archivo;
					//comprovamos si este archivo existe para no volverlo a copiar.
					//pero si quieren pueden obviar esto si no es necesario.
					//o pueden darle otro nombre para que no sobreescriba el actual.
					if (!file_exists($ruta)){
						//aqui movemos el archivo desde la ruta temporal a nuestra ruta
						//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
						//almacenara true o false
						$resultado = @move_uploaded_file($this->tmp_name, $ruta);
						if ($resultado){
							
						} else {
							echo "<script>if(confirm('Error al mover el archivo')){ 
									document.location='l_correo.php';} 
									else{ alert('Operacion Cancelada'); 
									}</script>";
									$v = 1;
						}
					} else {
						echo "<script>if(confirm('Este archivo ya existe')){ 
						document.location='l_correo.php';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
						$v = 1;
					}
				} else {
					echo "<script>if(confirm('Este tipo de archivo no es permitido')){ 
							document.location='l_correo.php';} 
							else{ alert('Operacion Cancelada'); 
							}</script>";
							$v = 1;
				}
			}
			if ($v == 0) {
				$sel_ejer = "SELECT `id_ejercicio` FROM `ejercicio` WHERE `estatus` = 1";
				$resul_sel_ejer = $mysqli->query($sel_ejer);
				$row_ejer = $resul_sel_ejer->fetch_array();

				$fecha = date('Y-m-j');
				
				echo $correo = "INSERT INTO `correos`(`id_empresa`, `asunto`, `mensaje`, `adjunto`, `fecha`, `id_ejercicio`) VALUES ($this->empresa,'$this->asunto','$this->mensaje','$this->archivo', '$fecha', $row_ejer[0])";
				$correo = $mysqli->query($correo);

				if ($mysqli->error) {
					echo "<script>if(confirm('Ocurrio un error')){ 
					document.location='l_correo.php';} 
					else{ alert('Operacion Cancelada');
					}</script>";
					unlink("../carga_archivos/correos/$this->archivo");
				}else
				{
					echo "<script> document.location='l_correo.php'; </script>";
				}
			}

		}

	} 
  	
?>