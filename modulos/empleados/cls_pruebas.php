
<?php

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
        public $datper_profe;
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


        //REFERENCIAS PERSONALES []

        public $refper_pnom;
        public $refper_snom;
        public $refper_pape;
        public $refper_sape;
        public $refper_dir;
        public $refper_tel;
        public $refper_parent;


        //BENEFICIARIOS EN CASO DE FALLECIMIENTO []

        public $benfa_pnom;
        public $benfa_snom;
        public $benfa_pape;
        public $benfa_sape;
        public $benfa_domici;
        public $benfa_tel;
        public $benfa_parent;


        //DATOS FAMILIARES O INDEPENDIENTES[]

        public $datfami_pnom;
        public $datfami_snom;
        public $datfami_pape;
        public $datfami_sape;
        public $datfami_date;
        public $datfami_parent;
        public $archivo; //ARCHIVO
        public $type;
        public $tamano;
        public $tmp_name;
        public $error;


        //EMPLEOS ANTERIORES[]
        public $empant_empr;
        public $empant_puesto;
        public $empant_jefe;
        public $empant_ano;
        public $empant_tel;

		//ESTUDIOS[]
        public $est_escu;
        public $est_gmax;
        public $est_certi;

        public $id_tmp;


		function __construct($datper_pnom, $datper_snom, $datper_pape, $datper_sape, $datper_lugar, $datper_date, $datper_rfc, $datper_curp, $datper_imss, $datper_profe, $datper_unifam, $datper_anoexp, $datper_calle, $datper_extint, $datper_col, $datper_cp, $datper_municipio, $datper_telpart, $datper_telcel, $datper_correo, $datper_ecivil,  $datper_banco, $datper_ncuenta, $datper_nclabe, $datper_sexo, $datper_ncredito, $refper_pnom, $refper_snom, $refper_pape, $refper_sape, $refper_dir, $refper_tel, $refper_parent, $benfa_pnom, $benfa_snom, $benfa_pape, $benfa_sape, $benfa_domici, $benfa_tel, $benfa_parent, $datfami_pnom, $datfami_snom, $datfami_pape, $datfami_sape, $datfami_date, $datfami_parent, $archivo, $type, $tamano, $tmp_name, $error, $empant_empr, $empant_puesto, $empant_jefe, $empant_ano, $empant_tel, $est_escu, $est_gmax, $est_certi, $id_tmp)
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
	        $this->datper_profe = $datper_profe;
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


	        //REFERENCIAS PERSONALES []

	        $this->refper_pnom = $refper_pnom;
	        $this->refper_snom = $refper_snom;
	        $this->refper_pape = $refper_pape;
	        $this->refper_sape = $refper_sape;
	        $this->refper_dir = $refper_dir;
	        $this->refper_tel = $refper_tel;
	        $this->refper_parent = $refper_parent;


	        //BENEFICIARIOS EN CASO DE FALLECIMIENTO []

	        $this->benfa_pnom = $benfa_pnom;
	        $this->benfa_snom = $benfa_snom;
	        $this->benfa_pape = $benfa_pape;
	        $this->benfa_sape = $benfa_sape;
	        $this->benfa_domici = $benfa_domici;
	        $this->benfa_tel = $benfa_tel;
	        $this->benfa_parent = $benfa_parent;


	        //DATOS FAMILIARES O INDEPENDIENTES[]

	        $this->datfami_pnom = $datfami_pnom;
	        $this->datfami_snom = $datfami_snom;
	        $this->datfami_pape = $datfami_pape;
	        $this->datfami_sape = $datfami_sape;
	        $this->datfami_date = $datfami_date;
	        $this->datfami_parent = $datfami_parent;
	        $this->archivo = $archivo; //ARCHIVO
	        $this->type = $type; //ARCHIVO
	        $this->tamano = $tamano; //ARCHIVO
	        $this->tmp_name = $tmp_name;
	        $this->error = $error;


	        //EMPLEOS ANTERIORES[]
	        $this->empant_empr = $empant_empr;
	        $this->empant_puesto = $empant_puesto;
	        $this->empant_jefe = $empant_jefe;
	        $this->empant_ano = $empant_ano;
	        $this->empant_tel = $empant_tel;

	        //ESTUDIOS[]
	        $this->est_escu = $est_escu;
	        $this->est_gmax = $est_gmax;
	        $this->est_certi = $est_certi;

	        $this->id_tmp = $id_tmp;
		}
		public function registrar()
		{
			require("../../control/connect.php");
			$mysqli->set_charset("utf8");	
			// AGREGAR DATOS PERSONALES 
				 echo $obtDatPer = "INSERT INTO `datos_personales`(`primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno`, `lugar_nacimiento`, `sexo`, `rfc`, `curp`, `imss`, `ano_experiencia`, `unidad_medica`, `calle`, `n_extint`, `colonia`, `cp`, `tel_part`, `tel_celular`, `correo`, `banco`, `n_bancaria`, `n_interbancaria`, `n_creinfo`, `estado_civil`, `id_municipio`) VALUES ('$this->datper_pnom','$this->datper_snom','$this->datper_pape','$this->datper_sape','$this->datper_lugar','$this->datper_sexo','$this->datper_rfc','$this->datper_curp','$this->datper_imss',$this->datper_anoexp,'$this->datper_unifam','$this->datper_calle', $this->datper_extint,'$this->datper_col',$this->datper_cp,$this->datper_telpart,$this->datper_telcel,'$this->datper_correo','$this->datper_banco',$this->datper_ncuenta,$this->datper_nclabe, $this->datper_ncredito ,'$this->datper_ecivil',$this->datper_municipio)";
				$resul_datper = $mysqli->query($obtDatPer);


			// SELECT DATOS PERSONALES
				$ctr_datper = "SELECT * FROM `datos_personales` WHERE `rfc` = '$this->datper_rfc' and `curp` = '$this->datper_curp'";				
				$res_datper = $mysqli->query($ctr_datper);
				/*if (!$mysqli->query($res_datper)) {
    echo "Falló la selección de la tabla: (" . $mysqli->errno . ") " . $mysqli->error;
}*/
$numrows = $res_datper->num_rows;
 $row_resdatper = $res_datper->fetch_array();
				if($numrows > 0)
				{

					//INICIA EL INSERT FOREACH DE REFERENCIAS PERSONALES
					for ($i=0; $i <= count($this->refper_pnom) -1 ; $i++) {					
						
				        

				        // AGREGAR REFERENCIAS PERSONALES 
						$obtRefPer = "INSERT INTO `referencias`(`primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno`, `direccion`, `tel`, `parentesco`, `id_datosper`) VALUES ('".$this->refper_pnom[$i]."','".$this->refper_snom[$i]."','".$this->refper_pape[$i]."','".$this->refper_sape[$i]."','".$this->refper_dir[$i]."',".$this->refper_tel[$i].", '".$this->refper_parent[$i]."',$row_resdatper[0])";
						$resul_refper = $mysqli->query($obtRefPer);
				    }//FINALIZA EL INSERT FOREACH DE REFERENCIAS PERSONALES


				    //INICIA EL INSERT FOREACH DE BENEFICIARIOS EN CASO DE FALLECIMIENTO
				    for ($q=0; $q <= count($this->benfa_pnom) -1 ; $q++) {					
						
				        // AGREGAR BENEFICIARIOS EN CASO DE FALLECIMIENTO 
						$obtbenfa = "INSERT INTO `beneficiarios`(`primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno`, `parentesco`, `domicilio`, `tel`, `id_datosper`) VALUES ('".$this->benfa_pnom[$q]."','".$this->benfa_snom[$q]."','".$this->benfa_pape[$q]."','".$this->benfa_sape[$q]."','".$this->benfa_parent[$q]."','".$this->benfa_domici[$q]."', ".$this->benfa_tel[$q].",$row_resdatper[0])";
						$resul_benfa = $mysqli->query($obtbenfa);
						
				    }//FINALIZA EL INSERT FOREACH DE BENEFICIARIOS EN CASO DE FALLECIMIENTO



				    //INICIA EL INSERT FOREACH DE DATOS FAMILIARES
				    for ($r=0; $r <= count($this->datfami_pnom) -1 ; $r++) {	

				    	
				    	if ($this->error[$r] > 0){
								echo "ha ocurrido un error";
							} else {
								//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
								//y que el tamano del archivo no exceda los 1000kb
								$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "application/pdf");
								$limite_kb = 1000;

								if (in_array($this->type[$r], $permitidos) && $this->tamano[$r] <= $limite_kb * 1024){
									//esta es la ruta donde copiaremos la imagen
									//recuerden que deben crear un directorio con este mismo nombre
									//en el mismo lugar donde se encuentra el archivo subir.php
									$ruta = "../carga_archivos/archivos_subidos/" . $row_resdatper[0] ."___".$this->archivo[$r];
									//comprovamos si este archivo existe para no volverlo a copiar.
									//pero si quieren pueden obviar esto si no es necesario.
									//o pueden darle otro nombre para que no sobreescriba el actual.
									if (!file_exists($ruta)){
										//aqui movemos el archivo desde la ruta temporal a nuestra ruta
										//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
										//almacenara true o false
										$resultado = @move_uploaded_file($this->tmp_name[$r], $ruta);
										if ($resultado){
											echo "el archivo ha sido movido exitosamente";
										} else {
											echo "ocurrio un error al mover el archivo.";
										}
									} else {
										echo $this->archivo[$r] . ", este archivo existe";
									}
								} else {
									echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
								}
							}


				        // AGREGAR DATOS FAMILIARES 
						$datfami = "INSERT INTO `datos_familiares`(`primer_nombre`, `segundo_nombre`, `ap_paterno`, `ap_materno`, `nacimiento`, `tipo`, `acta_nacimiento`, `id_datosper`) VALUES ('".$this->datfami_pnom[$r]."','".$this->datfami_snom[$r]."','".$this->datfami_pape[$r]."','".$this->datfami_sape[$r]."','".$this->datfami_date[$r]."','".$this->datfami_parent[$r]."', '".$this->archivo[$r]."',$row_resdatper[0])";
						$resul_datfami = $mysqli->query($datfami);

						
						
				    }//FINALIZA EL INSERT FOREACH DE DATOS FAMILIARES         


				    //INICIA EL INSERT FOREACH DE EMPLEOS ANTERIORES
				    for ($s=0; $s <= count($this->empant_empr) -1 ; $s++) {					
						
				        // AGREGAR EMPLEOS ANTERIORES 
						$obtempant = "INSERT INTO `empleos_anteriores`(`empresa`, `puesto`, `jefe_inmediato`, `año`, `tel`, `id_datosper`) VALUES ('".$this->empant_empr[$s]."','".$this->empant_puesto[$s]."','".$this->empant_jefe[$s]."','".$this->empant_ano[$s]."','".$this->empant_tel[$s]."',$row_resdatper[0])";
						$resul_empant = $mysqli->query($obtempant);
						
				    }//FINALIZA EL INSERT FOREACH DE EMPLEOS ANTERIORES


				    //INICIA EL INSERT FOREACH DE ESTUDIOS
				    for ($j=0; $j <= count($this->est_escu) -1 ; $j++) {					
						
				        // AGREGAR ESTUDIOS 
						$obtest = "INSERT INTO `estudios`(`escuela`, `grado`, `certificado`, `id_datosper`) VALUES ('".$this->est_escu[$j]."','".$this->est_gmax[$j]."','".$this->est_certi[$j]."',$row_resdatper[0])";
						$resul_est = $mysqli->query($obtest);
						
				    }//FINALIZA EL INSERT FOREACH DE ESTUDIOS



				    $sel_doc = "SELECT * FROM `documentos` WHERE `id_tmp` = '$this->id_tmp'";
    				$resul_seldoc = $mysqli->query($sel_doc);
    				while ( $row = $resul_seldoc->fetch_array()) {
    					echo $update = "UPDATE `documentos` SET `id_datosper`=$row_resdatper[0]), `id_tmp`="" WHERE `id_tmp` = '$this->id_tmp'";
    					$resul_update = $mysqli->query($update);
    				}
				
				} //FINALIZA EL IF DE DATOS PERSONALES
				if($numrows = 0){
					echo "<script>if(confirm('No se pudo agregar')){ 
					document.location='http://admonkco.com/rhkarlco/modulos/empleados/r_empleados.php';} 
					else{ alert('Operacion Cancelada'); 
					}</script>";
				}


		}
	}   	
?>