<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Stok Bahan Baku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6 py-4">
            <div class="flex items-center space-x-8">
                <h1 class="text-xl font-bold">Manajemen Gudang</h1>
                <div class="flex space-x-6">
                    <a href="<?= base_url('gudang/dashboard') ?>" class="hover:bg-blue-700 px-3 py-2 rounded-lg">Dashboard</a>
                    <a href="<?= base_url('gudang/stok') ?>" class="bg-blue-800 px-3 py-2 rounded-lg">Daftar Stok</a>
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

    <div class="container mx-auto mt-8 bg-white p-8 shadow-lg rounded-lg">
        <div class="flex justify-between mb-6">
            <h2 class="text-2xl font-bold">Daftar Bahan Baku</h2>
            <a href="<?= base_url('gudang/stok/tambah') ?>" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">+ Tambah Bahan</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="border p-3">No</th>
                    <th class="border p-3">Nama</th>
                    <th class="border p-3">Kategori</th>
                    <th class="border p-3">Jumlah</th>
                    <th class="border p-3">Satuan</th>
                    <th class="border p-3">Tanggal Masuk</th>
                    <th class="border p-3">Kadaluarsa</th>
                    <th class="border p-3">Status</th>
                    <th class="border p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($bahan_baku as $item): ?>
                <tr class="hover:bg-gray-100">
                    <td class="border p-3"><?= $no++ ?></td>
                    <td class="border p-3"><?= esc($item['nama']) ?></td>
                    <td class="border p-3"><?= esc($item['kategori']) ?></td>
                    <td class="border p-3"><?= esc($item['jumlah']) ?></td>
                    <td class="border p-3"><?= esc($item['satuan']) ?></td>
                    <td class="border p-3"><?= esc($item['tanggal_masuk']) ?></td>
                    <td class="border p-3"><?= esc($item['tanggal_kadaluarsa']) ?></td>
                    <td class="border p-3 font-semibold"><?= esc($item['status']) ?></td>
                    <td class="border p-3 flex space-x-2 justify-center">
                        <a href="<?= base_url('gudang/stok/edit/'.$item['id']) ?>" 
                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded"> Edit </a>
                        <a href="<?= base_url('gudang/stok/hapus/'.$item['id']) ?>"
                            onclick="return confirm('Yakin ingin menghapus bahan baku <?= esc($item['nama']) ?>?')"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-300">
                            Hapus
                        </a>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
