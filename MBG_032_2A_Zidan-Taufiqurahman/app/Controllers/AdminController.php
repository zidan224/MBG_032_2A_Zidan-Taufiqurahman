<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    /**
     * Metode default (index) untuk Dashboard Admin.
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'session' => session(),
        ];
        
        // Memuat tampilan (view) dashboard
        return view('admin/dashboard', $data);
    }

    /**
     * Contoh halaman lain yang dilindungi
     */
    public function settings()
    {
        $data = [
            'title' => 'Pengaturan Admin',
            'session' => session(),
        ];
        return view('admin/settings', $data);
    }
}