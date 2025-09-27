<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('is-admin', function (User $user) {
            return $user->role?->name === 'admin';
        });
        Gate::define('is-guru', function (User $user) {
            return $user->role?->name === 'guru';
        });
        Gate::define('is-siswa', function (User $user) {
            return $user->role?->name === 'siswa';
        });
        Gate::define('is-kepsek', function (User $user) {
            return $user->role->name === 'kepsek';
        });

        }

}
