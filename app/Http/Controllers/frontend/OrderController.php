<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\Commune;
use App\Models\Delivery;
use App\Models\FreeShip;
use App\Models\InfoShop;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Province;
use App\Models\UsedCoupon;
use App\Models\UsedFreeShip;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cart $cart, Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $cart_to = 0;
            $order = session()->get('order') ? session()->get('order') : [];
            foreach ($order as $item) {
                $cart_to += ($item['cart']->getProducts->sale_price > 0 ? $item['cart']->getProducts->sale_price : $item->getProducts->price) * $item['quantity'];
            }
            $cart_tot = $cart_to;
            if (session()->get('shipping')) {
                if (session()->get('freeship')) {
                    if ((session()->get('shipping')['price'] - session()->get('freeship')['discount']) > 0) {
                        $shiping = session()->get('shipping')['price'] - session()->get('freeship')['discount'];
                        $freeship_id = session()->get('freeship')['id'];
                    } else {
                        $freeship_id = session()->get('freeship')['id'];

                        $shiping = 0;
                    }
                } else {
                    $freeship_id = '';

                    $shiping = session()->get('shipping')['price'];
                }
            } else {
                $shiping = 0;
            }
            if (session()->get('coupon')) {
                if (session()->get('coupon')['condition'] == 0) {
                    $coupon = $cart_tot * ((100 - (session()->get('coupon')['discount'])) / 100);
                    $coupon_id = session()->get('coupon')['id'];
                } else {
                    $coupon_id = session()->get('coupon')['id'];
                    $coupon = session()->get('coupon')['discount'];
                }
            } else {

                $coupon = 0;
                $coupon_id = '';
            }

            $cart_total_in_order = $cart_tot - $coupon + $shiping;
        } else {
            $cart_total_in_order = 0;
        }
        if (session()->get('shipping')) {
            $id_xa = session()->get('shipping')['xa_id'];
            $quanhuyen = Province::where('matp', session()->get('shipping')['tp_id'])->get();
            $xa = Commune::where('maqh', session()->get('shipping')['qh_id'])->get();
            $tp_name = Delivery::find(session()->get('shipping')['id'])->getCity->name;
            $qh_name = Delivery::find(session()->get('shipping')['id'])->getProvince->name;
            $xa_name = Delivery::find(session()->get('shipping')['id'])->getCommune->name;
        } else {
            $quanhuyen  = [];
            $xa  = [];
            $id_xa  = 0;
            $tp_name = '';
            $qh_name = '';
            $xa_name = '';
        }


        $total_order = 0;
        $order = session()->get('order') ? session()->get('order') : [];
        $cities = City::all();
        $payment = Payment::where('status', 1)->get();
        foreach ($order as $item) {
            $total_order += ($item['cart']->getProducts->sale_price > 0 ? $item['cart']->getProducts->sale_price : $item->getProducts->price) * $item['quantity'];
        }

        return view('frontend.pages.order.list_order', compact('xa_name', 'qh_name', 'tp_name', 'order', 'cities', 'total_order', 'quanhuyen', 'xa',  'id_xa', 'payment', 'cart_total_in_order'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    public function check_freeship(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            if ($request->freeship == '') {
                $request->session()->forget('freeship');
                return response()->json([
                    'message' => 'error'
                ], status: 500);
            } else {
                $freeship  = FreeShip::where('code', $request->freeship)->first();
                if ($freeship->status == 1) {
                    if ($freeship == null) {
                        Toastr::error('SuccessAlert', 'Lorem ipsum dolor sit amet.');
                        $request->session()->forget('freeship');
                        return response()->json([
                            'message' => 'error'
                        ], status: 500);
                    } else {

                        $check2 = UsedFreeShip::where('user_id', Auth::guard('customer')->user()->id)->where('free_ship_id', $freeship->id)->count();
                        $check3 = UsedFreeShip::where('free_ship_id', $freeship->id)->groupBy('free_ship_id')->count();
                        if ($check3 < $freeship->quantity) {
                            if ($check2 == 1) {
                                return response()->json([
                                    'code' => 400,
                                    'message' => 'Đã áp dụng'
                                ], status: 500);
                            } else {
                                $free = [
                                    'id' => $freeship->id,
                                    'code' => $freeship->code,
                                    'discount' => $freeship->discount,
                                ];
                                session()->put(
                                    'freeship',
                                    $free
                                );
                                return '- ' . number_format(session()->get('freeship')['discount'], 0, ',', '.') . ' VND';
                            }
                        } else {
                            return response()->json([
                                'code' => 400,
                                'message' => 'Đã áp dụng'
                            ], status: 500);
                        }
                    }
                }else{
                    return response()->json([
                        'code' => 400,
                        'message' => 'Đã áp dụng'
                    ], status: 500);
                }
            }
        }
    }
    public function getTotalPrice()
    {
        if (Auth::guard('customer')->check()) {
            $cart_to = 0;
            $order = session()->get('order') ? session()->get('order') : [];
            foreach ($order as $item) {
                $cart_to += ($item['cart']->getProducts->sale_price > 0 ? $item['cart']->getProducts->sale_price : $item->getProducts->price) * $item['quantity'];
            }
            $cart_tot = $cart_to;
            if (session()->get('shipping')) {
                if (session()->get('freeship')) {
                    if ((session()->get('shipping')['price'] - session()->get('freeship')['discount']) > 0) {
                        $shiping = session()->get('shipping')['price'] - session()->get('freeship')['discount'];
                        $freeship_id = session()->get('freeship')['id'];
                    } else {
                        $freeship_id = session()->get('freeship')['id'];

                        $shiping = 0;
                    }
                } else {
                    $freeship_id = '';

                    $shiping = session()->get('shipping')['price'];
                }
            } else {
                $shiping = 0;
            }
            if (session()->get('coupon')) {
                if (session()->get('coupon')['condition'] == 0) {
                    $coupon = $cart_tot * ((100 - (session()->get('coupon')['discount'])) / 100);
                    $coupon_id = session()->get('coupon')['id'];
                } else {
                    $coupon_id = session()->get('coupon')['id'];
                    $coupon = session()->get('coupon')['discount'];
                }
            } else {

                $coupon = 0;
                $coupon_id = '';
            }

            $cart_total = $cart_tot - $coupon + $shiping;
        } else {
            $cart_total = 0;
        }
        return number_format($cart_total, 0, ',', '.') . ' VND';
    }
    public function getShippingDetail(Request $request)
    {
        $user =  User::find($request->user_id);
        $address =   $request->address;
        $user->update([
            'address' => $address,
        ]);
        if ($user->update()) {
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function getOrder(Request $request)
    {

        if (Auth::guard('customer')->check()) {
            $cart_to = 0;
            $order = session()->get('order') ? session()->get('order') : [];
            foreach ($order as $item) {
                $cart_to += ($item['cart']->getProducts->sale_price > 0 ? $item['cart']->getProducts->sale_price : $item->getProducts->price) * $item['quantity'];
            }

            $cart_tot = $cart_to;
            if (session()->get('shipping')) {
                $shiping_id = session()->get('shipping')['id'];
                if (session()->get('freeship')) {
                    if ((session()->get('shipping')['price'] - session()->get('freeship')['discount']) > 0) {
                        $shiping = session()->get('shipping')['price'] - session()->get('freeship')['discount'];
                        $freeship_id = session()->get('freeship')['id'];
                        $freeship = session()->get('freeship')['discount'];
                    } else {
                        $freeship_id = session()->get('freeship')['id'];
                        $freeship = session()->get('freeship');
                        $shiping = 0;
                    }
                } else {
                    $freeship_id = null;
                    $freeship = 0;
                    $shiping = session()->get('shipping')['price'];
                }
            } else {
                $shiping_id = 0;
                $shiping = 0;
            }
            if (session()->get('coupon')) {
                if (session()->get('coupon')['condition'] == 0) {
                    $coupon = $cart_tot * ((100 - (session()->get('coupon')['discount'])) / 100);
                    $coupon_id = session()->get('coupon')['id'];
                } else {
                    $coupon_id = session()->get('coupon')['id'];
                    $coupon = session()->get('coupon')['discount'];
                }
            } else {
                $coupon = 0;
                $coupon_id = null;
            }
            $cart_total = $cart_tot - $coupon + $shiping;
        }

        if ($request->payment == 2) {
            $status = 1;
            $status_payment = 1;
        } else {
            $status = 0;
            $status_payment = 0;
        }


        $checkout =   Order::create([
            'user_id' => $request->user_id,
            'address' => $request->address,
            'note' => $request->note,
            'total' => $cart_total,
            'delivery_id' => $shiping_id,
            'coupon_id' => $coupon_id,
            'free_ship_id' => $freeship_id,
            'payment_id' => $request->payment, 'status' => 0,
            'status_payment' => $status_payment
        ]);
        if ($checkout) {
            $info = InfoShop::orderBy('id')->where('status', 1)->first();
            $now  =  Carbon::now('Asia/Ho_Chi_Minh')->toRfc850String();

            foreach ($order as $item) {
                $quantity = $item['quantity'];
                $price = $item['cart']->getProducts->sale_price > 0 ? $item['cart']->getProducts->sale_price : $item->getProducts->price;
                $product_id = $item['cart']->getProducts->id;
                OrderDetail::create([
                    'order_id' => $checkout->id,
                    'product_id' => $product_id,
                    'price' => $price,
                    'quantity' => $quantity
                ]);
                Cart::find($item['id'])->update([
                    'status' => 0
                ]);
            }
            if (session()->get('coupon')) {
                UsedCoupon::create([
                    'user_id' => $request->user_id,
                    'coupon_id' => session()->get('coupon')['id']
                ]);
            }
            if (session()->get('freeship')) {
                UsedFreeShip::create([
                    'user_id' => $request->user_id,
                    'free_ship_id' => session()->get('freeship')['id']
                ]);
            }

            $data = [
                'order' =>  $order,
                'info' => $info,
                'now' => $now,
                'mail_send' => $request->mail_send,
                'payment' => $request->payment,
                'address' => $request->address,
                'cart_total' => $cart_total,
                'shipping' => $shiping, 'coupon' => $coupon,
                'freeship' => $freeship
            ];
            Mail::send('frontend.pages.order.mail_order_success', ['data' => $data], function ($message) use ($data) {
                $message->from('c2009g2@gmail.com');

                $message->to($data['mail_send'])->subject('Đặt hàng thành công');
            });


            session(['order' => []]);
            session()->forget('shipping');
            session()->forget('coupon');
            session()->forget('freeship');

            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function cancel_order(Request $request, $id)
    {
        $order = Order::find($request->id);
        $info = InfoShop::orderBy('id')->where('status', 1)->first();

        $order->update([
            'status' => 5
        ]);
        Mail::send('frontend.pages.order.cancel_mail', array(
            'order' =>  $order,
            'info' => $info,
        ), function ($message) use ($request) {
            $message->from('c2009g2@gmail.com');
            $message->to($request->email_send)->subject('Thông báo hủy đơn hàng');
        });
    }
    public function success_order()
    {
        return view('frontend.pages.order.thank_order');
    }
}
