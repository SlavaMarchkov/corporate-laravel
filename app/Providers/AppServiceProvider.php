<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

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
        // Создаем свою директиву
        // @set($i, 10), где $i - это имя переменной, а 10 - значение переменной
        Blade::directive('set', function ($expression) {
            list($var_name, $var_value) = explode(', ', $expression);
            return "<?php $var_name = $var_value; ?>";
        });
        // вешаем прослушку на SQL-запросы к базе данных
		DB::listen(function ($query) {
			// echo '<h2>' . $query->sql . '</h2>';
			// dump($query->bindings);
		});
    }
}
