<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/var/www/html/vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = getenv('SMTP_HOST') ?: 'smtp.example.com';
    $mail->SMTPAuth = true;
    $mail->Username = getenv('SMTP_USER') ?: 'your@email.com';
    $mail->Password = getenv('SMTP_PASS') ?: 'yourpassword';
    $mail->SMTPSecure = getenv('SMTP_SECURE') ?: 'tls';
    $mail->Port = getenv('SMTP_PORT') ?: 587;

    $mail->setFrom(getenv('MAIL_FROM') ?: 'your@email.com', 'PHPMailer Container');
    $mail->addAddress(getenv('MAIL_TO') ?: 'recipient@email.com');

    $mail->Subject = 'PHPMailer Test from Docker';
    $mail->Body    = 'This email was sent using a dedicated PHPMailer container.';

    $mail->send();
    echo 'Message sent successfully!';
} catch (Exception $e) {
    echo "Error sending email: {$mail->ErrorInfo}";
}
?>
