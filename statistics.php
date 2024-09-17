<?php session_start() ?>
<?php include 'includes/header.php'; ?>
<?php include 'components/navigation.php'; ?>
<div class="container-fluid d-flex flex-column justify-content-center align-items-center s-hero">
    <h1 class="text-capitalize text-white text-center">Statistics</h1>
</div>
<div class="container-fluid py-2">
    <div class="container text-end d-<?php echo (isset($_SESSION['user_username'])) ? "block":"none" ?> my-2">
        <a
            href="<?php
                        echo (($_SESSION['user_approval'] == 'approved') &&
    in_array($_SESSION['user_level'], ['aggregator', 'Commodities Brokers', 'Specialized Commodities Dealer', 'Commodities Broker Dealer', 'Commodities Trader'])) ? "aggregator.php":"dashboard.php" ?>"
            class="smfs-5 text-secondary text-decoration-none"><i class="bi bi-house-check-fill"></i> Return to dashboard</a>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link active"
                    id="home-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#home-tab-pane"
                    type="button"
                    role="tab"
                    aria-controls="home-tab-pane"
                    aria-selected="true">Daily Crude Oil Price</button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link"
                    id="profile-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#profile-tab-pane"
                    type="button"
                    role="tab"
                    aria-controls="profile-tab-pane"
                    aria-selected="false">Financial Data</button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link"
                    id="contact-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#contact-tab-pane"
                    type="button"
                    role="tab"
                    aria-controls="contact-tab-pane"
                    aria-selected="false">Daily Exchange Rates</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div
                class="tab-pane fade show active mt-4"
                id="home-tab-pane"
                role="tabpanel"
                aria-labelledby="home-tab"
                tabindex="0">
                <h5 class="fs-5">Crude Oil Price (US$/Barrel), Production (mbd) and Export (mbd)</h5>
                <?php
            include 'includes/db.php';

            try {
                $sql = "SELECT * FROM crude_oil";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $fd = $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
        <div class="table-responsive mt-4">
        <table id="example" class="table table-striped table-bordered datatable" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Price (USD/Barrel)</th>
            </tr>
        </thead>
            <tbody class="col-md-12">
                <?php foreach ($fd as $fdd): ?>
                    <tr style="vertical-align: middle">
                    <td class="col-md-2 my-2 py-2"><?= htmlspecialchars($fdd['date-added']) ?></td>
                        <td class="col-md-2 my-2 py-2 text-uppercase"><?= htmlspecialchars($fdd['asset-name']) ?></td>
                        <td class="col-md-2 my-2 py-2"><?= htmlspecialchars($fdd['price']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
            </div>
            <div
                class="tab-pane fade mt-4"
                id="profile-tab-pane"
                role="tabpanel"
                aria-labelledby="profile-tab"
                tabindex="0">
                <?php
            include 'includes/db.php';

            try {
                $sql = "SELECT * FROM financial_data";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $fd = $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
        <div class="table-responsive mt-4">
        <table id="example1" class="table table-striped table-bordered datatable" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Amount in Millions (NGN)</th>
            </tr>
        </thead>
            <tbody class="col-md-12">
                <?php foreach ($fd as $fdd): ?>
                    <tr style="vertical-align: middle">
                    <td class="col-md-2 my-2 py-2"><?= htmlspecialchars($fdd['date-added']) ?></td>
                        <td class="col-md-2 my-2 py-2 text-uppercase"><?= htmlspecialchars($fdd['asset-name']) ?></td>
                        <td class="col-md-2 my-2 py-2"><?= htmlspecialchars($fdd['price']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
            </div>
            <div
                class="tab-pane fade mt-4"
                id="contact-tab-pane"
                role="tabpanel"
                aria-labelledby="contact-tab"
                tabindex="0">
                <?php
            include 'includes/db.php';

            try {
                $sql = "SELECT * FROM exchange_rates";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $exchange = $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
        <div class="table-responsive mt-4">
        <table id="example2" class="table table-striped table-bordered datatable" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Currency</th>
                <th>Buying</th>
                <th>Central</th>
                <th>Selling</th>
                <th class="text-center">Strength</th>
            </tr>
        </thead>
            <tbody class="col-md-12">
                <?php foreach ($exchange as $exch): ?>
                    <tr style="vertical-align: middle">
                    <td class="col-md-2 my-2 py-2"><?= htmlspecialchars($exch['date-added']) ?></td>
                        <td class="col-md-2 my-2 py-2 text-uppercase"><?= htmlspecialchars($exch['currency']) ?></td>
                        <td class="col-md-2 my-2 py-2"><?= htmlspecialchars($exch['buying']) ?></td>
                        <td class="col-md-2 my-2 py-2"><?= htmlspecialchars($exch['central']) ?></td>
                        <td class="col-md-2 my-2 py-2"><?= htmlspecialchars($exch['selling']) ?></td>
                        <td class="col-md-2 my-2 py-2 text-center">
                            <span class="d-<?= ($exch['pl']=='strong') ? 'block':'none'; ?> text-primary"><i class="bi bi-caret-up-fill"></i></span>
                            <span class="d-<?= ($exch['pl']=='weak') ? 'block':'none'; ?> text-danger" ><i class="bi bi-caret-down-fill"></i></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
            </div>
        </div>
</div>
</div>
<?php include 'includes/footer.php'; ?>