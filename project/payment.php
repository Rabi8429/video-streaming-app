<!-- public/payment.php -->
<?php
session_start();
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Payment Page</h2>
<p>Thank you for your purchase! This is a mock-up of a payment page.</p>

