
<?php
require_once "../config/config.php";
require_once "../models/user_model.php";
require_once "../repositories/user_repository.php";

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$userRepository = new UserRepository($conn);

$userRepository->deleteUserByUsername("username");

echo "USER DELETED";
?>
