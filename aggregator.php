<?php
session_start();

if (!isset($_SESSION['user_id']) || 
    ($_SESSION['user_approval'] !== 'approved') ||
    !in_array($_SESSION['user_level'], ['aggregator', 'Commodities Brokers', 'Specialized Commodities Dealer', 'Commodities Broker Dealer', 'Commodities Trader'])) {
    header("Location: login.php");
    exit;
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'components/navigation.php'; ?>
<div class="container-fluid d-flex flex-column justify-content-center align-items-center c-hero">
    <h1 class="text-capitalize text-white text-center">
        <?php
                    include 'includes/db.php';

                    try {
                        $sql = 'SELECT * FROM users WHERE id = ' . $_SESSION['user_id'];
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();

                        $aggregators = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo $aggregators['level'];
                        
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                ?>'s Page
    </h1>
</div>
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
<div class="container py-4">
    <div class="d-md-flex gap-2 col-md-12 py-4">
        <div class="news d-flex flex-column col-md-7 mb-3">
            <h5 class="smfs-6 text-uppercase text-comp mb-2">Important updates for <?= $aggregators['level'];?></h5>
            <div class="w-100 rounded" style="height: 248px">
                <img src="assets/images/updates.jpg" alt="Image from article" class="w-100 rounded h-100" />
            </div>
            <h5 class="text-uppercase text-comp fw-bold mt-4">Check the table before you start profile registration!</h5>
            <div class="table-responsive rounded p-2">
                <table class="table table-striped table-success table-bordered">
                    <thead style="vertical-align: middle">
                        <th scope="col">SN</th>
                        <th scope="col">Item Description</th>
                        <th scope="col">Ecowas CET HS Code</th>
                        <th scope="col">Previous Duty Rate + Levy</th>
                        <th scope="col">New Duty Rate</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">1</td>
                            <td>Husked Brown Rice</td>
                            <td>1006.20.00.00</td>
                            <td>30%</td>
                            <td>0%</td>
                        </tr>
                        <tr>
                            <td scope="row">2</td>
                            <td>Grain Sorghum - Other</td>
                            <td>1007.90.00.00</td>
                            <td>5%</td>
                            <td>0%</td>
                        </tr>
                        <tr>
                            <td scope="row">3</td>
                            <td>Millet - Other</td>
                            <td>1008.29.00.00</td>
                            <td>5%</td>
                            <td>0%</td>
                        </tr>
                        <tr>
                            <td scope="row">4</td>
                            <td>Maize - Other</td>
                            <td>1005.90.00.00</td>
                            <td>5%</td>
                            <td>0%</td>
                        </tr>
                        <tr>
                            <td scope="row">5</td>
                            <td>Wheat - Other</td>
                            <td>1001.19.00.00</td>
                            <td>20%</td>
                            <td>0%</td>
                        </tr>
                        <tr>
                            <td scope="row">6</td>
                            <td>Beans</td>
                            <td>0713.31.90.00</td>
                            <td>20%</td>
                            <td>0%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="exchange-short col-md-5 mt-md-3 mb-3">
            <?php include 'components/exchange-v1.php'; ?>
        </div>
    </div>
    <div
        class="d-md-flex gap-2 justify-content-center align-items-center col-md-12 mt-4">
        <div class="p-4 rounded shadow bg-light d-flex flex-column gap-2 my-4 col-md-4 justify-content-center align-items-center" style="height: 220px">
            <h3 class="fs-6 fw-bold text-center">Company Profile</h3>
            <div class="d-flex gap-2">
                <span class="smfs-6 text-secondary text-uppercase">Status:</span>
                <span class="smfs-6 text-secondary text-uppercase">
                    <?php
                        include 'includes/db.php';

                        try {
                            $sql = "SELECT * FROM aggregator_details WHERE user_id = :user_id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
                            $stmt->execute();
                            
                            $aggregators = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                            if (count($aggregators) === 0) {
                                echo "Not Created";
                            } else {
                                echo "Created";
                            }
                        
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    ?>
                </span>
            </div>
            <a href="page1.php" class="text-comp fs-6 text-decoration-none">
                Create Profile
                <i class="bi bi-pencil-square"></i>
            </a>
        </div>
        <div class="p-4 rounded shadow bg-light d-flex flex-column gap-2 my-4 col-md-4 justify-content-center align-items-center" style="height: 220px">
            <h3 class="fs-6 fw-bold text-center">Register With A Dealing Member Firm</h3>
            <div class="d-flex gap-2">
                <span class="smfs-6 text-secondary text-uppercase">Status:</span>
                <span class="smfs-6 text-secondary text-uppercase">Not registered</span>
            </div>
            <a href="dealing.php" class="text-comp fs-6 text-decoration-none">
                Register Member
                <i class="bi bi-pencil-square"></i>
            </a>
        </div>
        <div class="p-4 rounded shadow bg-light d-flex flex-column gap-2 my-4 col-md-4 justify-content-center align-items-center" style="height: 220px">
            <h3 class="fs-6 fw-bold text-center">Contact Admin</h3>
            <div class="d-flex gap-2">
                <span class="smfs-6 text-secondary text-uppercase">Need:</span>
                <span class="smfs-6 text-secondary text-uppercase">any assistance</span>
            </div>
            <a href="#" class="text-comp fs-6 text-decoration-none">
                <i class="bi bi-phone-square"></i> +234-9150009000
            </a>
            <a href="#" class="text-comp fs-6 text-decoration-none">
                <i class="bi bi-phone-square"></i> Email: info@lcfe.ng // portal@lcfe.ng
            </a>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>