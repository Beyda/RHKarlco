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
						<!DOCTYPE>
<html xmlns=http://www.w3.org/1999/xhtml>
<head>
	<meta http-equiv=Content-Type content=text/html; charset=UTF-8 />
	<meta name=viewport content=width=device-width, initial-scale=1.0>
	<meta http-equiv=X-UA-Compatible content=IE=edge,chrome=1>
	<meta name=format-detection content=telephone=no /> <!-- disable auto telephone linking in iOS -->
	<title>Respmail is a response HTML email designed to work on all major email platforms and smartphones</title>
	<style type=text/css>
		/* RESET STYLES */
		html { background-color:#E1E1E1; margin:0; padding:0; }
		body, #bodyTable, #bodyCell, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;font-family:Helvetica, Arial, Lucida Grande, sans-serif;}
		table{border-collapse:collapse;}
		table[id=bodyTable] {width:100%!important;margin:auto;max-width:500px!important;color:#7A7A7A;font-weight:normal;}
		img, a img{border:0; outline:none; text-decoration:none;height:auto; line-height:100%;}
		a {text-decoration:none !important;border-bottom: 1px solid;}
		h1, h2, h3, h4, h5, h6{color:#5F5F5F; font-weight:normal; font-family:Helvetica; font-size:20px; line-height:125%; text-align:Left; letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;}

		/* CLIENT-SPECIFIC STYLES */
		.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail/Outlook.com to display emails at full width. */
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;} /* Force Hotmail/Outlook.com to display line heights normally. */
		table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up. */
		#outlook a{padding:0;} /* Force Outlook 2007 and up to provide a view in browser message. */
		img{-ms-interpolation-mode: bicubic;display:block;outline:none; text-decoration:none;} /* Force IE to smoothly render resized images. */
		body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%; font-weight:normal!important;} /* Prevent Windows- and Webkit-based mobile platforms from changing declared text sizes. */
		.ExternalClass td[class=ecxflexibleContainerBox] h3 {padding-top: 10px !important;} /* Force hotmail to push 2-grid sub headers down */

		/* /\/\/\/\/\/\/\/\/ TEMPLATE STYLES /\/\/\/\/\/\/\/\/ */

		/* ========== Page Styles ========== */
		h1{display:block;font-size:26px;font-style:normal;font-weight:normal;line-height:100%;}
		h2{display:block;font-size:20px;font-style:normal;font-weight:normal;line-height:120%;}
		h3{display:block;font-size:17px;font-style:normal;font-weight:normal;line-height:110%;}
		h4{display:block;font-size:18px;font-style:italic;font-weight:normal;line-height:100%;}
		.flexibleImage{height:auto;}
		.linkRemoveBorder{border-bottom:0 !important;}
		table[class=flexibleContainerCellDivider] {padding-bottom:0 !important;padding-top:0 !important;}

		body, #bodyTable{background-color:#E1E1E1;}
		#emailHeader{background-color:#E1E1E1;}
		#emailBody{background-color:#FFFFFF;}
		#emailFooter{background-color:#E1E1E1;}
		.nestedContainer{background-color:#F8F8F8; border:1px solid #CCCCCC;}
		.emailButton{background-color:#205478; border-collapse:separate;}
		.buttonContent{color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;}
		.buttonContent a{color:#FFFFFF; display:block; text-decoration:none!important; border:0!important;}
		.emailCalendar{background-color:#FFFFFF; border:1px solid #CCCCCC;}
		.emailCalendarMonth{background-color:#205478; color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:16px; font-weight:bold; padding-top:10px; padding-bottom:10px; text-align:center;}
		.emailCalendarDay{color:#205478; font-family:Helvetica, Arial, sans-serif; font-size:60px; font-weight:bold; line-height:100%; padding-top:20px; padding-bottom:20px; text-align:center;}
		.imageContentText {margin-top: 10px;line-height:0;}
		.imageContentText a {line-height:0;}
		#invisibleIntroduction {display:none !important;} /* Removing the introduction text from the view */

		/*FRAMEWORK HACKS & OVERRIDES */
		span[class=ios-color-hack] a {color:#275100!important;text-decoration:none!important;} /* Remove all link colors in IOS (below are duplicates based on the color preference) */
		span[class=ios-color-hack2] a {color:#205478!important;text-decoration:none!important;}
		span[class=ios-color-hack3] a {color:#8B8B8B!important;text-decoration:none!important;}
		/* A nice and clean way to target phone numbers you want clickable and avoid a mobile phone from linking other numbers that look like, but are not phone numbers.  Use these two blocks of code to unstyle any numbers that may be linked.  The second block gives you a class to apply with a span tag to the numbers you would like linked and styled.
		Inspired by Campaign Monitor's article on using phone numbers in email: http://www.campaignmonitor.com/blog/post/3571/using-phone-numbers-in-html-email/.
		*/
		.a[href^=tel], a[href^=sms] {text-decoration:none!important;color:#606060!important;pointer-events:none!important;cursor:default!important;}
		.mobile_link a[href^=tel], .mobile_link a[href^=sms] {text-decoration:none!important;color:#606060!important;pointer-events:auto!important;cursor:default!important;}


		/* MOBILE STYLES */
		@media only screen and (max-width: 480px){
			/*////// CLIENT-SPECIFIC STYLES //////*/
			body{width:100% !important; min-width:100% !important;} /* Force iOS Mail to render the email at full width. */

			/* FRAMEWORK STYLES */
			/*
			CSS selectors are written in attribute
			selector format to prevent Yahoo Mail
			from rendering media query styles on
			desktop.
			*/
			/*td[class=textContent], td[class=flexibleContainerCell] { width: 100%; padding-left: 10px !important; padding-right: 10px !important; }*/
			table[id=emailHeader],
			table[id=emailBody],
			table[id=emailFooter],
			table[class=flexibleContainer],
			td[class=flexibleContainerCell] {width:100% !important;}
			td[class=flexibleContainerBox], td[class=flexibleContainerBox] table {display: block;width: 100%;text-align: left;}
			/*
			The following style rule makes any
			image classed with 'flexibleImage'
			fluid when the query activates.
			Make sure you add an inline max-width
			to those images to prevent them
			from blowing out.
			*/
			td[class=imageContent] img {height:auto !important; width:100% !important; max-width:100% !important; }
			img[class=flexibleImage]{height:auto !important; width:100% !important;max-width:100% !important;}
			img[class=flexibleImageSmall]{height:auto !important; width:auto !important;}


			/*
			Create top space for every second element in a block
			*/
			table[class=flexibleContainerBoxNext]{padding-top: 10px !important;}

			/*
			Make buttons in the email span the
			full width of their container, allowing
			for left- or right-handed ease of use.
			*/
			table[class=emailButton]{width:100% !important;}
			td[class=buttonContent]{padding:0 !important;}
			td[class=buttonContent] a{padding:15px !important;}

		}

		/*  CONDITIONS FOR ANDROID DEVICES ONLY
		*   http://developer.android.com/guide/webapps/targeting.html
		*   http://pugetworks.com/2011/04/css-media-queries-for-targeting-different-mobile-devices/ ;
		=====================================================*/

		@media only screen and (-webkit-device-pixel-ratio:.75){
			/* Put CSS for low density (ldpi) Android layouts in here */
		}

		@media only screen and (-webkit-device-pixel-ratio:1){
			/* Put CSS for medium density (mdpi) Android layouts in here */
		}

		@media only screen and (-webkit-device-pixel-ratio:1.5){
			/* Put CSS for high density (hdpi) Android layouts in here */
		}
		/* end Android targeting */

		/* CONDITIONS FOR IOS DEVICES ONLY
		=====================================================*/
		@media only screen and (min-device-width : 320px) and (max-device-width:568px) {

		}
		/* end IOS targeting */
	</style>
	<!--
		Outlook Conditional CSS

		These two style blocks target Outlook 2007 & 2010 specifically, forcing
		columns into a single vertical stack as on mobile clients. This is
		primarily done to avoid the 'page break bug' and is optional.

		More information here:
		http://templates.mailchimp.com/development/css/outlook-conditional-css
	-->
	<!--[if mso 12]>
		<style type=text/css>
			.flexibleContainer{display:block !important; width:100% !important;}
		</style>
	<![endif]-->
	<!--[if mso 14]>
		<style type=text/css>
			.flexibleContainer{display:block !important; width:100% !important;}
		</style>
	<![endif]-->
</head>
<body bgcolor=#E1E1E1 leftmargin=0 marginwidth=0 topmargin=0 marginheight=0 offset=0>

	<!-- CENTER THE EMAIL // -->
	<!--
	1.  The center tag should normally put all the
		content in the middle of the email page.
		I added table-layout: fixed; style to force
		yahoomail which by default put the content left.

	2.  For hotmail and yahoomail, the contents of
		the email starts from this center, so we try to
		apply necessary styling e.g. background-color.
	-->
	<center style=background-color:#E1E1E1;>
		<table border=0 cellpadding=0 cellspacing=0 height=100% width=100% id=bodyTable style=table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;>
			<tr>
				<td align=center valign=top id=bodyCell>

					<!-- EMAIL HEADER // -->
					<!--
						The table emailBody is the email's container.
						Its width can be set to 100% for a color band
						that spans the width of the page.
					-->
					<table bgcolor=#E1E1E1 border=0 cellpadding=0 cellspacing=0 width=500 id=emailHeader>

						<!-- HEADER ROW // -->
						<tr>
							<td align=center valign=top>
								<!-- CENTERING TABLE // -->
								<table border=0 cellpadding=0 cellspacing=0 width=100%>
									<tr>
										<td align=center valign=top>
											<!-- FLEXIBLE CONTAINER // -->
											<table border=0 cellpadding=10 cellspacing=0 width=500 class=flexibleContainer>
												<tr>
													<td valign=top width=500 class=flexibleContainerCell>

														<!-- CONTENT TABLE // -->
														<table align=left border=0 cellpadding=0 cellspacing=0 width=100%>
															<tr>
																<!--
																	The invisibleIntroduction is the text used for short preview
																	of the email before the user opens it (50 characters max). Sometimes,
																	you do not want to show this message depending on your design but this
																	text is highly recommended.

																	You do not have to worry if it is hidden, the next <td> will automatically
																	center and apply to the width 100% and also shrink to 50% if the first <td>
																	is visible.
																-->
																<td align=left valign=middle id=invisibleIntroduction class=flexibleContainerBox style=display:none !important; mso-hide:all;>
																	<table border=0 cellpadding=0 cellspacing=0 width=100% style=max-width:100%;>
																		<tr>
																			<td align=left class=textContent>
																				<div style=font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%;>
																					The introduction of your message preview goes here. Try to make it short.
																				</div>
																			</td>
																		</tr>
																	</table>
																</td>
																<td align=right valign=middle class=flexibleContainerBox>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<!-- // FLEXIBLE CONTAINER -->
										</td>
									</tr>
								</table>
								<!-- // CENTERING TABLE -->
							</td>
						</tr>
						<!-- // END -->

					</table>
					<!-- // END -->

					<!-- EMAIL BODY // -->
					<!--
						The table emailBody is the email's container.
						Its width can be set to 100% for a color band
						that spans the width of the page.
					-->
					<table bgcolor=#FFFFFF  border=0 cellpadding=0 cellspacing=0 width=500 id=emailBody>

						<!-- MODULE ROW // -->
						<!--
							To move or duplicate any of the design patterns
							in this email, simply move or copy the entire
							MODULE ROW section for each content block.
						-->
						<tr>
							<td align=center valign=top>
								<!-- CENTERING TABLE // -->
								<!--
									The centering table keeps the content
									tables centered in the emailBody table,
									in case its width is set to 100%.
								-->
								<table border=0 cellpadding=0 cellspacing=0 width=100% style=color:#FFFFFF; bgcolor=#3498db>
									<tr>
										<td align=center valign=top>
											<!-- FLEXIBLE CONTAINER // -->
											<!--
												The flexible container has a set width
												that gets overridden by the media query.
												Most content tables within can then be
												given 100% widths.
											-->
											<table border=0 cellpadding=0 cellspacing=0 width=500 class=flexibleContainer>
												<tr>
													<td align=center valign=top width=500 class=flexibleContainerCell>

														<!-- CONTENT TABLE // -->
														<!--
														The content table is the first element
															that's entirely separate from the structural
															framework of the email.
														-->
														<table border=0 cellpadding=30 cellspacing=0 width=100%>
															<tr>
																<td align=center valign=top class=textContent>
																	<h1 style=color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;>Recursos Humanos</h1>
																	<h2 style=text-align:center;font-weight:normal;font-family:Helvetica,Arial,sans-serif;font-size:23px;margin-bottom:10px;color:#205478;line-height:135%;>Subheader introduction</h2>
																	<div style=text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</div>
																</td>
															</tr>
														</table>
														<!-- // CONTENT TABLE -->

													</td>
												</tr>
											</table>
											<!-- // FLEXIBLE CONTAINER -->
										</td>
									</tr>
								</table>
								<!-- // CENTERING TABLE -->
							</td>
						</tr>
						<!-- // MODULE ROW -->


						<!-- MODULE ROW // -->
						<tr>
							<td align=center valign=top>
								<!-- CENTERING TABLE // -->
								<table border=0 cellpadding=0 cellspacing=0 width=100% bgcolor=#F8F8F8>
									<tr>
										<td align=center valign=top>
											<!-- FLEXIBLE CONTAINER // -->
											<table border=0 cellpadding=0 cellspacing=0 width=500 class=flexibleContainer>
												<tr>
													<td align=center valign=top width=500 class=flexibleContainerCell>
														<table border=0 cellpadding=30 cellspacing=0 width=100%>
															<tr>
																<td align=center valign=top>

																	<!-- CONTENT TABLE // -->
																	<table border=0 cellpadding=0 cellspacing=0 width=100%>
																		<tr>
																			<td valign=top class=textContent>
																				<!--
																					The mc:edit is a feature for MailChimp which allows
																					you to edit certain row. It makes it easy for you to quickly edit row sections.
																					http://kb.mailchimp.com/templates/code/create-editable-content-areas-with-mailchimps-template-language
																				-->
																				<h3 mc:edit=header style=color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;>Message Title</h3>
																				<div mc:edit=body style=text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</div>
																			</td>
																		</tr>
																	</table>
																	<!-- // CONTENT TABLE -->

																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<!-- // FLEXIBLE CONTAINER -->
										</td>
									</tr>
								</table>
								<!-- // CENTERING TABLE -->
							</td>
						</tr>
						<!-- // MODULE ROW -->



						<!-- MODULE ROW // -->
						<tr>
							<td align=center valign=top>
								<!-- CENTERING TABLE // -->
								<table border=0 cellpadding=0 cellspacing=0 width=100%>
									<tr>
										<td align=center valign=top>
											<!-- FLEXIBLE CONTAINER // -->
											<table border=0 cellpadding=0 cellspacing=0 width=500 class=flexibleContainer>
												<tr>
													<td valign=top width=500 class=flexibleContainerCell>

														<!-- CONTENT TABLE // -->
														<table align=left border=0 cellpadding=0 cellspacing=0 width=100%>
															<tr>
																<td align=left valign=top class=flexibleContainerBox style=background-color:#5F5F5F;>
																	<table border=0 cellpadding=30 cellspacing=0 width=100% style=max-width:100%;>
																		<tr>
																			<td align=left class=textContent>
																				<h3 style=color:#FFFFFF;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;>Left Column</h3>
																				<div style=text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis.</div>
																			</td>
																		</tr>
																	</table>
																</td>
																<td align=right valign=top class=flexibleContainerBox style=background-color:#27ae60;>
																	<table class=flexibleContainerBoxNext border=0 cellpadding=30 cellspacing=0 width=100% style=max-width:100%;>
																		<tr>
																			<td align=left class=textContent>
																				<h3 style=color:#FFFFFF;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;>Right Column</h3>
																				<div style=text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis.</div>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
														<!-- // CONTENT TABLE -->

													</td>
												</tr>
											</table>
											<!-- // FLEXIBLE CONTAINER -->
										</td>
									</tr>
								</table>
								<!-- // CENTERING TABLE -->
							</td>
						</tr>
						<!-- // MODULE ROW -->


						<!-- MODULE ROW // -->
						<tr>
							<td align=center valign=top>
								<!-- CENTERING TABLE // -->
								<table border=0 cellpadding=0 cellspacing=0 width=100%>
									<tr>
										<td align=center valign=top>
											<!-- FLEXIBLE CONTAINER // -->
											<table border=0 cellpadding=0 cellspacing=0 width=500 class=flexibleContainer>
												<tr>
													<td align=center valign=top width=500 class=flexibleContainerCell>
														<table border=0 cellpadding=30 cellspacing=0 width=100%>
															<tr>
																<td align=center valign=top>

																	<!-- CONTENT TABLE // -->
																	<table border=0 cellpadding=0 cellspacing=0 width=100%>
																		<tr>
																			<td valign=top class=textContent>
																				<div style=text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;margin-top:3px;color:#5F5F5F;line-height:135%;>Empty row for your custom contents</div>
																			</td>
																		</tr>
																	</table>
																	<!-- // CONTENT TABLE -->

																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<!-- // FLEXIBLE CONTAINER -->
										</td>
									</tr>
								</table>
								<!-- // CENTERING TABLE -->
							</td>
						</tr>
						<!-- // MODULE ROW -->

					</table>
					<!-- // END -->


				</td>
			</tr>
		</table>
	</center>
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