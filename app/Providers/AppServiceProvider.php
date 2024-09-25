<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Photo;
use App\Policies\PhotoPolicy;
use App\Policies\UserPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Existing code
        View::composer('layouts.sidebar', function ($view) {
            $users = User::all();
            $view->with('users', $users);
        });

        // Register the PhotoPolicy
        Gate::policy(Photo::class, PhotoPolicy::class);

        // Register the UserPolicy
        Gate::policy(User::class, UserPolicy::class);

        // Define a gate for checking if a user is an admin
        Gate::define('admin', function (User $user) {
            return $user->is_admin;
        });

        // Share is_admin variable with all views
        View::composer('*', function ($view) {
            $view->with('is_admin', auth()->check() && auth()->user()->is_admin);
        });
    }
}