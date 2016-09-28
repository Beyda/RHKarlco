<?php
	ini_set("SMTP","mail.escuelactec.com");
	ini_set("smtp_port","localhost");
	ini_set('sendmail_from', 'info@escuelactec.com');
	
	$name = strip_tags($_POST["nombre"]);
	$apellido = strip_tags( $_POST["apellidos"]);
	$mail = strip_tags($_POST["correo"]);
	$mensaje = strip_tags($_POST["comentario"]);

	$nameFile = $_FILES["archivo"]["name"];
	$sizeFile= $_FILES["archivo"]["size"];
	$typeFile= $_FILES["archivo"]["type"];
	$tempFile= $_FILES["archivo"]["tmp_name"];

	$fecha= time();
	$fechaFormato = date("j/n/Y",$fecha);
		
	echo "Nombre: " . $nameFile . "<br>";
	echo "Tamaño: " . $sizeFile . "<br>";
	echo "Tipo: ". $typeFile . "<br>";
	echo "Temporal: " . $tempFile . "<br>";


	$correoDestino = "info@escuelactec.com";
	
	//asunto del correo
	$asunto = "Enviado por " . $name . " ". $apellido;

 	// -> mensaje en formato Multipart MIME
	$cabecera = "MIME-VERSION: 1.0\r\n";
	$cabecera .= "Content-type: multipart/mixed;";
	$cabecera .="boundary=\"=C=T=E=C=\"\r\n";
	$cabecera .= "From: {$mail}";

	//Primera parte del mensaje (texto plano)
	//    -> encabezado de la parte

	$cuerpo = "--=C=T=E=C=\r\n";
	$cuerpo .= "Content-type: text/plain";
	$cuerpo .= "charset=utf-8\r\n";
	$cuerpo .= "Content-Transfer-Encoding: 8bit\r\n";
	$cuerpo .= "\r\n"; // línea vacía
	$cuerpo .= "Correo enviado por: " . $name . " ". $apellido;
	$cuerpo .= " con fecha: " . $fechaFormato;
	$cuerpo .= "Email: " . $mail;
	$cuerpo .= "Mensaje: " . $mensaje;
	$cuerpo .= "\r\n";// línea vacía

 	// -> segunda parte del mensaje (archivo adjunto)
        //    -> encabezado de la parte
    $cuerpo .= "--=C=T=E=C=\r\n";
    $cuerpo .= "Content-Type: application/octet-stream; ";
    $cuerpo .= "name=" . $nameFile . "\r\n";
    $cuerpo .= "Content-Transfer-Encoding: base64\r\n";
    $cuerpo .= "Content-Disposition: attachment; ";
    $cuerpo .= "filename=" . $nameFile . "\r\n";
    $cuerpo .= "\r\n"; // línea vacía

    $fp = fopen($tempFile, "rb");
    $file = fread($fp, $sizeFile);
	$file = chunk_split(base64_encode($file));

    //    -> lectura del archivo correspondiente al archivo adjunto
    //$datos = file_get_contents($archivo);
    
    //    -> codificación y fragmentación de los datos
    //$datos = chunk_split(base64_encode($datos));
    //    -> datos de la parte (integración en el mensaje)
    //$mensaje .= "$datos\r\n";
    $cuerpo .= "$file\r\n";
    $cuerpo .= "\r\n"; // línea vacía
    // Delimitador de final del mensaje.
    $cuerpo .= "--=C=T=E=C=--\r\n";
    // Envío del mensaje.
    // $ok = mail($destinatarios,$asunto,$mensaje,$encabezados);
    echo 'Nota: la línea de código que permite enviar el correo está en el comentario.<br />';

	//Enviar el correo
	if(mail($correoDestino, $asunto, $cuerpo, $cabecera)){
		echo "Correo enviado";
	}else{
		echo "Error de envio";
	}
	
?>