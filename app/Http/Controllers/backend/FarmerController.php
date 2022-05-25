<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Farmer\AddRequest;
use App\Models\Farmer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $farmers = Farmer::search()->paginate(4);
        if (isset($_GET['status'])) {
            $sortBy = $_GET['status'];
            $farmers = Farmer::where('status',$sortBy)->search()->paginate(5);
        }
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            $pieces = explode("_", $sortBy);
            $farmers = Farmer::orderBy($pieces[0], $pieces[1])->search()->paginate(5);
        }
        return view('backend.pages.farmers.list_farmer', compact('farmers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.farmers.add_farmer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        if ($request->file('file')) {
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/farmer/'), $file_name);
        }
        $request->merge(['image' => $file_name]);
        $farmer = Farmer::create($request->all());
        if ($farmer) {
            Toastr::success('', 'Thêm mới nhân viên thành công', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->route('nhan-vien.index');
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
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function show(Farmer $farmer)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmer $farmer)
    {
        return view('backend.pages.farmers.edit_farmer', compact('farmer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farmer $farmer)
    {
        if ($request->file('file')) {
            unlink(public_path('uploads/farmer/' . $farmer->image));
            File::delete($farmer->image);
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/farmer/'), $file_name);
        } else {
            $file_name = $farmer->image;
        }
        $request->merge(['image' => $file_name]);
        $farmer->update($request->all());
        if ($farmer) {
            Toastr::success('', 'Cập nhật nhân viên thành công', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->route('nhan-vien.index');
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
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farmer $farmer)
    {
        if ($farmer->delete()) {
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function unactive($id)
    {
        Farmer::where('id', $id)->update(['status' => 1]);
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
        return redirect()->route('nhan-vien.index');
    }
    public function active($id)
    {
        Farmer::where('id', $id)->update(['status' => 0]);
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
        return redirect()->route('nhan-vien.index');
    }
}
