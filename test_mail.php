<?php

include "send_mail.php";

$result = sendReminderEmail(
    "rajpz3579@gmail.com",
    "Test Email",
    "If you received this, email system is working!"
);

if ($result) {
    echo "Email sent successfully!";
} else {
    echo "Email failed!";
}

?>