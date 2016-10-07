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
				$limite_kb = 10024;

				if ($this->tamano <= $limite_kb * 10024){
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
					$mail->Host = 'smtp.gmail.com';//Set the hostname of the mail server
					$mail->Port = 465;//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
					$mail->SMTPSecure = 'ssl';//Set the encryption system to use - ssl (deprecated) or tls
					$mail->SMTPAuth = true;//Whether to use SMTP authentication
					$mail->Username = "rhkarlco";//Username to use for SMTP authentication - use full email address for gmail
					$mail->Password = 'rhkarlco2016';//Password to use for SMTP authentication
					$mail->setFrom('amor.sanchez@karlcogroup.com', 'Recursos Humanos');//Set who the message is to be sent from
					$mail->addReplyTo('rhkarlco@gmail.com', 'Recursos Humanos');//Set an alternative reply-to address
					//$mail->addAddress('alindesing08@hotmail.com ', 'Prestamo');//Set who the message is to be sent to
					while ($row_correos = $resul_correos->fetch_array()) 
					          {
					      $mail->addAddress(utf8_decode($row_correos[4]) , utf8_decode($row_correos[0]) .' '. utf8_decode($row_correos[1]) .' '. utf8_decode($row_correos[2]) .' '. utf8_decode($row_correos[3]));//correos a donde se envia el mensaje
					          }
					$mail->Subject = $this->asunto;//Set the subject line

					$mail->AddAttachment($this->tmp_name, $this->archivo);
					//Read an HTML message body from an external file, convert referenced images to embedded,
					//convert HTML into a basic plain-text alternative body
					//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
					//$mail->isHTML(true);
					$mail->msgHTML("
						<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
						<html xmlns='http://www.w3.org/1999/xhtml'>
						<head>
						  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
						  <meta name='viewport' content='width=device-width'/>
						  <style>
						  
						  #outlook a { 
						    padding:0; 
						  } 

						  body{ 
						    width:100% !important; 
						    min-width: 100%;
						    -webkit-text-size-adjust:100%; 
						    -ms-text-size-adjust:100%; 
						    margin:0; 
						    padding:0;
						  }

						  .ExternalClass { 
						    width:100%;
						  } 

						  .ExternalClass, 
						  .ExternalClass p, 
						  .ExternalClass span, 
						  .ExternalClass font, 
						  .ExternalClass td, 
						  .ExternalClass div { 
						    line-height: 100%; 
						  } 

						  #backgroundTable { 
						    margin:0; 
						    padding:0; 
						    width:100% !important; 
						    line-height: 100% !important; 
						  }

						  img { 
						    outline:none; 
						    text-decoration:none; 
						    -ms-interpolation-mode: bicubic;
						    width: auto;
						    max-width: 100%; 
						    float: left; 
						    clear: both; 
						    display: block;
						  }

						  center {
						    width: 100%;
						    min-width: 580px;
						  }

						  a img { 
						    border: none;
						  }

						  p {
						    margin: 0 0 0 10px;
						  }

						  table {
						    border-spacing: 0;
						    border-collapse: collapse;
						  }

						  td { 
						    word-break: break-word;
						    -webkit-hyphens: auto;
						    -moz-hyphens: auto;
						    hyphens: auto;
						    border-collapse: collapse !important; 
						  }

						  table, tr, td {
						    padding: 0;
						    vertical-align: top;
						    text-align: left;
						  }

						  hr {
						    color: #d9d9d9; 
						    background-color: #d9d9d9; 
						    height: 1px; 
						    border: none;
						  }

						  /* Responsive Grid */

						  table.body {
						    height: 100%;
						    width: 100%;
						  }

						  table.container {
						    width: 580px;
						    margin: 0 auto;
						    text-align: inherit;
						  }

						  table.row { 
						    padding: 0px; 
						    width: 100%;
						    position: relative;
						  }

						  table.container table.row {
						    display: block;
						  }

						  td.wrapper {
						    padding: 10px 20px 0px 0px;
						    position: relative;
						  }

						  table.columns,
						  table.column {
						    margin: 0 auto;
						  }

						  table.columns td,
						  table.column td {
						    padding: 0px 0px 10px; 
						  }

						  table.columns td.sub-columns,
						  table.column td.sub-columns,
						  table.columns td.sub-column,
						  table.column td.sub-column {
						    padding-right: 10px;
						  }

						  td.sub-column, td.sub-columns {
						    min-width: 0px;
						  }

						  table.row td.last,
						  table.container td.last {
						    padding-right: 0px;
						  }

						  table.one { width: 30px; }
						  table.two { width: 80px; }
						  table.three { width: 130px; }
						  table.four { width: 180px; }
						  table.five { width: 230px; }
						  table.six { width: 280px; }
						  table.seven { width: 330px; }
						  table.eight { width: 380px; }
						  table.nine { width: 430px; }
						  table.ten { width: 480px; }
						  table.eleven { width: 530px; }
						  table.twelve { width: 580px; }

						  table.one center { min-width: 30px; }
						  table.two center { min-width: 80px; }
						  table.three center { min-width: 130px; }
						  table.four center { min-width: 180px; }
						  table.five center { min-width: 230px; }
						  table.six center { min-width: 280px; }
						  table.seven center { min-width: 330px; }
						  table.eight center { min-width: 380px; }
						  table.nine center { min-width: 430px; }
						  table.ten center { min-width: 480px; }
						  table.eleven center { min-width: 530px; }
						  table.twelve center { min-width: 580px; }

						  table.one .panel center { min-width: 10px; }
						  table.two .panel center { min-width: 60px; }
						  table.three .panel center { min-width: 110px; }
						  table.four .panel center { min-width: 160px; }
						  table.five .panel center { min-width: 210px; }
						  table.six .panel center { min-width: 260px; }
						  table.seven .panel center { min-width: 310px; }
						  table.eight .panel center { min-width: 360px; }
						  table.nine .panel center { min-width: 410px; }
						  table.ten .panel center { min-width: 460px; }
						  table.eleven .panel center { min-width: 510px; }
						  table.twelve .panel center { min-width: 560px; }

						  .body .columns td.one,
						  .body .column td.one { width: 8.333333%; }
						  .body .columns td.two,
						  .body .column td.two { width: 16.666666%; }
						  .body .columns td.three,
						  .body .column td.three { width: 25%; }
						  .body .columns td.four,
						  .body .column td.four { width: 33.333333%; }
						  .body .columns td.five,
						  .body .column td.five { width: 41.666666%; }
						  .body .columns td.six,
						  .body .column td.six { width: 50%; }
						  .body .columns td.seven,
						  .body .column td.seven { width: 58.333333%; }
						  .body .columns td.eight,
						  .body .column td.eight { width: 66.666666%; }
						  .body .columns td.nine,
						  .body .column td.nine { width: 75%; }
						  .body .columns td.ten,
						  .body .column td.ten { width: 83.333333%; }
						  .body .columns td.eleven,
						  .body .column td.eleven { width: 91.666666%; }
						  .body .columns td.twelve,
						  .body .column td.twelve { width: 100%; }

						  td.offset-by-one { padding-left: 50px; }
						  td.offset-by-two { padding-left: 100px; }
						  td.offset-by-three { padding-left: 150px; }
						  td.offset-by-four { padding-left: 200px; }
						  td.offset-by-five { padding-left: 250px; }
						  td.offset-by-six { padding-left: 300px; }
						  td.offset-by-seven { padding-left: 350px; }
						  td.offset-by-eight { padding-left: 400px; }
						  td.offset-by-nine { padding-left: 450px; }
						  td.offset-by-ten { padding-left: 500px; }
						  td.offset-by-eleven { padding-left: 550px; }

						  td.expander {
						    visibility: hidden;
						    width: 0px;
						    padding: 0 !important;
						  }

						  table.columns .text-pad,
						  table.column .text-pad {
						    padding-left: 10px;
						    padding-right: 10px;
						  }

						  table.columns .left-text-pad,
						  table.columns .text-pad-left,
						  table.column .left-text-pad,
						  table.column .text-pad-left {
						    padding-left: 10px;
						  }

						  table.columns .right-text-pad,
						  table.columns .text-pad-right,
						  table.column .right-text-pad,
						  table.column .text-pad-right {
						    padding-right: 10px;
						  }

						  /* Block Grid */

						  .block-grid {
						    width: 100%;
						    max-width: 580px;
						  }

						  .block-grid td {
						    display: inline-block;
						    padding:10px;
						  }

						  .two-up td {
						    width:270px;
						  }

						  .three-up td {
						    width:173px;
						  }

						  .four-up td {
						    width:125px;
						  }

						  .five-up td {
						    width:96px;
						  }

						  .six-up td {
						    width:76px;
						  }

						  .seven-up td {
						    width:62px;
						  }

						  .eight-up td {
						    width:52px;
						  }

						  /* Alignment & Visibility Classes */

						  table.center, td.center {
						    text-align: center;
						  }

						  h1.center,
						  h2.center,
						  h3.center,
						  h4.center,
						  h5.center,
						  h6.center {
						    text-align: center;
						  }

						  span.center {
						    display: block;
						    width: 100%;
						    text-align: center;
						  }

						  img.center {
						    margin: 0 auto;
						    float: none;
						  }

						  .show-for-small,
						  .hide-for-desktop {
						    display: none;
						  }

						  /* Typography */

						  body, table.body, h1, h2, h3, h4, h5, h6, p, td { 
						    color: #222222;
						    font-family: 'Helvetica', 'Arial', sans-serif; 
						    font-weight: normal; 
						    padding:0; 
						    margin: 0;
						    text-align: left; 
						    line-height: 1.3;
						  }

						  h1, h2, h3, h4, h5, h6 {
						    word-break: normal;
						  }

						  h1 {font-size: 40px;}
						  h2 {font-size: 36px;}
						  h3 {font-size: 32px;}
						  h4 {font-size: 28px;}
						  h5 {font-size: 24px;}
						  h6 {font-size: 20px;}
						  body, table.body, p, td {font-size: 14px;line-height:19px;}

						  p.lead, p.lede, p.leed {
						    font-size: 18px;
						    line-height:21px;
						  }

						  p { 
						    margin-bottom: 10px;
						  }

						  small {
						    font-size: 10px;
						  }

						  a {
						    color: #2ba6cb; 
						    text-decoration: none;
						  }

						  a:hover { 
						    color: #2795b6 !important;
						  }

						  a:active { 
						    color: #2795b6 !important;
						  }

						  a:visited { 
						    color: #2ba6cb !important;
						  }

						  h1 a, 
						  h2 a, 
						  h3 a, 
						  h4 a, 
						  h5 a, 
						  h6 a {
						    color: #2ba6cb;
						  }

						  h1 a:active, 
						  h2 a:active,  
						  h3 a:active, 
						  h4 a:active, 
						  h5 a:active, 
						  h6 a:active { 
						    color: #2ba6cb !important; 
						  } 

						  h1 a:visited, 
						  h2 a:visited,  
						  h3 a:visited, 
						  h4 a:visited, 
						  h5 a:visited, 
						  h6 a:visited { 
						    color: #2ba6cb !important; 
						  } 

						  /* Panels */

						  .panel {
						    background: #f2f2f2;
						    border: 1px solid #d9d9d9;
						    padding: 10px !important;
						  }

						  .sub-grid table {
						    width: 100%;
						  }

						  .sub-grid td.sub-columns {
						    padding-bottom: 0;
						  }

						  /* Buttons */

						  table.button,
						  table.tiny-button,
						  table.small-button,
						  table.medium-button,
						  table.large-button {
						    width: 100%;
						    overflow: hidden;
						  }

						  table.button td,
						  table.tiny-button td,
						  table.small-button td,
						  table.medium-button td,
						  table.large-button td {
						    display: block;
						    width: auto !important;
						    text-align: center;
						    background: #2ba6cb;
						    border: 1px solid #2284a1;
						    color: #ffffff;
						    padding: 8px 0;
						  }

						  table.tiny-button td {
						    padding: 5px 0 4px;
						  }

						  table.small-button td {
						    padding: 8px 0 7px;
						  }

						  table.medium-button td {
						    padding: 12px 0 10px;
						  }

						  table.large-button td {
						    padding: 21px 0 18px;
						  }

						  table.button td a,
						  table.tiny-button td a,
						  table.small-button td a,
						  table.medium-button td a,
						  table.large-button td a {
						    font-weight: bold;
						    text-decoration: none;
						    font-family: Helvetica, Arial, sans-serif;
						    color: #ffffff;
						    font-size: 16px;
						  }

						  table.tiny-button td a {
						    font-size: 12px;
						    font-weight: normal;
						  }

						  table.small-button td a {
						    font-size: 16px;
						  }

						  table.medium-button td a {
						    font-size: 20px;
						  }

						  table.large-button td a {
						    font-size: 24px;
						  }

						  table.button:hover td,
						  table.button:visited td,
						  table.button:active td {
						    background: #2795b6 !important;
						  }

						  table.button:hover td a,
						  table.button:visited td a,
						  table.button:active td a {
						    color: #fff !important;
						  }

						  table.button:hover td,
						  table.tiny-button:hover td,
						  table.small-button:hover td,
						  table.medium-button:hover td,
						  table.large-button:hover td {
						    background: #2795b6 !important;
						  }

						  table.button:hover td a,
						  table.button:active td a,
						  table.button td a:visited,
						  table.tiny-button:hover td a,
						  table.tiny-button:active td a,
						  table.tiny-button td a:visited,
						  table.small-button:hover td a,
						  table.small-button:active td a,
						  table.small-button td a:visited,
						  table.medium-button:hover td a,
						  table.medium-button:active td a,
						  table.medium-button td a:visited,
						  table.large-button:hover td a,
						  table.large-button:active td a,
						  table.large-button td a:visited {
						    color: #ffffff !important; 
						  }

						  table.secondary td {
						    background: #e9e9e9;
						    border-color: #d0d0d0;
						    color: #555;
						  }

						  table.secondary td a {
						    color: #555;
						  }

						  table.secondary:hover td {
						    background: #d0d0d0 !important;
						    color: #555;
						  }

						  table.secondary:hover td a,
						  table.secondary td a:visited,
						  table.secondary:active td a {
						    color: #555 !important;
						  }

						  table.success td {
						    background: #5da423;
						    border-color: #457a1a;
						  }

						  table.success:hover td {
						    background: #457a1a !important;
						  }

						  table.alert td {
						    background: #c60f13;
						    border-color: #970b0e;
						  }

						  table.alert:hover td {
						    background: #970b0e !important;
						  }

						  table.radius td {
						    -webkit-border-radius: 3px;
						    -moz-border-radius: 3px;
						    border-radius: 3px;
						  }

						  table.round td {
						    -webkit-border-radius: 500px;
						    -moz-border-radius: 500px;
						    border-radius: 500px;
						  }

						  /* Outlook First */

						  body.outlook p {
						    display: inline !important;
						  }

						  /*  Media Queries */

						  @media only screen and (max-width: 600px) {

						    table[class='body'] img {
						      width: auto !important;
						      height: auto !important;
						    }

						    table[class='body'] center {
						      min-width: 0 !important;
						    }

						    table[class='body'] .container {
						      width: 95% !important;
						    }

						    table[class='body'] .row {
						      width: 100% !important;
						      display: block !important;
						    }

						    table[class='body'] .wrapper {
						      display: block !important;
						      padding-right: 0 !important;
						    }

						    table[class='body'] .columns,
						    table[class='body'] .column {
						      table-layout: fixed !important;
						      float: none !important;
						      width: 100% !important;
						      padding-right: 0px !important;
						      padding-left: 0px !important;
						      display: block !important;
						    }

						    table[class='body'] .wrapper.first .columns,
						    table[class='body'] .wrapper.first .column {
						      display: table !important;
						    }

						    table[class='body'] table.columns td,
						    table[class='body'] table.column td {
						      width: 100% !important;
						    }

						    table[class='body'] .columns td.one,
						    table[class='body'] .column td.one { width: 8.333333% !important; }
						    table[class='body'] .columns td.two,
						    table[class='body'] .column td.two { width: 16.666666% !important; }
						    table[class='body'] .columns td.three,
						    table[class='body'] .column td.three { width: 25% !important; }
						    table[class='body'] .columns td.four,
						    table[class='body'] .column td.four { width: 33.333333% !important; }
						    table[class='body'] .columns td.five,
						    table[class='body'] .column td.five { width: 41.666666% !important; }
						    table[class='body'] .columns td.six,
						    table[class='body'] .column td.six { width: 50% !important; }
						    table[class='body'] .columns td.seven,
						    table[class='body'] .column td.seven { width: 58.333333% !important; }
						    table[class='body'] .columns td.eight,
						    table[class='body'] .column td.eight { width: 66.666666% !important; }
						    table[class='body'] .columns td.nine,
						    table[class='body'] .column td.nine { width: 75% !important; }
						    table[class='body'] .columns td.ten,
						    table[class='body'] .column td.ten { width: 83.333333% !important; }
						    table[class='body'] .columns td.eleven,
						    table[class='body'] .column td.eleven { width: 91.666666% !important; }
						    table[class='body'] .columns td.twelve,
						    table[class='body'] .column td.twelve { width: 100% !important; }

						    table[class='body'] td.offset-by-one,
						    table[class='body'] td.offset-by-two,
						    table[class='body'] td.offset-by-three,
						    table[class='body'] td.offset-by-four,
						    table[class='body'] td.offset-by-five,
						    table[class='body'] td.offset-by-six,
						    table[class='body'] td.offset-by-seven,
						    table[class='body'] td.offset-by-eight,
						    table[class='body'] td.offset-by-nine,
						    table[class='body'] td.offset-by-ten,
						    table[class='body'] td.offset-by-eleven {
						      padding-left: 0 !important;
						    }

						    table[class='body'] table.columns td.expander {
						      width: 1px !important;
						    }

						    table[class='body'] .right-text-pad,
						    table[class='body'] .text-pad-right {
						      padding-left: 10px !important;
						    }

						    table[class='body'] .left-text-pad,
						    table[class='body'] .text-pad-left {
						      padding-right: 10px !important;
						    }

						    table[class='body'] .hide-for-small,
						    table[class='body'] .show-for-desktop {
						      display: none !important;
						    }

						    table[class='body'] .show-for-small,
						    table[class='body'] .hide-for-desktop {
						      display: inherit !important;
						    }
						  }

						    </style>
						    <style>

						      table.facebook td {
						        background: #3b5998;
						        border-color: #2d4473;
						      }

						      table.facebook:hover td {
						        background: #2d4473 !important;
						      }

						      table.twitter td {
						        background: #00acee;
						        border-color: #0087bb;
						      }

						      table.twitter:hover td {
						        background: #0087bb !important;
						      }

						      table.google-plus td {
						        background-color: #DB4A39;
						        border-color: #CC0000;
						      }

						      table.google-plus:hover td {
						        background: #CC0000 !important;
						      }

						      .template-label {
						        color: #ffffff;
						        font-weight: bold;
						        font-size: 11px;
						      }

						      .callout .panel {
						        background: #ECF8FF;
						        border-color: #b9e5ff;
						      }

						      .header {
						        background: #999999;
						      }

						      .footer .wrapper {
						        background: #ebebeb;
						      }

						      .footer h5 {
						        padding-bottom: 10px;
						      }

						      table.columns .text-pad {
						        padding-left: 10px;
						        padding-right: 10px;
						      }

						      table.columns .left-text-pad {
						        padding-left: 10px;
						      }

						      table.columns .right-text-pad {
						        padding-right: 10px;
						      }

						      @media only screen and (max-width: 600px) {

						        table[class='body'] .right-text-pad {
						          padding-left: 10px !important;
						        }

						        table[class='body'] .left-text-pad {
						          padding-right: 10px !important;
						        }
						      }
						  </style>
						  <style>

						    table.facebook td {
						      background: #3b5998;
						      border-color: #2d4473;
						    }

						    table.facebook:hover td {
						      background: #2d4473 !important;
						    }

						    table.twitter td {
						      background: #00acee;
						      border-color: #0087bb;
						    }

						    table.twitter:hover td {
						      background: #0087bb !important;
						    }

						    table.google-plus td {
						      background-color: #DB4A39;
						      border-color: #CC0000;
						    }

						    table.google-plus:hover td {
						      background: #CC0000 !important;
						    }

						    .template-label {
						      color: #ffffff;
						      font-weight: bold;
						      font-size: 11px;
						    }

						    .callout .panel {
						      background: #ECF8FF;
						      border-color: #b9e5ff;
						    }

						    .header {
						      background: #999999;
						    }

						    .footer .wrapper {
						      background: #ebebeb;
						    }

						    .footer h5 {
						      padding-bottom: 10px;
						    }

						    table.columns .text-pad {
						      padding-left: 10px;
						      padding-right: 10px;
						    }

						    table.columns .left-text-pad {
						      padding-left: 10px;
						    }

						    table.columns .right-text-pad {
						      padding-right: 10px;
						    }

						    @media only screen and (max-width: 600px) {

						      table[class='body'] .right-text-pad {
						        padding-left: 10px !important;
						      }

						      table[class='body'] .left-text-pad {
						        padding-right: 10px !important;
						      }
						    }

						  </style>
						</head>
						<body>
						  <table class='body'>
						    <tr>
						      <td class='center' align='center' valign='top'>
						        <center>


						          <table class='row header'>
						            <tr>
						              <td class='center' align='center'>
						                <center>

						                  <table class='container'>
						                    <tr>
						                      <td class='wrapper last'>

						                        <table class='twelve columns'>
						                          <tr>

						                            <td >
						                              <img style=' border-radius: 50px; width: 100px' src='images/kco.jpg'>                              
						                            </td>
						                            <td>
						                              <img style=' border-radius: 50px; width: 100px' src='images/aep.jpg'>
						                            </td>
						                            <td>
						                              <img style=' border-radius: 50px; width: 100px' src='images/sma.jpg'>
						                            </td>

						                            
						                            <td class='expander'></td>

						                          </tr>
						                        </table>

						                      </td>
						                    </tr>
						                  </table>

						                </center>
						              </td>
						            </tr>
						          </table>
						          <br>

						          <table class='container'>
						            <tr>
						              <td>

						                <!-- content start -->
						                <table class='row'>
						                  <tr>
						                    <td class='wrapper last'>

						                      <table class='twelve columns'>
						                        <tr>
						                          <td>

						                            <h1>Solicitud de Préstamo</h1>
						                            <center><p class='lead'>La solicitud proviene del campo <h1 style='color:red' >df45</h1></p><center>
						                            <img width='580' height='300' src='images/logo.jpg'>

						                          </td>
						                          <td class='expander'></td>
						                        </tr>
						                      </table>

						                    </td>
						                  </tr>
						                </table>

						                <table class='row callout'>
						                  <tr>
						                    <td class='wrapper last'>

						                      <table class='twelve columns'>
						                        <tr>
						                          <td class='panel'>

						                            <p>El encargado de Campo $n_encargado  $a_encargado esta solicitanto un prestamo para: </p>

						                          </td>
						                          <td class='expander'></td>
						                        </tr>
						                      </table>

						                    </td>
						                  </tr>
						                </table>

						                <table class='row'>
						                  <tr>
						                    <td class='wrapper last'>

						                      <table class='twelve columns'>
						                        <tr>
						                          <th>Matricula</th>
						                          <th>Nombre</th>
						                          <th>Apellido Paterno</th>
						                          <th>Apellido Materno</th>
						                          <th>Cantidad</th>
						                          <th>fecha</th>
						                          <td class='expander'></td>
						                        </tr>
						                        <br>
						                        <tr>
						                          <td>33333</td>
						                          <td>fffff</td>
						                          <td>fferer</td>
						                          <td>3445435</td>
						                          <td style='color:red'>45</td>
						                          <td>ert</td> 
						                          <td class='expander'></td>
						                        </tr>
						                        
						                      </table>
						                      <br>
						                    </td>
						                  </tr>
						                </table>


						                <table class='row'>
						                  <tr>
						                    <td class='wrapper last'>

						                     <center> <table class='six columns'>
						                        <tr>
						                          <td>

						                            <table class='button'>
						                              <tr>
						                                <td>
						                                  <a href='http://admonkco.com/siskarlco/login.php'>Validar Préstamo</a>
						                                </td>
						                              </tr>
						                            </table>

						                          </td>
						                          <td class='expander'></td>
						                        </tr>
						                      </table></center>

						                    </td>
						                  </tr>
						                </table>


						                <table class='row footer'>
						                  <tr>
						                    <td class='wrapper'>                 

						                    </td>
						                    <td class='wrapper last'>

						                      <table class='twelve columns'>
						                        <tr>
						                          <td class='last right-text-pad'>
						                            <h5>Contacto de Validacion:</h5>
						                            <p>Telefono: 642 4280 302</p>
						                            <p>Email: <a href='mailto:marisela.suarez@karlcogroup.com '>marisela.suarez@karlcogroup.com </a></p>
						                            <p>Direccion: No. Reeleccion 301 -A C.P. 85830 Navojoa,, Sonora México</p>
						                          </td>
						                          <td class='expander'></td>
						                        </tr>
						                      </table>

						                    </td>
						                  </tr>
						                </table>


						                <table class='row'>
						                  <tr>
						                    <td class='wrapper last'>

						                      <table class='twelve columns'>
						                        <tr>
						                          <td align='center'>
						                            <center>
						                              <p style='text-align:center;'><a href='http://karlcogroup.com/'>karlcogroup.com/</a> | <a href='http://admonkco.com/'>admonkco.com</a> </p>
						                            </center>
						                          </td>
						                          <td class='expander'></td>
						                        </tr>
						                      </table>

						                    </td>
						                  </tr>
						                </table>

						                <!-- container end below -->
						              </td>
						            </tr>
						          </table>

						        </center>
						      </td>
						    </tr>
						  </table>
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
					    echo "Message sent!";
					    header("Location: l_correo.php");

					}
				}
			}

		}

	}



  	
?>