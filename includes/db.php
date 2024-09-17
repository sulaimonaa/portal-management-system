<?php
$host = 'localhost';  // Database host
$db = 'portal_db';    // Database name
$user = 'root';       // Database username
$pass = '';           // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
