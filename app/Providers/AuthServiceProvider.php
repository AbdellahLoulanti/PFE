<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        User::class => UserPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
