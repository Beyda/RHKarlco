

<?php
	header("Content-Type: text/html; charset=utf-8");
$nombre=$_GET['n'];
$a_paterno=$_GET['a_p'];
$a_materno=$_GET['a_m'];
$correo=$_GET['e'];
$telefono=$_GET['t'];
$curiculum=$_GET['doc'];



/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('America/Phoenix');

require '../PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'ssl';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "1100251@unav.edu.mx";

//Password to use for SMTP authentication
$mail->Password = 'patitofeo';


//Set who the message is to be sent from
//Quien lo envia
$mail->setFrom('1100251@unav.edu.mx', 'Bolsa de trabajo, INAES');

//Set an alternative reply-to address
//Responder a quien
$mail->addReplyTo('alindesing08@hotmail.com', 'Brenda Clemente');
$mail->addReplyTo('rdcarrada@gmail.com', 'Daniel Carrada');

//Set who the message is to be sent to
//Para
$mail->addAddress('alindesing08@hotmail.com', 'Inaes');
$mail->addAddress($correo, $nombre.' '.$a_paterno.' '.$a_materno);


//$nombre="Ricardo Daniel Carrada";
//Set the subject line
$mail->Subject = 'Nuevo Registro a la Bolsa de Trabajo: '.$nombre.' '.$a_paterno.' '.$a_materno;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body


//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$mail->msgHTML("<meta http-equiv='Content-Type' content='text/html; charset=utf-8'> <div style='width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;'>
        <div align='center'>
      <a href='#'><img src='http://biblioteca.unav2.edu.mx/inaes/logo.png' height='90' width='340' alt='PHPMailer rocks'></a>
    </div>
    <h1>El Modulo de inscripciones ha detectado un nuevo registo.</h1>
    <br>Datos del Nuevo Registro
<table border='' style='width:100%'>
<tr>
<td>Nombre Completo</td>
<td>".$nombre." ".$a_paterno." ".$a_materno."</td>
</tr>
<tr>
<td>Correo Electronico</td>
<td>".$correo."</td>
</tr>
<tr>
<td>telefono</td>
<td>".$telefono."</td>
</tr>
<tr>
<td>Curriculum</td>
<td><a href='http://localhost/inaes/inscripciones/admin/Doc_Bolsa_Trabajo/$curiculum'><img src='imagenes/pdf.png'></td>
</tr>


</table>
<br>



    ");

//Replace the plain text body with one created manually
$name="Ricardo Daniel Carrada";
$mail->AltBody = 'hola mundo';

//Attach an image file
//$path="/inaes/inscripciones/admin/Doc_Bolsa_Trabajo/";
//$mail->addAttachment('/images/f_deposito.jpg');
//$mail->addAttachment($path,$curiculum);


//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    header("Location: /inaes/inscripciones/admin/catalogo_bolsa.php");

}
