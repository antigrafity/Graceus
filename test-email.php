<?php
/**
 * Test Email Configuration
 * Akses file ini via browser untuk test email: http://yourdomain.com/test-email.php
 * HAPUS FILE INI setelah testing selesai untuk security!
 */

// Email tujuan untuk testing
$test_email = 'info@graseus.com';

echo "<h1>Email Configuration Test</h1>";
echo "<hr>";

// Test 1: Check if mail function exists
echo "<h2>Test 1: PHP Mail Function</h2>";
if (function_exists('mail')) {
    echo "✅ PHP mail() function is available<br>";
    
    // Try to send test email
    $subject = "Test Email from Graseus - " . date('Y-m-d H:i:s');
    $message = "This is a test email from your Graseus contact form setup.\n\nIf you receive this, PHP mail() is working correctly!";
    $headers = "From: noreply@graseus.com\r\n";
    
    if (mail($test_email, $subject, $message, $headers)) {
        echo "✅ Test email sent successfully to $test_email<br>";
        echo "Check your inbox (and spam folder)!<br>";
    } else {
        echo "❌ Failed to send test email. Check your mail server configuration.<br>";
    }
} else {
    echo "❌ PHP mail() function is NOT available<br>";
}

echo "<br><hr>";

// Test 2: Check PHP configuration
echo "<h2>Test 2: PHP Configuration</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Sendmail Path: " . ini_get('sendmail_path') . "<br>";
echo "SMTP Server: " . ini_get('SMTP') . "<br>";
echo "SMTP Port: " . ini_get('smtp_port') . "<br>";

echo "<br><hr>";

// Test 3: Check if PHPMailer is installed
echo "<h2>Test 3: PHPMailer</h2>";
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
    
    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        echo "✅ PHPMailer is installed<br>";
        echo "You can use send-email-smtp.php for more reliable email sending.<br>";
    } else {
        echo "❌ PHPMailer class not found<br>";
    }
} else {
    echo "⚠️ PHPMailer is NOT installed<br>";
    echo "Install it with: <code>composer require phpmailer/phpmailer</code><br>";
}

echo "<br><hr>";

// Test 4: Check file permissions
echo "<h2>Test 4: File Permissions</h2>";
$files = ['send-email.php', 'send-email-smtp.php'];
foreach ($files as $file) {
    if (file_exists($file)) {
        $perms = fileperms($file);
        echo "$file: " . substr(sprintf('%o', $perms), -4) . " ";
        echo (is_readable($file) ? "✅ Readable" : "❌ Not Readable") . " ";
        echo (is_writable($file) ? "⚠️ Writable (should be read-only for security)" : "✅ Read-only") . "<br>";
    } else {
        echo "❌ $file not found<br>";
    }
}

echo "<br><hr>";

// Test 5: Server Information
echo "<h2>Test 5: Server Information</h2>";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Current User: " . get_current_user() . "<br>";

echo "<br><hr>";
echo "<p style='color: red; font-weight: bold;'>⚠️ PENTING: Hapus file test-email.php ini setelah testing selesai untuk keamanan!</p>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background: #f5f5f5;
}
h1 {
    color: #004aad;
}
code {
    background: #eee;
    padding: 2px 6px;
    border-radius: 3px;
}
</style>
