<?php
namespace App\Models;

use CodeIgniter\Model;

class PermintaanDetailModel extends Model
{
    protected $table = 'permintaan_detail'; 
    protected $allowedFields = [
        'permintaan_id', 'bahan_id', 'jumlah_diminta'
    ];
    protected $useTimestamps = false;
}
