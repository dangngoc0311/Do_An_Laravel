<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\Commune;
use App\Models\Coupon;
use App\Models\Delivery;
use App\Models\Product;
use App\Models\Province;
use App\Models\UsedCoupon;
use App\Models\Wishlist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(session()->all());
        if (Auth::guard('customer')->check()) {
            $cart_to = 0;
            $cart = Cart::where('user_id', Auth::guard('customer')->user()->id)->where('status', 1)->get();
            foreach ($cart as $value) {
                $cart_to += ($value->getProducts->sale_price > 0  ? $value->getProducts->sale_price : $value->price) * $value->quantity;
            }
            $cart_tot = $cart_to;
            if (session()->get('shipping')) {
                if (session()->get('freeship')) {
                    if ((session()->get('shipping')['price'] - session()->get('freeship')['discount']) > 0) {
                        $shiping = session()->get('shipping')['price'] - session()->get('freeship')['discount'];
                    } else {
                        $shiping = 0;
                    }
                } else {
                    $shiping = session()->get('shipping')['price'];
                }
            } else {
                $shiping = 0;
            }
            if (session()->get('coupon')) {
                if (session()->get('coupon')['condition'] == 0) {
                    $coupon = $cart_tot * ((100 - (session()->get('coupon')['discount'])) / 100);
                } else {
                    $coupon = session()->get('coupon')['discount'];
                }
            } else {
                $coupon = 0;
            }

            $cart_total_price = $cart_tot - $coupon + $shiping;
        }

        if (Auth::guard('customer')->check()) {

            $carts = Cart::where('user_id', Auth::guard('customer')->user()->id)->where('status', 1)->orderBy('created_at', 'DESC')->get();
            $cart_to = 0;
            foreach ($carts as $value) {
                $cart_to += ($value->getProducts->sale_price > 0  ? $value->getProducts->sale_price : $value->price) * $value->quantity;
            }
            $cart_tot = $cart_to;
            if (session()->get('shipping')) {
                if (session()->get('freeship')) {
                    if ((session()->get('shipping')['price'] - session()->get('freeship')['discount']) > 0) {
                        $shiping = session()->get('shipping')['price'] - session()->get('freeship')['discount'];
                    } else {
                        $shiping = 0;
                    }
                } else {
                    $shiping = session()->get('shipping')['price'];
                }
            } else {
                $shiping = 0;
            }
            if (session()->get('coupon')) {
                if (session()->get('coupon')['condition'] == 0) {
                    $coupon = $cart_tot * ((100 - (session()->get('coupon')['discount'])) / 100);
                } else {
                    $coupon = session()->get('coupon')['discount'];
                }
            } else {
                $coupon = 0;
            }

            $cart_total_price = $cart_tot - $coupon + $shiping;
            $cities = City::all();
        } else {
            $carts = [];
            $cities = City::all();
            $cart_total_price = 0;
        }
        return view('frontend.pages.cart.list_cart', compact('carts', 'cities', 'cart_total_price'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id = $request->product_id;
        $user_id = $request->user_id;
        $quantity = $request->quantity;
        // dd($request->quantity);
        $check = Cart::where('user_id', $user_id)->where('product_id', $product_id)->where('status', 1)->count();
        $cart =  Cart::where('user_id', $user_id)->where('product_id', $product_id)->where('status', 1)->get();

        // dd($check);
        if ($check == 0) {
            $list_cart =  Cart::create([
                'quantity' => $quantity,
                'product_id' => $product_id,
                'user_id' => $user_id,
                'status' => 1
            ]);
            if ($list_cart) {
                if (isset($request->wishlist_id)) {
                    Wishlist::find($request->wishlist_id)->update([
                        'status' => 0
                    ]);
                }
                return response()->json([
                    'code' => 200,
                    'message' => 'success'
                ], status: 200);
            }
        } else {
            $quantity = $request->quantity;
            $cart =  Cart::where('user_id', $user_id)->where('product_id', $product_id)->where('status', 1)->first();
            $cart2 =  Cart::find($cart->id);

            $qty = ($cart->quantity += $quantity);
            $list_cart = $cart2->update([
                'quantity' => $qty
            ]);
            if ($list_cart) {
                if (isset($request->wishlist_id)) {
                    Wishlist::find($request->wishlist_id)->update([
                        'status' => 0
                    ]);
                }
                return response()->json([
                    'code' => 200,
                    'message' => 'success'
                ], status: 200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart, Request $request)
    {

        $order = session()->get('order') ? session()->get('order') : [];
        $ct = $cart::find($request->id);

        if ($ct->delete()) {
            session()->forget('order');
        }
    }
    public function plusCart(Request $request, Cart $cart)
    {
        $cart = Cart::find($request->id);
        $qty = $cart->quantity;
        $cart->update([
            'quantity' => ($qty += 0.1)
        ]);
        $quantity = $cart->quantity;
        return $quantity;
    }
    public function minusCart(Request $request, Cart $cart)
    {
        $cart = Cart::find($request->id);
        $qty = $cart->quantity;
        if ($qty != 1) {
            $cart->update([
                'quantity' => ($qty -= 0.1)
            ]);
            $quantity = $cart->quantity;
        }
        return $quantity;
    }
    public function multipledelete(Request $request)
    {
        $ids = $request->ids;
        if (Cart::whereIn('id', $ids)->delete()) {
            Toastr::success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return redirect()->route('gio-hang.index');
        }
    }
    public  function getCountCart(Request $request)
    {
        if (Auth::guard('customer')->check()) {

            $count = Cart::where("user_id", Auth::guard('customer')->user()->id)->where('status', 1)->count();
        } else {
            $count = 0;
        }
        return $count;
    }
    public  function getCart(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $cart = Cart::where('user_id', Auth::guard('customer')->user()->id)->where('status', 1)->orderBy('created_at', 'DESC')->get();
        } else {
            $cart = [];
        }
        return view('frontend.pages.cart.minicart', compact('cart'));
    }
    public function getTotalPrice(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $cart_tot = 0;
            $cart = Cart::where('user_id', Auth::guard('customer')->user()->id)->where('status', 1)->get();
            foreach ($cart as $value) {
                $cart_tot += ($value->getProducts->sale_price > 0  ? $value->getProducts->sale_price : $value->price) * $value->quantity;
            }
            $cart_total = $cart_tot;
        } else {
            $cart_total = 0;
        }
        return  number_format($cart_total, 0, ',', '.') . ' VND';
    }
    public function getPrice(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $cart = Cart::find($request->id);
            $total = ($cart->getProducts->sale_price > 0  ? $cart->getProducts->sale_price : $cart->price) * $cart->quantity;
        } else {
            $total = 0;
        }
        return number_format($total, 0, ',', '.') . ' VND';
    }
    public function check_coupon(Request $request)
    {

        if (Auth::guard('customer')->check()) {
            if ($request->coupon == '') {
                $request->session()->forget('coupon');
                return response()->json([
                    'message' => 'error'
                ], status: 500);
            } else {
                $coupon  = Coupon::where('code', $request->coupon)->first();
                if ($coupon->status == 1) {
                    if ($coupon == null) {
                        Toastr::error('SuccessAlert', 'Lorem ipsum dolor sit amet.');
                        $request->session()->forget('coupon');
                        return response()->json([
                            'message' => 'error'
                        ], status: 500);
                    } else {
                        $check2 = UsedCoupon::where('user_id', Auth::guard('customer')->user()->id)->where('coupon_id', $coupon->id)->count();
                        $check3 = UsedCoupon::where('coupon_id', $coupon->id)->groupBy('coupon_id')->count();
                        if ($check3 < $coupon->quantity) {
                            if ($check2 == 1) {
                                return response()->json([
                                    'code' => 400,
                                    'message' => 'Đã áp dụng'
                                ], status: 500);
                            } else {
                                $cou = [
                                    'id' => $coupon->id,
                                    'code' => $coupon->code,
                                    'condition' => $coupon->condition,
                                    'discount' => $coupon->discount,
                                ];
                                session()->put(
                                    'coupon',
                                    $cou
                                );
                                return response()->json([
                                    'code' => 200,
                                    'message' => 'success'
                                ], status: 200);
                            }
                        } else {
                            return response()->json([
                                'code' => 400,
                                'message' => 'Đã áp dụng'
                            ], status: 500);
                        }
                    }
                } else {
                    return response()->json([
                        'code' => 400,
                        'message' => 'Đã áp dụng'
                    ], status: 500);
                }
            }
        }
    }
    public function get_coupon()
    {

        if (Auth::guard('customer')->check()) {
            $cart_to = 0;
            $cart = Cart::where('user_id', Auth::guard('customer')->user()->id)->where('status', 1)->get();
            foreach ($cart as $value) {
                $cart_to += ($value->getProducts->sale_price > 0  ? $value->getProducts->sale_price : $value->price) * $value->quantity;
            }
            $cart_tot = $cart_to;
            if (session()->get('shipping')) {
                if (session()->get('freeship')) {
                    if ((session()->get('shipping')['price'] - session()->get('freeship')['discount']) > 0) {
                        $shiping = session()->get('shipping')['price'] - session()->get('freeship')['discount'];
                    } else {
                        $shiping = 0;
                    }
                } else {
                    $shiping = session()->get('shipping')['price'];
                }
            } else {
                $shiping = 0;
            }
            if (session()->get('coupon')) {
                if (session()->get('coupon')['condition'] == 0) {
                    $coupon = $cart_tot * ((100 - (session()->get('coupon')['discount'])) / 100);
                } else {
                    $coupon = session()->get('coupon')['discount'];
                }
            } else {
                $coupon = 0;
            }

            $cart_total = $cart_tot - $coupon + $shiping;
        } else {
            $cart_total = 0;
        }
        return number_format($cart_total, 0, ',', '.') . ' VND';
    }
    public function get_condition_coupon(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            if (session()->get('coupon')) {
                $condition = session()->get('coupon')['condition'];
                $dis = session()->get('coupon')['discount'];
                if ($condition == 0) {
                    return  'Giảm ' . $dis . ' %';
                } elseif ($condition == 1) {
                    return   'Giảm ' . $dis . ' VND';
                } else {
                    return   'Chưa có mã giảm giá';
                }
            } else {
                return   'Chưa có mã giảm giá';
            }
        }
    }
    public function select_ship(Request  $request)
    {
        if ($request->action) {
            $output = '';
            if ($request->action == 'tp_id') {
                $output .= '<option>--- Chon quan huyen ---</option>';
                $qh = Province::where('matp', $request->ma_id)->orderBy('id', 'ASC')->get();
                foreach ($qh as $key => $value) {
                    $output .= '<option value="' . $value->id . '">' . $value->name . '</option>';
                }
                echo $output;
            } elseif ($request->action == 'qh_id') {
                $output .= '<option>--- Chon xa ---</option>';
                $xa = Commune::where('maqh', $request->ma_id)->orderBy('id', 'ASC')->get();
                foreach ($xa as $key => $value) {
                    $output .= '<option value="' . $value->id . '">' . $value->name . '</option>';
                }
                echo $output;
            }
        }
    }
    public function getProInCart(Request $request)
    {
        if ((session()->get('order'))) {
            session()->forget('order');
        }
        if ($request->ids) {
            $items = session()->get('order') ? session()->get('order') : [];
            foreach ($request->ids as  $value) {
                $cart = Cart::find($value);
                $item = [
                    'id' => $cart->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'cart' => $cart
                ];
                $items[$cart->id] = $item;
            }
            session()->put('order', $items);
        } else {
            $items = session()->get('order') ? session()->get('order') : [];
            $carts = Cart::where('user_id', Auth::guard('customer')->user()->id)->where('status', 1)->pluck('id');
            foreach ($carts as  $value) {
                $cart = Cart::find($value);
                $item = [
                    'id' => $cart->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'cart' => $cart
                ];
                $items[$cart->id] = $item;
            }
            session()->put('order', $items);
        }

        return session()->get('order');
    }
    public function getShipping(Request $request)
    {
        // $request->session()->flush();
        if (Auth::guard('customer')->check()) {
            $check = Delivery::where('tp_id', $request->tp_id)->where('qh_id', $request->qh_id)->where('xa_id', $request->xa_id)->first();
            if ($check) {
                $ship = [
                    'id' => $check->id,
                    'price' => $check->price,
                    'tp_id' => $check->tp_id,
                    'qh_id' => $check->qh_id,
                    'xa_id' => $check->xa_id,
                ];
                session()->put(
                    'shipping',
                    $ship
                );
                return   $check->price . 'VND';
            } else {
                if (session()->get('shipping')) {
                    session()->forget('shipping');
                }
                return  'Khu vực chưa được hỗ trợ ship';
            }
        } else {
            return  '????';
        }
    }
}
