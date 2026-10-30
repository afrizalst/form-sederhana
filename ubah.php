<?php
require 'fungsi.php';
wajib_login();

// Identitas unik data yang diubah (primary key) diambil dari URL
$id = (int) ($_GET['id'] ?? 0);

$stmt = $conn->prepare('SELECT nim, nama, email, jurusan, angkatan FROM mahasiswa WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    pesan('galat', t('tidak_ada'));
    header('Location: index.php');
    exit;
}
$err = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ambil_input();
    $err = validasi_mahasiswa($conn, $data, $id);

    // UPDATE: simpan perubahan jika semua data valid
    if (!$err) {
        $angkatan = (int) $data['angkatan'];
        $stmt = $conn->prepare('UPDATE mahasiswa SET nim = ?, nama = ?, email = ?, jurusan = ?, angkatan = ? WHERE id = ?');
        $stmt->bind_param('ssssii', $data['nim'], $data['nama'], $data['email'], $data['jurusan'], $angkatan, $id);
        $stmt->execute();

        pesan('sukses', t('ok_ubah'));
        header('Location: index.php');
        exit;
    }
}

$judul = t('judul_ubah');
$subjudul = t('sub_ubah');
$tombol = t('perbarui');
include 'header.php';
include 'form.php';
include 'footer.php';
