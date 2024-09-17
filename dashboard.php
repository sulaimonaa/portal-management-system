<?php
session_start();

if (!isset($_SESSION['user_id']) || 
    ($_SESSION['user_approval'] !== 'approved') ||
    !in_array($_SESSION['user_level'], ['admin', 'user'])) {
    header("Location: login.php");
    exit;
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'components/navigation.php'; ?>
<?php include 'components/top-list.php'; ?>
<?php include 'components/view1.php'; ?>
<?php include 'components/edit-tables.php'; ?>
<?php include 'includes/footer.php'; ?>
