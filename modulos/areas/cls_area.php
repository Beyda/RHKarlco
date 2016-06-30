<?php
/**
* 
* @author Beyda Mariana Trejo Román <1130032@unav.edu.mx>
* @copyright 2016-2017 Área de Desarrollo UNAV 
* @version 1.0
*/
		class areas
	   	{
	   		public $area;

	   		function __construct($area)
	   		{
	   			$this->area = $area;
	   		}


	   		public function insertar()
	   		{
	   			session_start();
				require("../../control/connect.php");
			        // AGREGAR habilidades 
					$insertA = "INSERT INTO `areas`(`nombre`) VALUES ('$this->area')";
					$resul_area = $mysqli->query($insertA);					
					
			        // AGREGAR habilidades 
					$Sel_area = "SELECT `id_area` FROM `areas` WHERE `nombre` = '$this->area'";
					$res_selarea = $mysqli->query($Sel_area);
					$numrows = $res_selarea->num_rows;
			// SELECT DATOS PERSONALES
				
				if($numrows > 0)
				{
					echo "<script> document.location='l_areas.php'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($numrows == 0){
					echo "<script>if(confirm('Algunas datos no se pudieron guardar o ya existe uno igual')){ 
					document.location='l_areas.php';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	} 

	   	class Mareas
	   	{
	   		public $area;
	   		public $id;

	   		function __construct($area, $id)
	   		{
	   			$this->area = $area;
	   			$this->id = $id;
	   		}


	   		public function actualiza()
	   		{
	   			session_start();
				require("../../control/connect.php");
			        // AGREGAR habilidades 
					$updA = "UPDATE `areas` SET `nombre`='$this->area' WHERE `id_area` = $this->id";
					$resul_area = $mysqli->query($updA);					
					
			        // AGREGAR habilidades 
					$Sel_area = "SELECT `id_area` FROM `areas` WHERE `nombre` = '$this->area' and `id_area` = $this->id";
					$res_selarea = $mysqli->query($Sel_area);
					$numrows = $res_selarea->num_rows;
			// SELECT DATOS PERSONALES
				
				if($numrows > 0)
				{
					echo "<script> document.location='l_areas.php'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($numrows == 0){
					echo "<script>if(confirm('Algunas datos no se pudieron guardar o ya existe uno igual')){ 
					document.location='l_areas.php';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	} 


	   	class subareas
	   	{
	   		public $area;
	   		public $id;

	   		function __construct($area, $id)
	   		{
	   			$this->area = $area;
	   			$this->id = $id;
	   		}


	   		public function insertar()
	   		{
	   			session_start();
				require("../../control/connect.php");
			        // AGREGAR habilidades 
					$insertA = "INSERT INTO `subarea`(`nombre`, `id_area`) VALUES ('$this->area', $this->id)";
					$resul_area = $mysqli->query($insertA);					
					
			        // AGREGAR habilidades 
					$Sel_area = "SELECT `id_sub` FROM `subarea` WHERE `nombre` = '$this->area' and `id_area` = $this->id";
					$res_selarea = $mysqli->query($Sel_area);
					$numrows = $res_selarea->num_rows;
			// SELECT DATOS PERSONALES
				
				if($numrows > 0)
				{
					echo "<script> document.location='l_subareas.php?id=$this->id'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($numrows == 0){
					echo "<script>if(confirm('Algunas datos no se pudieron guardar o ya existe uno igual')){ 
					document.location='l_subareas.php?id=$this->id';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	} 

	   	class Msareas
	   	{
	   		public $area;
	   		public $id_sub;
	   		public $id;

	   		function __construct($area, $id_sub, $id)
	   		{
	   			$this->area = $area;
	   			$this->id_sub = $id_sub;
	   			$this->id = $id;
	   		}


	   		public function actualiza()
	   		{
	   			session_start();
				require("../../control/connect.php");
			        // AGREGAR habilidades 
					$updA = "UPDATE `subarea` SET `nombre`='$this->area' WHERE `id_sub` = $this->id_sub";
					$resul_area = $mysqli->query($updA);					
					
			        // AGREGAR habilidades 
					$Sel_area = "SELECT `id_sub` FROM `subarea` WHERE `nombre` = '$this->area' and `id_sub` = $this->id_sub and `id_area` = $this->id";
					$res_selarea = $mysqli->query($Sel_area);
					$numrows = $res_selarea->num_rows;
			// SELECT DATOS PERSONALES
				
				if($numrows > 0)
				{
					echo "<script> document.location='l_subareas.php?id=$this->id'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($numrows == 0){
					echo "<script>if(confirm('Algunas datos no se pudieron guardar o ya existe uno igual')){ 
					document.location='l_subareas.php?id=$this->id';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	} 

?>