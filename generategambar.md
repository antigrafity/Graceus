# Prompt Gambar untuk AI Generator

Total: **11 gambar**, yaitu Oceana Prime 3, MOIS 6, dan Tridenta 2.

Prompt sengaja ditulis dalam bahasa Inggris karena hasil generator biasanya lebih akurat. Setiap prompt sudah lengkap, jadi bisa langsung di-copy satu per satu.

## Aturan untuk semua gambar

- Tidak ada wajah orang yang terlihat. Orang boleh muncul kalau dari belakang, siluet, atau terpotong.
- Setiap gambar wajib ada kapal.
- Tidak boleh berupa screenshot dashboard atau software saja. Layar boleh muncul kalau ada orang yang sedang melihatnya, atau layarnya jadi bagian dari ruangan.
- Tanpa teks, logo, dan watermark, karena judul sudah ditaruh di atas gambar oleh web.

**Negative prompt** (isi di kolom negative, kalau generatornya punya):

```
visible face, facial features, portrait, close-up of a person, eyes, text, letters, numbers, captions, logo, watermark, brand name, readable user interface, standalone screenshot, flat UI mockup, infographic, cartoon, illustration, anime, 3D render look, explosion, fire, weapons firing, blurry, distorted ships, extra hulls
```

Kalau generatornya tidak punya kolom negative prompt, tambahkan kalimat ini di akhir setiap prompt:

```
Strictly no visible human faces, no text, no logos, no watermark.
```

## Ukuran dan nama file

| Jenis | Rasio | Ukuran export |
|---|---|---|
| Hero (3 gambar) | 16:9 | 1600 × 900 px |
| Gambar fitur/modul (8 gambar) | 3:2 | 1200 × 800 px |

Simpan sebagai **JPG** dengan nama file persis seperti di bawah, lalu timpa file placeholder-nya. Usahakan ukuran file di bawah ±500 KB supaya web tetap ringan.

Gambar hero nanti diberi lapisan gelap dan judul di tengah. Karena itu, bagian tengah gambar hero sebaiknya relatif tenang. Gambar kartu dipotong otomatis, jadi taruh objek utamanya di tengah.

---

## Oceana Prime (3 gambar)

### 1. `images/oceana-prime.jpg` — Hero dan kartu beranda (16:9)

```
Photorealistic cinematic wide shot of a fleet of grey naval patrol vessels sailing in loose formation across the open ocean at dusk, viewed from a high elevated angle, long white wakes on dark blue water, subtle cyan light glowing from the ship bridges suggesting connected communication, calm open sky in the center of the frame, dark navy and steel-blue color palette, moody low-key lighting, high detail, professional defense-industry aesthetic, no people, no text, no logos, 16:9 aspect ratio
```

### 2. `images/products/oceana-prime/maritime-chart.jpg` — Peta situasional (3:2)

```
Photorealistic over-the-shoulder shot from behind a naval officer standing on a ship's bridge, the officer seen only from the back, looking at a large glowing digital maritime navigation chart display; through the wide bridge windows several cooperating patrol vessels are visible sailing nearby on the sea, blue hour lighting, dark navy and cyan tones, cinematic, high detail, face not visible, no readable text, no logos, 3:2 aspect ratio
```

### 3. `images/products/oceana-prime/event-reporting.jpg` — Pelaporan kejadian / SAR (3:2)

```
Photorealistic maritime search and rescue scene, a coast guard patrol vessel approaching a small disabled boat on rough grey sea, crew members in orange safety gear on the deck seen from behind, one holding a handheld radio, overcast dramatic sky, cool steel-blue color grading with orange accents, cinematic, high detail, no faces visible, no text, no logos, 3:2 aspect ratio
```

---

## MOIS (6 gambar)

### 4. `images/mois.jpg` — Hero dan kartu beranda (16:9)

```
Photorealistic cinematic wide shot of a coastal surveillance tower with mounted cameras and sensors on a rocky headland, overlooking a busy shipping lane with several cargo ships and tankers at twilight, calm sea, open sky in the center of the frame, dark navy and steel-blue palette with soft cyan lights on the tower, moody lighting, high detail, no people, no text, no logos, 16:9 aspect ratio
```

### 5. `images/products/mois/visual-observation-report.jpg` — Visual Observation Report Module (3:2)

```
Photorealistic close-up of a rugged pan-tilt maritime surveillance camera mounted on a steel pole at the edge of a harbor pier, sharp focus on the camera housing and lens, a large cargo ship sailing in the soft-focus background on the sea, early evening light, dark blue and grey tones, cinematic, high detail, no people, no text, no logos, 3:2 aspect ratio
```

### 6. `images/products/mois/operational-interaction-coordinator.jpg` — Operational Interaction Coordinator (3:2)

```
Photorealistic interior of a coastal maritime operations room, an operator seen from behind sitting at a console with several monitors, a large panoramic window in front of him showing two small patrol boats moving toward a larger vessel on the sea outside, dim blue ambient lighting, cinematic, high detail, operator's face not visible, screens without readable text, no logos, 3:2 aspect ratio
```

### 7. `images/products/mois/maritime-behavior-observation.jpg` — Maritime Behavior Observation View (3:2)

```
Photorealistic high-altitude aerial view of dense vessel traffic in a shipping lane, many cargo ships moving in parallel straight lines leaving white wakes, one single vessel leaving a curved irregular wake that turns away from the common route, deep blue ocean, soft daylight, clean composition, high detail, no people, no text, no overlays, no logos, 3:2 aspect ratio
```

### 8. `images/products/mois/vessel-attention-list.jpg` — Vessel Attention List Builder (3:2)

```
Photorealistic scene from the deck of a patrol boat, a crew member seen from behind holding binoculars and observing a specific fishing vessel among many ships anchored in the distance, calm sea, late afternoon light, steel-blue and grey color grading, cinematic, high detail, face not visible, no text, no logos, 3:2 aspect ratio
```

### 9. `images/products/mois/system-connectivity-manager.jpg` — System Connectivity Manager (3:2)

```
Photorealistic interior of a port control facility, an engineer seen from behind working at a console beside tall network equipment racks with blinking blue status lights and neatly organized cables, a large window behind the racks showing a harbor with container ships and cranes at dusk, dark navy and cyan tones, cinematic, high detail, face not visible, no readable text, no logos, 3:2 aspect ratio
```

---

## Tridenta (2 gambar)

### 10. `images/tridenta.jpg` — Hero dan kartu beranda (16:9)

```
Photorealistic cinematic shot of a modern naval frigate cutting through dark ocean waves at night, dramatic low angle from the water, faint abstract cyan light lines arcing across the sky above the ship suggesting AI and data connectivity, stormy clouds, open dark sky in the center of the frame, dark navy and black palette with cyan highlights, high contrast, high detail, no people, no text, no logos, 16:9 aspect ratio
```

### 11. `images/products/tridenta/command-center.jpg` — Command Center Experience (3:2)

```
Photorealistic interior of a naval command center, several officers seen from behind as dark silhouettes standing in front of a large curved wall display showing a glowing blue maritime map; to the side a wide panoramic window reveals grey warships docked at a naval base at dusk, dim blue lighting, cinematic, high detail, no faces visible, display without readable text, no logos, 3:2 aspect ratio
```

---

## Checklist sebelum upload

- [ ] Tidak ada wajah yang terlihat
- [ ] Ada kapal di gambar
- [ ] Bukan screenshot dashboard saja
- [ ] Tidak ada teks, logo, atau watermark (cek sudut gambar)
- [ ] Bentuk kapal wajar, tidak dobel atau melengkung aneh
- [ ] Ukuran dan nama file sesuai tabel
