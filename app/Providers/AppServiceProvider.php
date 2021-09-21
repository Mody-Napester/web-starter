<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Testimonials;
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
        // Using closure based composers...
        view()->composer('@public._layouts.master', function ($view) {
            $clients = Client::all();
            $partners = Partner::all();
            $services = Service::all();
            $testimonials = Testimonials::all();

            $view->with('clients', $clients);
            $view->with('partners', $partners);
            $view->with('services', $services);
            $view->with('testimonials', $testimonials);
        });
    }
}
