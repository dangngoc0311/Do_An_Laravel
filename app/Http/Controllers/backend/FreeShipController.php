<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FreeShip\AddRequest;
use App\Http\Requests\FreeShip\UpdateRequest;
use App\Models\FreeShip;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FreeShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $now = Carbon::now()->format('Y-m-d');

        $freeShip = FreeShip::select(array(
            'id',
            'name',
            'discount',
            'status',
            'slug',
            'discount', 'start_date', 'end_date', 'quantity', 'code',
            DB::raw("DATEDIFF(end_date,'$now')AS end"),
            DB::raw("DATEDIFF('$now',start_date)AS start")
        ))->search()->paginate(5);
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            $pieces = explode("_", $sortBy);
            $freeShip = FreeShip::select(array(
                'id',
                'name',
                'discount',
                'status',
                'slug',
                'discount', 'start_date', 'end_date', 'quantity', 'code',
                DB::raw("DATEDIFF(end_date,'$now')AS end"),
                DB::raw("DATEDIFF('$now',start_date)AS start")
            ))->orderBy($pieces[0], $pieces[1])->search()->paginate(3);
        }
        if (isset($_GET['filter'])) {
            $sortBy = $_GET['filter'];
            $pieces = explode("_", $sortBy);
            $freeShip = FreeShip::select(array(
                'id',
                'name',
                'discount',
                'status',
                'slug',
                'discount', 'start_date', 'end_date', 'quantity', 'code',
                DB::raw("DATEDIFF(end_date,'$now')AS end"),
                DB::raw("DATEDIFF('$now',start_date)AS start")
            ))->where($pieces[0], $pieces[1])->search()->paginate(5);
        }
        return view('backend.pages.freeship.list_free', compact('freeShip'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.freeship.add_free');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $freeShip = FreeShip::create($request->all());
        if ($freeShip) {
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
            return redirect()->route('ma-free-ship.index');
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
     * @param  \App\Models\FreeShip  $freeShip
     * @return \Illuminate\Http\Response
     */
    public function show(FreeShip $freeShip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FreeShip  $freeShip
     * @return \Illuminate\Http\Response
     */
    public function edit(FreeShip $freeShip)
    {
        return view('backend.pages.freeship.edit_free', compact('freeShip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FreeShip  $freeShip
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, FreeShip $freeShip)
    {
        $cp = $freeShip->update($request->all());
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
            return redirect()->route('ma-free-ship.index');
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
     * @param  \App\Models\FreeShip  $freeShip
     * @return \Illuminate\Http\Response
     */
    public function destroy(FreeShip $freeShip)
    {

        if ($freeShip->delete()) {
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function unactive($slug)
    {
        FreeShip::where('slug', $slug)->update(['status' => 1]);
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
        return redirect()->route('ma-free-ship.index');
    }
    public function active($slug)
    {
        FreeShip::where('slug', $slug)->update(['status' => 0]);
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
        return redirect()->route('ma-free-ship.index');
    }
}
