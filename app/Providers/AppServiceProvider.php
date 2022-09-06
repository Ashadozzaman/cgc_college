<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Banner;
use App\Models\Department;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $banners = Banner::where('status',1)->orderBy('order_by','desc')->get();
        $departments = Department::where('status',1)->orderBy('order_by','desc')->get();
        view()->composer('layouts.front._header', function ($view) use ($banners){
            $view->with('banners',$banners);
        });
        view()->composer('layouts.front._header', function ($view) use ($departments){
            $view->with('departments',$departments);
        });

    }
}
