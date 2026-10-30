<?php
// Bagian atas halaman. Set $judul (dan $subjudul) sebelum include.
$sudah_login = !empty($_SESSION['user_id']);
$file = basename($_SERVER['PHP_SELF']);
$flash = $_SESSION['pesan'] ?? null;
unset($_SESSION['pesan']);
?>
<!DOCTYPE html>
<html lang="<?= e($_SESSION['bahasa']) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($judul ?? t('nama_app')) ?> | <?= e(t('nama_app')) ?></title>
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%23F4B63F'/%3E%3Ctext x='16' y='23' font-size='20' font-weight='800' text-anchor='middle' fill='%2314213D' font-family='Arial,sans-serif'%3EP%3C/text%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="topbar">
    <div class="wrap bar">
        <a class="brand" href="index.php">
            <span class="logo">P</span><?= e(t('nama_app')) ?>
        </a>

        <?php if ($sudah_login): ?>
        <nav class="menu">
            <a href="index.php" class="<?= in_array($file, ['index.php', 'ubah.php']) ? 'aktif' : '' ?>"><?= e(t('menu_data')) ?></a>
            <a href="tambah.php" class="<?= $file === 'tambah.php' ? 'aktif' : '' ?>"><?= e(t('menu_tambah')) ?></a>
        </nav>
        <?php endif; ?>

        <div class="kanan">
            <span class="bahasa">
                <a href="bahasa.php?b=id" class="<?= $_SESSION['bahasa'] === 'id' ? 'aktif' : '' ?>">ID</a>
                <a href="bahasa.php?b=en" class="<?= $_SESSION['bahasa'] === 'en' ? 'aktif' : '' ?>">EN</a>
            </span>
            <?php if ($sudah_login): ?>
                <span class="pengguna"><?= e($_SESSION['username']) ?></span>
                <a class="btn btn-garis" href="logout.php"><?= e(t('keluar')) ?></a>
            <?php endif; ?>
        </div>
    </div>
</header>

<?php if ($sudah_login && isset($judul)): ?>
<section class="judul">
    <div class="wrap">
        <h1><?= e($judul) ?></h1>
        <?php if (isset($subjudul)): ?><p><?= e($subjudul) ?></p><?php endif; ?>
    </div>
</section>
<?php endif; ?>

<main class="wrap">
<?php if ($flash): ?>
    <div class="pesan pesan-<?= e($flash[0]) ?>"><?= e($flash[1]) ?></div>
<?php endif; ?>
