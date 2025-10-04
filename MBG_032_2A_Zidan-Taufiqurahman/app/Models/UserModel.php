<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; 
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email', 'password', 'role'];

    // Menggunakan timestamps (created_at dan updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    // Menggunakan 'hashPassword'
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Fungsi untuk hashing password 
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            // Menggunakan PASSWORD_DEFAULT (saat ini bcrypt) untuk hashing 
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}