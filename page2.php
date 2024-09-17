<?php
session_start();

if (!in_array($_SESSION['user_level'], ['aggregator', 'Commodities Brokers', 'Specialized Commodities Dealer', 'Commodities Broker Dealer', 'Commodities Trader']) || $_SESSION['user_approval'] !== 'approved') {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $export_or_import = $_POST['export_or_import'];
    $_SESSION['export_or_import'] = implode(', ', $export_or_import);
    $_SESSION['product_type'] = $_POST['product_type'];
    $_SESSION['hs_code'] = $_POST['hs_code'];
    $_SESSION['eta'] = $_POST['eta'];
    $_SESSION['pod'] = $_POST['pod'];

    if (!file_exists('uploads')) {
        mkdir('uploads', 0755, true);
    }
    
    function uploadFile($input_name) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES[$input_name]["name"]);
        if (move_uploaded_file($_FILES[$input_name]["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return null;
        }
    }
    $_SESSION['qq_report'] = uploadFile('qq_report');
    $_SESSION['bill_of_lading'] = uploadFile('bill_of_lading');
    $_SESSION['capital_importation_license'] = uploadFile('capital_importation_license');


    // Redirect to Page 3
    header("Location: page3.php");
    exit();
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'components/navigation.php'; ?>
<div class="container-fluid bg-comp-2 py-4">
<div class="container">
    <div class="d-flex flex-row justify-content-between">
        <div class="smfs-6">
            <a href="aggregator.php" class="text-secondary">
                <i class="bi bi-house text-secondary"></i>
            </a>
            <span class="text-secondary">
                | Dashboard</span>
        </div>
    </div>
</div>
</div>
<div class="container mt-5">
    <h2 class="mb-4">Transaction Information</h2>
    <div class="progress mb-4">
        <div class="progress-bar" role="progressbar" style="width: 66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100">66%</div>
    </div>
    <form action="page2.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="export_or_import" class="form-label">Export or Import</label>
            <div class="d-flex gap-2 mb-3 mx-3 smfs-5">
                <span class="text-light bg-success p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Husked Brown Rice(import)"> Husked Brown Rice (Import)</span>
                <span class="text-light bg-danger p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Husked Brown Rice(export)"> Husked Brown Rice (Export)</span>
            </div>
            <div class="d-flex gap-2 mb-3 mx-3 smfs-5">
                <span class="text-light bg-success p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Grain Sorghum - Other(import)"> Grain Sorghum - Other (Import)</span>
                <span class="text-light bg-danger p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Grain Sorghum - Other(export)"> Grain Sorghum - Other (Export)</span>
            </div>
            <div class="d-flex gap-2 mb-3 mx-3 smfs-5">
                <span class="text-light bg-success p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Millet - Other(import)"> Millet - Other (Import)</span>
                <span class="text-light bg-danger p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Millet - Other(export)"> Millet - Other (Export)</span>
            </div>
            <div class="d-flex gap-2 mb-3 mx-3 smfs-5">
                <span class="text-light bg-success p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Maize - Other(import)"> Maize - Other (Import)</span>
                <span class="text-light bg-danger p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Maize - Other(export)"> Maize - Other (Export)</span>
            </div>
            <div class="d-flex gap-2 mb-3 mx-3 smfs-5">
                <span class="text-light bg-success p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Wheat - Other(import)"> Wheat - Other (Import)</span>
                <span class="text-light bg-danger p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Wheat - Other(export)"> Wheat - Other (Export)</span>
            </div>
            <div class="d-flex gap-2 mb-3 mx-3 smfs-5">
                <span class="text-light bg-success p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Beans(import)"> Beans (Import)</span>
                <span class="text-light bg-danger p-2 rounded"><input type="checkbox" name="export_or_import[]" value="Beans(export)"> Beans (Export)</span>
            </div>
        </div>
        <div class="mb-3">
            <label for="product_type" class="form-label">Type of Product</label>
            <select class="form-control" id="product_type" name="product_type" required>
                <option value="Raw Material">Raw Material</option>
                <option value="Finished Product">Finished Product</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="hs_code" class="form-label">HS Code</label>
            <input type="text" class="form-control" id="hs_code" name="hs_code" required>
            <span class="smfs-6"><a href="https://trade.gov.ng/en/tools/tariff-search" target="_blank">Click this link to get the correct HS code</a></span>
        </div>
        <div class="mb-3">
            <label for="qq_report" class="form-label">Quality and Quantity (Q&Q) Report</label>
            <input type="file" class="form-control" id="qq_report" name="qq_report" accept=".jpg,.jpeg,.png,.pdf" required>
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="mb-3">
            <label for="bill_of_lading" class="form-label">Bill of Lading</label>
            <input type="file" class="form-control" id="bill_of_lading" name="bill_of_lading" accept=".jpg,.jpeg,.png,.pdf" required>
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="mb-3">
            <label for="eta" class="form-label">Estimated Time of Arrival (ETA)</label>
            <input type="text" class="form-control" id="eta" name="eta" required>
        </div>
        <div class="mb-3">
            <label for="pod" class="form-label">Port of Discharge (Port of Loading)</label>
            <input type="text" class="form-control" id="pod" name="pod" required>
        </div>
        <div class="mb-3">
            <label for="capital_importation_license" class="form-label">Capital Importation License</label>
            <input type="file" class="form-control" id="capital_importation_license" name="capital_importation_license" accept=".jpg,.jpeg,.png,.pdf" required>
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Next</button>
            <button onclick="window.history.back();" class="btn btn-primary">Back</button>
        </div>
    </form>
</div>
<?php include 'includes/footer.php'; ?>