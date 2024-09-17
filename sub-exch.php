<?php
    include 'includes/db.php';

    try {
        // Check if form data is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // Retrieve form data
            $dateAdded = $_POST['date-added'];
            $assetCurrency = $_POST['currency'];
            $assetBuying = $_POST['buying'];
            $assetCentral = $_POST['central'];
            $assetSelling = $_POST['selling'];
            $pl = $_POST['pl'];
    
            // Prepare SQL and bind parameters
            $stmt = $pdo->prepare("INSERT INTO exchange_rates (`date-added`, `currency`, `buying`, `central`, `selling`, `pl`) VALUES (:dateAdded, :assetCurrency, :assetBuying, :assetCentral, :assetSelling, :pl)");
            $stmt->bindParam(':dateAdded', $dateAdded);
            $stmt->bindParam(':assetCurrency', $assetCurrency);
            $stmt->bindParam(':assetBuying', $assetBuying);
            $stmt->bindParam(':assetCentral', $assetCentral);
            $stmt->bindParam(':assetSelling', $assetSelling);
            $stmt->bindParam(':pl', $pl);
    
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