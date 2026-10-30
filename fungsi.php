<?php
// Dimuat paling atas di setiap halaman: session, koneksi, bahasa, dan fungsi bantu.
session_start();
require_once 'koneksi.php';
require_once 'lang.php';

// Bahasa bawaan: Indonesia. Pilihan bahasa disimpan di $_SESSION['bahasa'].
if (!isset($_SESSION['bahasa'])) {
    $_SESSION['bahasa'] = 'id';
}

$daftar_jurusan = ['Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Manajemen', 'Akuntansi'];

// Ambil teks sesuai bahasa yang dipilih
function t($kunci)
{
    global $teks;
    return $teks[$_SESSION['bahasa']][$kunci] ?? $kunci;
}

// Escape output agar aman dari XSS
function e($nilai)
{
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}

// Sanitasi input: buang tag HTML dan spasi di pinggir
function bersihkan($nilai)
{
    return trim(strip_tags((string) $nilai));
}

// Proteksi halaman: wajib login
function wajib_login()
{
    if (empty($_SESSION['user_id'])) {
        $_SESSION['pesan'] = ['galat', t('perlu_login')];
        header('Location: login.php');
        exit;
    }
}

// Pesan singkat yang tampil sekali setelah redirect
function pesan($jenis, $isi)
{
    $_SESSION['pesan'] = [$jenis, $isi];
}

// Ambil input form mahasiswa dari $_POST (sudah disanitasi)
function ambil_input()
{
    return [
        'nim'      => bersihkan($_POST['nim'] ?? ''),
        'nama'     => bersihkan($_POST['nama'] ?? ''),
        'email'    => bersihkan($_POST['email'] ?? ''),
        'jurusan'  => bersihkan($_POST['jurusan'] ?? ''),
        'angkatan' => bersihkan($_POST['angkatan'] ?? ''),
    ];
}

// Tampilkan pesan error di bawah kolom form
function galat($err, $kolom)
{
    return isset($err[$kolom]) ? '<small class="galat">' . e($err[$kolom]) . '</small>' : '';
}

// Validasi kelengkapan dan format data. Hasil: array error (kosong berarti valid).
// $id dipakai saat ubah data supaya NIM milik sendiri tidak dianggap duplikat.
function validasi_mahasiswa($conn, $d, $id = 0)
{
    $err = [];

    // NIM
    if ($d['nim'] === '') {
        $err['nim'] = t('wajib');
    } elseif (!preg_match('/^[0-9]{5,15}$/', $d['nim'])) {
        $err['nim'] = t('err_nim');
    } else {
        $stmt = $conn->prepare('SELECT id FROM mahasiswa WHERE nim = ? AND id <> ?');
        $stmt->bind_param('si', $d['nim'], $id);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $err['nim'] = t('err_nim_ada');
        }
    }

    // Nama
    if ($d['nama'] === '') {
        $err['nama'] = t('wajib');
    } elseif (!preg_match('/^[\p{L} .\'-]{3,100}$/u', $d['nama'])) {
        $err['nama'] = t('err_nama');
    }

    // Email
    if ($d['email'] === '') {
        $err['email'] = t('wajib');
    } elseif (!filter_var($d['email'], FILTER_VALIDATE_EMAIL)) {
        $err['email'] = t('err_email');
    }

    // Jurusan (switch: hanya lima jurusan yang tersedia yang diterima)
    switch ($d['jurusan']) {
        case '':
            $err['jurusan'] = t('wajib');
            break;
        case 'Teknik Informatika':
        case 'Sistem Informasi':
        case 'Teknik Elektro':
        case 'Manajemen':
        case 'Akuntansi':
            break;
        default:
            $err['jurusan'] = t('err_jurusan');
    }

    // Angkatan
    $tahun_ini = (int) date('Y');
    if ($d['angkatan'] === '') {
        $err['angkatan'] = t('wajib');
    } elseif (filter_var($d['angkatan'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 2000, 'max_range' => $tahun_ini]]) === false) {
        $err['angkatan'] = sprintf(t('err_angkatan'), 2000, $tahun_ini);
    }

    return $err;
}
