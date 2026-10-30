<?php
require 'fungsi.php';
wajib_login();

// DELETE hanya diproses lewat POST (dari tombol Hapus di tabel)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);

    $stmt = $conn->prepare('DELETE FROM mahasiswa WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        pesan('sukses', t('ok_hapus'));
    } else {
        pesan('galat', t('tidak_ada'));
    }
}

header('Location: index.php');
exit;
