<?php
	require 'PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();


	$mail->SMTPDebug = 0;

	$mail->From = "1130032@unav.edu.mx";
	$mail->FromName = "Beyda Trejo";

	$mail->addAddress("1130032@unav.edu.mx", "Recipient Name");

	//Provide file path and name of the attachments
	//$mail->addAttachment("file.txt", "File.txt");        
	$mail->addAttachment("images/logo.png"); //Filename is optional

	$mail->isHTML(true);

	$mail->Subject = "Subject Text";
	$mail->Body = "<i>Mail body in HTML</i>";
	$mail->AltBody = "This is the plain text version of the email content";

	if(!$mail->send())
	{
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
	    echo "Message has been sent successfully";
	}

?>