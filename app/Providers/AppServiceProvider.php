<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
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
     *
     * @return void
     */
    public function boot(): void
    {
        Schema::useNativeSchemaOperationsIfPossible(!App::runningUnitTests());
        Schema::defaultStringLength(191);
        Model::preventLazyLoading(!app()->isProduction());
        Paginator::useBootstrapFive();

        // Blade money directive
        Blade::directive('money', function ($amount) {
            return "<?php echo '$' . number_format($amount, 2); ?>";
        });
    }
}
