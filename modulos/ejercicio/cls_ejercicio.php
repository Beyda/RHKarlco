
<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*
*Es la clase que guarda la información de los años de ejercicios
*/
	class ejercicio
	{
		public $ano;
		public $desc;
        
		function __construct($ano, $desc)
		{
			$this->ano = $ano;
	        $this->desc = $desc;

		}
		public function insertar()
		{
			require("../../control/connect.php");

			$upt_ej = "SELECT `id_ejercicio` FROM `ejercicio` WHERE `estatus` = 1";
			$resul_upt_ej = $mysqli->query($upt_ej);
			$row_ejer = $resul_upt_ej->fetch_array();
			
			// AGREGAR EMPRESAS 
			
			$ejercicio = "INSERT INTO `ejercicio`(`ano`, `desc`, `estatus`) VALUES ($this->ano,'$this->desc',1)";
			$resul_ejercicio = $mysqli->query($ejercicio);

			if ($mysqli->error) {
				echo "<script>if(confirm('Ocurrio un error')){ 
				document.location='ejercicio.php';} 
				else{ alert('Operacion Cancelada');
				}</script>";
			}else
			{
				echo $upt_ej2 = "UPDATE `ejercicio` SET `estatus`=0 WHERE `id_ejercicio` = $row_ejer[0]";
				$resul_upt_ej2 = $mysqli->query($upt_ej2);
				echo "<script> document.location='ejercicio.php'; </script>";
			}

		}

	} 
  	
?>