<?php
namespace App\Controllers;

use App\Controllers\BaseController;

/**
 * Controller untuk menangani dashboard dan halaman yang diakses oleh role 'gudang'.
 */
class GudangController extends BaseController
{
    /**
     * Metode untuk Dashboard Gudang.
     * Mengandung pemeriksaan sesi manual karena tanpa Filter.
     */
    public function dashboard()
    {
        $session = session();
        // Jika user belum login atau role-nya bukan 'gudang', kembalikan ke login
        if (!$session->get('logged_in') || $session->get('role') !== 'gudang') {
            // Arahkan ke login dan berikan pesan error
            return redirect()->to(base_url('login'))->with('error', 'Akses ditolak. Silakan login sebagai Gudang.');
        }
        // -----------------------------

        $data = [
            // Judul akan ditampilkan di view Dashboard.php
            'title' => 'Dashboard Manajemen Gudang', 
            'session' => $session,
        ];
        
        // Memuat view Dashboard.php yang sudah Anda sediakan
        return view('Dashboard', $data); 
    }
}
