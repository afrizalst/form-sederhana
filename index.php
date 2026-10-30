<?php
require 'fungsi.php';
wajib_login();

// READ: ambil data mahasiswa (dengan pencarian jika ada kata kunci)
$q = bersihkan($_GET['q'] ?? '');

if ($q !== '') {
    $like = '%' . $q . '%';
    $stmt = $conn->prepare('SELECT * FROM mahasiswa WHERE nim LIKE ? OR nama LIKE ? OR jurusan LIKE ? ORDER BY nama');
    $stmt->bind_param('sss', $like, $like, $like);
} else {
    $stmt = $conn->prepare('SELECT * FROM mahasiswa ORDER BY nama');
}
$stmt->execute();
$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$judul = t('judul_data');
$subjudul = t('sub_data');
include 'header.php';
?>
<div class="bar-atas">
    <form method="GET" action="" class="cari">
        <input type="search" name="q" value="<?= e($q) ?>" placeholder="<?= e(t('cari')) ?>">
        <button type="submit" class="btn btn-utama"><?= e(t('tombol_cari')) ?></button>
        <?php if ($q !== ''): ?>
            <a href="index.php" class="btn btn-garis"><?= e(t('reset')) ?></a>
        <?php endif; ?>
    </form>
    <a href="tambah.php" class="btn btn-utama">+ <?= e(t('menu_tambah')) ?></a>
</div>

<p class="redup"><?= e(sprintf(t('jumlah'), count($data))) ?></p>

<div class="kartu tabel">
    <table>
        <thead>
            <tr>
                <th><?= e(t('no')) ?></th>
                <th><?= e(t('nim')) ?></th>
                <th><?= e(t('nama')) ?></th>
                <th><?= e(t('email')) ?></th>
                <th><?= e(t('jurusan')) ?></th>
                <th><?= e(t('angkatan')) ?></th>
                <th><?= e(t('aksi')) ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($data) === 0): ?>
            <tr><td colspan="7" class="tengah redup"><?= e(t('kosong')) ?></td></tr>
        <?php endif; ?>
        <?php foreach ($data as $i => $m): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= e($m['nim']) ?></td>
                <td><?= e($m['nama']) ?></td>
                <td><?= e($m['email']) ?></td>
                <td><?= e($m['jurusan']) ?></td>
                <td><?= e($m['angkatan']) ?></td>
                <td>
                    <div class="aksi">
                        <a href="ubah.php?id=<?= (int) $m['id'] ?>" class="btn btn-kecil btn-garis"><?= e(t('ubah')) ?></a>
                        <form method="POST" action="hapus.php" onsubmit="return confirm(<?= e(json_encode(t('konfirmasi_hapus'))) ?>)">
                            <input type="hidden" name="id" value="<?= (int) $m['id'] ?>">
                            <button type="submit" class="btn btn-kecil btn-bahaya"><?= e(t('hapus')) ?></button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>
