<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Application;
use App\User;

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

        Passport::routes();

        Gate::define('create-app', function ($user) {
            return $user->hasAccess(['create-app']);
        });

        Gate::define('view-app', function ($user, $appid) {
            $application = Application::find($appid);    
            return $user->inRole('admin') or $user->id === $application->user_id;
        });

        Gate::define('isAdmin', function ($user) {
            return $user->inRole('admin');
        });

    }
}
