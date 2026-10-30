<?php
// Koneksi ke database MySQL (pengaturan bawaan Laragon)
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'sim_mahasiswa';

try {
    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    die('Koneksi database gagal. Pastikan MySQL di Laragon sudah berjalan dan database.sql sudah diimport.');
}
