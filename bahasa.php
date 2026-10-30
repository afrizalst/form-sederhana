<?php
// Simpan pilihan bahasa ke $_SESSION lalu kembali ke halaman sebelumnya
session_start();

$b = $_GET['b'] ?? '';
if ($b === 'id' || $b === 'en') {
    $_SESSION['bahasa'] = $b;
}

// Kembali ke halaman asal (hanya jika berasal dari situs ini)
$kembali = 'index.php';
$asal = $_SERVER['HTTP_REFERER'] ?? '';
if ($asal !== '' && parse_url($asal, PHP_URL_HOST) === explode(':', $_SERVER['HTTP_HOST'])[0]) {
    $kembali = $asal;
}

header('Location: ' . $kembali);
exit;
