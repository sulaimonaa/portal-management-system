<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$update = $errUpdate = '';
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        
        $errUpdate = "Error: Username or email already exists.";
    } else {
        
        $generatedPassword = bin2hex(random_bytes(4)); 
        $hashedPassword = password_hash($generatedPassword, PASSWORD_BCRYPT);

        
        $stmt = $pdo->prepare("INSERT INTO users (name, phone, username, email, password, level, approval) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
        $stmt->execute([$name, $phone, $username, $email, $hashedPassword, $level]);

        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/OAuth.php';
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'mail.lcfe.ng';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'portal@lcfe.ng';
            $mail->Password   = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('portal@lcfe.ng', 'LCFE Portal');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Registration Details';
            $mail->Body    = "Dear $username,<br/><br/>Thank you for registering.<br/><br/>
                              Your login details are as follows:<br/>
                              Username: $username<br/>
                              Password: $generatedPassword<br/><br/>
                              Please note that your account creation is pending approval.<br/>
                              You will receive an email once your account has been reviewed.<br/><br/>
                              Best regards,<br/>LCFE";

            $mail->send();
            $update = "Registration successful! Details sent to $email.";
        } catch (Exception $e) {
            $update = "Registration successful, but failed to send email to the user. Error: {$mail->ErrorInfo}";
            
        }

        
        try {
            $mail->clearAddresses(); 
            $mail->addAddress('portal@lcfe.ng'); 

            $mail->isHTML(true);
            $mail->Subject = 'New User Registration Approval Needed';
            $mail->Body    = "Dear Admin,<br/><br/>A new user has registered and needs approval.<br/><br/>
                              Name: $name<br/>
                              Phone: $phone<br/>
                              Username: $username<br/>
                              Email: $email<br/>
                              Level: $level<br/><br/>
                              <a href='https://portal.lcfe.ng/approve_user.php?user=$username&action=approve'>Click here to approve</a> or <a href='https://portal.lcfe.ng/approve_user.php?user=$username&action=deny'>Click here to deny</a> the registration.<br/><br/>
                              Best regards,<br/>LCFE";

            $mail->send();
            $update = "Registration successful! Admin will review your registration shortly.";
        } catch (Exception $e) {
            $update = "Registration successful, but failed to notify admin. Error: {$mail->ErrorInfo}";
        }

        header("refresh:4;url=login.php");
    }
}
?>

<?php include 'includes/header.php'; ?>
<div class="col-md-12">
    <div class="row h-100">
        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center">
            <h1 class="mb-4 fs-1">Register User</h1>
            <form class="p-4 bg-light rounded lf" method="POST">
                Name:
                <input type="text" name="name" required="required" class="w-100 mt-1 mb-2 border-0 py-2 rounded"><br>
                Phone:
                <input type="tel" name="phone" pattern="[0-9]*" maxlength="11" required="required" placeholder="08012345678" class="w-100 mt-1 mb-2 border-0 py-2 rounded" placeholder="Enter your phone number"><br>
                Username:
                <input type="text" name="username" required="required" class="w-100 mt-1 mb-2 border-0 py-2 rounded"><br>
                Email:
                <input type="email" name="email" required="required" class="w-100 mt-1 mb-2 border-0 py-2 rounded"><br>
                Level:
                <select name="level" class="mb-2 border-0 p-1">
                    <option value="aggregator">Aggregator</option>
                    <option value="Commodities Brokers">Commodities Brokers</option>
                    <option value="Specialized Commodities Dealer">Specialized Commodities Dealer</option>
                    <option value="Commodities Broker Dealer">Commodities Broker Dealer</option>
                    <option value="Commodities Trader">Commodities Trader</option>
                </select><br>
                <button type="submit" class="border-0 py-2 px-4 rounded subBtn">Register</button>
                <a href="login.php" class="smfs-5 text-comp"><span class="smfs-5 text-comp">Go back to Login<i class="bi bi-door-open-fill"></i></span></a>
            </form>
            <p class="text-red bg-<?php echo empty($update) ? 'transparent' : 'success'; ?> text-white fs-6 p-1 text-center rounded"><?php echo $update; ?></p>
            <p class="text-red bg-<?php echo empty($errUpdate) ? 'transparent' : 'danger'; ?> text-white fs-6 p-1 text-center rounded"><?php echo $errUpdate; ?></p>
        </div>
        <div class="col-12 d-md-none d-lg-flex col-lg-6 bg-comp d-flex justify-content-center align-items-center p-0">
            <img src="assets/images/lcfe.png" class="w-25" alt="company logo"/>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
