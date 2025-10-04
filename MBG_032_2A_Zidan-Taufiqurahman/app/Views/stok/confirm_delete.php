<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Hapus Bahan Baku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto mt-20 bg-white p-8 shadow-lg rounded-xl max-w-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">
            Konfirmasi Hapus Bahan Baku
        </h2>

        <div class="mb-4">
            <p><strong>Nama:</strong> <?= esc($item['nama']) ?></p>
            <p><strong>Kategori:</strong> <?= esc($item['kategori']) ?></p>
            <p><strong>Jumlah:</strong> <?= esc($item['jumlah']) ?> <?= esc($item['satuan']) ?></p>
            <p><strong>Status:</strong> <?= esc($item['status']) ?></p>
            <p><strong>Kadaluarsa:</strong> <?= esc($item['tanggal_kadaluarsa']) ?></p>
        </div>

        <?php if ($item['status'] === 'Kadaluarsa'): ?>
            <p class="text-red-600 font-semibold mb-4">
                Apakah Anda yakin ingin menghapus bahan baku ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <form action="<?= base_url('gudang/stok/delete/'.$item['id']) ?>" method="post" class="flex justify-end space-x-3">
                <a href="<?= base_url('gudang/stok') ?>" 
                    class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg transition duration-300">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-300">
                    Hapus
                </button>
            </form>
        <?php else: ?>
            <div class="text-yellow-700 bg-yellow-100 border border-yellow-400 px-4 py-3 rounded">
                Bahan baku ini tidak dapat dihapus karena statusnya <strong><?= esc($item['status']) ?></strong>.
            </div>

            <div class="flex justify-end mt-4">
                <a href="<?= base_url('gudang/stok') ?>" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-300">
                    Kembali
                </a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
