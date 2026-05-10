<?php
session_start();
include "db.php";

/* =========================
   LOGIN (BACKEND ONLY)
========================= */
if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];

            header("Location: index.php");
            exit();

        } else {
            $_SESSION['error'] = "Wrong password";
        }

    } else {
        $_SESSION['error'] = "User not found";
    }

    header("Location: index.php");
    exit();
}

/* =========================
   REGISTER (BACKEND ONLY)
========================= */
if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // check duplicate email
    $check = $conn->query("SELECT id FROM users WHERE email='$email'");

    if ($check && $check->num_rows > 0) {
        $_SESSION['error'] = "Email already exists";
        header("Location: index.php");
        exit();
    }

    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql)) {
        $_SESSION['success'] = "Registered successfully. Please login.";
    } else {
        $_SESSION['error'] = "Registration failed.";
    }

    header("Location: index.php");
    exit();
}