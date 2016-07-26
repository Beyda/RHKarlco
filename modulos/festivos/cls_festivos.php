
<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*
*Es la clase que guarda la información de los días festivos
*/
	class festivos
	{
		public $fecha;
		public $desc;
		public $Mid;
        
		function __construct($fecha, $desc, $Mid)
		{
			$this->fecha = $fecha;
	        $this->desc = $desc;
	        $this->Mid = $Mid;

		}
		public function insertar()
		{
			require("../../control/connect.php");

			// AGREGAR EMPRESAS 
			
			$festivos = "INSERT INTO `dias_festivos`(`fecha`, `desc`, `estatus`) VALUES ('$this->fecha','$this->desc',1)";
			$resul_festivos = $mysqli->query($festivos);

			if ($mysqli->error) {
				echo "<script>if(confirm('Ocurrio un error')){ 
				document.location='festivos.php';} 
				else{ alert('Operacion Cancelada');
				}</script>";
			}else
			{
				echo "<script> document.location='festivos.php'; </script>";
			}

		}

		public function actualizar()
		{
			require("../../control/connect.php");

			$mfestivos = "UPDATE `dias_festivos` SET `fecha`='$this->fecha',`desc`='$this->desc' WHERE `id_festivos` = $this->Mid";
			$resul_mfestivos = $mysqli->query($mfestivos);

			if ($mysqli->error) {
				echo "<script>if(confirm('Ocurrio un error')){ 
				document.location='festivos.php';} 
				else{ alert('Operacion Cancelada'); 
				}</script>";
			}else
			{
				echo "<script> document.location='festivos.php'; </script>";
			}

		}
	} 

	if (isset($_GET['status'])) {
		require("../../control/connect.php");
		$status = $_GET["status"];
		$festivo = $_GET["festivo"];
	  		$status = "UPDATE `dias_festivos` SET `estatus`=$status WHERE `id_festivos` = $festivo";
			$resul_status = $mysqli->query($status);
			if($mysqli->error)
            {
              echo "<script>if(confirm('No se pudo actualizar')){ 
				document.location='festivos.php';} 
				else{ alert('Operacion Cancelada'); 
				}</script>";
            } else
            {
            	echo "<script> document.location='festivos.php'; </script>";
            }
	  	}  	
?>