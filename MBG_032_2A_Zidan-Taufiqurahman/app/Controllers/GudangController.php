<?php

namespace App\Controllers;

use App\Models\BahanBakuModel;
use App\Models\PermintaanModel;

/**
 * Kontroler Gudang (Warehouse Controller)
 * Mengelola fungsionalitas terkait gudang, seperti dashboard dan daftar stok bahan baku.
 * * @extends BaseController
 */
class GudangController extends BaseController
{
    /**
     * Menampilkan halaman dashboard Gudang.
     * * Memuat dan menampilkan daftar permintaan bahan baku yang berstatus 'Menunggu' 
     * (permintaan yang belum diproses) diurutkan dari yang terbaru.
     *
     * @return string
     */
    public function dashboard(): string
    {
        // Membuat instance model Permintaan
        $permintaanModel = new PermintaanModel();

        // Mengambil semua permintaan dengan status 'Menunggu'
        $permintaan = $permintaanModel
            ->where('status', 'Menunggu')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        // Mengirim data ke view 'dashboard_gudang'
        return view('gudang/dashboard', [
            'title'      => 'Dashboard Gudang',
            'session'    => session(), // Mengambil instance session saat ini
            'permintaan' => $permintaan // Daftar permintaan yang menunggu
        ]);
    }

    /**
     * Menampilkan halaman daftar stok bahan baku di Gudang.
     * * Mengambil semua data bahan baku dari database.
     *
     * @return string
     */
    public function stok(): string
    {
        // Membuat instance model BahanBaku
        $bahanModel = new BahanBakuModel();

        // Mengambil semua data bahan baku
        $bahan_baku = $bahanModel->findAll();

        // Mengirim data ke view 'stok_gudang'
        return view('stok_gudang', [
            'title'      => 'Daftar Stok Bahan',
            'session'    => session(),
            'bahan_baku' => $bahan_baku // Daftar semua bahan baku dan stoknya
        ]);
    }
}
