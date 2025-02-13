<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\AdminPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Las políticas del sistema.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => AdminPolicy::class, // Asigna la política al modelo User
    ];

    /**
     * Registra cualquier servicio de autenticación / autorización.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Definir el acceso de administrador
        Gate::define('admin-access', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
