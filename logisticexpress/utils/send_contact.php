<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../phpfiles/src/Exception.php';
require '../phpfiles/src/PHPMailer.php';
require '../phpfiles/src/SMTP.php';

$email = new PHPMailer();
$email->SetFrom('you@example.com', 'CV'); //Name is optional
$email->Subject   = 'cv';
$email->IsHTML(true);    

$body = '<html><body>';
        
$body .= '<p>Name: '.$_POST['first-name'].' '.$_POST['last-name'].'</p><br>';
$body .= '<p>Email: '.$_POST['email'].'</p><br>';
$body .= '<p>Phone: '.$_POST['phone'].'</p><br>';
$body .= '<p>Message: '.$_POST['message'].'</p><br>';

$body .= '</body></html>';

$email->Body = $body;

$email->AddAddress( 'vatia1998@gmail.com' );

$email->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
$email->isSMTP();                                            // Send using SMTP
$email->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
$email->SMTPAuth   = true;                                   // Enable SMTP authentication
$email->Username   = 'vatia1998@gmail.com';                     // SMTP username
$email->Password   = 'goalkeeper123';                               // SMTP password
$email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$email->Port       = 587;

if ($email->Send()) header('Location: ../contact.php');


?>