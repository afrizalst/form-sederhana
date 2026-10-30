<?php
// Form mahasiswa, dipakai bersama oleh tambah.php dan ubah.php.
// Variabel yang dibutuhkan: $data, $err, $tombol
?>
<?php if ($err): ?>
    <div class="pesan pesan-galat"><?= e(t('form_salah')) ?></div>
<?php endif; ?>

<form method="POST" action="" class="kartu form" novalidate>
    <div class="grid">
        <div class="kolom <?= isset($err['nim']) ? 'salah' : '' ?>">
            <label for="nim"><?= e(t('nim')) ?></label>
            <input type="text" id="nim" name="nim" maxlength="15" value="<?= e($data['nim']) ?>">
            <?= galat($err, 'nim') ?>
        </div>

        <div class="kolom <?= isset($err['angkatan']) ? 'salah' : '' ?>">
            <label for="angkatan"><?= e(t('angkatan')) ?></label>
            <input type="number" id="angkatan" name="angkatan" value="<?= e($data['angkatan']) ?>">
            <?= galat($err, 'angkatan') ?>
        </div>

        <div class="kolom penuh <?= isset($err['nama']) ? 'salah' : '' ?>">
            <label for="nama"><?= e(t('nama')) ?></label>
            <input type="text" id="nama" name="nama" maxlength="100" value="<?= e($data['nama']) ?>">
            <?= galat($err, 'nama') ?>
        </div>

        <div class="kolom penuh <?= isset($err['email']) ? 'salah' : '' ?>">
            <label for="email"><?= e(t('email')) ?></label>
            <input type="email" id="email" name="email" maxlength="100" value="<?= e($data['email']) ?>">
            <?= galat($err, 'email') ?>
        </div>

        <div class="kolom penuh <?= isset($err['jurusan']) ? 'salah' : '' ?>">
            <label for="jurusan"><?= e(t('jurusan')) ?></label>
            <select id="jurusan" name="jurusan">
                <option value=""><?= e(t('pilih_jurusan')) ?></option>
                <?php foreach ($daftar_jurusan as $j): ?>
                    <option value="<?= e($j) ?>" <?= $data['jurusan'] === $j ? 'selected' : '' ?>><?= e($j) ?></option>
                <?php endforeach; ?>
            </select>
            <?= galat($err, 'jurusan') ?>
        </div>
    </div>

    <div class="tombol">
        <button type="submit" class="btn btn-utama"><?= e($tombol) ?></button>
        <a href="index.php" class="btn btn-garis"><?= e(t('batal')) ?></a>
    </div>
</form>
