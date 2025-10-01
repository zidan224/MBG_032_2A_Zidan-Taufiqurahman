<?php

class BahanBakuModel {
    private $db; // Asumsikan ini adalah koneksi database

    public function __construct($database_connection) {
        $this->db = $database_connection;
    }

    // --- LOGIKA UTAMA (Sesuai Spesifikasi) ---
    private function hitungStatus($tanggal_kadaluarsa, $jumlah_stok) {
        $hari_ini = strtotime(date('Y-m-d'));
        $tgl_kadaluarsa = strtotime($tanggal_kadaluarsa);
        $selisih_hari = floor(($tgl_kadaluarsa - $hari_ini) / (60 * 60 * 24)); // Selisih dalam hari

        if ($jumlah_stok <= 0) {
            return 'Habis';
        }
        
        if ($hari_ini >= $tgl_kadaluarsa) {
            return 'Kadaluarsa';
        }

        if ($selisih_hari <= 3 && $jumlah_stok > 0) {
            return 'Segera Kadaluarsa';
        }
        
        return 'Tersedia'; // Jika stok > 0 dan tidak masuk kondisi di atas
    }

    // A. Tambah Bahan Baku
    public function tambah($data) {
        // Asumsi: data sudah divalidasi oleh Controller
        $status_awal = 'Tersedia'; // Sesuai spesifikasi (saat input jumlah > 0)
        
        // Simpan data ke database. Contoh:
        // $sql = "INSERT INTO bahan_baku (...) VALUES (...)";
        // $this->db->query($sql, $data);
        return true; // Berhasil
    }

    // B. Lihat Data Bahan Baku
    public function getAll() {
        // Ambil semua data dari database
        // Contoh data dummy dari database:
        $bahan_baku = [
            ['id' => 1, 'nama' => 'Tepung', 'kategori' => 'Dasar', 'jumlah' => 10, 'tanggal_kadaluarsa' => '2026-10-01'],
            ['id' => 2, 'nama' => 'Ragi', 'kategori' => 'Aditif', 'jumlah' => 2, 'tanggal_kadaluarsa' => date('Y-m-d', strtotime('+2 days'))], // Segera Kadaluarsa
            ['id' => 3, 'nama' => 'Susu', 'kategori' => 'Cair', 'jumlah' => 0, 'tanggal_kadaluarsa' => '2026-12-01'], // Habis
            ['id' => 4, 'nama' => 'Garam', 'kategori' => 'Bumbu', 'jumlah' => 5, 'tanggal_kadaluarsa' => date('Y-m-d', strtotime('-1 day'))], // Kadaluarsa
        ];

        // Tambahkan atribut 'status' ke setiap item
        foreach ($bahan_baku as &$baku) {
            $baku['status'] = $this->hitungStatus($baku['tanggal_kadaluarsa'], $baku['jumlah']);
        }

        return $bahan_baku;
    }

    // C. Update Stok Bahan Baku
    public function updateStok($id_bahan_baku, $stok_baru) {
        if ($stok_baru < 0) {
            return ['success' => false, 'message' => 'Sistem menolak update jika nilai stok kurang dari 0.'];
        }

        // Logika update database
        // $sql = "UPDATE bahan_baku SET jumlah = ? WHERE id = ?";
        // $this->db->execute($sql, [$stok_baru, $id_bahan_baku]);

        // Setelah update, hitung ulang status (opsional, bisa dilakukan di getAll)

        return ['success' => true, 'message' => 'Stok berhasil diperbarui.'];
    }

    // D. Hapus Bahan Baku
    public function hapus($id_bahan_baku) {
        // 1. Ambil data bahan baku untuk cek status
        // $baku = $this->db->getById($id_bahan_baku);
        // $status = $this->hitungStatus($baku['tanggal_kadaluarsa'], $baku['jumlah']);
        
        // Contoh dummy status Kadaluarsa:
        $status_current = 'Kadaluarsa'; // Asumsi setelah cek ke database
        
        // Cek status sesuai aturan: Sistem hanya mengizinkan penghapusan yang berstatus KADALUARSA
        if ($status_current !== 'Kadaluarsa') {
            return ['success' => false, 'message' => 'Gagal: Penghapusan hanya diizinkan untuk bahan baku yang berstatus **Kadaluarsa**.'];
        }

        // Lakukan penghapusan
        // $sql = "DELETE FROM bahan_baku WHERE id = ?";
        // $this->db->execute($sql, [$id_bahan_baku]);

        return ['success' => true, 'message' => 'Bahan baku Kadaluarsa berhasil dihapus.'];
    }
}