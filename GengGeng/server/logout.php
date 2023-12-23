<?php
session_start();

if (isset($_GET['logout'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_contact']);
    unset($_SESSION['user_name']);
    header('location: ../login.php');
    exit;
}
?>