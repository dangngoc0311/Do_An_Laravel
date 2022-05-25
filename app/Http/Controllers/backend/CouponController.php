<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coupon\AddRequest;
use App\Http\Requests\Coupon\UpdateRequest;
use App\Models\Coupon;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');

        $coupon = Coupon::select(array(
            'id',
            'name',
            'discount',
            'status',
            'slug',
            'discount', 'start_date', 'end_date', 'quantity', 'code', 'condition',
            DB::raw("DATEDIFF(end_date,'$now')AS end"),
            DB::raw("DATEDIFF('$now',start_date)AS start")
        ))->search()->paginate(5);

        // $coupon = Coupon::search()->paginate(5);
        if (isset($_GET['filter'])) {
            $sortBy = $_GET['filter'];
            $pieces = $_GET['by'];
            $coupon = Coupon::select(array(
                'id',
                'name',
                'discount',
                'status',
                'slug',
                'discount', 'start_date', 'end_date', 'quantity', 'code', 'condition',
                DB::raw("DATEDIFF(end_date,'$now')AS end"),
                DB::raw("DATEDIFF('$now',start_date)AS start")
            ))->orderBy($sortBy, $pieces)->search()->paginate(5);
        }
        if (isset($_GET['sort'])) {
            $sortBy = $_GET['sort'];
            $pieces = explode("_", $sortBy);
            $coupon = Coupon::where($pieces[0], $pieces[1])->search()->paginate(5);
        }
        if (isset($_GET['status'])) {
            $sortBy = $_GET['status'];
            $coupon = Coupon::select(array(
                'id',
                'name',
                'discount',
                'status',
                'slug',
                'discount', 'start_date', 'end_date', 'quantity', 'code', 'condition',
                DB::raw("DATEDIFF(end_date,'$now')AS end"),
                DB::raw("DATEDIFF('$now',start_date)AS start")
            ))->where('status', $sortBy)->search()->paginate(5);
        }



        return view('backend.pages.coupon.list_coupon', compact('coupon', 'now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.coupon.add_coupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $coupon = Coupon::create($request->all());
        if ($coupon) {
            Toastr::success('', 'Thêm mới thành công', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->route('ma-giam-gia.index');
        } else {
            Toastr::success('', 'Không thể thêm mới', [
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
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        // $now = Carbon::now()->format('Y-m-d');
        // $end = $coupon->end_date;
        // $d = Coupon::select(DB::raw("DATEDIFF('$end','$now')AS Days"))->get();
        // dd($d);

        return view('backend.pages.coupon.edit_coupon', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Coupon $coupon)
    {
        // dd($request->all());
        $cp = $coupon->update($request->all());
        if ($cp) {
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
            return redirect()->route('ma-giam-gia.index');
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
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {

        if ($coupon->delete()) {
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function unactive($slug)
    {
        Coupon::where('slug', $slug)->update(['status' => 1]);
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
        return redirect()->route('ma-giam-gia.index');
    }
    public function active($slug)
    {
        Coupon::where('slug', $slug)->update(['status' => 0]);
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
        return redirect()->route('ma-giam-gia.index');
    }
    public function sendmail(Request $request)
    {
        $coupon = Coupon::find($request->slug);

        $customer = User::where('role', 'customer')->where('status', 1)->get();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title  = "Mã khuyến mãi ngày" . ' ' . $now;
        $data = [];
        foreach ($customer as  $value) {
            $data['email'][] = $value->email;
        }
        Mail::send('backend.pages.coupon.send_mail', array(
            'name' => $coupon->name,
            'start' => $coupon->start_date,
            'end' => $coupon->end_date,
            'code' => $coupon->code,
            'condition' => $coupon->condition,
            'discount' => $coupon->discount
        ), function ($message) use ($title, $data) {
            $message->to($data['email'])->subject($title);
            $message->from($data['email'], $title);
        });
        return redirect()->back();
    }
}
