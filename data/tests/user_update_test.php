<?php
require_once "../config/config.php";
require_once "../models/user_model.php";
require_once "../repositories/user_repository.php";

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$userRepository = new UserRepository($conn);
$current_timestamp = date(format: "Y-m-d H:i:s");

$user = $userRepository->getUserById(1);

$userRepository->updateUserPassword($user, "NewNewPassword");

echo "PASSWORD UPDATED";

