<?php
    session_start();

    if ($_SESSION['user_level'] !== 'admin') {
        header('Location: dashboard.php');
        exit;
    }
?>
<?php include 'includes/header.php'; ?>
<h1>Admin Page!</h1>
<?php include 'includes/footer.php'; ?>