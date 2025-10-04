<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Bahan Baku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6 py-4">
            <h1 class="text-xl font-bold">Edit Stok</h1>
            <a href="<?= base_url('gudang/stok') ?>" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-lg">Kembali</a>
        </div>
    </nav>

    <div class="container mx-auto mt-10 bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Jumlah - <?= esc($item['nama']) ?></h2>

        <form action="<?= base_url('gudang/stok/update/'.$item['id']) ?>" method="post" class="space-y-4">
            <div>
                <label class="block font-semibold">Jumlah Stok</label>
                <input type="number" name="jumlah" min="0" value="<?= esc($item['jumlah']) ?>" 
                       class="border p-2 w-full rounded" required>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
