<?php

namespace App\Providers;

use App\Models\Task;
use App\Policies\TaskPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    // protected $policies = [
    //     Task::class => TaskPolicy::class,
    // ];
    // protected $policies = [
    //     \App\Models\Task::class => \App\Policies\TaskPolicy::class,
    // ];

    protected $policies = [
        Task::class => TaskPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();   
    }
}
