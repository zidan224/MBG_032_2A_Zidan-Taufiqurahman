<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body { font-family: sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        h1 { color: #333; }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
        .logout { float: right; }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?= base_url('logout') ?>" class="logout">Logout</a>
        <h1><?= $title ?></h1>

        <?php if ($session->getFlashdata('success')): ?>
            <div class="alert-success">
                <?= $session->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <p>Selamat datang di area administrasi, **<?= $session->get('username') ?? 'Admin' ?>**!</p>
        <p>Ini adalah halaman yang dilindungi oleh filter otentikasi (`AuthFilter`).</p>
        
        <h2>Menu Cepat</h2>
        <ul>
            <li><a href="<?= base_url('admin/settings') ?>">Pengaturan</a></li>
            <li><a href="<?= base_url('/') ?>">Kembali ke Halaman Utama</a></li>
        </ul>
    </div>
</body>
</html>