<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
// Tambahkan use statement untuk kelas filter Anda (opsional, tergantung lokasi)
use App\Filters\AuthFilter; // Pastikan kelas AuthFilter sudah benar dan ada di app/Filters/

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>> [filter_name => classname]
     * or [filter_name => [classname1, classname2, ...]]
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        // Alias 'auth' sudah ditambahkan
        'auth'          => AuthFilter::class, 
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, list<string>>
     */
    public array $globals = [
        'before' => [
            // Jika Anda menerapkan 'auth' secara global di sini, 
            // Anda HARUS menggunakan properti 'except' di bawah.
            // Contoh: 'auth' 
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     *
     * @var array<string, list<string>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, list<string>>>
     */
    public array $filters = [
        // *** BAGIAN PERBAIKAN PENTING UNTUK MENGHINDARI REDIRECT LOOP ***
        'auth' => [
            // Terapkan filter 'auth' ke semua path kecuali yang ada di 'except'
            'before' => ['admin/*', 'dashboard/*'], // Sesuaikan dengan URI yang ingin Anda lindungi
            
            // Kecualikan URI login/register dari filter 'auth' agar tidak terjadi loop
            // Sesuaikan 'login' dan 'register' dengan rute Anda yang sebenarnya
            'except' => ['login', 'register', '/'], 
        ],
    ];
}