<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('LOCATION: login.php ');
    exit;
}

?>