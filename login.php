<?php
session_start();
include 'includes/db.php';
$update = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to fetch the user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$input, $input]);
    $user = $stmt->fetch();

    // Check if the user exists and the password is correct
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_level'] = $user['level'];
        $_SESSION['user_username'] = $user['username'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['user_approval'] = $user['approval'];

        // Redirect based on user role
        if ($user['level'] == 'admin' || $user['level'] == 'user' && $user['approval'] == 'approved') {
            header("Location: dashboard.php");
        } elseif ($user['level'] == 'aggregator' || $user['level'] == 'Commodities Brokers' || $user['level'] == 'Specialized Commodities Dealer' || $user['level'] == 'Commodities Broker Dealer' || $user['level'] == 'Commodities Trader' && $user['approval'] == 'approved') {
            header("Location: aggregator.php");
        } else {
            $update = "Access denied!";
            echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;"><div style="background: #037537; color: #fff; padding: 15px; border-radius: 5px;">Your account is not yet approved! Check your mail for approval or contact LCFE admin.</div></div>';
            header("refresh:3;url=login.php");
        }
        exit;
    } else {
        $update = "Invalid login credentials!";
    }
}
?>
<?php include 'includes/header.php'; ?>
<div class="col-md-12">
    <div class="row h-100">
        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center">
            <h1 class="mb-4 fs-1">Registration Login</h1>
            <form class="p-4 bg-light rounded lf" method="POST">
                Username or Email:
                <input
                    type="text"
                    name="username"
                    required="required"
                    class="w-100 mt-1 mb-2 border-0 py-2 rounded"><br>
                Password:
                <input
                    type="password"
                    name="password"
                    required="required"
                    class="w-100 mt-1 mb-2 border-0 py-2 rounded"><br>
                <button type="submit" class="border-0 py-2 px-4 rounded subBtn">Login</button>
            </form>
            <div class="d-flex justify-content-between gap-4 lf">
                <span style="font-size: 14px; font-weight: 700" class="text-start">Don't have an account?
                    <a href="register.php" class="text-decoration-none text-success regBtn">Register</a>
                </span>
                <span style="font-size: 14px; font-weight: 700" class="text-end">
                    <a href="reset-password.php" class="text-decoration-none text-danger forgetBtn">Forgot password</a>
                </span>
            </div>
            <p
                class="text-red bg-<?php echo empty($update) ? 'transparent' : 'danger'; ?> text-white fs-6 p-1 text-center rounded">
                <?php echo $update; ?>
            </p>
        </div>
        <div class="col-12 d-md-none d-lg-flex col-lg-6 bg-comp d-flex justify-content-center align-items-center p-0">
            <img src="assets/images/lcfe.png" class="w-25" alt="company logo"/>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
