<?php
    include 'includes/db.php';

    try {
        // Check if form data is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // Retrieve form data
            $dateAdded = $_POST['date-added'];
            $assetName = $_POST['asset-name'];
            $price = $_POST['price'];
    
            // Prepare SQL and bind parameters
            $stmt = $pdo->prepare("INSERT INTO financial_data (`date-added`, `asset-name`, `price`) VALUES (:dateAdded, :assetName, :price)");
            $stmt->bindParam(':dateAdded', $dateAdded);
            $stmt->bindParam(':assetName', $assetName);
            $stmt->bindParam(':price', $price);
    
            // Execute the statement
            $stmt->execute();
            
            // Success message
            echo "New record created successfully!";
            header("Location: dashboard.php");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $pdo = null;
?>