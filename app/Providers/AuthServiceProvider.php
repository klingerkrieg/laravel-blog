<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\AccessPolicy;
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
        #Post::class =>  PostPolicy::class, 
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*Gate::before(function ($user, $ability) {
            if ($user->isAdministrator()) {
                return true;
            }
        });*/

        Gate::define('admin-access', [AccessPolicy::class, 'admin']);
    }
}
