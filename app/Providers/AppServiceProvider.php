<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
// use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //will unguard every table
        Model::unguard();
        // Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        //to check whether the user is admin or not
        //call back function got the current logged in user as the argument
        Gate::define('admin', function(User $user){
            return $user && $user->is_admin;
        });
    }
}
