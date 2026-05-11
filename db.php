<?php

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);

$connected = mysqli_real_connect(
    $conn,
    getenv('DB_HOST'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_NAME'),
    10007,
    NULL,
    MYSQLI_CLIENT_SSL
);

if (!$connected) {
    die("DB Connection failed: " . mysqli_connect_error());
}

?>