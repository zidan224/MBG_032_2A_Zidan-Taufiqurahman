<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Permintaan Bahan</title>
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
            tambahBahan(); // tambahkan 1 baris bahan saat form terbuka
        });
    </script>
</head>
<body class="bg-gray-100">
<nav class="bg-green-600 text-white p-4 flex justify-between">
    <div>
        <a href="<?= base_url('dapur/dashboard') ?>" class="px-3 py-2">Dashboard</a>
        <a href="<?= base_url('dapur/permintaan') ?>" class="px-3 py-2">Permintaan Bahan</a>
    </div>
</nav>

<div class="container mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Form Permintaan Bahan</h2>

    <form method="post" action="<?= base_url('dapur/storePermintaan') ?>" class="space-y-4">
        <div>
            <label>Tanggal Masak</label>
            <input type="date" name="tgl_masak" class="border p-2 rounded w-full" required>

        </div>

        <div>
            <label>Menu</label>
            <input type="text" name="menu_makan" class="border p-2 rounded w-full" required>
        </div>

        <div>
            <label>Jumlah Porsi</label>
            <input type="number" name="jumlah_porsi" min="1" class="border p-2 rounded w-full" required>
        </div>

        <div>
            <label>Daftar Bahan Baku</label>
            <div id="bahanContainer" class="space-y-2"></div>
            <button type="button" onclick="tambahBahan()" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">
                + Tambah Bahan
            </button>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">
                Kirim Permintaan
            </button>
        </div>
    </form>
</div>
</body>
</html>
