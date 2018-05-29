<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/Applications/XAMPP/xamppfiles/htdocs/dms-374/phpmailer/libs/PHPMailer-Master/src/Exception.php';
require '/Applications/XAMPP/xamppfiles/htdocs/dms-374/phpmailer/libs/PHPMailer-Master/src/PHPMailer.php';
require '/Applications/XAMPP/xamppfiles/htdocs/dms-374/phpmailer/libs/PHPMailer-Master/src/SMTP.php';

//Load composer's autoloader
//require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    //$mail->Host = 'smtp.gmail.com'; //smtp2.gmail.com // Specify main and backup SMTP servers
    $mail->Host = 'smtp.utexas.edu';
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
    //$mail->Username = 'tanniarodriguez12@gmail.com';                 // SMTP username
    $mail->Username = 'tanniarodriguez@utexas.edu';
	$mail->Password = 'GoodLuck2U';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('tanniarodriguez@utexas.edu', 'Mailer');
    $mail->addAddress('tanniarodriguez12@gmail.com', 'Tan R');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('Reply@example.com', 'Reply Address');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->addAttachment('/Applications/XAMPP/xamppfiles/htdocs/dms-374/phpmailer/files/Biographical Data Form.pdf');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = '<p>This is the HTML message body <b>in bold!</b></p><p>This is a new paragraph</p>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}