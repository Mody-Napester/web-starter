<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
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
        view()->composer('@public/_layouts/master', function ($view) {
            $clients = Client::all();
            $partners = Partner::all();
            $services = Service::all();
            $testimonials = Testimonial::all();
            $general_settings = Setting::where('id', 1)->first();

            $view->with('clients', $clients);
            $view->with('partners', $partners);
            $view->with('services', $services);
            $view->with('testimonials', $testimonials);
            $view->with('general_settings', $general_settings);
        });

        view()->composer('@dashboard/_layouts/master', function ($view) {
            $general_settings = Setting::where('id', 1)->first();

            $view->with('general_settings', $general_settings);
        });
    }
}
