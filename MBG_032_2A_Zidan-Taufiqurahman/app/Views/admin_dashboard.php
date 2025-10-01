<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin - Bahan Baku</title>
    <style> /* ... CSS dari jawaban sebelumnya ... */ </style>
</head>
<body>
    <div class="header"><h1>Dashboard Admin Manajemen Bahan Baku</h1></div>
    <div class="container">
        
        <?php if (!empty($message)): ?>
            <div class="alert-message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <div class="tabs">
            <button class="tab-link active" onclick="openTab(event, 'TambahBaku')">Tambah Bahan Baku</button>
            <button class="tab-link" onclick="openTab(event, 'LihatData')">Lihat Data Bahan Baku</button>
            </div>

        <div id="TambahBaku" class="tab-content active">
            <h2>a. Tambah Bahan Baku</h2>
            <form action="/store" method="POST">
                <label for="nama">Nama:</label><input type="text" name="nama" required>
                <label for="jumlah">Jumlah:</label><input type="number" name="jumlah" min="1" required>
                <button type="submit" class="btn-primary">Simpan Bahan Baku</button>
            </form>
        </div>

        <div id="LihatData" class="tab-content">
            <h2>b. Lihat Data Bahan Baku</h2>
            <table>
                <thead>
                    <tr><th>Nama</th><th>Jumlah</th><th>Tgl. Kadaluarsa</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($bahan_baku as $baku): ?>
                    <tr>
                        <td><?= htmlspecialchars($baku['nama']) ?></td>
                        <td><?= htmlspecialchars($baku['jumlah']) ?></td>
                        <td><?= htmlspecialchars($baku['tanggal_kadaluarsa']) ?></td>
                        <td>
                            <span class="status-<?= strtolower(str_replace(' ', '-', $baku['status'])) ?>">
                                <?= htmlspecialchars($baku['status']) ?>
                            </span>
                        </td>
                        <td>
                            <form action="/delete/<?= $baku['id'] ?>" method="POST" style="display:inline;">
                                <button type="submit" class="btn-delete" 
                                    <?= ($baku['status'] !== 'Kadaluarsa') ? 'disabled' : '' ?>>
                                    Hapus
                                </button>
                            </form>
                            </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        </div>
    <script> /* ... Fungsi openTab() dari jawaban sebelumnya ... */ </script>
</body>
</html>