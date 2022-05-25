<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\AddRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\CategoryGallery;
use App\Models\Contact;
use App\Models\Farmer;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Product $hot_product)
    {

        $categories = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->where('products.isHot', 1)->limit(3)
            ->select('categories.*')

            ->groupBy('categories.id','categories.name','categories.slug','categories.status','categories.created_at','categories.updated_at')

            ->get();
        $hot_pro = Product::where('status', 1)->where('isHot', 1)->orderBy('created_at', 'DESC')->limit(8)->get();
        $new_arrival = Product::where('status', 1)->orderBy('created_at', 'DESC')->limit(5)->get();
        $banner = Banner::where('status', 1)->get();
        $new_blog  = Blog::where('status', 1)->orderBy('created_at', 'DESC')->limit(4)->get();
        return view('frontend.pages.home', compact('banner', 'new_arrival', 'categories', 'hot_product', 'new_blog', 'hot_pro'));
    }
    public function login()
    {
        return view('frontend.pages.login.login');
    }
    public function login_post(Request $request)
    {
        // dd($request->all());
        if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
            $user_password = [
                'password' => $request->password,
            ];
            session()->put(
                'user_password',
                $user_password
            );
            $users = User::find(Auth::guard('customer')->user()->id);
            $check = Cart::where('user_id', $users->id)->where('product_id', $request->product_id)->count();
            if ($request->action == 'addCart') {
                // dd($check);
                if ($check == 0) {
                    $list_cart =  Cart::create([
                        'quantity' => 1,
                        'product_id' => $request->product_id,
                        'user_id' => $users->id,
                        'status' => 1
                    ]);
                } else {
                    $quantity = $request->quantity;
                    $cart =  Cart::where('user_id', $users->id)->where('product_id', $request->product_id)->first();
                    $cart2 =  Cart::find($cart->id);
                    $qty = ($cart->quantity += $quantity);
                    $list_cart = $cart2->update([
                        'quantity' => $qty
                    ]);
                }
                if ($list_cart) {
                    return redirect()->route('gio-hang.index');
                }
            }
            if ($request->action == 'addFavorite') {
                $check = Wishlist::where('user_id', $users->id)->where('product_id', $request->product_id)->where('status', 1)->count();
                if ($check == 0) {
                    $wishlist = Wishlist::create([
                        'user_id' => $users->id,
                        'product_id' => $request->product_id
                    ]);
                    if ($wishlist) {
                        Toastr::success('', 'Đã thêm vào danh sách yêu thích', [
                            "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                            "hideDuration" => "1000",
                            "timeOut" => "2000",
                            "extendedTimeOut" => "1000",
                            "showEasing" => "swing",
                            "hideEasing" => "linear",
                            "showMethod" => "fadeIn",
                            "hideMethod" => "fadeOut"
                        ]);
                        return redirect()->route('san-pham-yeu-thich.index');
                    }
                } else {
                    Toastr::error('', 'Sản phẩm đã có trong danh sách ', [
                        "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                        "hideDuration" => "1000",
                        "timeOut" => "2000",
                        "extendedTimeOut" => "1000",
                        "showEasing" => "swing",
                        "hideEasing" => "linear",
                        "showMethod" => "fadeIn",
                        "hideMethod" => "fadeOut"
                    ]);
                    return redirect()->route('san-pham-yeu-thich.index');
                }
            }
            if ($request->page === 'detail_blog') {
                $blog =  Blog::find($request->blog_id);
                return redirect()->route('danh-sach-bai-viet.show', $blog->slug);
            }
            return redirect()->route('customer.home');
        } else {
            return redirect()->back();
        }
    }
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }
    public function store(RegisterRequest $request)
    {
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if ($user) {
            return redirect()->route('customer.login');
        } else {
            return redirect()->back();
        }
    }
    public function create()
    {
        return view('frontend.pages.login.register');
    }
    public function profile()
    {
        return view('frontend.pages.account.my_profile');
    }
    public function saveImage(Request $request)
    {
        $id = $request->id;
        $user =  User::find($id);
        if ($request->password) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            $user_password = [
                'password' => $request->password,
            ];
            session()->put(
                'user_password',
                $user_password
            );
            return redirect()->route('customer.profile');
        }

        if ($request->has('files')) {
            $file = $request->file('files');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/user'), $file_name);
        } else {
            $file_name = $user->image;
        }
        $request->merge(['image' => $file_name]);
        $user->update($request->all());
        if ($user) {
            return redirect()->route('customer.profile');
        } else {
            return redirect()->back();
        }
    }
    public function contact()
    {
        return view('frontend.pages.contact.contact');
    }
    public function storeContactForm(AddRequest $request)
    {
        Contact::create($request->all());
        Mail::send('frontend.pages.contact.contactMail', array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ), function ($message) use ($request) {
            $message->from($request->email);
            $message->to('c2009g2@gmail.com', 'Admin')->subject($request->get('subject'));
        });
        return redirect()->back();
    }
    public function about()
    {
        $farmer = Farmer::where('status', 1)->get();
        return view('frontend.pages.about', compact('farmer'));
    }
    public function getHotProducts($cate_product_id)
    {
        $hot_product =  Product::where('status', '1')->where('isHot', 1)->where('category_id', 1)->orderBy('created_at', 'DESC')->limit(3)->get();
        dd($hot_product);

        return $hot_product;
    }
    public function gallery(Gallery $gallery)
    {
        $cate_gallery = CategoryGallery::where('status', 1)->get();
        return view('frontend.pages.gallery', compact('cate_gallery', 'gallery'));
    }
    // public function index_cke()
    // {
    //     $path

    //     return view('ckeditor.ckeditor');
    // }
    public function index_upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images_ckeditor'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images_ckeditor/' . $fileName);
            $msg = 'Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
    public function search_product(Request $request)
    {
        $product = Product::orderBy('id', 'DESC')->where('name', 'like', '%' . $request->keywords . '%')->paginate(6);
        return view('frontend.pages.shop.shop', compact('product'));
    }
    public function forgot_pass(Request $request)
    {

        $customer = User::where('email', $request->email)->where('status', 1)->first();
        if ($customer) {

            $token_member = Str::random(20);
            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
            $title_mail = "Lấy lại mật khẩu " . $now;
            $user = User::find($customer->id);
            $link_reset = url('/update_password?email=' . $request->email . '&token=' . $token_member . '');

            $user->update([
                'remember_token' => $token_member
            ]);
            if ($user->update()) {
                $data = [
                    "name" => $title_mail,
                    "body" => $link_reset,
                    "email" => $request->email
                ];
                Mail::send('frontend.pages.login.mail_forgot_password', ['data' => $data], function ($message) use ($data, $title_mail) {
                    $message->from($data['email']);
                    $message->to($data['email'])->subject($title_mail);
                });
                Toastr::success('', 'Gui mail thanh cong', [
                    "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                    "hideDuration" => "1000",
                    "timeOut" => "2000",
                    "extendedTimeOut" => "1000",
                    "showEasing" => "swing",
                    "hideEasing" => "linear",
                    "showMethod" => "fadeIn",
                    "hideMethod" => "fadeOut"
                ]);
                return redirect()->back();
            }else{
                Toastr::error('', 'khong the gui mail_forgot_password', [
                    "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                    "hideDuration" => "1000",
                    "timeOut" => "2000",
                    "extendedTimeOut" => "1000",
                    "showEasing" => "swing",
                    "hideEasing" => "linear",
                    "showMethod" => "fadeIn",
                    "hideMethod" => "fadeOut"
                ]);
                return redirect()->back();
            }

        } else {
            Toastr::error('', 'Email chua duoc dang ky', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->back();
        }
    }
    public function update_password_view()
    {
        return view('frontend.pages.login.update_password');
    }
    public function update_password(Request $request)
    {
        $customer = User::where('email', $request->email)->where('status', 1)->where('remember_token', $request->_token_value)->first();
        $user = User::find($customer->id);
        $user->update([
            "password" => bcrypt($request->password)
        ]);
        if ($user->update()) {
            Toastr::success('', 'Thay djdhj thanh cong', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->route('customer.login');
        }else{
            Toastr::error('', 'Khong the doi mk moi', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->back();
        }
    }
    public function view_forgot()
    {
        return view('frontend.pages.login.forgot_password');
    }
    public function brand($slug){
       $brands =  Brand::where('slug',$slug)->first();
    //    dd($brands);
        return view('frontend.pages.account.brand_info',compact('brands'));
    }
}
