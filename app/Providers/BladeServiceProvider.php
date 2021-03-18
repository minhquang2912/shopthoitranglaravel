<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('hasrole',function($expression){
            // user là class của Auth rồi nên chỉ đc dùng user chứ k đc dùng admin
            if(Auth::user()){ // nếu ng dùng có đăng nhập
               if(Auth::user()->hasAnyRole($expression)){ // nếu user có quyền admin
                   return true;
               } 
            }
            return false; // k đăng nhập thì trả về false 
        });
    }
}
