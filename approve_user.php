<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'includes/db.php';

if (isset($_GET['user']) && isset($_GET['action'])) {
    $username = $_GET['user'];
    $action = $_GET['action']; 

    
    $stmt = $pdo->prepare("SELECT email FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        $email = $user['email'];
        
        
        $approvalStatus = $action === 'approve' ? 'approved' : 'deny';
        $stmt = $pdo->prepare("UPDATE users SET approval = ? WHERE username = ?");
        $stmt->execute([$approvalStatus, $username]);

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
            $mail->Subject = 'Account Approval Status';
            $mail->Body    = "Dear $username,<br/><br/>
                              Your account has been <strong>$approvalStatus</strong>.<br/><br/>
                              " . ($approvalStatus === 'approved' ? "You can now log in to your account." : "Unfortunately, your registration request has been denied.") . "<br/><br/>
                              Best regards,<br/>LCFE";

            $mail->send();
            echo "User $approvalStatus and email notification sent to $email.";
            header("refresh:1;url=dashboard.php");
        } catch (Exception $e) {
            echo "User $approvalStatus, but failed to send email notification.";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
}
?>
