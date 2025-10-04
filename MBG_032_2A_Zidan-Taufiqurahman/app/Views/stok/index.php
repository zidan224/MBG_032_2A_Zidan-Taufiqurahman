<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Stok Bahan Baku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-6 py-4">

            <!-- Blok Kiri: Logo + Menu -->
            <div class="flex items-center space-x-8">
                <div class="text-xl font-bold">Manajemen Gudang</div>
                <div class="flex space-x-6">
                    <a href="<?= base_url('gudang/dashboard') ?>"
                       class="hover:bg-blue-700 px-3 py-2 rounded-lg transition duration-300
                       <?= service('uri')->getSegment(2) === 'dashboard' ? 'bg-blue-800' : '' ?>">
                       Dashboard
                    </a>

                    <a href="<?= base_url('gudang/stok') ?>"
                       class="hover:bg-blue-700 px-3 py-2 rounded-lg transition duration-300
                       <?= service('uri')->getSegment(2) === 'stok' ? 'bg-blue-800' : '' ?>">
                       Daftar Stok
                    </a>
                </div>
            </div>

            <!-- Blok Kanan: User Info + Logout -->
            <div class="flex items-center space-x-4">
                <span class="font-medium">Halo, <?= esc($session->get('username')) ?></span>
                <a href="<?= base_url('logout') ?>"
                   class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition duration-300">
                   Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="container mx-auto mt-8 px-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Stok Bahan Baku</h1>

        <!-- Tombol Tambah -->
        <div class="mb-4">
            <a href="<?= base_url('gudang/stok/tambah') ?>"
               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-300">
               + Tambah Bahan Baku
            </a>
        </div>

        <!-- TABEL DATA -->
        <?php if (!empty($bahan_baku)): ?>
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Kategori</th>
                            <th class="px-4 py-3 text-left">Jumlah</th>
                            <th class="px-4 py-3 text-left">Satuan</th>
                            <th class="px-4 py-3 text-left">Tgl Masuk</th>
                            <th class="px-4 py-3 text-left">Tgl Kadaluarsa</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($bahan_baku as $baku): ?>
                            <tr class="border-b hover:bg-gray-100 transition">
                                <td class="px-4 py-2"><?= $no++ ?></td>
                                <td class="px-4 py-2"><?= esc($baku['nama']) ?></td>
                                <td class="px-4 py-2"><?= esc($baku['kategori']) ?></td>
                                <td class="px-4 py-2"><?= esc($baku['jumlah']) ?></td>
                                <td class="px-4 py-2"><?= esc($baku['satuan'] ?? '-') ?></td>
                                <td class="px-4 py-2"><?= esc($baku['tanggal_masuk'] ?? '-') ?></td>
                                <td class="px-4 py-2"><?= esc($baku['tanggal_kadaluarsa']) ?></td>
                                <td class="px-4 py-2 font-semibold 
                                    <?= $baku['status'] === 'Kadaluarsa' ? 'text-red-500' : 
                                        ($baku['status'] === 'Segera Kadaluarsa' ? 'text-yellow-500' : 
                                        ($baku['status'] === 'Habis' ? 'text-gray-500' : 'text-green-600')) ?>">
                                    <?= esc($baku['status']) ?>
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="<?= base_url('gudang/stok/update/'.$baku['id']) ?>"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition">Update</a>
                                    <a href="<?= base_url('gudang/stok/delete/'.$baku['id']) ?>"
                                       class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-gray-600">Belum ada data bahan baku.</p>
        <?php endif; ?>
    </div>

</body>
</html>
