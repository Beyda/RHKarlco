<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Formulario</title> <!-- Aquí va el título de la página -->

</head>

<body>
<?php

$Nombre = $_POST['Nombre'];
$Email = $_POST['Email'];
$Mensaje = $_POST['Mensaje'];
$archivo = $_FILES['adjunto'];

if ($Nombre=='' || $Email=='' || $Mensaje==''){

echo "<script>alert('Los campos marcados con * son obligatorios');location.href ='javascript:history.back()';</script>";

}else{
    include('../../../control/connect.php');
    $correos = "SELECT DISTINCT d.`primer_nombre`, d.`segundo_nombre`, d.`ap_paterno`, d.`ap_materno`, d.`correo` FROM `datos_personales` d INNER JOIN `puesto_per` pp ON d.`id_datosper` = pp.`id_datosper` INNER JOIN `puestos` p ON pp.`id_puesto` = p.`id_puesto` INNER JOIN `empresas` e ON p.`id_empresa` = e.`id_empresa` AND e.`id_empresa` = 16";
    $resul_correos = $mysqli->query($correos);
    require("archivosformulario/class.phpmailer.php");
    $mail = new PHPMailer();

    $mail->From     = '1130032@unav.edu.mx';
    $mail->FromName = 'Rhkarlco'; 
    while ($row_correos = $resul_correos->fetch_array()) 
        {
    $mail->addAddress(utf8_decode($row_correos[4]) , utf8_decode($row_correos[0]) .' '. utf8_decode($row_correos[1]) .' '. utf8_decode($row_correos[2]) .' '. utf8_decode($row_correos[3]));//correos a donde se envia el mensaje
        }
        
    $mail->Subject  =  "Contacto";
    $mail->Body     =  "d";
    $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
    
    
    

// Datos del servidor SMTP

    $mail->IsSMTP(); 
    $mail->Debugoutput = 'html';//Ask for HTML-friendly debug output
                    $mail->Host = 'smtp.gmail.com';//hostname del servidor de gmail
                    $mail->Port = 465;//puerto del host de gmail
                    $mail->SMTPSecure = 'ssl';//envio de encriptación ssl
                    $mail->SMTPAuth = true;//Whether to use SMTP authentication
                    $mail->Username = "rhkarlco";//usuario creado en gmail de smtp
                    $mail->Password = 'rhkarlco2016';//contraseña del smtp
    
    if ($mail->Send())
    echo "<script>alert('Formulario enviado exitosamente, le responderemos lo más pronto posible.');location.href ='javascript:history.back()';</script>";
    
    echo "<script>alert('Error al enviar el formulario');location.href ='javascript:history.back()';</script>";

}

?>
</body>
</html>