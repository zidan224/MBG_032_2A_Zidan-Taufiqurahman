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

    // 📦 Daftar bahan baku
    public function index()
    {
        $bahan_baku = $this->bahanBakuModel->findAll();
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

            $this->bahanBakuModel->update($item['id'], ['status' => $item['status']]);
        }

        $data = [
            'bahan_baku' => $bahan_baku
        ];

        return view('stok/index', $data);
    }

    // ➕ Form tambah
    public function create()
    {
        return view('stok/create');
    }

    // 💾 Simpan data baru
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

    // ✏️ Form edit
    public function edit($id)
    {
        $item = $this->bahanBakuModel->find($id);

        if (!$item) {
            return redirect()->to('/gudang/stok')->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Bahan Baku',
            'item'  => $item
        ];

        return view('stok/edit', $data);
    }

    // 🔁 Update stok
    public function update($id)
    {
        $jumlah = $this->request->getPost('jumlah');
        if ($jumlah < 0) {
            return redirect()->back()->with('error', 'Jumlah stok tidak boleh negatif!');
        }

        $this->bahanBakuModel->update($id, ['jumlah' => $jumlah]);
        return redirect()->to('/gudang/stok')->with('success', 'Stok berhasil diperbarui');
    }

    // 🗑️ Hapus bahan baku
    public function delete($id)
{
    $item = $this->bahanBakuModel->find($id);

    if (!$item) {
        return redirect()->to('/gudang/stok')->with('error', 'Data tidak ditemukan!');
    }

    $this->bahanBakuModel->delete($id);

    return redirect()->to('/gudang/stok')->with('success', 'Data berhasil dihapus!');
}
}