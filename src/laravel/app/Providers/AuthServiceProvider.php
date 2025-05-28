<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

  
       protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];
 

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-employee', function ($user) {
            return $user->role_id == 0; 
         });
    }
}
