<?php
namespace App\Models;

use CodeIgniter\Model;

class BahanBakuModel extends Model
{
    protected $table = 'bahan_baku'; 
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama',
        'kategori',
        'jumlah',
        'satuan',
        'tanggal_masuk',
        'tanggal_kadaluarsa',
        'status'
    ];


    public function hitungStatus($tanggal_kadaluarsa, $jumlah_stok)
    {
        $hari_ini = strtotime(date('Y-m-d'));
        $tgl_kadaluarsa = strtotime($tanggal_kadaluarsa);
        $selisih_hari = floor(($tgl_kadaluarsa - $hari_ini) / (60 * 60 * 24));

        if ($jumlah_stok <= 0) {
            return 'Habis';
        }

        if ($hari_ini >= $tgl_kadaluarsa) {
            return 'Kadaluarsa';
        }

        if ($selisih_hari <= 3 && $jumlah_stok > 0) {
            return 'Segera Kadaluarsa';
        }

        return 'Tersedia';
    }
}
