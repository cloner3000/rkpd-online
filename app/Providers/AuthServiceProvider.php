<?php

namespace App\Providers;

use App\Enum\Roles;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('laporan-desa', function ($user) {
            return ($user->hasRole(Roles::DESA) || $user->hasRole(Roles::KECAMATAN) || $user->hasRole(Roles::ADMIN));
        });

        Gate::define('laporan-kecamatan', function ($user) {
            return ($user->hasRole(Roles::OPD) || $user->hasRole(Roles::KECAMATAN) || $user->hasRole(Roles::ADMIN) || $user->hasRole(Roles::DESA));
        });

        Gate::define('laporan-dewan', function ($user) {
            return ($user->hasRole(Roles::OPD) || $user->hasRole(Roles::DPRD) || $user->hasRole(Roles::ADMIN));
        });

        Gate::define('laporan-awal', function ($user) {
            return ($user->hasRole(Roles::OPD) || $user->hasRole(Roles::ADMIN) || $user->hasRole(Roles::KECAMATAN));
        });

        Gate::define('laporan-renja', function ($user) {
            return ($user->hasRole(Roles::OPD) || $user->hasRole(Roles::ADMIN) || $user->hasRole(Roles::KECAMATAN));
        });

        Gate::define('laporan-kabupaten', function ($user) {
            return ($user->hasRole(Roles::OPD) || $user->hasRole(Roles::ADMIN) || $user->hasRole(Roles::KECAMATAN));
        });

        Gate::define('laporan-akhir', function ($user) {
            return ($user->hasRole(Roles::OPD) || $user->hasRole(Roles::ADMIN) || $user->hasRole(Roles::KECAMATAN));
        });

        Gate::define('laporan-rancangankuappas', function ($user) {
            return ($user->hasRole(Roles::ADMIN) || $user->hasRole(Roles::TAPD) || $user->hasRole(Roles::BIDANG));
        });

        Gate::define('laporan-kuappas', function ($user) {
            return ($user->hasRole(Roles::ADMIN) || $user->hasRole(Roles::TAPD) || $user->hasRole(Roles::BIDANG));
        });

    }
}
