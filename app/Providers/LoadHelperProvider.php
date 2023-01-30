<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LoadHelperProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path().'/Helpers/Constant.php';
        require_once app_path().'/Helpers/Helper.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
