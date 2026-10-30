<?php
require 'fungsi.php';

// Jika sudah login, langsung ke halaman data
if (!empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = bersihkan($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = t('login_kosong');
    } else {
        // Cari user di database, lalu cocokkan password dengan hash-nya
        $stmt = $conn->prepare('SELECT id, username, password FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit;
        }
        $error = t('login_salah');
    }
}

$judul = t('masuk');
include 'header.php';
?>
<div class="kartu login">
    <h1><?= e(t('judul_login')) ?></h1>
    <p class="redup"><?= e(t('sub_login')) ?></p>

    <?php if ($error !== ''): ?>
        <div class="pesan pesan-galat"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="kolom">
            <label for="username"><?= e(t('username')) ?></label>
            <input type="text" id="username" name="username" value="<?= e($username) ?>" autocomplete="username" autofocus>
        </div>
        <div class="kolom">
            <label for="password"><?= e(t('password')) ?></label>
            <input type="password" id="password" name="password" autocomplete="current-password">
        </div>
        <button type="submit" class="btn btn-utama btn-penuh"><?= e(t('masuk')) ?></button>
    </form>
</div>
<?php include 'footer.php'; ?>
