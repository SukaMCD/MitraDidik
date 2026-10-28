# MitraDidik: Portal Kolaborasi Orang Tua & Guru

> *"Bermitra mendampingi tumbuh kembang siswa."*

Portal kemitraan dua arah antara **Orang Tua dan Guru** yang dikelola terpusat oleh **Admin Sekolah**, dirancang untuk mendampingi perkembangan akademik, kehadiran, kedisiplinan, budi pekerti, serta komunikasi interaktif per mata pelajaran bagi peserta didik.

---

## 1. Asumsi & Arsitektur Teknis

Berdasarkan kesepakatan dan klarifikasi teknis pengembangan:
1. **Framework & Bahasa**: Laravel 12 (PHP 8.4) + Vite + Tailwind CSS v4 + Alpine.js (komponen interaktif cepat, responsif, mobile-first).
2. **Basis Data**: MySQL (kompatibel penuh dengan phpMyAdmin di Laragon), database `mitradidik`.
3. **Penyimpanan Berkas (Private Storage)**: Storage Adapter lokal terenkripsi (*Encrypted Local Disk*) dengan *signed URL* bertenggat waktu untuk pengembangan lokal, siap beralih ke S3 / MinIO saat produksi.
4. **Sistem Realtime Chat**: Siap diintegrasikan dengan Pusher Protocol / Laravel Reverb untuk transmisi pesan instan.
5. **Peran Pengguna (RBAC)**:
   - `admin`: Pengaturan sekolah, master data akademik, akun pengguna, penugasan guru, relasi wali-murid, moderasi chat, dan audit log.
   - `teacher`: Wali kelas (presensi, verifikasi izin, merit/demerit) dan guru mata pelajaran (sinkronisasi tugas, nilai, chat mapel).
   - `guardian`: Memantau kehadiran, mengajukan izin/sakit, memantau tugas & nilai, melihat buku saku budi luhur & demerit, dan chat terarah dengan guru anak.
   - *Siswa tidak memiliki akun login mandiri* (siswa adalah subjek data).

---

## 2. Brand Guide & Logo Resmi

Logo MitraDidik disimpan dalam format vektor SVG murni di direktori `/public/brand/`:

| File Vektor | Deskripsi Varian | Lokasi File |
| --- | --- | --- |
| `logo-full.svg` | Logo Horizontal Lengkap (Emblem + Teks "MitraDidik" + Tagline) | [logo-full.svg](file:///c:/laragon/www/MitraDidik/public/brand/logo-full.svg) |
| `logo-icon.svg` | Ikon Triad Segitiga Kemitraan (Favicon & Avatar) | [logo-icon.svg](file:///c:/laragon/www/MitraDidik/public/brand/logo-icon.svg) |
| `logo-white.svg`| Logo Versi Putih / Terang (Khusus Header & Latar Gelap) | [logo-white.svg](file:///c:/laragon/www/MitraDidik/public/brand/logo-white.svg) |
| `logo-mono.svg` | Logo Versi Monochrome (Satu Warna untuk Cetak / Dokumen Resmi) | [logo-mono.svg](file:///c:/laragon/www/MitraDidik/public/brand/logo-mono.svg) |
| `favicon.svg`   | Favicon Browser Resolusi Tinggi | [favicon.svg](file:///c:/laragon/www/MitraDidik/public/brand/favicon.svg) |

### Filosofi Logo
Simbol triad geometris melambangkan sinergi tiga pihak yang saling menopang:
* **Simpul Atas (Biru `#1A73E8`)**: Guru sebagai pemandu, teladan, dan penyampai ilmu.
* **Simpul Kiri (Biru Tua `#1557B0`)**: Orang tua sebagai fondasi kasih sayang, rumah, dan moral pertama.
* **Simpul Kanan (Hijau Bertumbuh `#188038`)**: Siswa/anak didik yang terus berkembang secara cerdas dan berkarakter.
* **Titik Emas Pusat (`#F9AB00`)**: Kemitraan hangat, budi pekerti, dan tujuan bersama demi masa depan anak.

### Design Tokens & Kode Warna
* **Warna Inti**:
  * `Primary (Tombol & Tautan Aktif)`: `#1A73E8`
  * `Primary Dark (Hover & Kontras)`: `#1557B0`
  * `Primary Soft (Latar Item Aktif / Chip)`: `#E8F0FE`
  * `Background`: `#F8F9FA` (Mode Gelap: `#202124`)
  * `Surface (Kartu & Panel)`: `#FFFFFF` (Mode Gelap: `#2D2E31`)
  * `Border`: `#DADCE0` (Mode Gelap: `#3C4043`)
  * `Teks Utama`: `#202124` (Mode Gelap: `#E8EAED`)
  * `Teks Sekunder`: `#5F6368` (Mode Gelap: `#9AA0A6`)
* **Warna Status Fungsional**:
  * Hadir / Sudah / Normal ($\ge 85$): Hijau `#188038`
  * Terlambat / SP1 (70–84): Kuning `#F9AB00` / `#B06000`
  * Sakit / SP2 (50–69): Oranye `#E8710A`
  * Alpa / SP3 ($< 50$) / Terlambat Tugas: Merah `#D93025`
  * Izin / Dinilai: Biru `#1A73E8`
  * Poin Budi Luhur: Hijau Tosca `#0B8043` + ikon bintang emas
  * Jam Tenang (*Held Message*): Kuning Lembut `#FEF7E0`, teks `#B06000`
* **Warna Banner Mapel (Tetap & Konsisten)**:
  * Matematika: `#1A73E8`
  * IPA: `#188038`
  * Bahasa Indonesia: `#C5221F`
  * Bahasa Inggris: `#8430CE`
  * IPS: `#C26401`

---

## 3. Akun Pengguna Demo (Hasil Seeder)

Semua akun pengujian memiliki kata sandi seragam: `password123`.

| Peran | Nama Pengguna | Alamat Email | Keterangan |
| --- | --- | --- | --- |
| **Admin** | Hendra Wijaya, S.Kom | `admin@mitradidik.sch.id` | Pengelola master data, sekolah, audit log |
| **Guru** | Ahmad Fauzi, S.Pd | `guru.ahmad@mitradidik.sch.id` | Wali Kelas 7A & Guru Matematika |
| **Guru** | Siti Rahmawati, M.Pd | `guru.siti@mitradidik.sch.id` | Wali Kelas 7B & Guru IPA |
| **Guru** | Dewi Lestari, S.Pd | `guru.dewi@mitradidik.sch.id` | Guru Bahasa Indonesia 7A & 7B |
| **Guru** | Budi Santoso, M.Ed | `guru.budi@mitradidik.sch.id` | Guru Bahasa Inggris 7A & 7B |
| **Guru** | Joko Prasetyo, S.Pd | `guru.joko@mitradidik.sch.id` | Guru IPS 7A & 7B |
| **Orang Tua** | Bambang Pratama | `ortu.adit@gmail.com` | Wali murid Adit Pratama (Kelas 7A) |
| **Orang Tua** | Sri Wahyuni | `ortu.bella@gmail.com` | Wali murid Bella Safitri (Kelas 7A) |
| **Orang Tua** | Rina Marlina | `ortu.dimas@gmail.com` | Wali murid Dimas Arya (Kelas 7A) |

*(Tersedia tombol login cepat 1-klik di halaman `/login` untuk pengujian instan tanpa mengetik).*

---

## 4. Panduan Menjalankan Proyek Lokal

1. **Pastikan MySQL Aktif di Laragon**:
   Pastikan service MySQL aktif pada port 3306. Basis data `mitradidik` dibuat otomatis atau jalankan:
   ```bash
   mysql -u root -e "CREATE DATABASE IF NOT EXISTS mitradidik CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
   ```

2. **Jalankan Migrasi & Seeder**:
   ```bash
   php artisan migrate:fresh --seed
   ```

3. **Kompilasi Aset Frontend (Tailwind CSS v4 & Vite)**:
   ```bash
   npm run build
   # atau untuk mode live reload pengembangan:
   npm run dev
   ```

4. **Jalankan Server Lokal**:
   ```bash
   php artisan serve
   ```
   Buka di peramban: `http://localhost:8000`

5. **Akses Halaman Khusus Showcase Komponen UI**:
   Kunjungi tautan: `http://localhost:8000/components-preview` untuk melihat seluruh katalog komponen desain, logo, status chip, kartu mapel, dan accordion tugas.

---

## 5. Hasil Pengujian Otomatis (Automated Tests)

Logika kritis telah diuji secara menyeluruh dengan PHPUnit / Pest:
```bash
php artisan test
```

**Hasil Ringkasan Pengujian**:
* `Tests\Unit\CriticalLogicTest`:
  * `demerit warning levels` (Status Normal $\ge 85$, SP1 70–84, SP2 50–69, SP3 $<50$) &rarr; **LULUS**
  * `attendance recap percentage formula` ($((Hadir + Terlambat) / Hari Efektif) \times 100\%$) &rarr; **LULUS**
  * `quiet hours calculation` (Pengecekan waktu dinas vs waktu jam tenang guru) &rarr; **LULUS**
* `Tests\Feature\RbacAndAuthTest`:
  * `unauthenticated user redirected to login` &rarr; **LULUS**
  * `admin rbac access` (Akses eksklusif dasbor admin) &rarr; **LULUS**
  * `teacher rbac access` (Akses eksklusif dasbor guru) &rarr; **LULUS**
  * `guardian rbac access` (Akses eksklusif dasbor orang tua) &rarr; **LULUS**

---

## 6. Status Tahapan Pengerjaan

- [x] **Tahap 1: Setup Proyek, Desain Tokens, Logo & Brand Guide, Komponen Dasar UI (AppBar, Drawer, SubjectCard, StatusChip, AssignmentRow), Skema Basis Data & Models, Seeder Contoh, Autentikasi 3 Peran, Guard RBAC, Panel Admin** *(Selesai & Siap Direview)*.
- [ ] **Tahap 2: Presensi Harian, Pengajuan Izin/Sakit + Konfirmasi Guru, Rekap Bulanan**.
- [ ] **Tahap 3: Integrasi Google Classroom API, Manajemen Tugas, Nilai Siswa, Dasbor Orang Tua**.
- [ ] **Tahap 4: Sistem Chat Terarah Guru Mapel / Wali Kelas, Jam Tenang (Job Terjadwal), Moderasi Admin**.
- [ ] **Tahap 5: Merit Budi Luhur & Demerit 100-ke-0, Peringatan Bertingkat (SP1/SP2/SP3), Notifikasi**.
