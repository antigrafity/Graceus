<?php
/**
 * PHPMailer Version - More Reliable
 * Install via: composer require phpmailer/phpmailer
 * 
 * Uncomment this file jika sudah install PHPMailer
 * Dan ganti send-email.php jadi send-email-smtp.php di js/main.js
 */

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

// Get form data
$name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$company = isset($_POST['company']) ? strip_tags(trim($_POST['company'])) : '';
$message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

// Validation
if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

$mail = new PHPMailer(true);

try {
    // SMTP Configuration
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    
    // === GMAIL CONFIGURATION ===
    // Uncomment untuk pakai Gmail
    /*
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@gmail.com'; // Ganti dengan email Gmail
    $mail->Password = 'your-app-password'; // App Password dari Google (bukan password biasa)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    */
    
    // === OUTLOOK CONFIGURATION ===
    // Uncomment untuk pakai Outlook/Hotmail
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'akbarsatrio@outlook.co.id'; // Email Outlook
    $mail->Password = 'YOUR_OUTLOOK_PASSWORD'; // Password Outlook (GANTI INI!)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    
    // === CUSTOM SMTP SERVER ===
    // Uncomment kalau pakai SMTP server sendiri
    /*
    $mail->Host = 'mail.graseus.com'; // atau 'localhost'
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@graseus.com';
    $mail->Password = 'your-smtp-password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    */
    
    // Recipients
    $mail->setFrom('noreply@graseus.com', 'Graseus Contact Form');
    $mail->addAddress('akbarsatrio@outlook.co.id'); // Email tujuan
    // $mail->addAddress('info@graseus.com'); // Bisa tambah multiple recipients
    $mail->addReplyTo($email, $name);
    
    // Content
    $mail->isHTML(false);
    $mail->Subject = 'New Contact Form Submission - Graseus Website';
    
    $email_body = "You have received a new message from the Graseus contact form.\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Company/Organization: " . ($company ? $company : 'Not provided') . "\n\n";
    $email_body .= "Message:\n$message\n";
    $email_body .= "\n---\n";
    $email_body .= "Sent from: graseus.com contact form\n";
    $email_body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $email_body .= "Timestamp: " . date('Y-m-d H:i:s') . "\n";
    
    $mail->Body = $email_body;
    
    // Send email
    $mail->send();
    
    http_response_code(200);
    echo json_encode([
        'success' => true, 
        'message' => 'Thank you! Your message has been sent successfully. We will get back to you soon.'
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Sorry, there was an error sending your message. Please try again later.',
        'error' => $mail->ErrorInfo // Hapus di production untuk security
    ]);
}
?>
