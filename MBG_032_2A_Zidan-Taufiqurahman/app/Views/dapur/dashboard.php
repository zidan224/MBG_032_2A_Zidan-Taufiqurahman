<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dapur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-green-600 text-white p-4 shadow-lg flex justify-between">
    <div class="flex space-x-6">
        <a href="<?= base_url('dapur/dashboard') ?>" class="font-semibold hover:bg-green-700 px-3 py-2 rounded">Dashboard</a>
        <a href="<?= base_url('dapur/permintaan') ?>" class="hover:bg-green-700 px-3 py-2 rounded">Permintaan Bahan</a>
    </div>
    <div class="flex items-center space-x-4">
        <span>Halo, <?= esc($session->get('username') ?? 'Dapur') ?></span>
        <a href="<?= base_url('logout') ?>" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">Logout</a>
    </div>
</nav>

<div class="container mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Daftar Permintaan Bahan</h1>

    <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">Tanggal Masak</th>
                <th class="px-4 py-2">Menu</th>
                <th class="px-4 py-2">Jumlah Porsi</th>
                <th class="px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($permintaan)): ?>
                <tr><td colspan="4" class="text-center p-4 text-gray-500">Belum ada permintaan bahan.</td></tr>
            <?php else: ?>
                <?php foreach ($permintaan as $p): ?>
                <tr class="border-t">
                    <td class="px-4 py-2"><?= esc($p['tgl_masak']) ?></td>
                    <td class="px-4 py-2"><?= esc($p['menu_makan']) ?></td>
                    <td class="px-4 py-2"><?= esc($p['jumlah_porsi']) ?></td>
                    <td class="px-4 py-2 text-blue-600 font-semibold"><?= esc(ucfirst($p['status'])) ?></td>
                </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>
</body>
</html>
