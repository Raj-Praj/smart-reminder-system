<?php

function sendReminderEmail($to, $subject, $message) {

    $apiKey = getenv('BREVO_API_KEY');

    if (!$apiKey) {
        echo "Missing BREVO_API_KEY";
        return false;
    }

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
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "accept: application/json",
        "api-key: " . $apiKey,
        "content-type: application/json"
    ]);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "cURL Error: " . curl_error($ch);
        return false;
    }

    curl_close($ch);

    $result = json_decode($response, true);

    // Debug output (optional)
    echo $response;

    // SUCCESS check
    if (isset($result['messageId'])) {
        return true;
    }

    return false;
}