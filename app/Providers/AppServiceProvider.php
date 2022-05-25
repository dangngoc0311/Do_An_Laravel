<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\InfoShop;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        $brand = Brand::where('status', 1)->get() ? Brand::where('status', 1)->get() : [];
        $category = Category::where('status', 1)->get() ? Category::where('status', 1)->get() : [];
        $info = InfoShop::orderBy('id')->where('status', 1)->first() ? InfoShop::orderBy('id')->where('status', 1)->first() : [];


        view()->share(
            ['brand' => $brand, 'category' => $category, 'infoShop' => $info]
        );
        view()->composer('*', function ($view) {

            if (Auth::guard('customer')->check()) {
                $count = Cart::where("user_id", Auth::guard('customer')->user()->id)->where('status', 1)->count();
                $wishlist_count = Wishlist::where("user_id", Auth::guard('customer')->user()->id)->where('status', 1)->count();

                $cart = Cart::where('user_id', Auth::guard('customer')->user()->id)->where('status', 1)->get();
                $cart_mini = Cart::where('user_id', Auth::guard('customer')->user()->id)->where('status', 1)->orderBy('created_at','DESC')->limit(2)->get();
                $cart_total = 0;
                foreach ($cart as $value) {
                    $cart_total += ($value->getProducts->sale_price > 0  ? $value->getProducts->sale_price : $value->price) * $value->quantity;
                }
            } else {
                $cart_mini = [];
                $count = 0;
                $cart_total = 0;
                $wishlist_count = 0;
            }
           if (Auth::guard('admin')->check()) {
               $user_admin = User::find(Auth::guard('admin')->user()->id);
           }else{
               $user_admin=[];
           }

            $view->with([
                'cart' => $cart_mini, 'count' => $count, 'cart_total' => $cart_total, "wishlist_count" => $wishlist_count , "admin"=>$user_admin
            ]);
        });
    }
}
