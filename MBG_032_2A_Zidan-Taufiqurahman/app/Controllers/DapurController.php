<?php
namespace App\Controllers;

use App\Models\BahanBakuModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;

class DapurController extends BaseController
{
    protected $bahanModel;
    protected $permintaanModel;
    protected $permintaanDetailModel;
    protected $db; 

    public function __construct()
    {
        $this->bahanModel = new BahanBakuModel();
        $this->permintaanModel = new PermintaanModel();
        $this->permintaanDetailModel = new PermintaanDetailModel();
        $this->db = \Config\Database::connect();
    }

    public function dashboard()
    {
        $session = session();
        $permintaan = $this->permintaanModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('dapur/dashboard', [
            'title' => 'Dashboard Dapur',
            'session' => $session,
            'permintaan' => $permintaan
        ]);
    }

    public function permintaan()
    {
        $bahanTersedia = $this->bahanModel
            ->where('jumlah >', 0)
            ->where('status !=', 'Kadaluarsa')
            ->findAll();

        return view('dapur/permintaan', ['bahanTersedia' => $bahanTersedia]);
    }

    public function createPermintaan()
    {
        $bahanTersedia = $this->bahanModel
            ->where('jumlah >', 0)
            ->where('status !=', 'Kadaluarsa')
            ->findAll();

        return view('dapur/permintaan_tambah', ['bahanTersedia' => $bahanTersedia]);
    }

    public function storePermintaan()
{
    $pemohonId = session()->get('user_id'); 
    $tglMasak = $this->request->getPost('tgl_masak');
    $menu = $this->request->getPost('menu_makan');
    $jumlahPorsi = $this->request->getPost('jumlah_porsi');
    $bahanDipilih = $this->request->getPost('bahan');
    $jumlahDipilih = $this->request->getPost('jumlah');

    // Mulai transaksi database
    $this->db->transStart();

    //  SIMPAN DATA UTAMA KE TABEL permintaan
    $this->permintaanModel->insert([
        'pemohon_id' => $pemohonId,
        'tgl_masak' => $tglMasak,
        'menu_makan' => $menu,
        'jumlah_porsi' => $jumlahPorsi,
        'status' => 'Menunggu',
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // AMBIL ID PERMINTAAN YANG BARU DIBUAT
    $permintaanId = $this->permintaanModel->getInsertID();

    //  SIMPAN DETAIL BAHAN KE permintaan_detail
    foreach($bahanDipilih as $i => $bahanId){
        $this->permintaanDetailModel->insert([
            'permintaan_id' => $permintaanId,
            'bahan_id' => $bahanId,
            'jumlah_diminta' => $jumlahDipilih[$i]
        ]);
    }

    //  Selesaikan transaksi
    $this->db->transComplete();

    //  Feedback ke user
    if ($this->db->transStatus() === false) {
        return redirect()->back()->with('error', 'Gagal menyimpan permintaan!');
    }

    return redirect()->to(base_url('dapur/dashboard'))->with('success', 'Permintaan berhasil dikirim!');
}
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth/login'));
    }

    }

