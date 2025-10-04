<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Gudang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6 py-4">
            <div class="flex items-center space-x-8">
                <h1 class="text-xl font-bold">Manajemen Gudang</h1>
                <div class="flex space-x-6">
                    <a href="<?= base_url('gudang/dashboard') ?>" 
                       class="bg-blue-800 px-3 py-2 rounded-lg">Dashboard</a>
                    <a href="<?= base_url('gudang/stok') ?>" 
                       class="hover:bg-blue-700 px-3 py-2 rounded-lg">Daftar Stok</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <span class="font-medium">Halo, <?= esc($session->get('username')) ?></span>
                <a href="<?= base_url('logout') ?>" 
                   class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition duration-300">
                   Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Konten Dashboard -->
    <div class="container mx-auto mt-8 bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Permintaan Bahan dari Dapur (Menunggu)</h2>

        <?php if ($permintaan): ?>
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="border p-3">ID</th>
                        <th class="border p-3">Tanggal Masak</th>
                        <th class="border p-3">Menu</th>
                        <th class="border p-3">Jumlah Porsi</th>
                        <th class="border p-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($permintaan as $item): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="border p-3"><?= esc($item['id']) ?></td>
                        <td class="border p-3"><?= esc($item['tgl_masak']) ?></td>
                        <td class="border p-3"><?= esc($item['menu_makan']) ?></td>
                        <td class="border p-3"><?= esc($item['jumlah_porsi']) ?></td>
                        <td class="border p-3 font-semibold"><?= esc($item['status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-gray-600">Belum ada permintaan dari dapur.</p>
        <?php endif; ?>
    </div>

</body>
</html>
