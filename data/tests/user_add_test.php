<?php

require_once "../config/config.php";
require_once "../models/user_model.php";
require_once "../repositories/user_repository.php";

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$current_timestamp = date(format: "Y-m-d H:i:s");

$user = new User(1, "username", "email@email.com", "password", $current_timestamp, $current_timestamp);

$userRepository = new UserRepository($conn);

$userRepository->addUser($user);

echo "USER ADDED";
?>
