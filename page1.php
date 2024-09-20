<?php
session_start();

if (!in_array($_SESSION['user_level'], ['aggregator', 'Commodities Brokers', 'Specialized Commodities Dealer', 'Commodities Broker Dealer', 'Commodities Trader']) || $_SESSION['user_approval'] !== 'approved') {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['organization_name'] = $_POST['organization_name'];
    $_SESSION['years_in_operation'] = $_POST['years_in_operation'];
    $_SESSION['rc_number'] = $_POST['rc_number'];
    $_SESSION['contact_person_nin_bvn_1'] = $_POST['contact_person_nin_bvn_1'];
    $_SESSION['contact_person_nin_bvn_2'] = $_POST['contact_person_nin_bvn_2'];
    $_SESSION['size'] = $_POST['size'];
    $_SESSION['location'] = $_POST['location'];
    $_SESSION['type'] = $_POST['type'];
    $_SESSION['c_total'] = $_POST['c_total'];
    $_SESSION['registered_office_address'] = $_POST['registered_office_address'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['phone_number'] = $_POST['phone_number'];
    $_SESSION['commodity_to_aggregate'] = $_POST['commodity_to_aggregate'];
    $_SESSION['quantity_of_commodity'] = $_POST['quantity_of_commodity'];
    $_SESSION['user_id'] = $_POST['user_id'];
    $_SESSION['tax_id'] = $_POST['tax_id'];
    $_SESSION['authorized_share_capital'] = $_POST['authorized_share_capital'];

    if (!file_exists('uploads')) {
        mkdir('uploads', 0755, true);
    }
    
    function uploadFile($input_name) {
        $target_dir = "uploads/";
        $file = $_FILES[$input_name];
        $target_file = $target_dir . basename($file["name"]);
        
        if ($file['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
            if (in_array($file['type'], $allowed_types) && $file['size'] <= 3145728) {
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    return $target_file;
                }
            }
        }
        return null;
    }

    $_SESSION['certificate_of_incorporation'] = uploadFile('certificate_of_incorporation');
    $_SESSION['memorandum_articles_of_association'] = uploadFile('memorandum_articles_of_association');
    $_SESSION['status_report'] = uploadFile('status_report');
    $_SESSION['nerc_certificate'] = uploadFile('nerc_certificate');
    $_SESSION['financial_status'] = uploadFile('financial_status');
    $_SESSION['tax_certificate'] = uploadFile('tax_certificate');

    header("Location: page2.php");
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
    <h2 class="mb-4">General Information (Profile Creation)</h2>
    <div class="progress mb-4">
        <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">33%</div>
    </div>
    <form action="page1.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="organization_name" class="form-label">Name of Organization</label>
            <input type="text" class="form-control" id="organization_name" name="organization_name" required>
        </div>
        <div class="mb-3">
            <label for="registered_office_address" class="form-label">Registered Office Address</label>
            <input type="text" class="form-control" id="registered_office_address" name="registered_office_address" required>
        </div>
        <div class="mb-3">
            <label for="years_in_operation" class="form-label">Number of Years in Operation</label>
            <input type="number" class="form-control" id="years_in_operation" name="years_in_operation" required>
        </div>
        <div class="mb-3">
            <label for="rc_number" class="form-label">RC Number</label>
            <input type="text" class="form-control" id="rc_number" name="rc_number" required>
        </div>
        <div class="mb-3">
            <label for="certificate_of_incorporation" class="form-label">Certificate of Incorporation</label>
            <input type="file" class="form-control" id="certificate_of_incorporation" name="certificate_of_incorporation" accept=".jpg,.jpeg,.png,.pdf" required>
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="mb-3">
            <label for="memorandum_articles_of_association" class="form-label">Memorandum and Articles of Association</label>
            <input type="file" class="form-control" id="memorandum_articles_of_association" name="memorandum_articles_of_association" accept=".jpg,.jpeg,.png,.pdf" required>
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="mb-3">
            <label for="status_report" class="form-label">Status Report</label>
            <input type="file" class="form-control" id="status_report" name="status_report" accept=".jpg,.jpeg,.png,.pdf" required>
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="mb-3">
            <label for="nerc_certificate" class="form-label">NERC Certificate (For Exporters/Importers)</label>
            <input type="file" class="form-control" id="nerc_certificate" name="nerc_certificate" accept=".jpg,.jpeg,.png,.pdf">
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="mb-3">
            <label for="contact_person_nin_bvn_1" class="form-label">Contact Person's NIN/BVN 1</label>
            <input type="text" class="form-control" pattern="[0-9]*" minlength="11" maxlength="11" id="contact_person_nin_bvn_1" name="contact_person_nin_bvn_1" required>
        </div>
        <div class="mb-3">
            <label for="contact_person_nin_bvn_2" class="form-label">Contact Person's NIN/BVN 2</label>
            <input type="text" class="form-control" pattern="[0-9]*" minlength="11" maxlength="11" id="contact_person_nin_bvn_2" name="contact_person_nin_bvn_2">
        </div>
        <div class="mb-3">
            <label for="financial_status" class="form-label">Financial Status (5 Years Audited Accounts)</label>
            <input type="file" class="form-control" id="financial_status" name="financial_status" accept=".jpg,.jpeg,.png,.pdf" required>
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 3MB</span>
        </div>
        <div class="mb-3">
            <label for="tax_certificate" class="form-label">Tax Certificate</label>
            <input type="file" class="form-control" id="tax_certificate" name="tax_certificate" accept=".jpg,.jpeg,.png,.pdf" required>
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="mb-3">
            <label for="tax_id" class="form-label">Tax ID</label>
            <input type="text" class="form-control" id="tax_id" name="tax_id" required>
        </div>
        <div class="mb-3">
            <label for="authorized_share_capital" class="form-label">Authorized Share Capital</label>
            <input type="text" class="form-control" id="authorized_share_capital" name="authorized_share_capital" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Storage Type</label>
            <select type="text" class="form-control" id="type" name="type" required>
                <option value="Silos">Silos</option>
                <option value="Cold Storage">Cold Storage</option>
                <option value="Warehouse">Warehouse</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="size" class="form-label">Storage Size</label>
            <input type="text" class="form-control" id="size" name="size" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Storage Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Storage Capacity (Total)</label>
            <input type="text" class="form-control" id="c_total" name="c_total">
            <span class="smfs-6">Kindly fill this field, if you have more than 1 storage type</span>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="tel" pattern="[0-9]*" minlength="11" maxlength="11" required="required" placeholder="08012345678" class="form-control" id="phone_number" name="phone_number" required>
        </div>
        <div class="mb-3">
            <label for="commodity_to_aggregate" class="form-label">Commodity to Aggregate</label>
            <input type="text" class="form-control" id="commodity_to_aggregate" name="commodity_to_aggregate" required>
        </div>
        <div class="mb-3">
            <label for="quantity_of_commodity" class="form-label">Quantity of Commodity (in Kg)</label>
            <input type="text" class="form-control" id="quantity_of_commodity" name="quantity_of_commodity" required>
        </div>
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Next</button>
            <button onclick="window.history.back();" class="btn btn-primary">Back</button>
        </div>
    </form>
</div>
<?php include 'includes/footer.php'; ?>