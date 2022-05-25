<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery\AddRequest;
use App\Http\Requests\Gallery\UpdateRequest;
use App\Models\CategoryGallery;
use App\Models\Gallery;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::orderBy('created_at', 'DESC')->paginate(3);
        return view('backend.pages.gallery.list_gallery', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate_gallery = CategoryGallery::where('status', 1)->get();
        return view('backend.pages.gallery.add_gallery', compact('cate_gallery'));
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
            $file->move(public_path('uploads/gallery/'), $file_name);
        }
        $request->merge(['image' => $file_name]);
        $gallery = Gallery::create($request->all());
        if ($gallery) {
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
            return redirect()->route('bo-suu-tap.index');
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
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $cate_gallery = CategoryGallery::where('status', 1)->get();

        return view('backend.pages.gallery.edit_gallery', compact('gallery', 'cate_gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Gallery $gallery)
    {
        if ($request->file('file')) {
            unlink(public_path('uploads/gallery/' . $gallery->image));
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/gallery/'), $file_name);
        } else {
            $file_name = $gallery->image;
        }
        $request->merge(['image' => $file_name]);
        $gallery->update($request->all());
        if ($gallery) {
            Toastr::success('', 'Cập nhật danh mục thành công', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->route('bo-suu-tap.index');
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
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery, Request  $request)
    {
        $gallery = Gallery::find($request->id);
        if ($gallery->delete()) {
            unlink(public_path('uploads/gallery/' . $gallery->image));
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function unactive($id)
    {
        Gallery::where('id', $id)->update(['status' => 1]);
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
        return redirect()->route('bo-suu-tap.index');
    }
    public function active($id)
    {
        Gallery::where('id', $id)->update(['status' => 0]);
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
        return redirect()->route('bo-suu-tap.index');
    }
}
