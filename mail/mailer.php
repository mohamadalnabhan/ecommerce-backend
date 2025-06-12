<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// **Fix the paths**: go up one level, then into PHPMailer/
require __DIR__ . '/../PHPMailer/PHPMailer.php';
require __DIR__ . '/../PHPMailer/smtp.php';
require __DIR__ . '/../PHPMailer/Exception.php';

function sendEmail($to, $subject, $body, $altBody = '') {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;
        $mail->AuthType   = 'PLAIN';
        $mail->Username   = '8f0c0d001@smtp-brevo.com';
        $mail->Password   = '6awjRz0CIAHtNM4V';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('mhamad.nabhan.222@outlook.com', 'Your Name');
        $mail->addAddress($to);
        $mail->addReplyTo('mhamad.nabhan.222@outlook.com', 'Mhamad');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $altBody ?: strip_tags($body);

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("❌ Email failed: " . $mail->ErrorInfo);
        return false;
    }
}
