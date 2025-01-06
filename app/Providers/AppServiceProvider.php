<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Paginator::useBootstrap();

        Blade::directive('readonlyForBasicPermission', function () {
            return "<?php echo Auth::user()->hasBasicPermissions() ? 'readonly' : ''; ?>";
            });

        Blade::directive('disabledForBasicPermission', function () {
            return "<?php echo Auth::user()->hasBasicPermissions() ? 'disabled'  : ''; ?>";
            });
    }
}
