<?php

namespace App\Providers;
use App\Models\Dataset;
use App\Models\User;
use Log;

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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-dataset', function (User $user, Dataset $dataset) {
            return ($user->is_editor && $user->id == $dataset->user_id) || $user->is_admin;
        });
    }
}
