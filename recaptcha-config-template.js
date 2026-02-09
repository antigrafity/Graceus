/**
 * ⚙️ reCAPTCHA v2 Configuration Template
 * 
 * Cara Setup:
 * 1. Daftar di https://www.google.com/recaptcha/admin/create
 * 2. Pilih reCAPTCHA v2 → "I'm not a robot" Checkbox
 * 3. Copy Site Key dan Secret Key
 * 4. Ganti placeholder di files berikut:
 */

// ========================================
// FRONTEND CONFIGURATION
// ========================================

/**
 * File: index.html (line 32)
 * 
 * Script tag sudah benar, tidak perlu diubah:
 */
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

/**
 * File: index.html (line ~383, di dalam form sebelum submit button)
 * 
 * Ganti YOUR_SITE_KEY_HERE dengan Site Key dari Google:
 */
<div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY_HERE" data-theme="dark"></div>


// ========================================
// BACKEND CONFIGURATION
// ========================================

/**
 * File: send-email.php (line 7)
 * 
 * Ganti YOUR_SECRET_KEY_HERE dengan Secret Key dari Google:
 */
$recaptcha_secret_key = 'YOUR_SECRET_KEY_HERE';

/**
 * File: send-email-smtp.php (line 21)
 * 
 * Ganti YOUR_SECRET_KEY_HERE dengan Secret Key yang sama:
 */
$recaptcha_secret_key = 'YOUR_SECRET_KEY_HERE';


// ========================================
// KEY FORMAT EXAMPLES (TEST KEYS - JANGAN PAKAI DI PRODUCTION!)
// ========================================

/**
 * Site Key Example (40 characters):
 * 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
 * 
 * Secret Key Example (40 characters):
 * 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
 * 
 * Note: Keys above are for localhost testing only!
 */


// ========================================
// SECURITY CHECKLIST
// ========================================

/**
 * ✅ Site Key diganti di index.html (data-sitekey attribute di form)
 * ✅ Secret Key diganti di send-email.php ATAU send-email-smtp.php
 * ✅ Domain sudah didaftarkan di reCAPTCHA admin
 * ✅ Pilih reCAPTCHA v2 (bukan v3!) saat registrasi
 * ✅ Secret Key TIDAK di-commit ke public repository
 * ✅ Test form submission dengan centang checkbox
 * ✅ Check checkbox "I'm not a robot" muncul di form
 * ✅ Monitor di reCAPTCHA admin console
 */


// ========================================
// QUICK LINKS
// ========================================

/**
 * 📝 Register: https://www.google.com/recaptcha/admin/create
 * 🎛️ Admin Console: https://www.google.com/recaptcha/admin
 * 📚 v2 Documentation: https://developers.google.com/recaptcha/docs/display
 * 📖 Setup Guide: Baca file RECAPTCHA-SETUP.md
 */
