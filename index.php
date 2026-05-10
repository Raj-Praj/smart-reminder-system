<?php
include "db.php";
include "header.php";
?>

<h2>Dashboard</h2>

<?php
if(isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}

if(isset($_SESSION['success'])) {
    echo "<p style='color:green'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}
?>

<?php $user_logged_in = isset($_SESSION['user_id']); ?>

<!-- =========================
     DASHBOARD STATS
========================= -->

<?php if($user_logged_in) {

$user_id = $_SESSION['user_id'];

$total_sql = "SELECT COUNT(*) as total FROM reminders WHERE user_id=$user_id";
$total = $conn->query($total_sql)->fetch_assoc()['total'];

$pending_sql = "SELECT COUNT(*) as pending FROM reminders 
                WHERE user_id=$user_id ";
$pending = $conn->query($pending_sql)->fetch_assoc()['pending'];


?>

<div class="dashboard">

    <div class="card total">
        <h3>Total Reminders</h3>
        <p><?php echo $total; ?></p>
    </div>

    <div class="card pending">
        <h3>Upcoming</h3>
        <p><?php echo $pending; ?></p>
    </div>

    <div class="card sent">
        <h3>Recurring</h3>

        <p>
        <?php

         $daily_sql = "SELECT COUNT(*) as total 
                  FROM reminders 
                  WHERE user_id=$user_id 
                  AND repeat_type='daily'";

         $daily = $conn->query($daily_sql)->fetch_assoc()['total'];

         echo $daily;

    ?>
    </p>
</div>

</div>

<?php } else { ?>

<div style="background:#fff3cd;padding:15px;border-radius:8px;color:#856404;margin:15px 0;">
    ⚠ You are viewing as guest. Login to add and manage reminders.
    <a href="#" onclick="openAuth('login')">Login here</a>
</div>

<?php } ?>

<br>

<!-- =========================
     ADD BUTTON
========================= -->

<?php if($user_logged_in) { ?>
    <a href="add_reminder.php" style="text-decoration:none;">
        ➕ Add New Reminder
    </a>
<?php } else { ?>
    <p style="color:red;">
        Please login to add reminders →
        <a href="#" onclick="openAuth('login')">Login</a>
    </p>
<?php } ?>

<br><br>

<!--TABLE -->

<table border="1" cellpadding="10" width="100%">
    <tr>
       
        <th>Title</th>
        <th>Email</th>
        <th>Final Time</th>
        <th>Early (min)</th>
        <th>Action</th>
    </tr>

<?php
if($user_logged_in) {

    $sql = "SELECT * FROM reminders WHERE user_id = $user_id";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        echo "<tr>
            
            <td>{$row['title']}</td>
            <td>{$row['email']}</td>
            <td>{$row['final_time']}</td>
            <td>{$row['early_reminder_minutes']}</td>
            <td>
                  <a class='delete-btn'
                 href='delete_reminder.php?id={$row['id']}'
                onclick=\"return confirm('Delete this reminder?')\">
              Delete
             </a>
</td>
        </tr>";
    }

} else {
    echo "<tr><td colspan='5' style='text-align:center;color:gray;'>
        Login to view your reminders
    </td></tr>";
}
?>

</table>





<?php include "authform.php";
include "footer.php"; ?>