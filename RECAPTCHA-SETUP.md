# 🛡️ Google reCAPTCHA v2 Setup Guide

Google reCAPTCHA v2 sudah terintegrasi di contact form dengan checkbox "I'm not a robot" yang visible!

## 📋 Step-by-Step Setup

### Step 1: Daftar Google reCAPTCHA v2

1. Buka: https://www.google.com/recaptcha/admin/create
2. Login dengan Google Account
3. Isi form registrasi:
   - **Label**: `Graseus Contact Form`
   - **reCAPTCHA type**: Pilih **reCAPTCHA v2** → "I'm not a robot" Checkbox
   - **Domains**: 
     - `graseus.com`
     - `www.graseus.com`
     - Tambahkan `localhost` kalau mau test di local
   - Accept Terms of Service
4. Click **Submit**

### Step 2: Copy Keys

Setelah registrasi, lu akan dapat 2 keys:
- **Site Key** (Public) - Untuk frontend
- **Secret Key** (Private) - Untuk backend

**PENTING**: Jangan share Secret Key ke publik!

---

## 🔧 Configuration

### Frontend Configuration

Edit file: `index.html` (line 32)

```html
<!-- Google reCAPTCHA v2 -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
```

Sudah benar, tidak perlu diubah!

---

Edit file: `index.html` (line ~383 - di dalam form, sebelum submit button)

```html
<!-- reCAPTCHA v2 Widget -->
<div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY_HERE" data-theme="dark"></div>
```

**Ganti `YOUR_SITE_KEY_HERE` dengan Site Key lu!**

---

### Backend Configuration

#### Kalau pakai `send-email.php`:

Edit file: `send-email.php` (line 7)

```php
$recaptcha_secret_key = 'YOUR_SECRET_KEY_HERE'; // Ganti dengan Secret Key dari Google reCAPTCHA
```

**Ganti `YOUR_SECRET_KEY_HERE` dengan Secret Key lu!**

---

#### Kalau pakai `send-email-smtp.php`:

Edit file: `send-email-smtp.php` (line 21)

```php
$recaptcha_secret_key = 'YOUR_SECRET_KEY_HERE'; // Ganti dengan Secret Key dari Google reCAPTCHA
```

**Ganti `YOUR_SECRET_KEY_HERE` dengan Secret Key lu!**

---

## 🧪 Testing

### Test di Local:
1. Pastikan sudah tambahkan `localhost` di domain list reCAPTCHA admin
2. Buka website di browser
3. Isi contact form
4. **Click checkbox "I'm not a robot"**
5. Submit form
6. Check Console browser untuk error (F12)

### Test di Production:
1. Upload semua files ke VPS
2. Make sure keys sudah di-update
3. Test submit form dengan centang checkbox
4. Monitor di Google reCAPTCHA Admin: https://www.google.com/recaptcha/admin

---

## 📊 How It Works

### reCAPTCHA v2 Flow:

1. **User fills form** → User must click "I'm not a robot" checkbox
2. **Google analyzes behavior** → Mouse movement, timing, browser data
3. **If suspicious** → Shows image challenge (select traffic lights, crosswalks, etc.)
4. **If looks human** → Green checkmark appears
5. **Form submission** → Response token sent to backend
6. **Backend verification** → PHP verifies token with Google API
7. **If valid** → Email sent successfully

### Checkbox States:

- ⬜ **Unchecked** → User hasn't verified yet (form won't submit)
- ⏳ **Loading** → Google analyzing behavior
- ✅ **Verified** → Human confirmed (can submit form)
- 🖼️ **Challenge** → Must solve image puzzle if suspicious

---

## 🎨 reCAPTCHA Widget Styling

reCAPTCHA v2 widget sudah styled dengan dark theme (`data-theme="dark"` in HTML).

### Available Themes:

```html
<!-- Light theme (default) -->
<div class="g-recaptcha" data-sitekey="YOUR_KEY" data-theme="light"></div>

<!-- Dark theme (current) -->
<div class="g-recaptcha" data-sitekey="YOUR_KEY" data-theme="dark"></div>
```

### Custom Size:

```html
<!-- Normal size (default, 304px wide) -->
<div class="g-recaptcha" data-sitekey="YOUR_KEY" data-size="normal"></div>

<!-- Compact size (256px wide, for mobile) -->
<div class="g-recaptcha" data-sitekey="YOUR_KEY" data-size="compact"></div>
```

Current setup menggunakan **dark theme** dan **normal size** untuk match dengan glassmorphism design.

---

## 🔒 Security Features

reCAPTCHA v2 provides:
- ✅ **Visual verification** - Checkbox "I'm not a robot"
- ✅ **Bot detection** - Behavioral analysis (mouse movement, timing)
- ✅ **Image challenges** - CAPTCHA puzzles for suspicious activity
- ✅ **IP verification** - Checks sender IP address
- ✅ **Token validation** - One-time use tokens with expiry
- ✅ **Form protection** - Prevents automated spam submissions

---

## 🚨 Troubleshooting

### Checkbox tidak muncul

**Possible causes:**

1. **Wrong Site Key**
   - Check `index.html` data-sitekey attribute
   - Make sure Site Key is correct

2. **Domain not registered**
   - Go to https://www.google.com/recaptcha/admin
   - Add your domain to allowed list

3. **JavaScript not loaded**
   - Check browser Console (F12) for errors
   - Make sure api.js loaded correctly

### reCAPTCHA verification failed

**Possible causes:**

1. **Wrong Secret Key**
   - Check `send-email.php` atau `send-email-smtp.php`
   - Make sure Secret Key is correct

2. **User didn't check the box**
   - Form validation prevents submit without checkbox
3. **Response token empty**
   - User must click checkbox before submitting
   - JavaScript validation prevents empty response

### Challenge keeps appearing

**Normal behavior for:**
- VPN/Proxy users
- Suspicious IP addresses
- Unusual browser configurations
- Multiple failed attempts

**Not a bug** - This is how v2 protects against bots!

### Form submits without checkbox

Check JavaScript in `main.js`:
```javascript
if (!recaptchaResponse) {
  showMessage('Please complete the reCAPTCHA verification.', 'error');
  return;
}
```

This validation prevents submission without checkbox verification.

---

## 📈 Monitoring

Monitor reCAPTCHA performance:

1. Go to: https://www.google.com/recaptcha/admin
2. Click on your site key
3. View **Analytics Dashboard**:
   - Total verifications
   - Success/failure rate
   - Challenge frequency
   - Geographic distribution

---

## 🔑 Quick Reference

### Files to Update:

| File | Line | What to Change |
|------|------|----------------|
| `index.html` | ~383 | Site Key in g-recaptcha div |
| `send-email.php` | 7 | Secret Key |
| `send-email-smtp.php` | 21 | Secret Key |

### Keys Format:

- **Site Key**: `6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI` (40 chars, public)
- **Secret Key**: `6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe` (40 chars, private)

*(Above are test keys for localhost only, don't use in production!)*

---

## 💡 Pro Tips

1. **Always use HTTPS in production** - reCAPTCHA requires secure connection
2. **Use dark theme** - Matches website design (already configured!)
3. **Keep Secret Key secret** - Never commit to public Git repos
4. **Test before deploy** - Test thoroughly including checkbox interaction
5. **Add rate limiting** - Combine with server-side rate limiting for extra protection
6. **Monitor analytics** - Check if challenges are appearing too frequently

---

## 📞 Need Help?

- **Google reCAPTCHA v2 Docs**: https://developers.google.com/recaptcha/docs/display
- **Admin Console**: https://www.google.com/recaptcha/admin
- **FAQ**: https://developers.google.com/recaptcha/docs/faq

---

**Setup time**: ~5 minutes ⏱️  
**Protection level**: High 🛡️  
**User experience**: Clear verification with checkbox ✅

**Setup time**: ~5 minutes ⏱️  
**Protection level**: High 🛡️  
**User experience**: Seamless (no CAPTCHA challenges) ✨

Good luck ngab! 🚀
