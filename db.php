<?php

$conn = mysqli_init();

mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);

mysqli_real_connect(
    $conn,
    "mysql-29b24fb6-esmart-reminder-system.k.aivencloud.com",
    "avnadmin",
    "AVNS_FbAJ_XwSUqIgs8eajOg",
    "defaultdb",
    10007,
    NULL,
    MYSQLI_CLIENT_SSL
);

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

?>