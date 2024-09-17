<?php

$delStat = '';
$reload = isset($_GET['reload']) ? $_GET['reload'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
        
        $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;

        try {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $delStat = 'User deleted successfully';
                
            } else {

                $delStat = 'No user found with that ID.';
                
            }
        } catch (PDOException $e) {
            $delStat = "Error: " . $e->getMessage();
        }

        if (empty($reload)) {
            echo "<script>
                    setTimeout(() => {
                        window.location.href = window.location.href + '?reload=true';
                    });
                  </script>";
        }
    }
}
?>

<div class="container-fluid mt-4">
    <div class="container px-0">
        <div
            class="col-md-12 d-block d-md-flex gap-3 align-items-start dash-container">
            <div
                class="col-12 col-md-6 bg-light shadow-sm p-4 px-2 px-md-4 mb-2 rounded dash-table">
                <h2 class="fs-4 text-secondary">Client List</h2>
                <?php
                    include 'includes/db.php';

                    try {
                        $sql = "SELECT * FROM users WHERE level IN ('aggregator', 'Commodities Brokers', 'Specialized Commodities Dealer', 'Commodities Broker Dealer', 'Commodities Trader')";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();

                        $aggregators = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($aggregators) === 0) {
                           echo '<div style="display: flex; justify-content: center; align-items: center; height: 50px;">No records found!</div>';

                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                ?>
                <div class="table-responsive mt-4">
                    <table class="table smfs-6">
                        <thead style="vertical-align: middle;">
                            <th>Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Class</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">View</th>
                        </thead>
                        <tbody>
                            <?php foreach ($aggregators as $aggregator): ?>
                            <tr style="vertical-align: middle;">
                                <td><?= htmlspecialchars($aggregator['name']) ?></td>
                                <td><?= htmlspecialchars($aggregator['email']) ?></td>
                                <td class="text-capitalize"><?= htmlspecialchars($aggregator['level']) ?></td>
                                <td class="text-capitalize"><?= htmlspecialchars($aggregator['approval']) ?></td>
                                <td>
                                    <form action="profile.php" method="post" class="m-0">
                                        <input
                                            type="hidden"
                                            name="user_id"
                                            value="<?= htmlspecialchars($aggregator['id']) ?>"/>
                                        <button type="submit" name="view_profile" class="bg-primary text-white border-0 rounded-circle p-2"><i class="bi bi-eye-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>

        <div
            class="col-12 col-md-6 bg-light shadow-sm p-4 px-2 px-md-4 mb-2 rounded dash-table">
            <h2 class="fs-4 text-secondary">List of Registered Users</h2>
            <?php
                    include 'includes/db.php';

                    try {
                        $sql = "SELECT * FROM users";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();

                        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($users) === 0) {
                            echo '<div style="display: flex; justify-content: center; align-items: center; height: 50px;">No records found!</div>';
                        
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                ?>
            <div class="table-responsive mt-4">
                <table class="table smfs-6 position-relative">
                    <thead style="vertical-align: middle;">
                        <th>Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Status</th>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr style="vertical-align: middle;">
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                            <td>
                            <a href='https://portal.lcfe.ng/approve_user.php?user=<?php echo $user["username"]; ?>&action=approve' class="text-decoration-none text-white" target="_blank">
                                <button class="bg-primary text-white border-0 rounded-circle p-2 opacity-<?php echo ($user["approval"] == "approved") ? "25" : ""; ?>" <?php echo ($user["approval"] == "approved") ? "disabled" : ""; ?>>
                                <i class="bi bi-check-all"></i></button></a>
                                    <a href='https://portal.lcfe.ng/approve_user.php?user=<?php echo $user["username"]; ?>&action=deny' class="text-decoration-none text-white" target="_blank">
                                <button class="bg-danger text-white border-0 rounded-circle p-2 opacity-<?php echo ($user["approval"] == "deny" || $user["approval"] == "pending") ? "25" : ""; ?>" <?php echo ($user["approval"] == "deny" || $user["approval"] == "pending") ? "disabled" : ""; ?>>
                                <i class="bi bi-x"></i></button></a>

                                <button class="bg-danger rounded-circle border-0 p-2 text-white" id="perform-delete" onclick="showConfirmDelete(<?php echo $user['id']; ?>, '<?php echo $user['name']; ?>')">
                                    <i class="bi bi-trash3-fill"></i> 
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<script>
    function showConfirmDelete(userId, userName) {
        const confirmDelete = document.getElementById('confirm-delete');
        const userIdInput = document.getElementById('user-id-input');
        const userNameDisplay = document.getElementById('user-name-display');
        userIdInput.value = userId; 
        userNameDisplay.textContent = userName;
        confirmDelete.style.display = 'block';
    }

    function cancelDelete() {
        const confirmDelete = document.getElementById('confirm-delete');
        confirmDelete.style.display = 'none';
    }
</script>

<!-- Confirmation form -->
<form method="post" action="dashboard.php" id="confirm-delete" style="display: none; position: absolute; width: 100%; height: 100%; z-index: 1; background: #f8f8f8; padding: 2px; bottom: 0; left: 0; text-align: center; padding-top: 25px; opacity: 0.9">
    <div class="d-flex flex-column justify-content-center align-items-center gap-2" style="min-height: 525px">
        <p>Are you sure you want to delete <strong id="user-name-display"></strong>?</p>
        <input type="hidden" name="user_id" id="user-id-input">
        <div class="d-flex gap-3">
            <button class="bg-primary border-0 text-white fw-bold rounded" type="submit" name="confirm" value="yes">Yes</button>
            <button class="bg-danger border-0 text-white fw-bold rounded" type="button" onclick="cancelDelete()">No</button>
        </div>
    </div>
</form>