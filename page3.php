<?php
session_start();

if (!in_array($_SESSION['user_level'], ['aggregator', 'Commodities Brokers', 'Specialized Commodities Dealer', 'Commodities Broker Dealer', 'Commodities Trader']) || $_SESSION['user_approval'] !== 'approved') {
    header('Location: dashboard.php');
    exit;
}

include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!file_exists('uploads')) {
        mkdir('uploads', 0755, true);
    }

    function uploadFile($input_name) {
        $target_dir = "uploads/";
        $file = $_FILES[$input_name];
        $target_file = $target_dir . basename($file["name"]);
        
        if ($file['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
            if (in_array($file['type'], $allowed_types) && $file['size'] <= 1048576) {
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    return $target_file;
                }
            }
        }
        return null;
    }

    $_SESSION['certificate_of_origin'] = uploadFile('certificate_of_origin');
    $_SESSION['sellers_commercial_invoice'] = uploadFile('sellers_commercial_invoice');
    $_SESSION['ministry_of_finance_approval'] = uploadFile('ministry_of_finance_approval');
    $_SESSION['custom_validation'] = uploadFile('custom_validation');
    $_SESSION['npa_mol'] = uploadFile('npa_mol');

    try {
        $checkSql = "SELECT COUNT(*) FROM aggregator_details WHERE organization_name = :organization_name OR rc_number = :rc_number OR email = :email OR user_id = :user_id";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->bindValue(':organization_name', $_SESSION['organization_name']);
        $checkStmt->bindValue(':rc_number', $_SESSION['rc_number']);
        $checkStmt->bindValue(':email', $_SESSION['email']);
        $checkStmt->bindValue(':user_id', $_SESSION['user_id']);
        $checkStmt->execute();

        if ($checkStmt->fetchColumn() > 0) {
            echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;"><div style="background: #037537; color: #fff; padding: 15px; border-radius: 5px;">Company profile already created.</div></div>';
            header("refresh:3;url=aggregator.php");
        } else {
            $sql = "INSERT INTO aggregator_details (
                        organization_name, years_in_operation, rc_number, certificate_of_incorporation, 
                        memorandum_articles_of_association, status_report, nerc_certificate, 
                        contact_person_nin_bvn_1, contact_person_nin_bvn_2, financial_status, 
                        tax_certificate, tax_id, authorized_share_capital, size, location, type, c_total, 
                        registered_office_address, email, phone_number, commodity_to_aggregate, 
                        quantity_of_commodity, user_id, export_or_import, product_type, hs_code, 
                        qq_report, bill_of_lading, eta, pod, capital_importation_license, certificate_of_origin, sellers_commercial_invoice, 
                        ministry_of_finance_approval, custom_validation, npa_mol
                    ) VALUES (
                        :organization_name, :years_in_operation, :rc_number, :certificate_of_incorporation, 
                        :memorandum_articles_of_association, :status_report, :nerc_certificate, 
                        :contact_person_nin_bvn_1, :contact_person_nin_bvn_2, :financial_status, 
                        :tax_certificate, :tax_id, :authorized_share_capital, :size, :location, :type, :c_total, 
                        :registered_office_address, :email, :phone_number, :commodity_to_aggregate, 
                        :quantity_of_commodity, :user_id, :export_or_import, :product_type, :hs_code, 
                        :qq_report, :bill_of_lading, :eta, :pod, :capital_importation_license, :certificate_of_origin, :sellers_commercial_invoice, 
                        :ministry_of_finance_approval, :custom_validation, :npa_mol
                    )";

            $stmt = $pdo->prepare($sql);
            // Bind values using bindValue or bindParam
            $stmt->bindValue(':organization_name', $_SESSION['organization_name']);
            $stmt->bindValue(':years_in_operation', $_SESSION['years_in_operation']);
            $stmt->bindValue(':rc_number', $_SESSION['rc_number']);
            $stmt->bindValue(':certificate_of_incorporation', $_SESSION['certificate_of_incorporation']);
            $stmt->bindValue(':memorandum_articles_of_association', $_SESSION['memorandum_articles_of_association']);
            $stmt->bindValue(':status_report', $_SESSION['status_report']);
            $stmt->bindValue(':nerc_certificate', $_SESSION['nerc_certificate']);
            $stmt->bindValue(':contact_person_nin_bvn_1', $_SESSION['contact_person_nin_bvn_1']);
            $stmt->bindValue(':contact_person_nin_bvn_2', $_SESSION['contact_person_nin_bvn_2']);
            $stmt->bindValue(':financial_status', $_SESSION['financial_status']);
            $stmt->bindValue(':tax_certificate', $_SESSION['tax_certificate']);
            $stmt->bindValue(':tax_id', $_SESSION['tax_id']);
            $stmt->bindValue(':authorized_share_capital', $_SESSION['authorized_share_capital']);
            $stmt->bindValue(':size', $_SESSION['size']);
            $stmt->bindValue(':location', $_SESSION['location']);
            $stmt->bindValue(':type', $_SESSION['type']);
            $stmt->bindValue(':c_total', $_SESSION['c_total']);
            $stmt->bindValue(':registered_office_address', $_SESSION['registered_office_address']);
            $stmt->bindValue(':email', $_SESSION['email']);
            $stmt->bindValue(':phone_number', $_SESSION['phone_number']);
            $stmt->bindValue(':commodity_to_aggregate', $_SESSION['commodity_to_aggregate']);
            $stmt->bindValue(':quantity_of_commodity', $_SESSION['quantity_of_commodity']);
            $stmt->bindValue(':user_id', $_SESSION['user_id']);
            $stmt->bindValue(':export_or_import', $_SESSION['export_or_import']);
            $stmt->bindValue(':product_type', $_SESSION['product_type']);
            $stmt->bindValue(':hs_code', $_SESSION['hs_code']);
            $stmt->bindValue(':qq_report', $_SESSION['qq_report']);
            $stmt->bindValue(':bill_of_lading', $_SESSION['bill_of_lading']);
            $stmt->bindValue(':eta', $_SESSION['eta']);
            $stmt->bindValue(':pod', $_SESSION['pod']);
            $stmt->bindValue(':capital_importation_license', $_SESSION['capital_importation_license']);
            $stmt->bindValue(':certificate_of_origin', $_SESSION['certificate_of_origin']);
            $stmt->bindValue(':sellers_commercial_invoice', $_SESSION['sellers_commercial_invoice']);
            $stmt->bindValue(':ministry_of_finance_approval', $_SESSION['ministry_of_finance_approval']);
            $stmt->bindValue(':custom_validation', $_SESSION['custom_validation']);
            $stmt->bindValue(':npa_mol', $_SESSION['npa_mol']);

            // Execute the statement
            if ($stmt->execute()) {
                echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;"><div style="background: #037537; color: #fff; padding: 15px; border-radius: 5px;">Your company profile registration is submitted successfully!</div></div>';
                header("refresh:2;url=aggregator.php");
                
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Clear only specific session variables after submission
    unset($_SESSION['certificate_of_origin'], $_SESSION['sellers_commercial_invoice'], $_SESSION['ministry_of_finance_approval'], $_SESSION['custom_validation'], $_SESSION['npa_mol']);
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
                <span class="text-secondary"> | Dashboard</span>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h2 class="mb-4">Final Step</h2>
    <div class="progress mb-4">
        <div
            class="progress-bar"
            role="progressbar"
            style="width: 100%;"
            aria-valuenow="100"
            aria-valuemin="0"
            aria-valuemax="100">100%</div>
    </div>
    <form action="page3.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="certificate_of_origin" class="form-label">Certificate of Origin for the Commodity</label>
            <input
                type="file"
                class="form-control"
                id="certificate_of_origin"
                name="certificate_of_origin"
                accept=".jpg,.jpeg,.png,.pdf"
                required="required">
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="mb-3">
            <label for="sellers_commercial_invoice" class="form-label">Seller's Commercial Invoice</label>
            <input
                type="file"
                class="form-control"
                id="sellers_commercial_invoice"
                name="sellers_commercial_invoice"
                accept=".jpg,.jpeg,.png,.pdf"
                required="required">
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="mb-3">
            <label for="ministry_of_finance_approval" class="form-label">Approval from the Ministry of Finance</label>
            <input
                type="file"
                class="form-control"
                id="ministry_of_finance_approval"
                name="ministry_of_finance_approval"
                accept=".jpg,.jpeg,.png,.pdf"
                required="required">
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="mb-3">
            <label for="custom_validation" class="form-label">Custom Validation</label>
            <input
                type="file"
                class="form-control"
                id="custom_validation"
                name="custom_validation"
                accept=".jpg,.jpeg,.png,.pdf"
                required="required">
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="mb-3">
            <label for="npa_mol" class="form-label">Nigerian Port Authority</label>
            <input
                type="file"
                class="form-control"
                id="npa_mol"
                name="npa_mol"
                accept=".jpg,.jpeg,.png,.pdf"
                required="required">
            <span class="smfs-6">File Type: .jpg,.jpeg,.png,.pdf | Max. Size: 1MB</span>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Complete Registration</button>
            <button onclick="window.history.back();" class="btn btn-primary">Back</button>
        </div>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
