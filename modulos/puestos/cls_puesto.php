
<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*
*Es la clase que guarda la información de una empresa
*/
	class puesto
	{
		public $puesto;
        public $id;
        public $id_emp;

		function __construct($puesto, $id, $id_emp)
		{
			$this->puesto = $puesto;
	        $this->id = $id;
	        $this->id_emp = $id_emp;

		}
		public function insertar()
		{
			require("../../control/connect.php");

			// AGREGAR EMPRESAS 
			$puestos = "INSERT INTO `puestos`(`puesto`, `id_empresa`, `status`) VALUES ('$this->puesto', $this->id_emp, 1)";
			$resul_puesto = $mysqli->query($puestos);

			if ($mysqli->error) {
				echo "<script>if(confirm('Ocurrio un error')){ 
				document.location='l_puestos.php?id=$this->id_emp';} 
				else{ alert('Operacion Cancelada'); 
				}</script>";
			}else
			{
				echo "<script> document.location='l_puestos.php?id=$this->id_emp'; </script>";
			}

		}

		public function actualizar()
		{
			require("../../control/connect.php");

			$mpuesto = "UPDATE `puestos` SET `puesto`='$this->puesto' WHERE `id_puesto` = $this->id";
			$resul_mpuesto = $mysqli->query($mpuesto);

			if ($mysqli->error) {
				echo "<script>if(confirm('Ocurrio un error')){ 
				document.location='l_puestos.php?id=$this->id_emp';} 
				else{ alert('Operacion Cancelada'); 
				}</script>";
			}else
			{
				echo "<script> document.location='l_puestos.php?id=$this->id_emp'; </script>";
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