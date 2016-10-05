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
				
				$correo = "INSERT INTO `correos`(`id_empresa`, `asunto`, `mensaje`, `adjunto`, `fecha`, `id_ejercicio`) VALUES ($this->empresa,'$this->asunto','$this->mensaje','$this->archivo', '$fecha', $row_ejer[0])";
				$correo = $mysqli->query($correo);

				if ($mysqli->error) {
					echo "<script>if(confirm('Ocurrio un error')){ 
					document.location='l_correo.php';} 
					else{ alert('Operacion Cancelada');
					}</script>";
					unlink("../carga_archivos/correos/$this->archivo");
				}else
				{
					//echo "<script> document.location='l_correo.php'; </script>";
					header("Content-Type: text/html; charset=utf-8");
					date_default_timezone_set('America/Phoenix');

					$correos = "SELECT DISTINCT d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, d.`correo` FROM `datos_personales` d INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON pp.`id_puesto` = p.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` AND e.`id_empresa` = $this->empresa";
					$resul_correos = $mysqli->query($correos);

					require '../mail/PHPMailerAutoload.php';


					$mail = new PHPMailer;//Create a new PHPMailer instance


					$mail->isSMTP();//Tell PHPMailer to use SMTP


					$mail->SMTPDebug = 0;//Enable SMTP debugging
					// 0 = off (for production use)
					// 1 = client messages
					// 2 = client and server messages


					$mail->Debugoutput = 'html';//Ask for HTML-friendly debug output
					$mail->Host = 'smtp.gmail.com';//hostname del servidor de gmail
					$mail->Port = 465;//puerto del host de gmail
					$mail->SMTPSecure = 'ssl';//envio de encriptación ssl
					$mail->SMTPAuth = true;//Whether to use SMTP authentication
					$mail->Username = "rhkarlco";//usuario creado en gmail de smtp
					$mail->Password = 'rhkarlco2016';//contraseña del smtp
					$mail->setFrom('amor.sanchez@karlcogroup.com', 'Recursos Humanos');//correo que envia el correo
					$mail->addReplyTo('rhkarlco@gmail.com', 'Recursos Humanos');//correo donde se debe responder el correo
					while ($row_correos = $resul_correos->fetch_array()) 
                      	{
                      		echo "$row_correos[4]";
					echo $mail->addAddress($row_correos[4] , $row_correos[0] $row_correos[1] $row_correos[2] $row_correos[3]);//correos a donde se envia el mensaje
						}
					$mail->Subject = $this->asunto ;//Tema del mensaje

					//Read an HTML message body from an external file, convert referenced images to embedded,
					//convert HTML into a basic plain-text alternative body
					//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
					//$mail->isHTML(true);
					$mail->msgHTML("
						<!DOCTYPE html>
					  	<html>
					  	<head>
					  		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
					  	</head>
					  	<body>
					  		<p>$this->mensaje </p>
					  	</body>
					  	</html>
						");
					$name=$this->asunto;
					$mail->AltBody = $this->asunto;//Replace the plain text body with one created manually

					//Attach an image file
					//$mail->addAttachment('images/phpmailer_mini.png');
					//send the message, check for errors
					if (!$mail->send()) {
					    echo "Mailer Error: " . $mail->ErrorInfo;
					} else {
					    echo "Message enviado!";
					    header("Location: l_correo.php");

					}//Termina lo del correo
				}
			}

		}

	} 
  	
?>