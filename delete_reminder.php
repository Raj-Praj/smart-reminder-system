<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // delete only user's own reminder
    $sql = "DELETE FROM reminders 
            WHERE id='$id' AND user_id='$user_id'";

    if ($conn->query($sql)) {
        $_SESSION['success'] = "Reminder deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete reminder.";
    }
}

header("Location: index.php");
exit();
?>