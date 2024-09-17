<?php
$update = $noUpdate = '';
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = $_POST['identifier'];
    $newPassword = $_POST['password'];

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Check if the username or email exists in the database
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$identifier, $identifier]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Update the password
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hashedPassword, $user['id']]);
        $update = "Password updated successfully!";
        header("refresh:3;url=login.php");
    } else {
        $noUpdate = "Error: Username or email does not exist.";
    }
}
?>
<?php include 'includes/header.php'; ?>
<div class="col-md-12">
    <div class="row h-100">
        <div
            class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center">
            <h1 class="mb-4 fs-1">Update/Reset Password</h1>
            <form class="p-4 bg-light rounded lf" method="POST">
                Username:
                <input
                    type="text"
                    name="identifier"
                    required="required"
                    class="w-100 mt-1 mb-2 border-0 py-2 rounded"><br>
                Set A New Password:
                <input
                    type="password"
                    name="password"
                    id="password"
                    required="required"
                    class="w-100 mt-1 mb-2 border-0 py-2 rounded"><br>
                    <div 
                        id="password-strength"></div>
                <button type="submit" class="border-0 py-2 px-4 rounded subBtn">Update Password</button>
            </form>
            <p
                class="text-red bg-<?php echo empty($update) ? 'transparent' : 'success'; ?> text-white fs-6 p-1 text-center rounded"><?php echo $update; ?></p>
                <p
                class="text-red bg-<?php echo empty($noUpdate) ? 'transparent' : 'danger'; ?> text-white fs-6 p-1 text-center rounded"><?php echo $noUpdate; ?></p>
        </div>
        <div
            class="col-12 d-md-none d-lg-flex col-lg-6 bg-comp d-flex justify-content-center align-items-center p-0">
            <img src="assets/images/lcfe.png" class="w-25" alt="company logo"/>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>