# 🚀 Quick Start - Email Contact Form

## Cara Tercepat Setup Email (5 Menit)

### Step 0: Setup Google reCAPTCHA (IMPORTANT! 🛡️)

**Protect form dari spam dan bot attacks:**

1. Daftar di: https://www.google.com/recaptcha/admin/create
2. Pilih **reCAPTCHA v2** → "I'm not a robot" Checkbox, add domain `graseus.com`
3. Copy **Site Key** dan **Secret Key**
4. Ganti di files berikut:
   - `index.html` line ~383: `data-sitekey="YOUR_SITE_KEY_HERE"` (di dalam form)
   - `send-email.php` line 7: `$recaptcha_secret_key = 'YOUR_SECRET_KEY_HERE'`

**📖 Detailed guide: Baca [RECAPTCHA-SETUP.md](RECAPTCHA-SETUP.md)**

**✅ Checkbox "I'm not a robot" akan muncul di form sebelum submit button!**

---

### Step 1: Upload Files ke VPS
Upload semua files ke VPS:
```bash
# Via SCP
scp -r graseus/* user@your-vps-ip:/var/www/html/

# Atau via SFTP menggunakan FileZilla
```

### Step 2: Test Email Configuration
Buka di browser: `http://your-domain.com/test-email.php`

File ini akan otomatis test:
- ✅ PHP mail function available?
- ✅ Sendmail/SMTP configured?
- ✅ File permissions correct?
- ✅ PHPMailer installed?

**Jangan lupa HAPUS file test-email.php setelah testing!**

### Step 3: Pilih Metode Email

#### 🟢 OPTION A: PHP Mail (Paling Mudah)
Pakai file: `send-email.php` (sudah siap pakai!)

**Requirements:**
- PHP harus installed
- Sendmail atau Postfix harus running

**Install Sendmail (Ubuntu/Debian):**
```bash
sudo apt update && sudo apt install sendmail -y
sudo sendmailconfig  # Jawab Y untuk semua
```

**Edit email tujuan:**
```php
// Edit line 7 di send-email.php
$to_email = 'akbarsatrio@outlook.co.id'; // Ganti sesuai kebutuhan
```

✅ **Langsung bisa dipakai!**

---

#### 🟡 OPTION B: PHPMailer + Gmail/Outlook (Recommended for Production)
Pakai file: `send-email-smtp.php`

**Kenapa lebih baik?**
- ✅ Lebih reliable
- ✅ Email tidak masuk spam
- ✅ Support Gmail, Outlook, custom SMTP

**Install PHPMailer:**
```bash
cd /var/www/html/graseus
composer require phpmailer/phpmailer
```

**Setup Gmail:**
1. Enable 2FA di Google Account
2. Generate App Password: https://myaccount.google.com/apppasswords
3. Edit `send-email-smtp.php` line 44-50:
```php
$mail->Host = 'smtp.gmail.com';
$mail->Username = 'your-email@gmail.com';
$mail->Password = 'your-16-digit-app-password';
```

**Setup Outlook:**
Edit `send-email-smtp.php` line 54-59:
```php
$mail->Host = 'smtp-mail.outlook.com';
$mail->Username = 'akbarsatrio@outlook.co.id';
$mail->Password = 'your-outlook-password';
```

**Update JavaScript:**
Edit `js/main.js` line 28, ganti:
```javascript
fetch('send-email.php', {  // Ganti jadi:
fetch('send-email-smtp.php', {
```

✅ **Done!**

---

### Step 4: Test Contact Form
1. Buka website: `http://your-domain.com`
2. Scroll ke Contact Form
3. Isi form dan submit
4. Check email inbox (cek juga spam folder!)

---

## ⚡ Troubleshooting

### Email tidak terkirim?

**Check 1: PHP Error Log**
```bash
sudo tail -f /var/log/apache2/error.log
# atau
sudo tail -f /var/log/nginx/error.log
```

**Check 2: Mail Log**
```bash
sudo tail -f /var/log/mail.log
```

**Check 3: Test Sendmail**
```bash
echo "Test email" | sendmail akbarsatrio@outlook.co.id
```

**Check 4: Firewall**
```bash
# Pastikan port 25/587 terbuka
sudo ufw allow 25/tcp
sudo ufw allow 587/tcp
```

### CORS Error di Browser?
Headers sudah ada di `send-email.php`, tapi kalau masih error:

Edit `.htaccess`, uncomment:
```apache
Header set Access-Control-Allow-Origin "*"
```

### Permission Error?
```bash
sudo chmod 644 send-email.php
sudo chown www-data:www-data send-email.php
```

---

## 📧 Email Configuration Summary

**Files yang penting:**
- `send-email.php` - Basic PHP mail (Option A)
- `send-email-smtp.php` - PHPMailer SMTP (Option B) ⭐
- `test-email.php` - Testing tool (HAPUS setelah test!)
- `js/main.js` - AJAX handler (sudah configured)
- `index.html` - Form with id="contactForm" (sudah ready)
- `.htaccess` - Security headers

**Email Destination:**
Default: `akbarsatrio@outlook.co.id`
Production: `info@graseus.com`

---

## 🎯 Recommendation

Untuk VPS production, gunakan **Option B (PHPMailer + Outlook)**:
- Email sudah ada: akbarsatrio@outlook.co.id ✅
- Tinggal masukkan password
- Lebih reliable
- Tidak masuk spam

**Command lengkap:**
```bash
# 1. Install PHPMailer
composer require phpmailer/phpmailer

# 2. Edit send-email-smtp.php
nano send-email-smtp.php
# Ganti YOUR_OUTLOOK_PASSWORD di line 58

# 3. Update main.js
nano js/main.js
# Line 28: ganti 'send-email.php' jadi 'send-email-smtp.php'

# 4. Test
# Buka browser, isi form, submit!
```

**That's it!** 🚀

---

## 💡 Pro Tips

1. **Setelah testing selesai, HAPUS `test-email.php`** untuk security
2. **Enable HTTPS** dengan Let's Encrypt (gratis):
   ```bash
   sudo apt install certbot python3-certbot-apache
   sudo certbot --apache -d graseus.com
   ```
3. **Monitor email logs** untuk debugging
4. **Backup email credentials** securely

---

Need help? Email gw di akbarsatrio@outlook.co.id 😎
