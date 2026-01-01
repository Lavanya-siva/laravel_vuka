<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
       /* $this->registerPolicies();

        Gate::define('valid-proof-type', function ($user, $proofType) {
            $allowedTypes = ['National ID', 'Alien ID', 'Passport ID'];
            return in_array($proofType, $allowedTypes);
        });*/
    }
}
