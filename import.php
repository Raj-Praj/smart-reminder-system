<?php
include "db.php";

$sql = file_get_contents("mydb.sql");

if ($conn->multi_query($sql)) {
    echo "Import successful";
} else {
    echo "Error: " . $conn->error;
}
?>