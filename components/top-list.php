<div class="container-fluid bg-comp-2 py-4">
    <div class="container">
        <div class="d-flex flex-column gap-2">
            <div class="d-flex flex-row justify-content-between">
                <div class="col-sm-6"> 
                    <a href="dashboard.php" class="text-secondary">
                        <i class="bi bi-house text-secondary"></i>
                    </a>
                    <span class="text-secondary">
                        | Dashboard</span>
                </div>
            </div>
            <div class="col-md-12 d-flex flex-row gap-1 my-4 flex-wrap flex-md-nowrap justify-content-evenly">
                <div class="d-flex bg-light shadow rounded p-2 px-4 align-items-center col-5 col-md-3 justify-content-between">
                    <div class="d-flex flex-column">
                        <span class="text-secondary" style="font-size: 0.8rem">Registered Users</span>
                        <span class="text-dark fs-2 fw-bold">
                            <?php
                                include 'includes/db.php';
                                try {
                                    $sql = "SELECT * FROM users";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    echo count($users);
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                            ?>
                        </span>
                    </div>
                    <i class="bi bi-check-all border border-secondary-subtle rounded-circle fs-6 p-2 d-none d-sm-block"></i>
                </div>

                <!-- 2 -->
                <div class="d-flex bg-light shadow rounded p-2 px-4 align-items-center col-5 col-md-3 justify-content-between">
                    <div class="d-flex flex-column">
                        <span class="text-secondary" style="font-size: 0.8rem">Registered Clients</span>
                        <span class="text-dark fs-2 fw-bold">
                        <?php
                            include 'includes/db.php';
                            try {
                                $sql = "SELECT * FROM users WHERE level IN ('aggregator', 'Commodities Brokers', 'Specialized Commodities Dealer', 'Commodities Broker Dealer', 'Commodities Trader')";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                $aggregators = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                echo count($aggregators);
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                        ?>

                        </span>
                    </div>
                    <i class="bi bi-exclamation border border-secondary-subtle rounded-circle fs-6 p-2 d-none d-sm-block"></i>
                </div>

                <!-- 3 -->
                <div class="d-flex bg-light shadow rounded p-2 px-4 align-items-center col-5 col-md-3 justify-content-between">
                    <div class="d-flex flex-column">
                        <span class="text-secondary" style="font-size: 0.8rem">Approved Clients</span>
                        <span class="text-dark fs-2 fw-bold">
                        <?php
                                include 'includes/db.php';
                                try {
                                    $sql = "SELECT * FROM users WHERE level IN ('aggregator', 'Commodities Brokers', 'Specialized Commodities Dealer', 'Commodities Broker Dealer', 'Commodities Trader') AND approval = 'approved'";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    $approvedAggregators = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    echo count($approvedAggregators);
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                            ?>
                        </span>
                    </div>
                    <i class="bi bi-arrow-90deg-up border border-secondary-subtle rounded-circle fs-6 p-2 d-none d-sm-block"></i>
                </div>

                <!-- 4 -->
                <div class="d-flex bg-light shadow rounded p-2 px-4 align-items-center col-5 col-md-3 justify-content-between">
                    <div class="d-flex flex-column">
                        <span class="text-secondary" style="font-size: 0.8rem">Pending or Denied Clients</span>
                        <span class="text-dark fs-2 fw-bold">
                        <?php
                                include 'includes/db.php';
                                try {
                                    $sql = "SELECT * FROM users WHERE level IN (:level1, :level2, :level3, :level4, :level5) AND (approval = :pending OR approval = :deny)";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute([
                                        ':level1' => 'aggregator',
                                        ':level2' => 'Commodities Brokers',
                                        ':level3' => 'Specialized Commodities Dealer',
                                        ':level4' => 'Commodities Broker Dealer',
                                        ':level5' => 'Commodities Trader',
                                        ':pending' => 'pending',
                                        ':deny' => 'deny'
                                    ]);
                                    $pendingOrDeniedAggregators = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    echo count($pendingOrDeniedAggregators);
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }                                
                            ?>
                        </span>
                    </div>
                    <i class="bi bi-arrow-90deg-down border border-secondary-subtle rounded-circle fs-6 p-2 d-none d-sm-block"></i>
                </div>
            </div>
        </div>
    </div>
</div>
