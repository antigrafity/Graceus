#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Generate placeholder product images for Graseus.

Membuat gambar placeholder bertema (gradient navy + nama produk) untuk tiap
produk pada sub-kategori "Oceana Prime" dan "Facility Protection".

CARA PAKAI
----------
1. Install dependency (sekali saja):
       pip3 install pillow
2. Jalankan dari root project:
       python3 tools/generate-placeholders.py
3. Gambar akan dibuat di:
       images/products/oceana-prime/
       images/products/facility-protection/

CATATAN
-------
- Script ini AMAN dijalankan berulang; file lama akan ditimpa.
- Nama file mengikuti slug halaman produk (mis. aurix-v-mdp.jpg) sehingga
  HTML tidak perlu diubah.
- Kalau sudah punya foto produk asli, cukup timpa file dengan nama yang sama,
  atau tambahkan entri baru di list PRODUCTS di bawah.
- Ubah WIDTH/HEIGHT, warna, atau font sesuai kebutuhan.
"""

import os
import sys

try:
    from PIL import Image, ImageDraw, ImageFont
except ImportError:
    sys.exit("Pillow belum terpasang. Jalankan: pip3 install pillow")

# ---------------------------------------------------------------------------
# Konfigurasi
# ---------------------------------------------------------------------------

# Root project = folder di atas folder tools/
PROJECT_ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
BASE_DIR = os.path.join(PROJECT_ROOT, "images", "products")

# Font (macOS). Ganti kalau di OS lain, mis. Linux:
#   "/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf"
FONT_BOLD = "/System/Library/Fonts/Supplemental/Arial Bold.ttf"
FONT_REGULAR = "/System/Library/Fonts/Supplemental/Arial.ttf"

WIDTH, HEIGHT = 1000, 640

# Palet warna sesuai tema situs
NAVY_TOP = (12, 22, 46)
NAVY_BOTTOM = (4, 7, 15)
PRIMARY = (0, 74, 173)     # biru utama (Oceana Prime)
ACCENT = (46, 166, 255)    # biru terang (Facility Protection)
INK = (231, 238, 252)
INK_SOFT = (150, 170, 205)

# Daftar produk: (folder, nama_file, judul, label_kategori, warna_aksen)
OCEANA = "Maritime Operations"
FACILITY = "Facility Protection"

PRODUCTS = [
    ("oceana-prime", "central-operations-hub.jpg", "Central Operations Hub", OCEANA, PRIMARY),
    ("oceana-prime", "field-command-hub.jpg", "Field Command Hub", OCEANA, PRIMARY),
    ("oceana-prime", "secure-fleet-communications.jpg", "Secure Fleet Communications", OCEANA, PRIMARY),
    ("facility-protection", "aurix-v-mdp.jpg", "AURIX-V MDP", FACILITY, ACCENT),
    ("facility-protection", "neuravista.jpg", "NEURAVISTA", FACILITY, ACCENT),
    ("facility-protection", "optivue.jpg", "OPTIVUE", FACILITY, ACCENT),
    ("facility-protection", "quantashield.jpg", "QUANTASHIELD", FACILITY, ACCENT),
    ("facility-protection", "signavia.jpg", "SIGNAVIA", FACILITY, ACCENT),
    ("facility-protection", "stareon.jpg", "STAREON", FACILITY, ACCENT),
    ("facility-protection", "aerovigil.jpg", "AEROVIGIL", FACILITY, ACCENT),
]

# ---------------------------------------------------------------------------
# Helper
# ---------------------------------------------------------------------------

def lerp(a, b, t):
    """Interpolasi linear antar dua warna RGB."""
    return tuple(int(a[i] + (b[i] - a[i]) * t) for i in range(3))


def make_image(path, title, subtitle, accent):
    # Background gradient vertikal
    img = Image.new("RGB", (WIDTH, HEIGHT), NAVY_BOTTOM)
    px = img.load()
    for y in range(HEIGHT):
        color = lerp(NAVY_TOP, NAVY_BOTTOM, y / HEIGHT)
        for x in range(WIDTH):
            px[x, y] = color

    # Glow radial di kiri atas dengan warna aksen
    glow = Image.new("RGBA", (WIDTH, HEIGHT), (0, 0, 0, 0))
    gd = ImageDraw.Draw(glow)
    cx, cy = int(WIDTH * 0.22), int(HEIGHT * 0.18)
    for r in range(420, 0, -6):
        alpha = int(55 * (1 - r / 420))
        gd.ellipse([cx - r, cy - r, cx + r, cy + r],
                   fill=(accent[0], accent[1], accent[2], alpha))
    img = Image.alpha_composite(img.convert("RGBA"), glow).convert("RGB")

    draw = ImageDraw.Draw(img, "RGBA")

    # Garis diagonal halus
    for i in range(-HEIGHT, WIDTH, 46):
        draw.line([(i, 0), (i + HEIGHT, HEIGHT)], fill=(255, 255, 255, 6), width=1)

    # Aksen bar
    draw.rectangle([70, 250, 150, 258], fill=accent)

    # Teks judul (wrap otomatis) + subjudul
    f_title = ImageFont.truetype(FONT_BOLD, 60)
    f_sub = ImageFont.truetype(FONT_REGULAR, 26)

    lines, cur = [], ""
    for word in title.split():
        test = (cur + " " + word).strip()
        if draw.textlength(test, font=f_title) > WIDTH - 140:
            lines.append(cur)
            cur = word
        else:
            cur = test
    if cur:
        lines.append(cur)

    y = 285
    for line in lines:
        draw.text((70, y), line.upper(), font=f_title, fill=INK)
        y += 68
    draw.text((72, y + 8), subtitle.upper(), font=f_sub, fill=INK_SOFT)

    os.makedirs(os.path.dirname(path), exist_ok=True)
    img.save(path, "JPEG", quality=88)
    print("saved", os.path.relpath(path, PROJECT_ROOT))


def main():
    for folder, filename, title, label, accent in PRODUCTS:
        make_image(os.path.join(BASE_DIR, folder, filename), title, label, accent)
    print("DONE -", len(PRODUCTS), "images")


if __name__ == "__main__":
    main()
