<div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Tambah Bahan Baku</h2>

    <form action="<?= base_url('gudang/stok/store') ?>" method="post" class="space-y-4">
        <div>
            <label class="block font-medium">Nama</label>
            <input type="text" name="nama" class="border p-2 w-full rounded" required>
        </div>
        <div>
            <label class="block font-medium">Kategori</label>
            <input type="text" name="kategori" class="border p-2 w-full rounded" required>
        </div>
        <div>
            <label class="block font-medium">Jumlah</label>
            <input type="number" name="jumlah" class="border p-2 w-full rounded" required>
        </div>
        <div>
            <label class="block font-medium">Satuan</label>
            <input type="text" name="satuan" class="border p-2 w-full rounded" required>
        </div>
        <div>
            <label class="block font-medium">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="border p-2 w-full rounded" required>
        </div>
        <div>
            <label class="block font-medium">Tanggal Kadaluarsa</label>
            <input type="date" name="tanggal_kadaluarsa" class="border p-2 w-full rounded" required>
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>
