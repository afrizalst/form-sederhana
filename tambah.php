<?php
require 'fungsi.php';
wajib_login();

$data = ['nim' => '', 'nama' => '', 'email' => '', 'jurusan' => '', 'angkatan' => ''];
$err = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ambil_input();
    $err = validasi_mahasiswa($conn, $data);

    // CREATE: simpan jika semua data valid
    if (!$err) {
        $angkatan = (int) $data['angkatan'];
        $stmt = $conn->prepare('INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssi', $data['nim'], $data['nama'], $data['email'], $data['jurusan'], $angkatan);
        $stmt->execute();

        pesan('sukses', t('ok_tambah'));
        header('Location: index.php');
        exit;
    }
}

$judul = t('judul_tambah');
$subjudul = t('sub_tambah');
$tombol = t('simpan');
include 'header.php';
include 'form.php';
include 'footer.php';
