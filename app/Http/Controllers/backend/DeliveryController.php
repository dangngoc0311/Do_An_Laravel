<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ship\AddRequest;
use App\Models\City;
use App\Models\Commune;
use App\Models\Delivery;
use App\Models\Province;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Contracts\Provider;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ship = Delivery::orderBy('id', 'DESC')->paginate(6);
        $cities = City::all();
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            $pieces = explode("_", $sortBy);
            $ship = Delivery::orderBy($pieces[0], $pieces[1])->paginate(6);
        }
        return view('backend.pages.ship.list_ship', compact('ship', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();

        return view('backend.pages.ship.add_ship', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $ship =  Delivery::create($request->all());
        if ($ship) {
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
            return redirect()->route('ma-ship.index');
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
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery, $id)
    {

        $cities = City::all();
        $delivery = Delivery::find($id);
        $qh = Province::where('matp', $delivery->tp_id)->get();
        $xa = Commune::where('maqh', $delivery->qh_id)->get();

        return view('backend.pages.ship.edit_ship', compact('delivery', 'cities', 'qh', 'xa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery)
    {
        $delivery = Delivery::find($request->id);
        $delivery->update($request->all());
        if ($delivery->update()) {
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
            return redirect()->route('ma-ship.index');
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
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery, Request $request)
    {
        $delivery = Delivery::find($request->id);
        if ($delivery->delete()) {
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
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
}
