<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Session;
use App\Models\Order;
use App\Models\TheUser;
use App\Models\Promocode;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $ordersUnderPreparing = Order::where('status', 'Under_Preparing')->count();
        $ordersCancelled = Order::where('status', 'Cancelled')->count();
        $users = TheUser::count();
        $promocodes = Promocode::count();

        app()->singleton('lang',function(){
            if(session()->has('lang'))
                return session()->get('lang');
            else
                return 'ar';
        });

        view()->share('ordersUnderPreparing', $ordersUnderPreparing);
        view()->share('ordersCancelled', $ordersCancelled);
        view()->share('users', $users);
        view()->share('promocodes', $promocodes);

    }
}
