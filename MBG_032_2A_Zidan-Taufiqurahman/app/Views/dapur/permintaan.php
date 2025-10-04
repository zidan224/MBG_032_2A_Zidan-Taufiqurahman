<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Permintaan Bahan Baku</title>
    <script src="https://cdn.tailwindcss.com"></script>

    
    <script>
const bahanTersedia = <?= json_encode($bahanTersedia ?? []) ?>;

function tambahBahan() {
    const container = document.getElementById('bahanContainer');
    const div = document.createElement('div');
    div.classList = 'flex space-x-4 mb-2';

    let options = '<option value="">-- Pilih Bahan --</option>';
    bahanTersedia.forEach(b => {
       options += `<option value="${b.id}">${b.nama}</option>`;

    });

    div.innerHTML = `
        <select name="bahan[]" class="border p-2 rounded w-1/2" required>
            ${options}
        </select>
        <input type="number" name="jumlah[]" min="1" class="border p-2 rounded w-1/2" placeholder="Jumlah" required>
    `;
    container.appendChild(div);
}

window.addEventListener('DOMContentLoaded', () => {
    tambahBahan();
});
</script>
</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-green-600 text-white p-4 shadow-lg flex justify-between">
    <div class="flex space-x-6">
        <a href="<?= base_url('dapur/dashboard') ?>" class="hover:bg-green-700 px-3 py-2 rounded">Dashboard</a>
        <a href="<?= base_url('dapur/permintaan') ?>" class="bg-green-700 px-3 py-2 rounded">Permintaan Bahan</a>
    </div>
    <div class="flex items-center space-x-4">
        <span>Halo, <?= esc(session()->get('username') ?? 'Dapur') ?></span>
        <a href="<?= base_url('logout') ?>" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">Logout</a>
    </div>
</nav>

<div class="container mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Form Permintaan Bahan</h2>

    <form method="post" action="<?= base_url('dapur/storePermintaan') ?>" class="space-y-4">

        <div>
            <label class="font-semibold">Tanggal Masak</label>
            <input type="date" name="tgl_masak" class="border p-2 rounded w-full" required>
        </div>

        <div>
            <label class="font-semibold">Menu yang akan dibuat</label>
            <input type="text" name="menu_makan" class="border p-2 rounded w-full" required>
        </div>

        <div>
            <label class="font-semibold">Jumlah Porsi</label>
            <input type="number" name="jumlah_porsi" min="1" class="border p-2 rounded w-full" required>
        </div>

        <div>
            <label class="font-semibold">Daftar Bahan Baku</label>
            <div id="bahanContainer" class="space-y-2"></div>
            <button type="button" onclick="tambahBahan()" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Bahan
            </button>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                Kirim Permintaan
            </button>
        </div>
    </form>
</div>
</body>
</html>
