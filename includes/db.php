<?php
$host = 'localhost';
$db = 'your_db_database';
$user = 'your_user_db';
$pass = 'your_pass_';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    die("DB Connection Failed: " . $e->getMessage());
}
?>