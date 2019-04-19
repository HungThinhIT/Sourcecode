<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Spa\Slider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Truyen bien $rootURL de su dung source link o noi khac-- Hung Thinh
        $this->rootURL();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        Carbon::setLocale('vi');
        $this->footer();
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
    public function footer() {
        view()->composer('spa.footer',function($view) {
            $sliders = Slider::take(6)->get();
            $view->with('sliders', $sliders);
        });
    }
    public function rootURL(){
        // Get the current URL without the query string...
        // echo url()->current();

        // // Get the current URL including the query string...
        // echo url()->full();

        // // Get the full URL for the previous request...
        // echo url()->previous();
        $rootURL = url()->current()."#";
        view()->share('rootURL',$rootURL);
    }
}
