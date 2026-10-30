<?php
session_start();
$bahasa = $_SESSION['bahasa'] ?? 'id';

// Hapus seluruh data session, lalu mulai session baru hanya untuk menyimpan bahasa
$_SESSION = [];
session_destroy();
session_start();
$_SESSION['bahasa'] = $bahasa;

header('Location: login.php');
exit;
