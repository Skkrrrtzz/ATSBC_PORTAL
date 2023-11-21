<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
$Email = $_POST['email'];
$Name = $_POST['name'];

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Set your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply.atsbcportal@gmail.com';
    $mail->Password = 'utmgdfcswrxjzevg';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('noreplyats1@gmail.com', 'ATS Business Control Portal'); // Sender details
    $mail->addAddress($Email, $Email); // Set recipient details 
    // $mail->addCC('kgajete@pimes.com.ph', 'Programmer'); // Set CC details
    //Attachments
    // $mail->addAttachment($outputFile, 'efficiency_capture.png'); // Attachments
    $mail->isHTML(true);
    $mail->Subject = 'Email Confirmation';
    $mail->Body = "This is your Email for sending emails from ATS Business Control Portal";

    $mail->send();
    // Create a response array
    echo json_encode([
        'success' => true,
        'message' => 'Please check your Email.'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => 'error',
        'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo
    ]);
}
exit();
