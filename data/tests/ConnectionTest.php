<?php
require "../config/config.php";

$conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);

if ($conn->connect_error == null) {
    echo "Connected Successfully";
} else {
    echo "Failed to connect.";
}

?>
