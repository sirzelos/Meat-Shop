<?php

namespace App\Providers;

use App\Pay;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Post::class => \App\Policies\CartPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('index-cart',function($user,$cart){
               return $user->isCustomer();
           });
        Gate::define('create-product',function($user,$product){
                  return $user->isAdmin();
          });
        Gate::define('index-user',function($user){
                    return $user->isAdmin();
          });
        Gate::define('add-cart',function($user,$cart){
            return $user->isCustomer();
            });
        Gate::define('show-order', function ($user, $order) {
            return $user->isAdmin()
                or $user->id === $order->user_id;
        });
        Gate::define('show-pay', function ($user, $pay) {
            return $user->isAdmin()
                or $user->id === $pay->user_id;
        });
        Gate::define('edit-order',function($user,$order){
            return $user->isAdmin();
        });
        Gate::define('show-user',function($user){
            return $user->isAdmin();
        });
        Gate::define('add-product',function($user,$product){
            return $user->isAdmin();
        });
        Gate::define('status-show',function($pay){
            return Auth::user()->isAdmin()
                or Auth::user()->id === $pay->user_id;
        });
        Gate::define('index-report',function($user,$report){
            return $user->isAdmin();
        });


    }
}
