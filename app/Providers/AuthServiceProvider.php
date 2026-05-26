<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate; // <-- WAJIB DI-IMPORT
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 1. DEFINISI GERBANG MAHASISWA
        Gate::define('access-student', function ($user) {
            return $user->role === 'student';
        });

        // 2. DEFINISI GERBANG SATGAS (Pegang Hak Akses Kriptografi)
        Gate::define('access-satgas', function ($user) {
            return $user->role === 'satgas';
        });

        // 3. DEFINISI GERBANG ADMIN (Hanya Kelola Akun & Infrastruktur)
        Gate::define('access-admin', function ($user) {
            return $user->role === 'admin';
        });
    }
}