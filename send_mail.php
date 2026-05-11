<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendReminderEmail($to, $subject, $message) {

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        // 🔴 YOUR EMAIL DETAILS
        $mail->Username = getenv('EMAIL_USER');
        $mail->Password = getenv('EMAIL_PASS');

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom(getenv('EMAIL_USER'),'Smart Reminder System');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        return true;

    } catch (Exception $e) {
        echo "Email failed: " . $mail->ErrorInfo;
        return false;
}
    }
