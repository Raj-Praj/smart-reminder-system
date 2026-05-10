<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Reminder System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- TOP NAVBAR (HEADER + MENU TOGETHER) -->
<div class="topbar">

    <div class="logo">
        <a href="index.php">Smart Reminder</a>
    </div>

    <div class="menu">
        <?php if(isset($_SESSION['user_id'])) { ?>
            <a href="index.php">Dashboard</a>
            <a href="add_reminder.php">Add Reminder</a>
            <a href="logout.php">Logout</a>
        <?php } else { ?>
            <a href="#" onclick="openAuth('login')">Login</a>
            <a href="#" onclick="openAuth('register')">Register</a>
        <?php } ?>
    </div>

</div>

<div class="container">