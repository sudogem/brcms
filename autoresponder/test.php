<?php 
	include('function_auto_res.php');
	
	$destination = "grifter140@yahoo.com";
	$message = "This is a test message";
	$origin = "From:admin@localhost.com";
	
	$mail = new auto_res($destination, $message, $origin) ;
	echo $mail->notification_mail(100, 25, 'expire');
?>