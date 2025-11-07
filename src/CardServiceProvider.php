<?php

namespace Hcuro\NovaBreadcrumb;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class CardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../dist' => public_path('vendor/nova-breadcrumb'),
        ], 'nova-breadcrumb-assets');

        Nova::serving(function (ServingNova $event) {
            $distPath = __DIR__.'/../dist';

            // Check if files exist, if not use published assets
            if (file_exists($distPath.'/js/card.js')) {
                Nova::script('nova-breadcrumb', $distPath.'/js/card.js');
            } else {
                Nova::script('nova-breadcrumb', asset('vendor/nova-breadcrumb/js/card.js'));
            }

            if (file_exists($distPath.'/css/card.css')) {
                Nova::style('nova-breadcrumb', $distPath.'/css/card.css');
            } else {
                Nova::style('nova-breadcrumb', asset('vendor/nova-breadcrumb/css/card.css'));
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
