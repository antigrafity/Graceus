# Setup Email Contact Form di VPS

## Opsi 1: Menggunakan PHP Mail (Paling Mudah)

### Prerequisites
1. PHP harus terinstall di VPS
2. Sendmail atau Postfix harus terconfig di VPS

### Setup Sendmail/Postfix di VPS

#### Untuk Ubuntu/Debian:
```bash
# Install sendmail
sudo apt update
sudo apt install sendmail sendmail-cf

# Atau install postfix (recommended)
sudo apt install postfix
# Pilih "Internet Site" saat instalasi
# Masukkan domain: graseus.com
```

#### Konfigurasi Postfix:
```bash
sudo nano /etc/postfix/main.cf
```

Edit:
```
myhostname = graseus.com
mydestination = graseus.com, localhost
relayhost = [smtp.gmail.com]:587  # Atau SMTP server lain
smtp_sasl_auth_enable = yes
smtp_sasl_password_maps = hash:/etc/postfix/sasl_passwd
smtp_sasl_security_options = noanonymous
smtp_tls_security_level = encrypt
```

Buat file password SMTP:
```bash
sudo nano /etc/postfix/sasl_passwd
```

Isi dengan:
```
[smtp.gmail.com]:587 your-email@gmail.com:your-app-password
```

Hash dan restart:
```bash
sudo postmap /etc/postfix/sasl_passwd
sudo chmod 600 /etc/postfix/sasl_passwd /etc/postfix/sasl_passwd.db
sudo systemctl restart postfix
```

### Update send-email.php
File sudah dibuat di `/Volumes/Works/SPASI/graseus/send-email.php`

Ganti email tujuan di line 7:
```php
$to_email = 'info@graseus.com'; // Atau akbarsatrio@outlook.co.id
```

---

## Opsi 2: Menggunakan PHPMailer (Lebih Reliable)

PHPMailer lebih baik untuk production karena:
- Support SMTP authentication
- Better error handling
- Works with Gmail, Outlook, dll

### Install PHPMailer via Composer:
```bash
cd /path/to/graseus
composer require phpmailer/phpmailer
```

### Buat file send-email-smtp.php:
```php
<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$company = $_POST['company'] ?? '';
$message = $_POST['message'] ?? '';

if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Please fill all required fields']);
    exit;
}

$mail = new PHPMailer(true);

try {
    // SMTP Settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Atau smtp-mail.outlook.com untuk Outlook
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@gmail.com'; // Email pengirim
    $mail->Password = 'your-app-password'; // App password (bukan password biasa)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('noreply@graseus.com', 'Graseus Contact Form');
    $mail->addAddress('akbarsatrio@outlook.co.id'); // Email tujuan
    $mail->addReplyTo($email, $name);

    // Content
    $mail->isHTML(false);
    $mail->Subject = 'New Contact Form Submission - Graseus';
    $mail->Body = "Name: $name\nEmail: $email\nCompany: $company\n\nMessage:\n$message";

    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Message sent successfully!']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $mail->ErrorInfo]);
}
?>
```

### Untuk Gmail:
1. Enable 2-Factor Authentication di akun Gmail
2. Generate App Password: https://myaccount.google.com/apppasswords
3. Gunakan App Password di script

### Untuk Outlook:
```php
$mail->Host = 'smtp-mail.outlook.com';
$mail->Username = 'akbarsatrio@outlook.co.id';
$mail->Password = 'your-outlook-password';
$mail->Port = 587;
```

---

## Opsi 3: Menggunakan SMTP Server Sendiri

Jika VPS punya SMTP server sendiri:
```php
$mail->Host = 'localhost'; // atau 'mail.graseus.com'
$mail->SMTPAuth = false; // Jika server lokal
$mail->Port = 25;
```

---

## Testing

### Test dari command line:
```bash
# Test PHP mail function
php -r "mail('akbarsatrio@outlook.co.id', 'Test', 'This is a test email');"

# Test sendmail
echo "Test email" | sendmail akbarsatrio@outlook.co.id
```

### Test form di browser:
1. Upload semua files ke VPS
2. Buka website
3. Scroll ke Contact Form
4. Isi dan submit
5. Cek email & console browser untuk error

---

## Troubleshooting

### Email tidak terkirim:
1. Cek PHP error log: `sudo tail -f /var/log/apache2/error.log` atau `/var/log/nginx/error.log`
2. Cek mail log: `sudo tail -f /var/log/mail.log`
3. Pastikan port 25/587 tidak di-block oleh firewall
4. Test koneksi SMTP: `telnet smtp.gmail.com 587`

### Permission denied:
```bash
sudo chmod 755 send-email.php
sudo chown www-data:www-data send-email.php
```

### CORS error di browser:
Pastikan headers sudah ada di PHP:
```php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
```

---

## Recommendation

Untuk production use, saya recommend **Opsi 2 (PHPMailer dengan Gmail/Outlook SMTP)** karena:
- Lebih reliable
- Tidak perlu setup complicated mail server
- Email pasti terkirim
- Tidak masuk spam

Files yang sudah dibuat:
- `send-email.php` - Basic PHP mail (Opsi 1)
- `js/main.js` - Sudah ada AJAX handler
- `index.html` - Form sudah di-update dengan id="contactForm"

Tinggal pilih mau pakai opsi yang mana! 🚀
