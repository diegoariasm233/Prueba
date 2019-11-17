<?php

namespace App\Providers;
use App\Role;
use App\User;
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
  $user = \Auth::user();

          Gate::define('company_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

Gate::define('employee_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('employee_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('employee_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('employee_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('employee_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });











    }
}
