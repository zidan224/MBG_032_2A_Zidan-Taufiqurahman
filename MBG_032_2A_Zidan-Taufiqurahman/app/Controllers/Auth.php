<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    /**
     * Menampilkan halaman login
     */
    public function login()
    {
        // Pastikan pengguna yang sudah login tidak bisa mengakses halaman login lagi
        if (session()->get('logged_in')) {
            // Redirect ke dashboard sesuai role jika sudah login
            $role = session()->get('role');
            if ($role === 'gudang') {
                return redirect()->to('/gudang/dashboard');
            } elseif ($role === 'dapur') {
                return redirect()->to('/dapur/dashboard');
            } else {
                return redirect()->to('/default/dashboard');
            }
        }
        
        return view('auth/login');
    }

    /**
     * Memproses data login dan melakukan otentikasi
     */
    public function doLogin()
    {
        $session = session();
        // Pastikan Anda telah mendefinisikan App\Models\UserModel
        $userModel = new UserModel();

        // 1. Definisikan aturan validasi input
        $rules = [
            'name'      => 'required|min_length[3]',
            'password'  => 'required|min_length[8]'
        ];

        if (! $this->validate($rules)) {
            // Validasi gagal, tampilkan error
            return redirect()->back()->withInput()->with('error', 'Nama pengguna minimal 3 karakter, dan Password minimal 8 karakter.');
        }

        // 2. Ambil data input setelah validasi
        // Gunakan strtolower() untuk memastikan pencarian nama tidak case-sensitive
        $name = strtolower($this->request->getPost('name')); 
        $password = $this->request->getPost('password');

        // 3. Cari pengguna berdasarkan nama (name)
        $user = $userModel->where('name', $name)->first();

        if ($user) {
            
            // --- VERIFIKASI PASSWORD MENGGUNAKAN password_verify() (AMAN) ---
            if (password_verify($password, $user['password'])) {
            
                // --- Otentikasi Berhasil ---
                
                // 4. Set Session
                $session->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['name'],
                    'role'      => $user['role'],
                    'logged_in' => true
                ]);
                
                // 5. Logika pengalihan berdasarkan peran (role)
                if ($user['role'] === 'gudang') {
                    // Pengalihan ke Dashboard Gudang
                    return redirect()->to('/gudang/dashboard')->with('success', 'Login berhasil! Selamat datang di Gudang.'); 
                } elseif ($user['role'] === 'dapur') {
                    return redirect()->to('/dapur/dashboard');  
                } else {
                    return redirect()->to('/default/dashboard'); 
                }
            } else {
                // Password TIDAK COCOK
                return redirect()->back()->withInput()->with('error', 'Nama pengguna atau Password salah.');
            }
        } else {
            // Nama pengguna tidak ditemukan
            return redirect()->back()->withInput()->with('error', 'Nama pengguna atau Password salah.');
        }
    }

    /**
     * Menghapus session dan logout
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
