<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Bahan Baku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6 py-4">
            <h1 class="text-xl font-bold">Tambah Bahan Baku</h1>
            <a href="<?= base_url('gudang/stok') ?>" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-lg">Kembali</a>
        </div>
    </nav>

    <div class="container mx-auto mt-10 bg-white p-8 shadow-lg rounded-lg">
        <form action="<?= base_url('gudang/stok/store') ?>" method="post" class="space-y-4">
            <div><label>Nama</label><input type="text" name="nama" class="border p-2 w-full rounded" required></div>
            <div><label>Kategori</label><input type="text" name="kategori" class="border p-2 w-full rounded" required></div>
            <div><label>Jumlah</label><input type="number" name="jumlah" class="border p-2 w-full rounded" required></div>
            <div><label>Satuan</label><input type="text" name="satuan" class="border p-2 w-full rounded" required></div>
            <div><label>Tanggal Masuk</label><input type="date" name="tanggal_masuk" class="border p-2 w-full rounded" required></div>
            <div><label>Tanggal Kadaluarsa</label><input type="date" name="tanggal_kadaluarsa" class="border p-2 w-full rounded" required></div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</body>
</html>
