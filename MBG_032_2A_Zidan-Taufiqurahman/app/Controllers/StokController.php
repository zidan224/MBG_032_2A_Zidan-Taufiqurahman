<?php
namespace App\Controllers;

use App\Models\BahanBakuModel;
use CodeIgniter\Controller;

class StokController extends Controller
{
    protected $bahanBakuModel;

    public function __construct()
    {
        $this->bahanBakuModel = new BahanBakuModel();
    }

    // LIST SEMUA DATA
    public function index()
    {
        $session = session(); // ✅ Tambahkan ini

        $bahan_baku = $this->bahanBakuModel->findAll();

        // Hitung status otomatis
        $today = date('Y-m-d');
        foreach ($bahan_baku as &$item) {
            if ($item['jumlah'] == 0) {
                $item['status'] = 'Habis';
            } elseif ($today >= $item['tanggal_kadaluarsa']) {
                $item['status'] = 'Kadaluarsa';
            } elseif ((strtotime($item['tanggal_kadaluarsa']) - strtotime($today)) / 86400 <= 3) {
                $item['status'] = 'Segera Kadaluarsa';
            } else {
                $item['status'] = 'Tersedia';
            }

            // update status ke DB
            $this->bahanBakuModel->update($item['id'], ['status' => $item['status']]);
        }

        $data = [
            'bahan_baku' => $bahan_baku,
            'session' => $session
        ];

        return view('stok/index', $data);
    }

    // FORM TAMBAH
    public function create()
    {
        $session = session(); // kalau view-nya juga pakai session, tambahkan ini
        return view('stok/create', ['session' => $session]);
    }

    // SIMPAN TAMBAHAN
    public function store()
    {
        $jumlah = $this->request->getPost('jumlah');
        if ($jumlah < 0) {
            return redirect()->back()->with('error', 'Jumlah stok tidak boleh negatif!');
        }

        $this->bahanBakuModel->insert([
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $jumlah,
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => 'Tersedia'
        ]);

        return redirect()->to('/gudang/stok')->with('success', 'Bahan baku berhasil ditambahkan');
    }

    // UPDATE JUMLAH
    public function update($id)
    {
        $jumlah = $this->request->getPost('jumlah');
        if ($jumlah < 0) {
            return redirect()->back()->with('error', 'Jumlah stok tidak boleh negatif!');
        }

        $this->bahanBakuModel->update($id, ['jumlah' => $jumlah]);
        return redirect()->to('/gudang/stok')->with('success', 'Stok berhasil diperbarui');
    }

    // HAPUS
    public function delete($id)
    {
        $item = $this->bahanBakuModel->find($id);

        if ($item['status'] !== 'Kadaluarsa') {
            return redirect()->back()->with('error', 'Hanya bahan baku kadaluarsa yang bisa dihapus!');
        }

        $this->bahanBakuModel->delete($id);
        return redirect()->to('/gudang/stok')->with('success', 'Data berhasil dihapus');
    }
}
