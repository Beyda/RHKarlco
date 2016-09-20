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
        
		function __construct($empresa, $asunto, $mensaje, $archivo)
		{
			$this->empresa = $empresa;
	        $this->asunto = $asunto;
	        $this->mensaje = $mensaje;
	        $this->archivo = $archivo;

		}
		public function insertar()
		{
			require("../../control/connect.php");

			$sel_ejer = "SELECT `id_ejercicio` FROM `ejercicio` WHERE `estatus` = 1";
			$resul_sel_ejer = $mysqli->query($sel_ejer);
			$row_ejer = $resul_sel_ejer->fetch_array();

			$fecha = date('Y-m-j');
			
			$correo = "INSERT INTO `correos`(`id_empresa`, `asunto`, `mensaje`, `adjunto`, `fecha`, `id_ejercicio`) VALUES ($this->empresa,'$this->asunto','$this->mensaje','$this->archivo', $fecha, $row_ejer[0])";
			$correo = $mysqli->query($correo);

			if ($mysqli->error) {
				echo "<script>if(confirm('Ocurrio un error')){ 
				document.location='l_correo.php';} 
				else{ alert('Operacion Cancelada');
				}</script>";
			}else
			{
				echo "<script> document.location='l_correo.php'; </script>";
			}

		}

	} 
  	
?>