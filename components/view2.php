<?php
    include 'includes/db.php';

    try {
        $sql = "SELECT * FROM aggregator_details WHERE user_id = $user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $aggregators = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($aggregators) === 0) {
            echo '<div style="display: flex; justify-content: center; align-items: center; height: 50px;">No records found!</div>
                    <br/><div class="container text-end"><a href="dashboard.php" class="smfs-6 text-uppercase text-secondary text-decoration-none"><i class="bi bi-arrow-90deg-left"></i> back</a></div>   
                ';
            
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>
<div class="container mt-5 agr">
        <?php foreach ($aggregators as $aggregator): ?>
        <div class="col-md-12 rounded p-4 my-4 text-center profile-display">
            <div class="d-flex justify-content-between align-items-center" style="height: 80px;">
                <h2 class="fs-5 text-uppercase text-secondary"><?= htmlspecialchars($aggregator['organization_name']) ?> Details</h2>
                <a href="dashboard.php" class="smfs-6 text-uppercase text-secondary text-decoration-none"><i class="bi bi-arrow-90deg-left"></i> back</a>
            </div>
                <div class="py-3 d-md-flex align-items-center pdc">
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">organization name</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['organization_name']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">years in operation</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['years_in_operation']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">rc number</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['rc_number']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">certificate of incorporation</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['certificate_of_incorporation']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">memorandum-articles of association</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['memorandum_articles_of_association']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">status report</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['status_report']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
            </div>
            <div class="py-3 d-md-flex align-items-center pdc">
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">nerc certificate</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['nerc_certificate']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">contact person nin bvn 1</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['contact_person_nin_bvn_1']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">contact person nin bvn 2</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['contact_person_nin_bvn_2']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">financial status</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['financial_status']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">tax certificate</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['tax_certificate']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">tax id</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['tax_id']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
            </div>
            <div class="py-3 d-md-flex align-items-center pdc">
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">authorized share capital</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['authorized_share_capital']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">size</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['size']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">location</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['location']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">type</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['type']) ?></span>
                </div>
                <div class="col-md-4 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">registered office address</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['registered_office_address']) ?></span>
                </div>
            </div>
            <div class="py-3 d-md-flex align-items-center pdc">
                <div class="col-md-4 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">Email</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['email']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">phone number</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['phone_number']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">commodity to aggregate</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['commodity_to_aggregate']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">quantity of commodity</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['quantity_of_commodity']) ?></span>
                </div>
                
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">product type</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['product_type']) ?></span>
                </div>
            </div>
            <div class="py-3 d-md-flex align-items-center pdc">
                <div class="col-md-12 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">export or import</span>
                    <span class="smfs-5 text-comp"><?= htmlspecialchars($aggregator['export_or_import']) ?></span>
                </div>
            </div>
            <div class="py-3 d-md-flex align-items-center pdc">
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">HS code</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['hs_code']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">qq report</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['qq_report']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">bill of lading</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['bill_of_lading']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">eta</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['eta']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">pod</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['pod']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">capital importation license</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['capital_importation_license']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
            </div>
            <div class="py-3 d-md-flex align-items-center pdc">
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">bank account number</span>
                    <span class="fs-6"><?= htmlspecialchars($aggregator['bank_account_number']) ?></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">certificate of origin</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['certificate_of_origin']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">sellers commercial invoice</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['sellers_commercial_invoice']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">ministry of finance approval</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['ministry_of_finance_approval']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">custom validation</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['custom_validation']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
                <div class="col-md-2 col-12 float-start d-flex flex-column gap-2" style="height: 80px;">
                    <span class="smfs-6 text-uppercase text-secondary" style="height: 30px;">npa mol</span>
                    <span class="fs-6"><a href="<?= htmlspecialchars($aggregator['npa_mol']) ?>" class="text-decoration-none" download><i class="bi bi-download"></i> Download</a></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>