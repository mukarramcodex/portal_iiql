<?php
require 'includes/db.php';

$email = 'admin@example.com';
$password = 'admin123';

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user into the database
$stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
$stmt->execute([$email, $hashedPassword]);

// echo "User added successfully!";
// unlink(__FILE__); // Optional: delete this script automatically after running once
?>
