<?php 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'inc/config.php';

if($_POST)
{
    $names = $_POST['names'];
    $email = $_POST['email'];
    $messages = $_POST['messages'];

    DB::insert("INSERT INTO contact(names,email,messages) VALUES(?,?,?)",array(
        $names,
        $email,
        $messages

    ));

    $mail_icerik = "Hello Admin, A new contact form has been submitted from your site. The information is below.";
	$mail_icerik .= "Name: $names<br>";
	
	$mail_icerik .= "Email: $email<br>";
	$mail_icerik .= "Message: $messages<br>";

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    $mail = new PHPMailer(true);

	try {

		$mail->SMTPDebug = 0;                      // Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'peteksukarpuz95@gmail.com';                     // SMTP username
		$mail->Password   = '';                               // SMTP password
		$mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port = 587;                                // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		//Recipients
		$mail->setFrom('peteksukarpuz95@gmail.com', 'Mail - form');
		$mail->addAddress('peteksukarpuz99@gmail.com', 'Peteksu Karpuz');     



		$mail->isHTML(true);  
		$mail->CharSet = 'UTF-8';                 
		$mail->Subject = 'A contact form has been sent from your site.';
		$mail->Body    = $mail_icerik;
		$mail->AltBody = $mail_icerik;

		$mail->send();
			
		
	} 
	catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		die();
	}
    
    
    header("Location:index.php?success=1");
}



?>