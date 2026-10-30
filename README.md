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
