<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendReminderEmail($to, $subject, $message) {

    $mail = new PHPMailer(true);

    try {

        $mail->SMTPDebug = 2; // show debug
        $mail->Debugoutput = 'html';

       $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com';
        $mail->SMTPAuth = true;

        $mail->Username = getenv('BREVO_USER');
        $mail->Password = getenv('BREVO_PASS');

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 587;

        $mail->Timeout = 20;

        $mail->setFrom(getenv('EMAIL_USER'), 'Smart Reminder System');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();

        echo "MAIL SENT";
        return true;

    } catch (Exception $e) {

        echo "ERROR: " . $mail->ErrorInfo;
        return false;
    }
}