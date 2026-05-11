<?php

include "db.php";
include "send_mail.php";

date_default_timezone_set("Asia/Kathmandu");

$now = new DateTime("now", new DateTimeZone("Asia/Kathmandu"));

# =========================
# EARLY REMINDERS FIRST
# =========================

$sql2 = "SELECT * FROM reminders 
         WHERE early_sent=0 
         AND early_reminder_minutes IS NOT NULL";

$result2 = $conn->query($sql2);

while($row = $result2->fetch_assoc()) {

    if (empty($row['final_time'])) continue;

    $final = new DateTime($row['final_time'], new DateTimeZone("Asia/Kathmandu"));

    $early = clone $final;
    $early->modify("-{$row['early_reminder_minutes']} minutes");

    if ($early <= $now) {

        sendReminderEmail(
            $row['email'],
            "EARLY REMINDER: " . $row['title'],
            "This is your early reminder.<br><br>" . $row['description']
        );

        $conn->query("
            UPDATE reminders 
            SET early_sent=1 
            WHERE id=" . $row['id']
        );
    }
}

# =========================
# FINAL REMINDERS
# =========================

$sql = "SELECT * FROM reminders";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

    if (empty($row['final_time'])) continue;

    $final = new DateTime($row['final_time'], new DateTimeZone("Asia/Kathmandu"));

    if ($final <= $now) {

        sendReminderEmail(
            $row['email'],
            "FINAL REMINDER: " . $row['title'],
            "Your reminder time has arrived.<br><br>" . $row['description']
        );

        # DAILY REMINDER
        if ($row['repeat_type'] == 'daily') {

            $next_day = clone $final;
            $next_day->modify("+1 day");

            $conn->query("
                UPDATE reminders 
                SET final_time='" . $next_day->format("Y-m-d H:i:00") . "',
                    early_sent=0
                WHERE id=" . $row['id']
            );

        } else {

            # ONE TIME REMINDER
            $conn->query("
                DELETE FROM reminders 
                WHERE id=" . $row['id']
            );
        }
    }
}

echo "Reminder check executed successfully.";

?>