<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Peternak;
use Auth;
use Redirect;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
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

        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });

        Gate::define('isPeternak', function($user) {
            if(Peternak::where('username', $user->username)->exists()){
                return $user->role == 'peternak';
            }
            else{
                Auth::logout();
                return Redirect::route('login')->with('failure', 'Tidak terauthorisasi - Register dari Admin!');
            }
        });

    }
}
