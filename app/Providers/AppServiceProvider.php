<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use App\Models\Employee;
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
        view()->share([
            'user_counter' => User::all()->count(),
            'client_counter' => Client::all()->count(),
            'category_counter' => Category::all()->count(),
            'item_counter' => Item::all()->count(),
            'order_done_counter' => Order::where('status' , 1)->orWhere('payment',1)->count(),
            'order_undone_counter' => Order::where('status' ,'!=' ,1)->orWhere('payment','!=',1)->count(),
            'employee_counter' => Employee::all()->count(),
        ]);
    }
}
