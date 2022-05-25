<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryBlog\UpdateRequest;
use App\Http\Requests\CategoryGallery\AddRequest;
use App\Models\CategoryGallery;
use App\Models\Gallery;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CategoryGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate_gallery = CategoryGallery::orderBy('created_at', 'DESC')->search()->paginate(5);
        if (isset($_GET['status'])) {
            $sortBy = $_GET['status'];
            $cate_gallery = CategoryGallery::where('status', $sortBy)->search()->paginate(5);
        }
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            $pieces = explode("_", $sortBy);
            $cate_gallery = CategoryGallery::orderBy($pieces[0], $pieces[1])->search()->paginate(5);
        }
        return view('backend.pages.category_gallery.list_cate_gallery', compact('cate_gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.category_gallery.add_cate_gallery');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {

        $cate_gallery = CategoryGallery::create($request->all());
        if ($cate_gallery) {
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
            return redirect()->route('danh-muc-bo-suu-tap.index');
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
     * @param  \App\Models\CategoryGallery  $categoryGallery
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryGallery $categoryGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryGallery  $categoryGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryGallery $categoryGallery)
    {
        return view('backend.pages.category_gallery.edit_cate_gallery', compact('categoryGallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryGallery  $categoryGallery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, CategoryGallery $categoryGallery)
    {
        $categoryGallery->update($request->all());
        if ($categoryGallery) {
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
            return redirect()->route('danh-muc-bo-suu-tap.index');
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
     * @param  \App\Models\CategoryGallery  $categoryGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryGallery $categoryGallery)
    {
        $blog = Gallery::where('category_gallery_id', $categoryGallery->id)->pluck('id')->toArray();
        $blog2 = Gallery::where('category_gallery_id', $categoryGallery->id)->get();
        Gallery::whereIn('id', $blog)->delete();
        foreach ($blog2 as $key => $value) {
            unlink(public_path('uploads/' . $value->image));
        }
        if ($categoryGallery->delete()) {
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function unactive($slug)
    {
        CategoryGallery::where('slug', $slug)->update(['status' => 1]);
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
        return redirect()->route('danh-muc-bo-suu-tap.index');
    }
    public function active($slug)
    {
        CategoryGallery::where('slug', $slug)->update(['status' => 0]);
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
        return redirect()->route('danh-muc-bo-suu-tap.index');
    }
}
