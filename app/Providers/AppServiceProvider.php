<?php

namespace App\Providers;

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
        //
        if (!\Illuminate\Database\Eloquent\Collection::hasMacro('paginate')) {

                \Illuminate\Database\Eloquent\Collection::macro('paginate',
                    function ($perPage = 15, $page = null, $options = []) {
                    $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
                    return (new \Illuminate\Pagination\LengthAwarePaginator(
                        $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                        ->withPath('');
                });
        }
    }
}
