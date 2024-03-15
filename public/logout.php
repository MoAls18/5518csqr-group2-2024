<?php
session_start();
if (session_status() !== PHP_SESSION_NONE) {
    session_unset();
    session_destroy();
    echo "Log out successfull!";
    header('location: index.php');
} else {
    echo "No logged in user!";
}
