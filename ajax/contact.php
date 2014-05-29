<?php
	    session_start();

		$to = "saudadeh@gmail.com";
		$subject = "New Message from Pet Magick Contact Form";
		$body = "<strong>Full Name:</strong>: ".$_POST['name'].
				"<br> <strong> Email</strong>: ".$_POST['email'].
				"<br> <strong> Phone / Mobile:</strong> " . $_POST['phone'].
				"<br> <strong> Message:</strong> " . $_POST['message'];
		$headers =  "From: PetMagickContactUs@petmagick.co.nz\r\n";
		$headers .= "Date: ". date('Y-m-d H:i:s'); 
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		mail($to, $subject, $body, $headers);
		header('Location: http://www.petmagick.com/');
?>