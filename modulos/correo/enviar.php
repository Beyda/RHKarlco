<?php
	require("../../control/connect.php");
	$empresa = $_POST["empresa"];
	$asunto = $_POST["asunto"];
	$mensaje = $_POST["mensaje"];
	$archivo = $_FILES['archivo']['name'];
	$type = $_FILES['archivo']['type'];
	$tamano = $_FILES['archivo']['size'];
	$tmp_name = $_FILES['archivo']['tmp_name'];
	$error = $_FILES['archivo']['error'];

	$v=0;
	//echo "<script>alert('$this->type');</script>";
	if ($this->error > 0){
		echo "ha ocurrido un error";
	} else {
			//esta es la ruta donde copiaremos la imagen
			$ruta = "../carga_archivos/correos/" . $archivo;
			//comprovamos si este archivo existe para no volverlo a copiar.
			if (!file_exists($ruta)){
				//aqui movemos el archivo desde la ruta temporal a nuestra ruta
				//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
				//almacenara true o false
				$resultado = @move_uploaded_file($tmp_name, $ruta);
				if ($resultado){
					
				} else {
					echo "<script>if(confirm('Error al mover el archivo')){ 
							document.location='l_correo.php';} 
							else{ alert('Operacion Cancelada'); 
							}</script>";
							$v = 1;
				}
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
		unlink("../carga_archivos/correos/$archivo");
	}else
	{
		//echo "<script> document.location='l_correo.php'; </script>";

		echo $correos = "SELECT DISTINCT d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, d.`correo` FROM `datos_personales` d INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON pp.`id_puesto` = p.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` AND e.`id_empresa` = $empresa";
		$resul_correos = $mysqli->query($correos);

		require '../PHPMailerAutoload.php';


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
$mail->Subject = 'Recursos Humanos ';//Set the subject line

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//$mail->isHTML(true);
$mail->msgHTML("Enviado mensaje");
$name="Recursos Humanos";
$mail->AltBody = 'Recursos Humanos';//Replace the plain text body with one created manually

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

?>