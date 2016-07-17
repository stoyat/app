<?php

namespace App\Providers;

use App\Book;
use App\Policies\BookPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Book::class => UserPolicy::class,
        User::class => UserPolicy::class,
        //'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        foreach (get_class_methods(new \App\Policies\UserPolicy) as $class_method)
        {
            $gate->define($class_method, "App\\Policies\\UserPolicy@{$class_method}");
        }

        $this->registerPolicies($gate);
        //
    }
}
