<?php

// Asumsi ada autoload untuk BahanBakuModel dan ViewHelper
require_once 'app/Models/BahanBakuModel.php';

class BahanBakuController {
    private $model;

    public function __construct() {
        // Inisialisasi Model (asumsi koneksi database ada di sini)
        $db_connection = new PDO('sqlite::memory:'); // Contoh koneksi dummy
        $this->model = new BahanBakuModel($db_connection);
    }

    // 1. Tampilkan Dashboard Admin (b. Lihat Data Bahan Baku)
    public function index() {
        // Ambil semua data bahan baku dari Model (sudah termasuk status)
        $data_bahan_baku = $this->model->getAll();

        // Tampilkan View
        $this->loadView('admin_dashboard', [
            'bahan_baku' => $data_bahan_baku,
            'message' => null
        ]);
    }

    // 2. Proses Tambah Bahan Baku (a. Tambah Bahan Baku)
    public function store() {
        // Ambil data dari POST request (simulasi)
        $input = [
            'nama' => $_POST['nama'] ?? 'Bahan Baru',
            'kategori' => $_POST['kategori'] ?? 'Dummy',
            'jumlah' => (int)($_POST['jumlah'] ?? 1),
            // ... atribut lain
        ];

        // Validasi input di Controller (walaupun Model bisa melakukan ini juga)
        if ($input['jumlah'] <= 0) {
            // Kembali ke halaman index dengan pesan error
            return $this->loadView('admin_dashboard', ['bahan_baku' => $this->model->getAll(), 'message' => 'Error: Jumlah harus lebih dari 0.']);
        }

        $this->model->tambah($input);
        
        // Redirect atau muat ulang index dengan pesan sukses
        header('Location: /bahanbaku?success=Tambah berhasil');
        exit;
    }

    // 3. Proses Update Stok (c. Update Stok Bahan Baku)
    public function updateStok($id) {
        $stok_baru = (int)($_POST['stok'] ?? -1); // Ambil stok baru dari request
        
        $result = $this->model->updateStok($id, $stok_baru);

        // Redirect atau muat ulang index dengan pesan dari Model
        header('Location: /bahanbaku?message=' . urlencode($result['message']));
        exit;
    }

    // 4. Proses Hapus Bahan Baku (d. Hapus Bahan Baku)
    public function destroy($id) {
        $result = $this->model->hapus($id);

        // Redirect atau muat ulang index dengan pesan dari Model
        header('Location: /bahanbaku?message=' . urlencode($result['message']));
        exit;
    }

    // Fungsi helper sederhana untuk memuat view
    private function loadView($view_name, $data = []) {
        // Mengekstrak array data menjadi variabel (misalnya $bahan_baku)
        extract($data); 
        // Memuat file view
        require "app/Views/{$view_name}.php";
    }
}