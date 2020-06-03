<?php

require_once(__DIR__ . "/../functions/db.php");
require_once(__DIR__ . "/../functions/functions.php");

if (!isset($_FILES['image'])) exit;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../phpfiles/src/Exception.php';
require '../phpfiles/src/PHPMailer.php';
require '../phpfiles/src/SMTP.php';

$email = new PHPMailer();
$email->SetFrom('info@halitrephes.com', 'CV'); //Name is optional
$email->Subject   = 'cv';
$email->Body      = '-';
$email->AddAddress( 'careers@halitrephes.com' );

$email->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
$email->isSMTP();                                            // Send using SMTP
$email->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
$email->SMTPAuth   = true;                                   // Enable SMTP authentication
$email->Username   = 'vatia1998@gmail.com';                     // SMTP username
$email->Password   = 'goalkeeper123';                               // SMTP password
$email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$email->Port       = 587;

$file_to_attach = $_FILES['image']['tmp_name'];

$email->AddAttachment( $file_to_attach , $_FILES['image']['name'] );

return $email->Send();


?>