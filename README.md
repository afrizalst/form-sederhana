# SIM Data Mahasiswa (PHP Murni + MySQL)

Aplikasi pengelolaan data mahasiswa dengan PHP murni dan MySQL/MariaDB.
Fitur: login berbasis `$_SESSION`, CRUD data mahasiswa, validasi dan sanitasi form, serta dua bahasa (Indonesia dan Inggris).

## Struktur File

| File | Fungsi |
|------|--------|
| `koneksi.php` | Koneksi database |
| `fungsi.php` | Session, bahasa, sanitasi, proteksi login, validasi |
| `lang.php` | Kamus teks Indonesia dan Inggris |
| `header.php`, `footer.php`, `form.php` | Bagian tampilan yang dipakai bersama |
| `login.php`, `logout.php` | Masuk dan keluar |
| `index.php` | Read: daftar dan pencarian data |
| `tambah.php` | Create |
| `ubah.php` | Update |
| `hapus.php` | Delete |
| `bahasa.php` | Ganti bahasa |
| `style.css` | Tampilan |
| `database.sql` | Skrip database |

## Cara Menjalankan di Laragon

1. Buka Laragon, klik **Start All** (Apache dan MySQL harus aktif).
2. Salin folder `sim-mahasiswa` ke `C:\laragon\www\`.
3. Import `database.sql` lewat phpMyAdmin (`http://localhost/phpmyadmin`) atau HeidiSQL.
4. Buka `http://localhost/sim-mahasiswa/` di browser.
5. Masuk dengan username `admin` dan password `admin123`.

Pengaturan koneksi ada di `koneksi.php` (bawaan Laragon: user `root`, password kosong).

## Upload ke GitHub

```bash
cd sim-mahasiswa
git init
git add .
git commit -m "SIM Data Mahasiswa"
git branch -M main
git remote add origin https://github.com/<username>/sim-mahasiswa.git
git push -u origin main
```
