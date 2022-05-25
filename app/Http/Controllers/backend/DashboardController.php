<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\FreeShip;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ReviewProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Order $orders)
    {
        $now = Carbon::now()->format('Y-m-d');

        $coupon_1 = Coupon::select(array(
            'id',
            'name',
            'discount',
            'status',
            'slug',
            DB::raw("DATEDIFF(end_date,'$now')AS end"),
            DB::raw("DATEDIFF('$now',start_date)AS start")
        ))->get();
        foreach ($coupon_1 as $key => $value) {
            if ($value->start >= 0) {
                if ($value->end < 0) {
                    Coupon::find($value->id)->update([
                        'status' => 0
                    ]);
                } else {
                    Coupon::find($value->id)->update([
                        'status' => 1
                    ]);
                }
            } else {
                Coupon::find($value->id)->update([
                    'status' => 0
                ]);
            }
        }
        $free_ship_1 = FreeShip::select(array(
            'id',
            'name',
            'discount',
            'status',
            'slug',
            DB::raw("DATEDIFF(end_date,'$now')AS end"),
            DB::raw("DATEDIFF('$now',start_date)AS start")
        ))->get();
        foreach ($free_ship_1 as $key => $value) {
            if ($value->start >= 0) {
                if ($value->end < 0) {
                    FreeShip::find($value->id)->update([
                        'status' => 0
                    ]);
                } else {
                    FreeShip::find($value->id)->update([
                        'status' => 1
                    ]);
                }
            } else {
                FreeShip::find($value->id)->update([
                    'status' => 0
                ]);
            }
        }
        $category = Category::where('status', 1)->limit(5)->get();
        $sale = Order::select(DB::raw('MONTH(created_at) as month'), DB::raw('sum(total) as money'))->groupBy('month')->where('status', '!=', 5)->get();
        $total_year = 0;
        foreach ($sale as $key => $value) {
            $total_year  += $value->money;
        }
        $product = Product::all();
        foreach ($product as $key => $value) {
            if (isset($value->getInventoryById($value->id)->qty)) {
                if ($value->getInventoryById($value->id)->qty >= $value->import_quantity) {
                    // dd( Product::find($value->id));
                    Product::find($value->id)->update([
                        'status' => 0,
                        'isHot' => 0
                    ]);
                }
            }
        }
        $sale_month = Order::select(DB::raw('MONTH(created_at) as month'), DB::raw('sum(total) as money'))->groupBy('month')->where(DB::raw('MONTH(created_at)'), Carbon::now()->month)->where('status', '!=', 5)->first();
        $order = Order::select(DB::raw('count(*) as total_order'))->where('status', '!=', 5)->first();
        $user = User::where('role', 'customer')->where('status', 1)->count();
        $list_order = Order::orderBy('created_at', 'DESC')->where('status', '!=', 5)->limit(5)->get();
        $hot_product = OrderDetail::select('order_details.product_id', DB::raw('SUM(order_details.quantity) as qty'))->groupBy('order_details.product_id')->orderBy('qty', 'DESC')->limit(4)->get();
        return view('backend.pages.dashboard', compact('category', 'sale', 'sale_month', 'order', 'user', 'total_year', 'orders', 'list_order', 'hot_product'));
    }
    public function register()
    {
        return view('backend.pages.login_register.register_admin');
    }
    public function register_post(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if ($user) {
            Toastr::success('SuccessAlert', 'Lorem sipsum dolor sit amet.');
            return redirect()->route('admin.login');
        } else {
            Toastr::error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return redirect()->back();
        }
    }
    public function login()
    {
        return view('backend.pages.login_register.login_admin');
    }
    public function login_post(Request $request)
    {
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.home');
        } else {
            Toastr::error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return redirect()->back();
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function feedback(ReviewProduct $reviews)
    {
        $review = DB::table('review_products')->join('order_details', 'order_details.id', '=', 'review_products.order_detail_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('review_products.*', 'users.name AS user_name', 'users.image AS user_image', 'products.name AS product_name')
            ->paginate(5);
        if (isset($_GET['star'])) {
            $sortBy = $_GET['star'];
            $review = DB::table('review_products')->join('order_details', 'order_details.id', '=', 'review_products.order_detail_id')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->join('orders', 'orders.id', '=', 'order_details.order_id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->select('review_products.*', 'users.name AS user_name', 'users.image AS user_image', 'products.name AS product_name')->where('review_products.rating', $sortBy)->paginate(5);
        }
        if (isset($_GET['keyword'])) {
            $search = $_GET['keyword'];
            $review = DB::table('review_products')->join('order_details', 'order_details.id', '=', 'review_products.order_detail_id')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->join('orders', 'orders.id', '=', 'order_details.order_id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->select('review_products.*', 'users.name AS user_name', 'users.image AS user_image', 'products.name AS product_name')->where('products.name', 'like', '%' . $search . '%')->paginate(5);
        }
        return view('backend.pages.product.feedback', compact('review', 'reviews'));
    }
    public function unactive($id)
    {
        ReviewProduct::where('id', $id)->update(['status' => 1]);
        Toastr::success('', 'Cập nhật trạng thái thành công', [
            "closeButton" => true, "progressBar" => true, "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "2000",
            "extendedTimeOut" => "1000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut"
        ]);
        return redirect()->route('admin.feedback');
    }
    public function active($id)
    {
        ReviewProduct::where('id', $id)->update(['status' => 0]);
        Toastr::success('', 'Cập nhật trạng thái thành công', [
            "closeButton" => true, "progressBar" => true, "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "2000",
            "extendedTimeOut" => "1000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut"
        ]);
        return redirect()->route('admin.feedback');
    }
}
