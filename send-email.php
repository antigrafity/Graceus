<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

// reCAPTCHA configuration
$recaptcha_secret_key = '6LeOZWUsAAAAAMh3cAta3oGbRAlpamD7uDSDuo61'; // Ganti dengan Secret Key dari Google reCAPTCHA

// Email configuration
$to_email = 'info@graseus.com'; // Change this to info@graseus.com in production
$from_email = 'noreply@graseus.com';
$from_name = 'Graseus Contact Form';

// Get POST data
$name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$company = isset($_POST['company']) ? strip_tags(trim($_POST['company'])) : '';
$message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';
$recaptcha_response = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

// Verify reCAPTCHA v2
if (empty($recaptcha_response)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please complete the reCAPTCHA verification.']);
    exit;
}

if (!empty($recaptcha_secret_key) && $recaptcha_secret_key !== '6LeOZWUsAAAAAMh3cAta3oGbRAlpamD7uDSDuo61') {
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_data = array(
        'secret' => $recaptcha_secret_key,
        'response' => $recaptcha_response,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    );
    
    $recaptcha_options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($recaptcha_data)
        )
    );
    
    $recaptcha_context  = stream_context_create($recaptcha_options);
    $recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
    $recaptcha_json = json_decode($recaptcha_result);
    
    // Check reCAPTCHA v2 verification (no score, just success/fail)
    if (!$recaptcha_json->success) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'reCAPTCHA verification failed. Please try again.']);
        exit;
    }
}

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

// Email subject
$subject = 'New Contact Form Submission - Graseus Website';

// Email body
$email_body = "You have received a new message from the Graseus contact form.\n\n";
$email_body .= "Name: $name\n";
$email_body .= "Email: $email\n";
$email_body .= "Company/Organization: " . ($company ? $company : 'Not provided') . "\n\n";
$email_body .= "Message:\n$message\n";

// Email headers
$headers = "From: $from_name <$from_email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email
if (mail($to_email, $subject, $email_body, $headers)) {
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Thank you! Your message has been sent successfully.']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Sorry, there was an error sending your message. Please try again later.']);
}
?>
