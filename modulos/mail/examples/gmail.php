

<?php
	header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set('America/Phoenix');


  include('../../control/connect.php');//librerias para coneccion a la base de datos


//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that


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
$mail->addAddress('1130032@unav.edu.mx ', 'Información');//Set who the message is to be sent to
$mail->addAddress('mayis1995maz@hotmail.com ', 'Información');//Set who the message is to be sent to
$mail->Subject = 'Información ';//Set the subject line

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//$mail->isHTML(true);
$mail->msgHTML("Enviado mensaje");
$name="Prestamo";
$mail->AltBody = 'Prestamo';//Replace the plain text body with one created manually

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    header("Location: l_correo.php");

}





