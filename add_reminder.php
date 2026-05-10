<?php
ob_start();
include "header.php";
include "db.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$success = "";
$error = "";
if ($_POST) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $final_time = $_POST['final_time'];
    $early = $_POST['early_reminder_minutes'] ?: NULL;
    $repeat_type = $_POST['repeat_type'];
    $user_id = $_SESSION['user_id'];
    $early_minutes = $_POST['early_reminder_minutes']?:NULL;

   

    $sql = "INSERT INTO reminders 
    (user_id, title, description, email, final_time, early_reminder_minutes,repeat_type)
    VALUES 
    ('$user_id', '$title', '$description', '$email', '$final_time', '$early','$repeat_type')";

    if ($conn->query($sql)) {
        $success = "Reminder saved successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<div class="reminder-container">

    <div class="reminder-card">

        <h2>Add Reminder</h2>

        <?php if($success) { ?>
            <div class="success-box"><?php echo $success; ?></div>
        <?php } ?>

        <?php if($error) { ?>
            <div class="error-box"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST">

            <!-- TITLE -->
            <div class="reminder-input-group">
                <input type="text" name="title" required>
                <label>Reminder Title</label>
            </div>

            <!-- DESCRIPTION -->
            <div class="reminder-input-group">
                <textarea name="description" required></textarea>
                <label>Description</label>
            </div>

            <!-- EMAIL -->
            <div class="reminder-input-group">
                <input type="email" name="email" required>
                <label>Email Address</label>
            </div>

            <!-- FINAL TIME -->
            <div class="reminder-input-group">
                <input type="datetime-local" name="final_time" required>
                <label class="top-label">Final Time</label>
            </div>
            <!--repeat type-->
            <div class="reminder-input-group">

                 <select name="repeat_type">

                     <option value="once">One Time</option>
                     <option value="daily">Daily</option>

                 </select>

            </div>

            <!-- EARLY REMINDER -->
            <div class="reminder-input-group">
                <select name="early_reminder_minutes">
                    <option value="1">none</option>
                    <option value="5">5 minutes before</option>
                    <option value="10">10 minutes before</option>
                    <option value="30">30 minutes before</option>
                    <option value="60">1 hour before</option>
                </select>
                <label class="top-label">Early reminder</label>
            </div>

            <button type="submit" class="save-btn">
                Save Reminder
            </button>

        </form>

    </div>

</div>

<?php include "footer.php"; ?>