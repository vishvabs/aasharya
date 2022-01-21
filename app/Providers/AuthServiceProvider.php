<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        /**
         * Defining the user Roles
         */
        Gate::define('isAdmin', function ($user) {
            // if ($user->isAdmin()) {
            //     return true;
            // }

            // for simplicity
            return $user->is_admin === 1;
        });

        Gate::define('isUser', function ($user) {
            // if ($user->isUser()) {
            //     return true;
            // }

            // for simplicity
            return $user->is_admin === 0;
        });

    }
}
