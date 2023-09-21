<?php

namespace App\Providers;

use App\Models\CategoryService;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(125);
        view()->share('settings', Setting::firstOrCreate());
        view()->share('all_services', Service::get());
        view()->share('serviceCategories', CategoryService::get());

    }
}
