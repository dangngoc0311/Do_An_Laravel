<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\InfoShop;
use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::orderBy('created_at','DESC')->paginate(5);
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            $pieces = explode("_", $sortBy);
            $order = Order::orderBy($pieces[0], $pieces[1])->paginate(5);
        }
        if (isset($_GET['status'])) {
            $sortBy = $_GET['status'];
            $order = Order::where('status', $sortBy)->paginate(5);
        }
        return view('backend.pages.order.list_order', compact('order'));
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
    public function show(Order $order, $id)
    {
        $order = Order::find($id);
        $info = InfoShop::orderBy('id')->where('status', 1)->first();

        return view('backend.pages.order.order_detail', compact('order', 'info'));
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
    public function update(Request $request, Order $order, $id)
    {
        $order = Order::find($id);
        $info = InfoShop::orderBy('id')->where('status', 1)->first();
        $now  =  Carbon::now('Asia/Ho_Chi_Minh')->toRfc850String();

        $order->update([
            'status' => $request->status
        ]);
        if ($order->status == 4) {
            $order->update([
                'status_payment' => 1
            ]);
            Mail::send('backend.pages.order.mail', array(
                'order' =>  $order,
                'info' => $info,
                'now' => $now
            ), function ($message) use ($request) {
                $message->from('c2009g2@gmail.com');
                $message->to($request->email_send)->subject('Thông báo giao hàng thành công');
            });
        }
        if ($order->status == 5) {
            if ($order->payment_id == 2) {
                $order->update([
                    'status_payment' => 2
                ]);
            }

            Mail::send('backend.pages.order.sorry_mail', array(
                'order' =>  $order,
                'info' => $info,
                'now' => $now
            ), function ($message) use ($request) {
                $message->from('c2009g2@gmail.com');
                $message->to($request->email_send)->subject('Thông báo hủy đơn hàng');
            });
        }
        if ($order) {
            Toastr::success('', 'Cập nhật thành công', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->route('don-hang.index');
        } else {
            Toastr::error('', 'Không cập nhật ', [
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
    public function pdfl($id)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($id));
        return $pdf->stream();
    }
    public function print_order_convert($id)
    {
        $order = Order::find($id);
        $info = InfoShop::orderBy('id')->where('status', 1)->first();
        $output = '';
        $output = '

        <!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <style>


            body{
                font-family:DejaVu Sans !important;
            }


            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }

            .text-center {
                text-align: center!important;
            }
            .table {
                width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
            }
            thead {
                display: table-header-group;
                vertical-align: middle;
                border-color: inherit;
            }table {
                border-collapse: collapse;
            }
            tr {
                display: table-row;
                vertical-align: inherit;
                border-color: inherit;
            }
            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }
            .table td, .table th {
                padding: .75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }
            tbody {
                display: table-row-group;
                vertical-align: middle;
                border-color: inherit;
            }
            address {
                margin-bottom: 1rem;
                font-style: normal;
                line-height: inherit;
            }
            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, .05);
            }
       </style>
       </head>
  <body>
        <div class="row invoice-info">
        <div class="col-12 table-responsive">
        <table class="table  text-center "  style="border:1px  dotted #000;">
            <tr >
            <td  style="border:1px  dotted #000;">
            From
            <address>
            <strong>Organic Admin</strong><br>
            ' . $info->address . '<br>
            Phone: ' . $info->phone . '<br>
            Email: ' . $info->email . '
            </address>
            </td>
            <td  style="border:1px  dotted #000;">
            To
            <address>
                <strong>' . $order->user->name . '</strong><br>
                ' . $order->address . ' - ' . $order->deliveries->getCommune->name . '<br>
                - ' . $order->deliveries->getProvince->name . '
                - ' . $order->deliveries->getCity->name . '
                <br>
                Phone: ' . $order->user->phone . '<br>
                Email: ' . $order->user->email . '
            </address>
            </td>
            </tr>
        </table>
        </div>





        </div>
        <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped text-center table-styling">
        <thead>
            <tr>
                <th>Tên </th>
                <th>Số lượng</th>
                <th>Gía</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>';
        $total_order = 0;

        foreach ($order->order_detail as $key => $value) {
            $total_order += $value->price * $value->quantity;
            $output .= '
            <tr>
                <td>' . $value->productInOrderDetail->name . '</td>
                <td>' . $value->quantity . '</td>
                <td>' . number_format($value->price, 0, ',', '.') . ' VND' . '</td>
                <td>' . number_format($value->price * $value->quantity, 0, ',', '.') . ' VND' . '
                </td>
            </tr>';
        }
        $output .= '
        </tbody>
       </table>
       </div>
       </div>
        <div class="row">

        <div class="col-12 table-responsive">
        <table class="table  text-center ">
            <tr>
                <td>
                <b class="lead">Phương thức thanh toán:</b>
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    ' . $order->payment->name . '
                </p>
                <b class="lead">Tình trạng thanh toán:</b>
                <p class="text-muted" style="margin-top: 10px;">
                ';
        if ($order->status_payment == 0) {
            $output .= '                                            Chưa thanh toán
    ';
        } elseif ($order->status_payment == 1) {
            $output .= '                                            Đã thanh toán
    ';
        } else {
            $output .= 'Đã hoàn trả thanh toán';
        }
        $output .= '</p>
            </td>
                <td>
                <table class="table">
                <tr>
                    <th style="width:50%">Tiền:</th>
                    <td> ' . number_format($total_order, 0, ',', '.') . ' VND' . '
                    </td>
                </tr>';
        if ($order->coupon_id) {
            $output .= '
                    <tr>
                    <th>Tiền giảm giá</th>
                    <td>-';
            if ($order->coupon->condition == 0) {
                $output .= '
        ' . number_format(($total_order * $order->coupon->discount) / 100, 0, ',', '.') . ' VND' . '
        ';
            } else {
                $output .= '
        ' . number_format($order->coupon->discount, 0, ',', '.') . ' VND' . '';
            }
            $output .= '   </td>
                    </tr>';
        }
        $output .= '
            <tr>
                <th>Tiền ship:</th>
                <td>
                    ' . number_format($order->deliveries->price, 0, ',', '.') . ' VND' . '
                </td>
            </tr>';
        if ($order->free_ship_id) {
            $output .= '
            <tr>
                <th>Free ship:</th>
                <td>
                    -
                    ' . number_format($order->freeship->discount, 0, ',', '.') . ' VND' . '
                    </td>
                    <tr>
                    ';
        }
        $output .= '

            </table>
                </td>
            </tr>
        </table>
        </div>


            </div>

            <div class="col-12 table-responsive">
            <table class="table  text-center " border=1>

                    <thead>
                    <tr>
                        <th>Người lập phiếu </th>
                        <th>Người nhận</th>
<th>Tiền thu
</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                <td >
                Organic Admin
                    </td>
                    <td >

                    </td>
                    <td >
                    ' . number_format($order->total, 0, ',', '.') . ' VND' . '
                    </td>
                </tr>
</tbody>

            </table>
            </div>

        </div>
      </body>
    </html>
        ';
        return $output;
    }
}
