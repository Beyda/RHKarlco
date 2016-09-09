
<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*
*Es la clase que guarda la información de una empresa
*/
	class jefes
	{
		public $puesto;
		public $jefi;
		public $jefa;
        public $id;
        
		function __construct($puesto, $jefi, $jefa, $id)
		{
			$this->puesto = $puesto;
	        $this->jefi = $jefi;
	        $this->jefa = $jefa;
	        $this->id = $id;

		}
		public function insertar()
		{
			require("../../control/connect.php");

			$rh = "SELECT d.`id_datosper` FROM `datos_personales` d INNER JOIN `usuarios` u ON u.`id_datosper` = d.`id_datosper` INNER JOIN `tipo_usuario` t ON t.`id_tipous` = u.`id_tipous` AND t.`nombre` = 'Recursos Humanos'";
	        $res_rh = $mysqli->query($rh);
	        $row_rh = $res_rh->fetch_array();

			// AGREGAR EMPRESAS 
			$jefes = "INSERT INTO `jefes`(`id_puesto`, `id_jefin`, `id_jefar`) VALUES ($this->puesto,$this->jefi,$this->jefa)";
			$resul_jefe = $mysqli->query($jefes);

			if ($mysqli->error) {
				echo "<script>if(confirm('Ocurrio un error')){ 
				document.location='jefes.php';} 
				else{ alert('Operacion Cancelada'); 
				}</script>";
			}else
			{
				echo "<script> document.location='jefes.php'; </script>";
			}

		}

		public function actualizar()
		{
			require("../../control/connect.php");

			$mjefes = "UPDATE `jefes` SET `id_puesto`=$this->puesto,`id_jefin`=$this->jefi,`id_jefar`=$this->jefa WHERE `id_jefes` = $this->id";
			$resul_mjefes = $mysqli->query($mjefes);

			if ($mysqli->error) {
				echo "<script>if(confirm('Ocurrio un error')){ 
				document.location='jefes.php';} 
				else{ alert('Operacion Cancelada'); 
				}</script>";
			}else
			{
				echo "<script> document.location='jefes.php'; </script>";
			}

		}
	} 

	if (isset($_GET['status'])) {
		require("../../control/connect.php");
		$status = $_GET["status"];
		$puesto = $_GET["puesto"];
		$emp = $_GET["emp"];
	  		$status = "UPDATE `puestos` SET `status`=$status WHERE `id_puesto` = $puesto";
			$resul_status = $mysqli->query($status);
			if($mysqli->error)
            {
              echo "<script>if(confirm('No se pudo actualizar')){ 
				document.location='l_puestos.php?id=$emp';} 
				else{ alert('Operacion Cancelada'); 
				}</script>";
            } else
            {
            	echo "<script> document.location='l_puestos.php?id=$emp'; </script>";
            }
	  	}  	
?>