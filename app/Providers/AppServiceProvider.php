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

        Blade::directive('readonlyForBenutzer', function () {
            return "<?php echo Auth::user()->role == 'Benutzer' ? 'readonly' : ''; ?>";
            });

        Blade::directive('disabledForBenutzer', function () {
            return "<?php echo Auth::user()->role == 'Benutzer' ? 'disabled'  : ''; ?>";
            });
    }
}
