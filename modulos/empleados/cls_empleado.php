<?php
session_start();
if ($_SESSION['id_tmp'] == $_SESSION['id_datosper']) {
	$_SESSION['id_tmp2'] = $_SESSION['id_datosper'];
	$link = "perfil.php";
}else
{
	$_SESSION['id_tmp2'] = $_SESSION['id_tmp'];
	$link = "a_perfil.php?id=$_SESSION[id_tmp2]";
}
		
		/**
		* Aqui se realiza la clase de registro de días de vacaciones
		*/
		class dvaca
		{
			public $signo;
			public $dias;
			public $ano;
			public $desc;
			public $id_dias;
			
			function __construct($signo, $dias, $ano, $desc, $id_dias)
			{
				$this->signo = $signo;
				$this->dias = $dias;
				$this->ano = $ano;
				$this->desc = $desc;
				$this->id_dias = $id_dias;
			}

			public function insertar()
			{
				session_start();
				require("../../control/connect.php");
				$date = date('Y-m-j');
	              $ano = "SELECT * FROM `ejercicio` WHERE `estatus` = 1";
	              $res_anos = $mysqli->query($ano);
	              $row_anos = $res_anos->fetch_array();
				  $sel_pp = "INSERT INTO `dias_vacaciones`(`descripcion`, `dias`, `id_ejercicio`, `fecha`, `id_datosper`, `id_autoriza`, `signo`) VALUES ('$this->desc',$this->dias,$row_anos[0],'$date',$_SESSION[id_tmp2],$_SESSION[id_datosper],'$this->signo')";				
				$res_pu = $mysqli->query($sel_pp);
				if ($mysqli->error) 
				{
					echo "<script>if(confirm('No se pudo agregar los días de vacaciones')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}else
				{
					echo "<script> document.location='$link'; </script>";
				}
			}
		}
	
		/**
		* Aqui se hace la clase de agregar puestos en la hoja de salario
		*/
		class salario
		{
		public $f_inicio;
        public $salario;
        public $puesto;
        public $id;
        public $f_final;
			function __construct($f_inicio, $salario, $puesto, $id, $f_final)
			{
				$this->f_inicio = $f_inicio;
		        $this->salario = $salario;
		        $this->puesto = $puesto;
		        $this->id = $id;
		        $this->f_final = $f_final;
			}

			public function insertar()
			{
				session_start();
				require("../../control/connect.php");
				$sel_pp = "SELECT * FROM `puesto_per` WHERE `id_datosper` = $_SESSION[id_tmp2] AND `fecha_final` = '0000-00-00'";				
				$res_pu = $mysqli->query($sel_pp);
				$numrows = $res_pu->num_rows;
				if ($numrows > 0 && $this->f_final == '0000-00-00') 
				{	
					echo "<script>if(confirm('Ya existe un puesto actual')){ 
						document.location='$link';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
				}else
				{
					$isert_pp = "INSERT INTO `puesto_per`(`fecha`, `fecha_final`, `salario`, `id_datosper`, `id_puesto`) VALUES ('$this->f_inicio', '$this->f_final', $this->salario,$_SESSION[id_tmp2],$this->puesto)";				
					$res_pu = $mysqli->query($isert_pp);
					if ($mysqli->error) {
						echo "<script>if(confirm('No se pudo agregar el puesto')){ 
						document.location='$link';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
					}else
					{
						echo "<script> document.location='$link'; </script>";
					}
				}
			}


			public function actualizar()
			{
				session_start();
				require("../../control/connect.php");
				$sel_pp = "SELECT * FROM `puesto_per` WHERE `id_datosper` = $_SESSION[id_tmp2] AND `fecha_final` = '0000-00-00'";				
				$res_pu = $mysqli->query($sel_pp);
				$numrows = $res_pu->num_rows;
				if ($numrows > 0 && $this->f_final == '0000-00-00') 
				{
					echo "<script>if(confirm('Ya existe un puesto actual')){ 
						document.location='$link';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
				}else
				{
					
					echo $upd_pu = "UPDATE `puesto_per` SET `fecha`='$this->f_inicio', `fecha_final` = '$this->f_final', `salario`=$this->salario,`id_puesto`=$this->puesto WHERE `id_puestoper` = $this->id";
					$res_updpu = $mysqli->query($upd_pu);


					if ($mysqli->error) {
						echo "<script>if(confirm('No se pudo actualizar el puesto')){ 
						document.location='$link';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
					}else
					{
						echo "<script> document.location='$link'; </script>";
					}
				}
			}
		}

		class datos
		{
		public $datper_pnom;
        public $datper_snom;
        public $datper_pape;
        public $datper_sape;
        public $datper_lugar;
        public $datper_date;
        public $datper_rfc;
        public $datper_curp;
        public $datper_imss;
        public $datper_unifam;
        public $datper_anoexp;
        public $datper_calle;
        public $datper_extint;
        public $datper_col;
        public $datper_cp;
        public $datper_municipio;
        public $datper_nacio;
        public $datper_telpart;
        public $datper_telcel;
        public $datper_correo;
        public $datper_ecivil;
        public $datper_banco;
        public $datper_ncuenta;
        public $datper_nclabe;
        public $datper_sexo;
        public $datper_ncredito;
        public $id;
        public $empresa;
        public $f_inicio;
        public $salario;
        public $puesto;

		function __construct($datper_pnom, $datper_snom, $datper_pape, $datper_sape, $datper_lugar, $datper_date, $datper_rfc, $datper_curp, $datper_imss, $datper_unifam, $datper_anoexp, $datper_calle, $datper_extint, $datper_col, $datper_cp, $datper_municipio, $datper_telpart, $datper_telcel, $datper_correo, $datper_ecivil,  $datper_banco, $datper_ncuenta, $datper_nclabe, $datper_sexo, $datper_ncredito, $id, $datper_nacio, $empresa, $f_inicio, $salario, $puesto)
		{
			$this->datper_pnom = $datper_pnom;
	        $this->datper_snom = $datper_snom;
	        $this->datper_pape = $datper_pape;
	        $this->datper_sape =  $datper_sape;
	        $this->datper_lugar = $datper_lugar;
	        $this->datper_date = $datper_date;
	        $this->datper_rfc = $datper_rfc;
	        $this->datper_curp = $datper_curp;
	        $this->datper_imss = $datper_imss;
	        $this->datper_unifam = $datper_unifam;
	        $this->datper_anoexp = $datper_anoexp;
	        $this->datper_calle = $datper_calle;
	        $this->datper_extint = $datper_extint;
	        $this->datper_col = $datper_col; 
	        $this->datper_cp = $datper_cp;
	        $this->datper_municipio = $datper_municipio;
	        $this->datper_nacio = $datper_nacio;
	        $this->datper_telpart = $datper_telpart;
	        $this->datper_telcel = $datper_telcel;
	        $this->datper_correo = $datper_correo;
	        $this->datper_ecivil = $datper_ecivil;
	        $this->datper_banco = $datper_banco;
	        $this->datper_ncuenta = $datper_ncuenta;
	        $this->datper_nclabe = $datper_nclabe;
	        $this->datper_sexo = $datper_sexo;
	        $this->datper_ncredito = $datper_ncredito;

	        $this->id = $id;

	        $this->empresa = $empresa;
	        $this->f_inicio = $f_inicio;
	        $this->salario = $salario;
	        $this->puesto = $puesto;


		}
		public function registrar()
		{

			session_start();
			require("../../control/connect.php");			
			$mysqli->set_charset("utf8");	
			// AGREGAR DATOS PERSONALES 
				$obtDatPer = "INSERT INTO `datos_personales`(`primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno`, `lugar_nacimiento`, `f_nacimiento`, `sexo`, `rfc`, `curp`, `imss`, `ano_experiencia`, `unidad_medica`, `calle`, `n_extint`, `colonia`, `cp`, `tel_part`, `tel_celular`, `correo`, `banco`, `n_bancaria`, `n_interbancaria`, `n_creinfo`, `estado_civil`, `id_municipio`, `solicitante`, `estatus`, `nacionalidad`) VALUES ('$this->datper_pnom','$this->datper_snom','$this->datper_pape','$this->datper_sape','$this->datper_lugar', '$this->datper_date','$this->datper_sexo','$this->datper_rfc','$this->datper_curp','$this->datper_imss',$this->datper_anoexp,'$this->datper_unifam','$this->datper_calle', $this->datper_extint,'$this->datper_col',$this->datper_cp,$this->datper_telpart,$this->datper_telcel,'$this->datper_correo','$this->datper_banco',$this->datper_ncuenta,$this->datper_nclabe, $this->datper_ncredito ,'$this->datper_ecivil',$this->datper_municipio, 0, 1, '$this->datper_nacio')";
				$resul_datper = $mysqli->query($obtDatPer);


			// SELECT DATOS PERSONALES
				$ctr_datper = "SELECT `id_datosper` FROM `datos_personales` WHERE `rfc` = '$this->datper_rfc' and `curp` = '$this->datper_curp'";				
				$res_datper = $mysqli->query($ctr_datper);
				/*if (!$mysqli->query($res_datper)) {
    echo "Falló la selección de la tabla: (" . $mysqli->errno . ") " . $mysqli->error;
}*/
				$numrows = $res_datper->num_rows;
 				$row_resdatper = $res_datper->fetch_array();
				if($numrows > 0)
				{
					$sel_pu = "INSERT INTO `puesto_per`(`fecha`, `salario`, `id_datosper`, `id_puesto`) VALUES ('$this->f_inicio',$this->salario,$row_resdatper[0],$this->puesto)";				
					$res_pu = $mysqli->query($sel_pu);
					if ($mysqli->error) {
						echo "<script>if(confirm('No se pudo agregar el puesto')){ 
						document.location='http://admonkco.com/rhkarlco/modulos/empleados/l_empleados.php';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
					}else
					{
						echo "<script> document.location='l_empleados.php'; </script>";
					}
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($numrows == 0){
					echo "<script>if(confirm('Hubo un error o ya existe su información en la base de datos')){ 
					document.location='http://admonkco.com/rhkarlco/modulos/empleados/r_empleados.php';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}


		} // CIERRA LA FUNCIÓN REGISTRAR

		public function modificar()
		{
			session_start();
			require("../../control/connect.php");
			
			if ($this->id != 0) 
			{
				
			/* ***************ACTUALIZAR DATOS PERSONALES *************************** */
			
			$updDatPer = "UPDATE `datos_personales` SET `primer_nombre`='$this->datper_pnom',`segundo_nombre`='$this->datper_snom',`ap_paterno`='$this->datper_pape',`ap_materno`='$this->datper_sape',`lugar_nacimiento`='$this->datper_lugar',`f_nacimiento`='$this->datper_date',`sexo`='$this->datper_sexo',`rfc`='$this->datper_rfc',`curp`='$this->datper_curp',`imss`='$this->datper_imss',`ano_experiencia`=$this->datper_anoexp,`unidad_medica`='$this->datper_unifam',`calle`='$this->datper_calle',`n_extint`=$this->datper_extint,`colonia`='$this->datper_col',`cp`=$this->datper_cp,`tel_part`=$this->datper_telpart,`tel_celular`=$this->datper_telcel,`correo`='$this->datper_correo',`banco`='$this->datper_banco',`n_bancaria`=$this->datper_ncuenta,`n_interbancaria`=$this->datper_nclabe,`n_creinfo`=$this->datper_ncredito,`estado_civil`='$this->datper_ecivil',`id_municipio`=$this->datper_municipio, `nacionalidad` = '$this->datper_nacio' WHERE `id_datosper` = $this->id";
			$resul_datperupd = $mysqli->query($updDatPer);
			// SELECT DATOS PERSONALES
				$ctr_datperupd = "SELECT * FROM `datos_personales` WHERE `primer_nombre`='$this->datper_pnom' and `segundo_nombre`='$this->datper_snom' and `ap_paterno`='$this->datper_pape' and `ap_materno`='$this->datper_sape' and `lugar_nacimiento`='$this->datper_lugar' and `f_nacimiento`='$this->datper_date' and `sexo`='$this->datper_sexo' and `rfc`='$this->datper_rfc' and `curp`='$this->datper_curp' and `imss`='$this->datper_imss' and `ano_experiencia`=$this->datper_anoexp and `unidad_medica`='$this->datper_unifam' and `calle`='$this->datper_calle' and `n_extint`=$this->datper_extint and `colonia`='$this->datper_col' and `cp`=$this->datper_cp and `tel_part`=$this->datper_telpart and `tel_celular`=$this->datper_telcel and `correo`='$this->datper_correo' and `banco`='$this->datper_banco' and `n_bancaria`=$this->datper_ncuenta and `n_interbancaria`=$this->datper_nclabe and `n_creinfo`=$this->datper_ncredito and `estado_civil`='$this->datper_ecivil' and `id_municipio`=$this->datper_municipio and `id_datosper` = $this->id and `nacionalidad` = '$this->datper_nacio'";				
				$resul_datperupd2 = $mysqli->query($ctr_datperupd);
				$numrowsupd = $resul_datperupd2->num_rows;
			
			
					if($numrowsupd > 0)
					{	
						echo "<script> document.location='l_empleados.php'; </script>";
					
					} //FINALIZA EL IF DE DATOS PERSONALES
					if($numrowsupd == 0){
						echo "<script>if(confirm('No se pudo actualizar')){
						document.location='m_empleados.php?id=$this->id';}
						else{ alert('Operacion Cancelada');
						}</script>";
					}
			} else
			{
				/* ***************ACTUALIZAR DATOS PERSONALES *************************** */
			
			$updDatPer = "UPDATE `datos_personales` SET `primer_nombre`='$this->datper_pnom',`segundo_nombre`='$this->datper_snom',`ap_paterno`='$this->datper_pape',`ap_materno`='$this->datper_sape',`lugar_nacimiento`='$this->datper_lugar',`f_nacimiento`='$this->datper_date',`sexo`='$this->datper_sexo',`rfc`='$this->datper_rfc',`curp`='$this->datper_curp',`imss`='$this->datper_imss',`ano_experiencia`=$this->datper_anoexp,`unidad_medica`='$this->datper_unifam',`calle`='$this->datper_calle',`n_extint`=$this->datper_extint,`colonia`='$this->datper_col',`cp`=$this->datper_cp,`tel_part`=$this->datper_telpart,`tel_celular`=$this->datper_telcel,`correo`='$this->datper_correo',`banco`='$this->datper_banco',`n_bancaria`=$this->datper_ncuenta,`n_interbancaria`=$this->datper_nclabe,`n_creinfo`=$this->datper_ncredito,`estado_civil`='$this->datper_ecivil',`id_municipio`=$this->datper_municipio WHERE `id_datosper` = $_SESSION[id_tmp2]";
			$resul_datperupd = $mysqli->query($updDatPer);
			// SELECT DATOS PERSONALES
				$ctr_datperupd = "SELECT * FROM `datos_personales` WHERE `primer_nombre`='$this->datper_pnom' and `segundo_nombre`='$this->datper_snom' and `ap_paterno`='$this->datper_pape' and `ap_materno`='$this->datper_sape' and `lugar_nacimiento`='$this->datper_lugar' and `f_nacimiento`='$this->datper_date' and `sexo`='$this->datper_sexo' and `rfc`='$this->datper_rfc' and `curp`='$this->datper_curp' and `imss`='$this->datper_imss' and `ano_experiencia`=$this->datper_anoexp and `unidad_medica`='$this->datper_unifam' and `calle`='$this->datper_calle' and `n_extint`=$this->datper_extint and `colonia`='$this->datper_col' and `cp`=$this->datper_cp and `tel_part`=$this->datper_telpart and `tel_celular`=$this->datper_telcel and `correo`='$this->datper_correo' and `banco`='$this->datper_banco' and `n_bancaria`=$this->datper_ncuenta and `n_interbancaria`=$this->datper_nclabe and `n_creinfo`=$this->datper_ncredito and `estado_civil`='$this->datper_ecivil' and `id_municipio`=$this->datper_municipio and `id_datosper` = $_SESSION[id_tmp2]";				
				$resul_datperupd2 = $mysqli->query($ctr_datperupd);
				$numrowsupd = $resul_datperupd2->num_rows;
			
			
					if($numrowsupd > 0)
					{	
						echo "<script> document.location='perfil.php'; </script>";
					
					} //FINALIZA EL IF DE DATOS PERSONALES
					if($numrowsupd == 0){
						echo "<script>if(confirm('No se pudo actualizar')){
						document.location='m_empleados.php?id=$this->id';}
						else{ alert('Operacion Cancelada');
						}</script>";
					}
			} // CIERRA EL ELSE


		}// CIERRA LA FUNCIÓN MODIFICAR


	}// CIERRA LA CLASE

	/* ********************************************************************************************************************************************** CLASE INSERTAR HABILIDAD **********************************************************************************************************************************************	*/

	   class habilidad
	   	{
	   		public $hdad;

	   		function __construct($hdad)
	   		{
	   			$this->hdad = $hdad;
	   		}

	   		public function insertar()
	   		{
	   			session_start();
				require("../../control/connect.php");

	   			//INICIA EL INSERT FOREACH DE habilidades
			    for ($s=0; $s <= count($this->hdad) -1 ; $s++) {					
					
			        // AGREGAR habilidades 
					$InsHdad = "INSERT INTO `habilidades`(`id_lhab`, `id_datosper`) VALUES (".$this->hdad[$s].",$_SESSION[id_tmp2])";
					$resul_Hdad = $mysqli->query($InsHdad);
					
			    }//FINALIZA EL INSERT FOREACH DE habilidades
			    $t=0;
			    //INICIA EL INSERT FOREACH DE habilidades
			    for ($s=0; $s <= count($this->hdad) -1 ; $s++) {					
					
			        // AGREGAR habilidades 
					$Sel_Hdad = "SELECT `id_habilidad` FROM `habilidades` WHERE `id_lhab` = ".$this->hdad[$s]." and `id_datosper` = $_SESSION[id_tmp2]";				
					$res_selHdad = $mysqli->query($Sel_Hdad);
					$numrows = $res_selHdad->num_rows;
					if($numrows == 0)
						{//echo "locura";
					$t++;
					}
					
			    }//FINALIZA EL INSERT FOREACH DE habilidades
			// SELECT DATOS PERSONALES
				
				if($t == 0)
				{//echo "aqui 1";
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($t > 0){//echo "aqui 2";
					echo "<script>if(confirm('Algunas datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	}

/* ********************************************************************************************************************************************** CLASE MODIFICAR HABILIDADES **********************************************************************************************************************************************	*/

	   	class mhabilidad
	   	{
	   		public $mhdad;
	   		public $id;

	   		function __construct($mhdad, $id)
	   		{
	   			$this->mhdad = $mhdad;
	   			$this->id = $id;
	   		}


	   		public function actualizar()
	   		{
	   			session_start();
				require("../../control/connect.php");
			        // AGREGAR habilidades 
					$updHab = "UPDATE `habilidades` SET `habilidad`='$this->prof' WHERE `id_habilidad` = $this->id";
					$resul_Hab = $mysqli->query($updHab);					
					
			        // AGREGAR habilidades 
					$Sel_Hab = "SELECT `id_habilidad` FROM `habilidades` WHERE `habilidad` = '$this->prof' and `id_habilidad` = $this->id";				
					$res_selhab = $mysqli->query($Sel_Hab);
					$numrows = $res_selhab->num_rows;
			// SELECT DATOS PERSONALES
				
				if($numrows > 0)
				{
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($numrows == 0){
					echo "<script>if(confirm('Algunas datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	} 

	  	if (isset($_GET["borrar"])) 
	  	{
	  		require("../../control/connect.php");
	  		$id = $_GET["borrar"];
	  		$borrarHab = "DELETE FROM `habilidades` WHERE `id_habilidad` = $id";       
        	$borrarHab = $mysqli->query($borrarHab);
	        $sel_borrarH = "SELECT `id_habilidad` FROM `habilidades` WHERE `id_habilidad` = $id";       
	        $res_selborrarH = $mysqli->query($sel_borrarH);
	        $numrows1 = $res_selborrarH->num_rows;
	        if($numrows1 == 0)
	            {
	              header( "Refresh:0; url=$link");
	            } else
	            {
	            	echo "<script>if(confirm('No se pudo borrar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
	            }
	  	}


/* ********************************************************************************************************************************************** CLASE INSERTAR ESTUDIOS ANTERIORES **********************************************************************************************************************************************	*/

	   	class estant
	   	{
	   		public $est_escu;
	   		public $est_gmax;
	   		public $est_certi;

	   		function __construct($est_escu, $est_gmax, $est_certi)
	   		{
	   			$this->est_escu = $est_escu;
	   			$this->est_gmax = $est_gmax;
	   			$this->est_certi = $est_certi;
	   		}


	   		public function insertar()
	   		{
	   			session_start();
				require("../../control/connect.php");
			        //INICIA EL INSERT FOREACH DE estudios
			    for ($s=0; $s <= count($this->est_escu) -1 ; $s++) 
			    {	
			        // AGREGAR estudios 
					$InsEstant = "INSERT INTO `estudios`(`escuela`, `grado`, `certificado`, `id_datosper`) VALUES ('".$this->est_escu[$s]."','".$this->est_gmax[$s]."',".$this->est_certi[$s].",$_SESSION[id_tmp2])";
					$resul_Estant = $mysqli->query($InsEstant);
			    }//FINALIZA EL INSERT FOREACH DE estudios

			    $t=0;

			    //INICIA EL INSERT FOREACH DE estudios
			    for ($s2=0; $s2 <= count($this->est_escu) -1 ; $s2++) 
			    {					
					
			        // AGREGAR estudios 
					$Sel_Estant = "SELECT `id_estudios` FROM `estudios` WHERE `escuela` = '".$this->est_escu[$s2]."' and `grado` = '".$this->est_gmax[$s2]."' and `certificado` = ".$this->est_certi[$s2]." and `id_datosper` = $_SESSION[id_tmp2]";				
					$res_selEstant = $mysqli->query($Sel_Estant);
					$numrowsEA = $res_selEstant->num_rows;
					if($numrowsEA == 0)
						{
					$t++;
					}
					
			    }//FINALIZA EL INSERT FOREACH DE estudios
			// SELECT DATOS PERSONALES
				
				if($t == 0)
				{//echo "aqui 1";
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE estudios
				if($t > 0){//echo "aqui 2";
					echo "<script>if(confirm('Algunos datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	}


	   	class mestant
	   	{
	   		public $mest_escu;
	   		public $mest_gmax;
	   		public $mest_certi;
	   		public $id_estant;

	   		function __construct($mest_escu, $mest_gmax, $mest_certi, $id_estant)
	   		{
	   			$this->mest_escu = $mest_escu;
	   			$this->mest_gmax = $mest_gmax;
	   			$this->mest_certi = $mest_certi;
	   			$this->id_estant = $id_estant;
	   		}


	   		public function actualiza()
	   		{
	   			session_start();
				require("../../control/connect.php");
			        // AGREGAR estudios 
					echo $Updsestant = "UPDATE `estudios` SET `escuela`='$this->mest_escu',`grado`='$this->mest_gmax',`certificado`=$this->mest_certi WHERE `id_estudios` = $this->id_estant";
					$resul_updEstant = $mysqli->query($Updsestant);

			        // AGREGAR estudios 
					$Sel_Estant = "SELECT `id_estudios` FROM `estudios` WHERE `id_estudios` = $this->id_estant and `escuela` = '$this->mest_escu' and `grado` = '$this->mest_gmax' and `certificado` = $this->mest_certi";				
					$res_selEstant = $mysqli->query($Sel_Estant);
					$numrowsEA = $res_selEstant->num_rows;
			// SELECT estudios
				
				if($numrowsEA > 0)
				{//echo "aqui 1";
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE estudios
				if($numrowsEA == 0){//echo "aqui 2";
					echo "<script>if(confirm('Algunos datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	}

	   	if (isset($_GET["borrarEstant"])) 
	  	{
	  		require("../../control/connect.php");
	  		$id = $_GET["borrarEstant"];
	  		$borrarEstant = "DELETE FROM `estudios` WHERE `id_estudios` = $id";       
        	$borrarEstant = $mysqli->query($borrarEstant);
	        $sel_borrarEstant = "SELECT `id_estudios` FROM `estudios` WHERE `id_estudios` = $id";       
	        $res_selborrarEstant = $mysqli->query($sel_borrarEstant);
	        $numrowsEstant = $res_selborrarEstant->num_rows;
	        if($numrowsEstant == 0)
	            {
	              header( "Refresh:0; url=$link");
	            } else
	            {
	            	echo "<script>if(confirm('No se pudo borrar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
	            }
	  	} 



/* ********************************************************************************************************************* CLASE INSERTAR BENEFICIARIOS EN CASO DE FALLECIMIENTO*********************************************************************************************************************	*/

	   	class beneficiarios
	   	{
	   		public $benfa_pnom;
	   		public $benfa_snom;
	   		public $benfa_pape;
	   		public $benfa_sape;
	   		public $benfa_domici;
	   		public $benfa_tel;
	   		public $benfa_parent;

	   		function __construct($benfa_pnom, $benfa_snom, $benfa_pape, $benfa_sape, $benfa_domici, $benfa_tel, $benfa_parent)
	   		{
	   			$this->benfa_pnom = $benfa_pnom;
	   			$this->benfa_snom = $benfa_snom;
	   			$this->benfa_pape = $benfa_pape;
	   			$this->benfa_sape = $benfa_sape;
	   			$this->benfa_domici = $benfa_domici;
	   			$this->benfa_tel = $benfa_tel;
	   			$this->benfa_parent = $benfa_parent;
	   		}


	   		public function insertar()
	   		{
	   			session_start();
				require("../../control/connect.php");
			    //INICIA EL INSERT FOREACH DE BENEFICIARIOS EN CASO DE FALLECIMIENTO
				for ($q=0; $q <= count($this->benfa_pnom) -1 ; $q++) {					
						
				        // AGREGAR BENEFICIARIOS EN CASO DE FALLECIMIENTO 
						$obtbenfa = "INSERT INTO `beneficiarios`(`primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno`, `parentesco`, `domicilio`, `tel`, `id_datosper`) VALUES ('".$this->benfa_pnom[$q]."','".$this->benfa_snom[$q]."','".$this->benfa_pape[$q]."','".$this->benfa_sape[$q]."','".$this->benfa_parent[$q]."','".$this->benfa_domici[$q]."', ".$this->benfa_tel[$q].",$_SESSION[id_tmp2])";
						$resul_benfa = $mysqli->query($obtbenfa);
						
				    }//FINALIZA EL INSERT FOREACH DE BENEFICIARIOS EN CASO DE FALLECIMIENTO

			    $t=0;

			    //INICIA EL SELECT DE BENEFICIARIOS
			    for ($s2=0; $s2 <= count($this->benfa_pnom) -1 ; $s2++) 
			    {					
					
			        // BUSCAR BENEFICIARIOS 
					$Sel_benfa = "SELECT `id_benificiario` FROM `beneficiarios` WHERE `primer_nombre` = '".$this->benfa_pnom[$s2]."' and `segundo_nombre` = '".$this->benfa_snom[$s2]."' and `ap_paterno` = '".$this->benfa_pape[$s2]."' and `ap_materno` = '".$this->benfa_sape[$s2]."' and `parentesco` = '".$this->benfa_parent[$s2]."' and `domicilio` = '".$this->benfa_domici[$s2]."' and `tel` = ".$this->benfa_tel[$s2]." and `id_datosper` = $_SESSION[id_tmp2]";				
					$res_selBenfa = $mysqli->query($Sel_benfa);
					$numrowsBenfa = $res_selBenfa->num_rows;
					if($numrowsBenfa == 0)
						{
					$t++;
					}
					
			    }//FINALIZA EL SELECT DE BENEFICIARIOS
			// SELECT DATOS PERSONALES
				
				if($t == 0)
				{//echo "aqui 1";
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($t > 0){//echo "aqui 2";
					echo "<script>if(confirm('Algunos datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	}


	   	class mbeneficiarios
	   	{
	   		public $benfa_pnom;
	   		public $benfa_snom;
	   		public $benfa_pape;
	   		public $benfa_sape;
	   		public $benfa_domici;
	   		public $benfa_tel;
	   		public $benfa_parent;
	   		public $id_benfa;

	   		function __construct($benfa_pnom, $benfa_snom, $benfa_pape, $benfa_sape, $benfa_domici, $benfa_tel, $benfa_parent, $id_benfa)
	   		{
	   			$this->benfa_pnom = $benfa_pnom;
	   			$this->benfa_snom = $benfa_snom;
	   			$this->benfa_pape = $benfa_pape;
	   			$this->benfa_sape = $benfa_sape;
	   			$this->benfa_domici = $benfa_domici;
	   			$this->benfa_tel = $benfa_tel;
	   			$this->benfa_parent = $benfa_parent;
	   			$this->id_benfa = $id_benfa;
	   		}



	   		public function actualiza()
	   		{
	   			session_start();
				require("../../control/connect.php");				
						
			        // AGREGAR BENEFICIARIOS EN CASO DE FALLECIMIENTO 
					$obtbenfa = "UPDATE `beneficiarios` SET `primer_nombre`='$this->benfa_pnom',`segundo_nombre`='$this->benfa_snom',`ap_paterno`='$this->benfa_pape',`ap_materno`='$this->benfa_sape',`parentesco`='$this->benfa_parent',`domicilio`='$this->benfa_domici',`tel`= $this->benfa_tel WHERE `id_benificiario` = $this->id_benfa";
					$resul_benfa = $mysqli->query($obtbenfa);

			        // BUSCAR BENEFICIARIOS 
					$Sel_benfa = "SELECT `id_benificiario` FROM `beneficiarios` WHERE `primer_nombre` = '$this->benfa_pnom' and `segundo_nombre` = '$this->benfa_snom' and `ap_paterno` = '$this->benfa_pape' and `ap_materno` = '$this->benfa_sape' and `parentesco` = '$this->benfa_parent' and `domicilio` = '$this->benfa_domici' and `tel` = $this->benfa_tel and `id_benificiario` = $this->id_benfa";				
					$res_selBenfa = $mysqli->query($Sel_benfa);
					$numrowsBenfa = $res_selBenfa->num_rows;
			// SELECT DATOS PERSONALES
				
				if($numrowsBenfa > 0)
				{//echo "aqui 1";
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($numrowsBenfa == 0){//echo "aqui 2";
					echo "<script>if(confirm('Algunos datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	}

	   	if (isset($_GET["borrarBenfa"])) 
	  	{
	  		require("../../control/connect.php");
	  		$id = $_GET["borrarBenfa"];
	  		$borrarBenfa = "DELETE FROM `beneficiarios` WHERE `id_benificiario` = $id";       
        	$borrarBenfa = $mysqli->query($borrarBenfa);
	        $sel_borrarBenfa = "SELECT `id_benificiario` FROM `beneficiarios` WHERE `id_benificiario` = $id";       
	        $res_selborrarBenfa = $mysqli->query($sel_borrarBenfa);
	        $numrowsBenfa = $res_selborrarBenfa->num_rows;
	        if($numrowsBenfa == 0)
	            {
	              header( "Refresh:0; url=$link");
	            } else
	            {
	            	echo "<script>if(confirm('No se pudo borrar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
	            }
	  	} 


/* ********************************************************************************************************************************************** CLASE INSERTAR DATOS FAMILIARES **********************************************************************************************************************************************	*/

	   	class datosfami
	   	{
	   		public $datfami_pnom;
	   		public $datfami_snom;
	   		public $datfami_pape;
	   		public $datfami_sape;
	   		public $datfami_date;
	   		public $datfami_parent;
	   		public $archivo;
	   		public $type;
	        public $tamano;
	        public $tmp_name;
	        public $error;

	   		function __construct($datfami_pnom, $datfami_snom, $datfami_pape, $datfami_sape, $datfami_date, $datfami_parent, $archivo, $type, $tamano, $tmp_name, $error)
	   		{
	   			$this->datfami_pnom = $datfami_pnom;
	   			$this->datfami_snom = $datfami_snom;
	   			$this->datfami_pape = $datfami_pape;
	   			$this->datfami_sape = $datfami_sape;
	   			$this->datfami_date = $datfami_date;
	   			$this->datfami_parent = $datfami_parent;
	   			$this->archivo = $archivo;
	   			$this->type = $type;
		        $this->tamano = $tamano;
		        $this->tmp_name = $tmp_name;
		        $this->error = $error;
	   		}


	   		public function insertar()
	   		{
	   			session_start();
				require("../../control/connect.php");
			    //INICIA EL INSERT FOREACH DE DATOS FAMILIARES
				for ($q=0; $q <= count($this->datfami_pnom) -1 ; $q++) {
					$v=0;

				    	if ($this->error[$q] > 0){
								echo "ha ocurrido un error";
							} else {
								//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
								//y que el tamano del archivo no exceda los 1000kb
								$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "application/pdf");
								$limite_kb = 1000;

								if (in_array($this->type[$q], $permitidos) && $this->tamano[$q] <= $limite_kb * 1024){
									//esta es la ruta donde copiaremos la imagen
									//recuerden que deben crear un directorio con este mismo nombre
									//en el mismo lugar donde se encuentra el archivo subir.php
									$ruta = "../carga_archivos/archivos_subidos/" . $_SESSION["id_datosper"] ."___".$this->archivo[$q];
									//comprovamos si este archivo existe para no volverlo a copiar.
									//pero si quieren pueden obviar esto si no es necesario.
									//o pueden darle otro nombre para que no sobreescriba el actual.
									if (!file_exists($ruta)){
										//aqui movemos el archivo desde la ruta temporal a nuestra ruta
										//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
										//almacenara true o false
										$resultado = @move_uploaded_file($this->tmp_name[$q], $ruta);
										if ($resultado){
											
										} else {
											echo "<script>if(confirm('Error al mover el archivo')){ 
													document.location='$link';} 
													else{ alert('Operacion Cancelada'); 
													}</script>";
													$v = 1;
										}
									} else {
										echo "<script>if(confirm('Este archivo ya existe')){ 
										document.location='$link';} 
										else{ alert('Operacion Cancelada'); 
										}</script>";
										$v = 1;
									}
								} else {
									echo "<script>if(confirm('Este tipo de archivo no es permitido')){ 
											document.location='$link';} 
											else{ alert('Operacion Cancelada'); 
											}</script>";
											$v = 1;
								}
							}					
						if ($v == 0) {
							
						
				        // AGREGAR DATOS FAMILIARES 
						$obtDatfami = "INSERT INTO `datos_familiares`(`primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno`, `nacimiento`, `tipo`, `acta_nacimiento`, `id_datosper`) VALUES ('".$this->datfami_pnom[$q]."','".$this->datfami_snom[$q]."','".$this->datfami_pape[$q]."','".$this->datfami_sape[$q]."','".$this->datfami_date[$q]."','".$this->datfami_parent[$q]."', '$_SESSION[id_tmp2]___".$this->archivo[$q]."',$_SESSION[id_tmp2])";
						$resul_datfami = $mysqli->query($obtDatfami);
						}
				    }//FINALIZA EL INSERT FOREACH DE DATOS FAMILIARES

			    $t=0;

			    //INICIA EL SELECT DE DATOS FAMILIARES
			    for ($s2=0; $s2 <= count($this->datfami_pnom) -1 ; $s2++) 
			    {					
					
			        // BUSCAR DATOS FAMILIARES 
					$Sel_datfami = "SELECT `id_datosfam` FROM `datos_familiares` WHERE `primer_nombre` = '".$this->datfami_pnom[$s2]."' and `segundo_nombre` = '".$this->datfami_snom[$s2]."' and `ap_paterno` = '".$this->datfami_pape[$s2]."' and `ap_materno` = '".$this->datfami_sape[$s2]."' and `nacimiento` = '".$this->datfami_date[$s2]."' and `tipo` = '".$this->datfami_parent[$s2]."' and `acta_nacimiento` = '$_SESSION[id_tmp2]___".$this->archivo[$s2]."' and `id_datosper` = $_SESSION[id_tmp2]";				
					$res_selDatfami = $mysqli->query($Sel_datfami);
					$numrowsDatfami = $res_selDatfami->num_rows;
					if($numrowsDatfami == 0)
						{
					$t++;
					}
					
			    }//FINALIZA EL SELECT DE DATOS FAMILIARES
			// SELECT DATOS PERSONALES
				
				if($t == 0)
				{//echo "aqui 1";
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($t > 0){//echo "aqui 2";
					echo "<script>if(confirm('Algunos datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
				
	   		}
	   	}


		class Mdatosfami
	   	{
	   		public $datfami_pnom;
	   		public $datfami_snom;
	   		public $datfami_pape;
	   		public $datfami_sape;
	   		public $datfami_date;
	   		public $datfami_parent;
	   		public $archivo;
	   		public $type;
	        public $tamano;
	        public $tmp_name;
	        public $error;
	        public $id;
	        public $opt;

	   		function __construct($datfami_pnom, $datfami_snom, $datfami_pape, $datfami_sape, $datfami_date, $datfami_parent, $archivo, $type, $tamano, $tmp_name, $error, $id, $opt)
	   		{
	   			$this->datfami_pnom = $datfami_pnom;
	   			$this->datfami_snom = $datfami_snom;
	   			$this->datfami_pape = $datfami_pape;
	   			$this->datfami_sape = $datfami_sape;
	   			$this->datfami_date = $datfami_date;
	   			$this->datfami_parent = $datfami_parent;
	   			$this->archivo = $archivo;
	   			$this->type = $type;
		        $this->tamano = $tamano;
		        $this->tmp_name = $tmp_name;
		        $this->error = $error;
		        $this->id = $id;
		        $this->opt = $opt;
	   		}


	   	public function actualiza()
	   	{
	   			session_start();
				require("../../control/connect.php");

			if ($this->opt == 0) 
			{
				// AGREGAR DATOS FAMILIARES 
				$obtDatfami = "UPDATE `datos_familiares` SET `primer_nombre`='$this->datfami_pnom',`segundo_nombre`='$this->datfami_snom',`ap_paterno`='$this->datfami_pape',`ap_materno`='$this->datfami_sape',`nacimiento`='$this->datfami_date',`tipo`='$this->datfami_parent' WHERE `id_datosfam` = $this->id";
				$resul_datfami = $mysqli->query($obtDatfami);

			    
		        // BUSCAR DATOS FAMILIARES 
				$Sel_datfami = "SELECT `id_datosfam` FROM `datos_familiares` WHERE `primer_nombre` = '$this->datfami_pnom' and `segundo_nombre` = '$this->datfami_snom' and `ap_paterno` = '$this->datfami_pape' and `ap_materno` = '$this->datfami_sape' and `nacimiento` = '$this->datfami_date' and `tipo` = '$this->datfami_parent' and `id_datosper` = $_SESSION[id_tmp2] and `id_datosfam` = $this->id";				
				$res_selDatfami = $mysqli->query($Sel_datfami);
				$numrowsDatfami2 = $res_selDatfami->num_rows;
				
				if($numrowsDatfami2 > 0)
				{//echo "aqui 1 del else";
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($numrowsDatfami2 == 0){//echo "aqui 2 del else";
					echo "<script>if(confirm('Algunos datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}		
			}else
			{
		        $sel_Datfami = "SELECT `id_datosfam`, `acta_nacimiento` FROM `datos_familiares` WHERE `id_datosfam` = $this->id";       
	        			$res_selDatfami = $mysqli->query($sel_Datfami);
	        			$row = $res_selDatfami->fetch_array();
						$v=0;

				    	if ($this->error[$q] > 0){
								echo "ha ocurrido un error";
							} else {
								//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
								//y que el tamano del archivo no exceda los 1000kb
								$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "application/pdf");
								$limite_kb = 1000;

								if (in_array($this->type, $permitidos) && $this->tamano <= $limite_kb * 1024){
									//esta es la ruta donde copiaremos la imagen
									//recuerden que deben crear un directorio con este mismo nombre
									//en el mismo lugar donde se encuentra el archivo subir.php
									$ruta = "../carga_archivos/archivos_subidos/" . $_SESSION["id_datosper"] ."___".$this->archivo;
									//comprovamos si este archivo existe para no volverlo a copiar.
									//pero si quieren pueden obviar esto si no es necesario.
									//o pueden darle otro nombre para que no sobreescriba el actual.
									if (!file_exists($ruta)){
										//aqui movemos el archivo desde la ruta temporal a nuestra ruta
										//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
										//almacenara true o false
										$resultado = @move_uploaded_file($this->tmp_name, $ruta);
										if ($resultado){
											unlink("../carga_archivos/archivos_subidos/$row[1]");//Se borra el archivo anterior
										} else {
											echo "<script>if(confirm('Error al mover el archivo')){ 
													document.location='$link';} 
													else{ alert('Operacion Cancelada'); 
													}</script>";
													$v = 1;
										}
									} else {
										echo "<script>if(confirm('Este archivo ya existe')){ 
										document.location='$link';} 
										else{ alert('Operacion Cancelada'); 
										}</script>";
										$v = 1;
									}
								} else {
									echo "<script>if(confirm('Este tipo de archivo no es permitido')){ 
											document.location='$link';} 
											else{ alert('Operacion Cancelada'); 
											}</script>";
											$v = 1;
								}
							}					
						if ($v == 0) {
							
						
				        // AGREGAR DATOS FAMILIARES 
						$obtDatfami = "UPDATE `datos_familiares` SET `primer_nombre`='$this->datfami_pnom',`segundo_nombre`='$this->datfami_snom',`ap_paterno`='$this->datfami_pape',`ap_materno`='$this->datfami_sape',`nacimiento`='$this->datfami_date',`tipo`='$this->datfami_parent',`acta_nacimiento`='$_SESSION[id_tmp2]___$this->archivo' WHERE `id_datosfam` = $this->id";
						$resul_datfami = $mysqli->query($obtDatfami);
						}

			    
			        // BUSCAR DATOS FAMILIARES 
					$Sel_datfami = "SELECT `id_datosfam` FROM `datos_familiares` WHERE `primer_nombre` = '$this->datfami_pnom' and `segundo_nombre` = '$this->datfami_snom' and `ap_paterno` = '$this->datfami_pape' and `ap_materno` = '$this->datfami_sape' and `nacimiento` = '$this->datfami_date' and `tipo` = '$this->datfami_parent' and `acta_nacimiento` = '$_SESSION[id_tmp2]___$this->archivo' and `id_datosper` = $_SESSION[id_tmp2] and `id_datosfam` = $this->id";				
					$res_selDatfami = $mysqli->query($Sel_datfami);
					$numrowsDatfami = $res_selDatfami->num_rows;
				
				if($numrowsDatfami > 0)
				{//echo "aqui 1";
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($numrowsDatfami == 0){//echo "aqui 2";
					echo "<script>if(confirm('Algunos datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
		}
	}

	   	if (isset($_GET["borrarDatfami"])) 
	  	{
	  		require("../../control/connect.php");
	  		$id = $_GET["borrarDatfami"];
	  		$Sel_datfami = "SELECT `id_datosfam`, `acta_nacimiento` FROM `datos_familiares` WHERE `id_datosfam` = $id";       
	        $res_selDatfami = $mysqli->query($Sel_datfami);
	        $row = $res_selDatfami->fetch_array();
	  		$borrarDatfami = "DELETE FROM `datos_familiares` WHERE `id_datosfam` = $id";       
        	$borrarDatfami = $mysqli->query($borrarDatfami);
	        $sel_borrarBenfa = "SELECT `id_datosfam`, `acta_nacimiento` FROM `datos_familiares` WHERE `id_datosfam` = $id";       
	        $res_selborrarBenfa = $mysqli->query($sel_borrarBenfa);
	        $numrowsBenfa = $res_selborrarBenfa->num_rows;
	        if($numrowsBenfa == 0)
	            {
	            	if (file_exists("../carga_archivos/archivos_subidos/$row[1]"))//Vertifica que exista el archivo
	            	{ 
        				unlink("../carga_archivos/archivos_subidos/$row[1]");//borra el archivo
        				$v2 = 1;
    				} else
    				{
    					$v2 = 0;
    				}

    				if ($v2 = 1) { //verifica si el archivo fue borrado
    					header( "Refresh:0; url=$link");
    				}else
    				{ // aquí entra si el archivo no fue borrado
    					echo "<script>if(confirm('No se pudo borrar')){ 
						document.location='$link';} 
						else{ alert('Operacion Cancelada'); 
						}</script>";
    				}
	              
	            } else
	            {
	            	echo "<script>if(confirm('No se pudo borrar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
	            }
	  	}


/* ********************************************************************************************************************************************** CLASE EMPLEOS ANTERIORES **********************************************************************************************************************************************	*/

	   	class empleosAn
	   	{
	   		public $empant_empr;
	   		public $area;
	   		public $subarea;
	   		public $empant_jefe;
	   		public $empant_anoi;
	   		public $empant_anof;
	   		public $industria;
	   		public $empant_tel;

	   		function __construct($empant_empr, $area, $subarea, $empant_jefe, $empant_anoi, $empant_anof, $industria, $empant_tel)
	   		{
	   			$this->empant_empr = $empant_empr;
	   			$this->area = $area;
	   			$this->subarea = $subarea;
	   			$this->empant_jefe = $empant_jefe;
	   			$this->empant_anoi = $empant_anoi;
	   			$this->empant_anof = $empant_anof;
	   			$this->industria = $industria;
	   			$this->empant_tel = $empant_tel;
	   		}


	   		public function insertar()
	   		{
	   			session_start();
				require("../../control/connect.php");
			        //INICIA EL INSERT FOREACH DE EMPLEOS ANTERIORES
			    for ($s=0; $s <= count($this->empant_empr) -1 ; $s++) {					
					
			        // AGREGAR EMPLEOS ANTERIORES 
					$InsEmpant = "INSERT INTO `empleos_anteriores`(`empresa`, `jefe_inmediato`, `ano_inicio`, `ano_fin`, `tel`, `id_datosper`, `id_area`, `id_sub`, `id_industria`) VALUES ('".$this->empant_empr[$s]."','".$this->empant_jefe[$s]."','".$this->empant_anoi[$s]."','".$this->empant_anof[$s]."','".$this->empant_tel[$s]."',$_SESSION[id_tmp2],".$this->area[$s].",".$this->subarea[$s].",".$this->industria[$s].")";

					$resul_empant = $mysqli->query($InsEmpant);
					
			    }//FINALIZA EL INSERT FOREACH DE EMPLEOS ANTERIORES
			    
				
				if($resul_empant)
				{//echo "aqui 1";
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				else{//echo "aqui 2";
					echo "<script>if(confirm('Algunas datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	} 


	   	class MempleosAn
	   	{
	   		public $empant_empr;
	   		public $area;
	   		public $subarea;
	   		public $empant_jefe;
	   		public $empant_anoi;
	   		public $empant_anof;
	   		public $industria;
	   		public $empant_tel;
	   		public $id;

	   		function __construct($empant_empr, $area, $subarea, $empant_jefe, $empant_anoi, $empant_anof, $industria, $empant_tel, $id)
	   		{
	   			$this->empant_empr = $empant_empr;
	   			$this->area = $area;
	   			$this->subarea = $subarea;
	   			$this->empant_jefe = $empant_jefe;
	   			$this->empant_anoi = $empant_anoi;
	   			$this->empant_anof = $empant_anof;
	   			$this->industria = $industria;
	   			$this->empant_tel = $empant_tel;
	   			$this->id = $id;
	   		}


	   		public function actualiza()
	   		{
	   			session_start();
				require("../../control/connect.php");				
					
			        // AGREGAR EMPLEOS ANTERIORES 
					$UpdtEmpant = "UPDATE `empleos_anteriores` SET `empresa`='$this->empant_empr',`jefe_inmediato`='$this->empant_jefe',`ano_inicio`='$this->empant_anoi',`ano_fin`='$this->empant_anof',`tel`='$this->empant_tel',`id_area`=$this->area,`id_sub`=$this->subarea,`id_industria`=$this->industria WHERE `id_empleos` = $this->id";
					$resul_empant = $mysqli->query($UpdtEmpant);

			    	/*
					$Sel_Empant = "SELECT `id_empleos` FROM `empleos_anteriores` WHERE `empresa` = '$this->empant_empr' and `puesto` = '$this->empant_puesto' and `jefe_inmediato` = '$this->empant_jefe' and `ano` = $this->empant_ano and `tel` = $this->empant_tel and `id_datosper` = $_SESSION[id_tmp2] and `id_empleos` = $this->id";				
					$res_selempant = $mysqli->query($Sel_Empant);
					$numrows = $res_selempant->num_rows;*/
			// SELECT DATOS PERSONALES
				
				if($resul_empant)
				{//echo "aqui 1";
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				else{//echo "aqui 2";
					echo "<script>if(confirm('Algunas datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	} 

	  	if (isset($_GET["borrarEmpant"])) 
	  	{
	  		require("../../control/connect.php");
	  		$id = $_GET["borrarEmpant"];
	  		$borrarEmpant = "DELETE FROM `empleos_anteriores` WHERE `id_empleos` = $id";       
        	$borrarEmpant = $mysqli->query($borrarEmpant);
	        $sel_borrarEant = "SELECT `id_empleos` FROM `empleos_anteriores` WHERE `id_empleos` = $id";       
	        $res_selborrarEant = $mysqli->query($sel_borrarEant);
	        $numrows3 = $res_selborrarEant->num_rows;
	        if($numrows3 == 0)
	            {
	              header( "Refresh:0; url=$link");
	            } else
	            {
	            	echo "<script>if(confirm('No se pudo borrar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
	            }
	  	}



/* ********************************************************************************************************************************************** CLASE REFERENCIAS PERSONALES **********************************************************************************************************************************************	*/

	   	class refper
	   	{
	   		public $refper_pnom;
	   		public $refper_snom;
	   		public $refper_pape;
	   		public $refper_sape;
	   		public $refper_dir;
	   		public $refper_tel;
	   		public $refper_parent;

	   		function __construct($refper_pnom, $refper_snom, $refper_pape, $refper_sape, $refper_dir,$refper_tel, $refper_parent)
	   		{
	   			$this->refper_pnom = $refper_pnom;
	   			$this->refper_snom = $refper_snom;
	   			$this->refper_pape = $refper_pape;
	   			$this->refper_sape = $refper_sape;
	   			$this->refper_dir = $refper_dir;
	   			$this->refper_tel = $refper_tel;
	   			$this->refper_parent = $refper_parent;
	   		}


	   		public function insertar()
	   		{
	   			session_start();
				require("../../control/connect.php");
			        //INICIA EL INSERT FOREACH DE EMPLEOS ANTERIORES

			    for ($s=0; $s <= count($this->refper_pnom) -1 ; $s++) {					
					
			        // AGREGAR EMPLEOS ANTERIORES 
					$InsRefper = "INSERT INTO `referencias`(`primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno`, `direccion`, `tel`, `parentesco`, `id_datosper`) VALUES ('".$this->refper_pnom[$s]."','".$this->refper_snom[$s]."','".$this->refper_pape[$s]."','".$this->refper_sape[$s]."','".$this->refper_dir[$s]."',".$this->refper_tel[$s].",'".$this->refper_parent[$s]."',$_SESSION[id_tmp2])";
					$resul_refper = $mysqli->query($InsRefper);
					
			    }//FINALIZA EL INSERT FOREACH DE EMPLEOS ANTERIORES
			    $t=0;
			    //INICIA EL SELECT FOREACH DE EMPLEOS ANTERIORES
			    for ($s=0; $s <= count($this->empant_empr) -1 ; $s++) {	
			        // AGREGAR EMPLEOS ANTERIORES 
					$Sel_Refper = "SELECT `id_ref` FROM `referencias` WHERE `primer_nombre` = '".$this->refper_pnom[$s]."' and `segundo_nombre` = '".$this->refper_snom[$s]."' and `ap_paterno` = '".$this->refper_pape[$s]."' and `ap_materno` = '".$this->refper_sape[$s]."' and `direccion` = '".$this->refper_dir[$s]."' and `tel` = ".$this->refper_tel[$s]." and `parentesco` = '".$this->refper_parent[$s]."' and `id_datosper` = $_SESSION[id_tmp2]";
					$res_selrefper = $mysqli->query($Sel_Refper);
					$numrows = $res_selrefper->num_rows;
					if($numrows == 0)
						{//echo "locura";
					$t++;
					}
					
			    }//FINALIZA EL SELECT FOREACH DE EMPLEOS ANTERIORES
				if($t == 0)
				{//echo "aqui 1";
					echo "<script> document.location='$link'; </script>";
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($t > 0){//echo "aqui 2";
					echo "<script>if(confirm('Algunas datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}
	   		}
	   	} 


	   	class Mrefper
	   	{
	   		public $refper_pnom;
	   		public $refper_snom;
	   		public $refper_pape;
	   		public $refper_sape;
	   		public $refper_dir;
	   		public $refper_tel;
	   		public $refper_parent;
	   		public $id;

	   		function __construct($refper_pnom, $refper_snom, $refper_pape, $refper_sape, $refper_dir,$refper_tel, $refper_parent,$id)
	   		{
	   			$this->refper_pnom = $refper_pnom;
	   			$this->refper_snom = $refper_snom;
	   			$this->refper_pape = $refper_pape;
	   			$this->refper_sape = $refper_sape;
	   			$this->refper_dir = $refper_dir;
	   			$this->refper_tel = $refper_tel;
	   			$this->refper_parent = $refper_parent;
	   			$this->id = $id;
	   		}


	   		public function actualiza()
	   		{
	   			session_start();
				require("../../control/connect.php");				
					
			        // AGREGAR EMPLEOS ANTERIORES 
					$UpdtEmpant = "UPDATE `referencias` SET `primer_nombre`='$this->refper_pnom',`segundo_nombre`='$this->refper_snom',`ap_paterno`='$this->refper_pape',`ap_materno`='$this->refper_sape',`direccion`='$this->refper_dir',`tel`=$this->refper_tel,`parentesco`='$this->refper_parent' WHERE `id_ref` = $this->id";
					$resul_empant = $mysqli->query($UpdtEmpant);
					
				if($mysqli->error)
				{//echo "aqui 1";
					echo "<script>if(confirm('Algunas datos no se pudieron guardar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				
				} else{//echo "aqui 2";
					echo "<script> document.location='$link'; </script>";
				}
	   		}
	   	} 

	  	if (isset($_GET["borrarRefper"])) 
	  	{
	  		require("../../control/connect.php");
	  		$id = $_GET["borrarRefper"];
	  		$borrarRefper = "DELETE FROM `referencias` WHERE `id_ref` = $id";       
        	$borrarRefper = $mysqli->query($borrarRefper);
	        if($mysqli->error)
	            {
	              echo "<script>if(confirm('No se pudo borrar')){ 
					document.location='$link';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
	            } else
	            {
	            	header( "Location:$link");
	            }
	  	}
?>