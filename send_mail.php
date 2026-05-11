/*
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
*/
<?php

function sendReminderEmail($to, $subject, $message) {

    $apiKey = getenv('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');

    $data = [
        "sender" => [
            "name" => "Smart Reminder System",
            "email" => "esmart.reminder.system@gmail.com"
        ],
        "to" => [
            [
                "email" => $to
            ]
        ],
        "subject" => $subject,
        "htmlContent" => $message
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.brevo.com/v3/smtp/email");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "accept: application/json",
        "api-key: $apiKey",
        "content-type: application/json"
    ]);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if(curl_errno($ch)) {
        echo curl_error($ch);
        return false;
    }

    curl_close($ch);

    echo $response;

    return true;
}